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

        $range = $this->calculateRange($start, $end);

        $result = $this->reviewRepository->findAverageReviewsByRange($hotelId, $dateStart, $dateEnd, $range);
        return $result->hydrateResultsAs(ReviewOutput::class);

    }

    /**
     * Get the string range
     * @param $start
     * @param $end
     * @return string
     */
    private function calculateRange($start, $end){
        $daysBetweenDates = (int) $end->diff($start)->days;

        $range = "'day'";

        if ($daysBetweenDates <= 29) {

            $range = "'day'";
        } elseif ($daysBetweenDates <= 89) {

            $range = "'week'";
        } else {

            $range = "'month'";
        }

        return $range;
    }

}