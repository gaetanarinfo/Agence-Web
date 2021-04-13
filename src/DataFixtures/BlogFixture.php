<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BlogFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 12; $i++)
        {
            $blog = new Blog();
            $blog
                ->setTitle($faker->word(100, true))
                ->setSmallContent($faker->sentence(135, true))
                ->setLargeContent($faker->sentence(255, true));
            $manager->persist($blog);    
        }
        $manager->flush();
    }
}
