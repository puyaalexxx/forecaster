<?php

namespace App\Entity;

use App\Repository\ForecastRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForecastRepository::class)]
class Forecast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $tempaeratureCelsius = null;

    #[ORM\Column]
    private ?int $humidity = null;

    #[ORM\Column]
    private ?int $windSpeed = null;

    #[ORM\Column]
    private ?int $pressure = null;

    #[ORM\ManyToOne(inversedBy: 'forecasts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempaeratureCelsius(): ?int
    {
        return $this->tempaeratureCelsius;
    }

    public function setTempaeratureCelsius(int $tempaeratureCelsius): static
    {
        $this->tempaeratureCelsius = $tempaeratureCelsius;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): static
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getWindSpeed(): ?int
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(int $windSpeed): static
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getPressure(): ?int
    {
        return $this->pressure;
    }

    public function setPressure(int $pressure): static
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }
}
