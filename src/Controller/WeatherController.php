<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{

    #[Route('/weather/{countryCode}/{city}', name: 'weather')]
    public function forecast(string $countryCode, string $city): Response{

        $data = [
            [
              'tempaeratureCelsius' => 20,
              'humidity' => 50,
              'windSpeed' => 10,
              'pressure' => 1012,
            ],
            [
                'tempaeratureCelsius' => 22,
                'humidity' => 55,
                'windSpeed' => 12,
                'pressure' => 1010,
            ],
            [
                'tempaeratureCelsius' => 19,
                'humidity' => 60,
                'windSpeed' => 8,
                'pressure' => 1015,
            ],
        ];

        return $this->render('weather/forecast.html.twig', [
            'forecasts' => $data,
            'countryCode' => $countryCode,
            'city' => $city,
        ]);
    }
}
