<?php
declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{id}', name: 'weather')]
    public function index(int $id = 10): Response{

        return $this->render('weather/highlander.html.twig', [
            'message' => 'There can be only one!',
            'id' => $id,
        ]);
    }
}
