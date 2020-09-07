<?php


namespace App\Dto;


use App\Infrastructure\Repository\traits\ConstructableFromArrayTrait;

class ReviewOutput implements ConstructFromArrayInterface
{
    use ConstructableFromArrayTrait;

    /** @var  */
    public $reviewCount;
    /** @var  */
    public $averageScore;
    /** @var  */
    public $dateGroup;



    /**
     * ReviewOutput constructor.
     * @param $reviewCount
     * @param $averageScore
     * @param $dateGroup
     */
    public function __construct($reviewCount, $averageScore, $dateGroup)
    {
        $this->reviewCount = $reviewCount;
        $this->averageScore = $averageScore;
        $this->dateGroup = $dateGroup;
    }

    /**
     * @return mixed
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    /**
     * @param mixed $reviewCount
     */
    public function setReviewCount($reviewCount): void
    {
        $this->reviewCount = $reviewCount;
    }

    /**
     * @return mixed
     */
    public function getAverageScore()
    {
        return $this->averageScore;
    }

    /**
     * @param mixed $averageScore
     */
    public function setAverageScore($averageScore): void
    {
        $this->averageScore = $averageScore;
    }

    /**
     * @return mixed
     */
    public function getDateGroup()
    {
        return $this->dateGroup;
    }

    /**
     * @param mixed $dateGroup
     */
    public function setDateGroup($dateGroup): void
    {
        $this->dateGroup = $dateGroup;
    }

}