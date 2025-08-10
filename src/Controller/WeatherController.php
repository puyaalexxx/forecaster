<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Forecast;
use App\Entity\Location;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use App\Service\ForecastService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{

    function __construct(private readonly ForecastService $forecastService)
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/weather/{countryCode}/{city}', name: 'forecasts')]
    public function forecast(string $countryCode = 'MD', string $city = 'Chisinau'): Response{

        list($location, $forecasts) = $this->forecastService->getForecastsForLocationName($countryCode, $city);

        return $this->render('weather/forecast.html.twig', [
            'forecasts' => $forecasts,
            'location' => $location,
        ]);
    }
}
