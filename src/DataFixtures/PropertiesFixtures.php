<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Property;
use Faker\Factory;

class PropertiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<100;$i++)
        {
            $property = new Property();
            $property->setTitle($faker->words(3,true))
            ->setDescription($faker->sentences(3,true))
            ->setsurface($faker->numberBetween(20,350))
            ->setRooms($faker->numberBetween(2,10))
            ->setbedrooms($faker->numberBetween(1,9))
            ->setfloor($faker->numberBetween(0,15))
            ->setPrice($faker->numberBetween(10000,150000))
            ->setHeat($faker->numberBetween(0, count(Property::Heat) - 1))
            ->setCity($faker->city)
            ->setAdresse($faker->address)
            ->setPostalCode($faker->postcode)
            ->setSold(false);

            $manager->persist($property);
            
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
