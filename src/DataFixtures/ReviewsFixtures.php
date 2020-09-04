<?php


namespace App\DataFixtures;


use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReviewsFixtures extends BaseFixture
{

    protected $faker;

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Review::class, 100000, function (Review $review, $count){
            $review->setScore($this->faker->numberBetween(0,5));
            $review->setComment($this->faker->text( 255));
            $review->setCreatedDate($this->faker->dateTimeBetween('-2 years', '-1 seconds'));
            $review->setHotel($this->getReference(Hotel::class.'_'.$this->faker->numberBetween(0, 9)));
        });

        $manager->flush();
    }

}