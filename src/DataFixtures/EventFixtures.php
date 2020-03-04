<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;

class EventFixtures extends Fixture
{



    public function load(ObjectManager $manager)
    {

        for ($i=0; $i < 10 ; $i++) { 
            
            $faker = Factory::create('fr_FR');

            $event = new Event();
            $event->setTitle($faker->title);
            $event->setDescription($faker->text);
            $event->setDateEvent(new \DateTime);
            $event->setregister("0");
            $event->setTypeEvent($faker->numberBetween(0, 2));

            $manager->persist($event);

            $manager->flush();
        }

    }
}
