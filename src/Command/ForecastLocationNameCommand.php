<?php

namespace App\Command;

use App\Entity\Forecast;
use App\Entity\Location;
use App\Exception\LocationNotFoundException;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use App\Service\ForecastService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'forecast:location-name',
    description: 'Get forecast for a given country code and location name',
)]
class ForecastLocationNameCommand extends Command
{
    public function __construct(private ForecastService $forecastService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('countryCode', InputArgument::REQUIRED, 'Country code of the location to check')
            ->addArgument('cityName', InputArgument::REQUIRED, 'City/location name to check forecast for');
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $countryCode = $input->getArgument('countryCode');
        $cityName = $input->getArgument('cityName');

        if ($io->isVeryVerbose()){
            $io->writeln("Running command with $cityName, $countryCode");
        }

        try {
            /** @var $location  Location */
            /** @var $forecasts Forecast[] */
            list($location, $forecasts) = $this->forecastService->getForecastsForLocationName($countryCode, $cityName);
        }
        catch (LocationNotFoundException){
            $io->error("Failed to find location with name $cityName and country code $countryCode");
            return Command::FAILURE;
        }

        $io->title("Forecast for {$location->getName()}, {$location->getCountryCode()}");

        $forecastArray = [];
        foreach ($forecasts as $forecast) {
            $forecastArray[] = [
                'Temperature' => "{$forecast->getTempaeratureCelsius()}°C",
                'Humidity' => "{$forecast->getHumidity()}%",
                'Wind Speed' => "{$forecast->getWindSpeed()} km/h",
                'Pressure' => "{$forecast->getPressure()} hPa",
            ];
            //$io->listing((array)"Temperature: {$forecast->getTempaeratureCelsius()}°C, Humidity: {$forecast->getHumidity()}%, Wind Speed: {$forecast->getWindSpeed()} km/h, Pressure: {$forecast->getPressure()} hPa");

            $io->horizontalTable([
                'Temperature',
                'Humidity',
                'Wind Speed',
                'Pressure',
            ], $forecastArray);
        }

        return Command::SUCCESS;
    }
}
