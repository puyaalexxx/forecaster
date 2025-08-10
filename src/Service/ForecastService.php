<?php
declare(strict_types=1);


namespace App\Service;

use App\Entity\Forecast;
use App\Exception\LocationNotFoundException;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use Exception;

class ForecastService
{

    function __construct(private LocationRepository $locationRepository, private ForecastRepository $forecastRepository)
    {
    }

    /**
     * @param string $countryCode
     * @param string $locationName
     * @return Forecast[]
     * @throws LocationNotFoundException
     */
    public function getForecastsForLocationName(string $countryCode, string $locationName): array
    {
        $location = $this->locationRepository->findOneBy(['countryCode' => $countryCode, 'name' => $locationName]);

        if (!$location) {
            throw new LocationNotFoundException('Location not found');
        }

        $forecasts = $this->forecastRepository->findForForecast($location);

        return [$location, $forecasts];
    }
}
