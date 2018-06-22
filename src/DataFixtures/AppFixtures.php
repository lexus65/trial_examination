<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\FootballLeague;
use App\Entity\FootballTeam;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var mixed is $faker */
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $league = new FootballLeague();
            $league->setName($faker->text(8));
            $manager->persist($league);
            for ($i = 0; $i < 10; $i++) {
                $team = new FootballTeam();
                $team->setName($faker->text(5));
                $team->setStrip($faker->text(10));
                $team->addLeague($league);
                $manager->persist($team);
            }
        }
        $manager->flush();
    }
}