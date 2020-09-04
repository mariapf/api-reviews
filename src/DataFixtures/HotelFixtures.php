<?php


namespace App\DataFixtures;


use App\Entity\Hotel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HotelFixtures extends BaseFixture
{

    protected $faker;

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Hotel::class, 10, function (Hotel $hotel, $count){
                $hotel->setName('Hotel '.$this->faker->name);
        });

        $manager->flush();
    }

}