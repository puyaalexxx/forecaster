<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $location1 = new Location();
        $location1->setName('Chisinau')
            ->setCountryCode('MD')
            ->setLatitude('47.0105')
            ->setLongitute('28.8638');
        $manager->persist($location1);

        $location2 = new Location();
        $location2->setName('Balti')
            ->setCountryCode('MD')
            ->setLatitude('48.0105')
            ->setLongitute('31.8638');
        $manager->persist($location2);

        $forecast = new \App\Entity\Forecast();
        $forecast->setTempaeratureCelsius(20)
            ->setHumidity(50)
            ->setWindSpeed(10)
            ->setPressure(1012)
            ->setLocation($location1);
        $manager->persist($forecast);

        $forecast2 = new \App\Entity\Forecast();
        $forecast2->setTempaeratureCelsius(10)
            ->setHumidity(40)
            ->setWindSpeed(20)
            ->setPressure(1000)
            ->setLocation($location1);
        $manager->persist($forecast2);

        $forecast3 = new \App\Entity\Forecast();
        $forecast3->setTempaeratureCelsius(10)
            ->setHumidity(40)
            ->setWindSpeed(20)
            ->setPressure(1007)
            ->setLocation($location2);
        $manager->persist($forecast3);

        $manager->flush();
    }
}
