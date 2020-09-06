<?php


namespace App\Service;


use App\Dto\ReviewOutput;
use App\Entity\Hotel;
use App\Repository\ReviewRepository;
use DateTime;
use Exception;

class HotelStatsService
{
    /** @var ReviewRepository */
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @param $hotelId
     * @param $dateStart
     * @param $dateEnd
     * @return mixed
     * @throws Exception
     */
    public function averageHotelScore($hotelId, $dateStart, $dateEnd)
    {

        $start = new DateTime($dateStart);
        $end = new DateTime($dateEnd);

        $daysBetweenDates = (int) $end->diff($start)->days;

        $range = "'day'";

        if ($daysBetweenDates <= 29) {

            $range = "'day'";
        } elseif ($daysBetweenDates <= 89) {

            $range = "'week'";
        } else {

            $range = "'month'";
        }

        $result = $this->reviewRepository->findAverageReviewsByRange($hotelId, $dateStart, $dateEnd, $range);
        return $result->hydrateResultsAs(ReviewOutput::class);

        //return $this->reviewRepository->findAverageReviewsByRange($hotelId, $dateStart, $dateEnd, $range)->hydrateResultsAs(ReviewOutput::class);




    }

}