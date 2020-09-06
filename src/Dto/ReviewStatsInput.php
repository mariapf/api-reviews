<?php


namespace App\Dto;

use App\Repository\HotelRepository;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Hotel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Expression;


class ReviewStatsInput
{
    /**
     * @var int
     *
     * @Assert\NotBlank(
     *     groups={"getReviewStats"},
     * )
     * @Assert\NotNull(
     *     groups={"getReviewStats"},
     * )
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Hotel"
     *
     * )
     */
    private $id;
    /**
     * @var dateTime
     *
     * @Assert\NotBlank(
     *     groups={"getReviewStats"},
     * )
     * @Assert\DateTime(
     *     format="Y-m-d")
     * @var string A "Y-m-d" formatted value
     *
     */
    private $dateStart;
    /**
     * @var dateTime
     *
     * @Assert\NotBlank(
     *     groups={"getReviewStats"},
     * )
     * @Assert\DateTime(format="Y-m-d")
     * @var string A "Y-m-d" formatted value
     *
     * @Assert\Expression(
     *     "this.getDateEnd() >= this.getDateStart()",
     *     message="The start date should be earlier than the end date"
     * )
     */
    private $dateEnd;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

}