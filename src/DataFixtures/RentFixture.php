<?php

namespace App\DataFixtures;

use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RentFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100; $i++)
        {
            $rent = new Rent();
            $rent
                ->setTitle($faker->words(3, true))
                ->setContent($faker->sentence(3, true))
                ->setSurface($faker->numberBetween(20, 350))
                ->setRooms($faker->numberBetween(2, 10))
                ->setBedrooms($faker->numberBetween(1, 9))
                ->setFloor($faker->numberBetween(0, 15))
                ->setPrice($faker->numberBetween(100, 1000))
                ->setHeat($faker->numberBetween(0, count(Rent::HEAT) - 1))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setAvailable(false);
            $manager->persist($rent);    
        }
        $manager->flush();
    }
}
