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

        return $this->render('weather/forecast.html.twig', [
            'countryCode' => $countryCode,
            'city' => $city,
        ]);
    }
}
