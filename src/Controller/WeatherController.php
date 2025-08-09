<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{

    #[Route('/weather/{countryCode}/{city}', name: 'forecasts')]
    public function forecast(
        LocationRepository $locationRepository, ForecastRepository $forecastRepository,
        string $countryCode = 'MD', string $city = 'Chisinau'): Response{

        $location = $locationRepository->findOneBy(['countryCode' => $countryCode, 'name' => $city]);

        if (!$location) {
            throw $this->createNotFoundException('Location not found');
        }

        $forecasts = $forecastRepository->findForForecast($location);

        return $this->render('weather/forecast.html.twig', [
            'forecasts' => $forecasts,
            'location' => $location,
        ]);
    }
}
