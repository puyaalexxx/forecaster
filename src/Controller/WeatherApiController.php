<?php

namespace App\Controller;

use App\Entity\Forecast;
use App\Entity\Location;
use App\Exception\LocationNotFoundException;
use App\Service\ForecastService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/weather', name: 'app_weather_api')]
final class WeatherApiController extends AbstractController
{
    public function __construct(private readonly ForecastService $forecastService)
    {
    }

    #[Route('/forecast', name: 'weather_api')]
    public function index(#[MapQueryParameter] string $countryCode, #[MapQueryParameter] string $city): JsonResponse
    {
        /** @var $location  Location */
        /** @var $forecasts Forecast[] */
        try {
            list($location, $forecasts) = $this->forecastService->getForecastsForLocationName($countryCode, $city);
        } catch (LocationNotFoundException $e) {
            return new JsonResponse([
                'status' => 'error',
                'error' => $e->getMessage()
            ],
                Response::HTTP_NOT_FOUND);
        }

        $json = [
            'location_city_name' => $location->getName(),
            'location_country_code' => $location->getCountryCode(),
            'forecasts' => []
        ];

        $cnt = 0;
        foreach ($forecasts as $forecast) {
            $json['forecasts'][$cnt] = [
                'temperature' => $forecast->getTempaeratureCelsius(),
                'humidity' => "{$forecast->getHumidity()}",
                'wind_speed' => "{$forecast->getWindSpeed()}",
                'pressure' => "{$forecast->getPressure()}",
            ];

            $cnt++;
        }

        return new JsonResponse($json, Response::HTTP_OK, []);
    }
}
