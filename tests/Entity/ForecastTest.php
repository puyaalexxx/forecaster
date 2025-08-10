<?php

namespace App\Tests\Entity;

use App\Entity\Forecast;
use PHPUnit\Framework\TestCase;

class ForecastTest extends TestCase
{
    public function testForecast(): void
    {
        $forecast = new Forecast();
        $forecast->setTempaeratureCelsius(20);

        // Test setting and getting humidity
        $forecast->setHumidity(50);
        $this->assertEquals(50, $forecast->getHumidity(), 'Humidity should be 50%');

        // Test setting and getting wind speed
        $forecast->setWindSpeed(10);
        $this->assertEquals(10, $forecast->getWindSpeed(), 'Wind speed should be 10 km/h');

        // Test setting and getting pressure
        $forecast->setPressure(1012);
        $this->assertNotEquals(1013, $forecast->getPressure(), 'Pressure should be 1013 hPa');
    }
}
