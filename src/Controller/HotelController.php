<?php

namespace App\Controller;

use App\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Dto\Request\DtoResourceInterface;
use App\Dto\ReviewStatsInput;
use App\Infrastructure\Controller\Traits\HasSerializedResponse;
use App\Infrastructure\Repository\ResultCollection;
use App\Repository\HotelRepository;
use App\Service\HotelStatsService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HotelController extends AbstractController
{
    use HasSerializedResponse;

    /** @var HotelRepository */
    private $hotelRepository;

    /** @var HotelStatsService */
    private $hotelStatsService;

    /** @var SerializerInterface  */
    private $serializer;

    /** @var ObjectNormalizer */
    private $normalizer;

    /** @var ValidatorInterface  */
    private $validator;


    /**
     * HotelController constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param HotelRepository $hotelRepository
     * @param HotelStatsService $hotelStatsService
     */
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        HotelRepository $hotelRepository,
        HotelStatsService $hotelStatsService
    )
    {

        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->hotelRepository = $hotelRepository;
        $this->hotelStatsService = $hotelStatsService;
    }


    /**
     * @Route(
     *     "/hotel/{hotelId}/reviews-stats",
     *     name="hotel_stats")
     * @param Request $request
     * @return Response|null
     * @throws Exception
     */
    public function stats(Request $request)
    {

        try {

            /** @var DtoResourceInterface $requestDto */
            $requestDto = $this->serializer->deserialize(
                $request->getContent(),
                ReviewStatsInput::class,
                'json'
            );

            if(!$this->hotelRepository->findById( $requestDto->getId())){
                throw new ResourceNotFoundException( "Resource not found");
            }

            $errors = $this->validator->validate($requestDto);

            if (count($errors) > 0) {
                return new Response($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

                /** @var ResultCollection $statsCollection */
                $statsCollection = $this->hotelStatsService->averageHotelScore(
                    $requestDto->getId(),
                    $requestDto->getDateStart(),
                    $requestDto->getDateEnd());

                $this->setNormalizedResponse();
                return $this->getSerializedResponse($statsCollection);


        } catch (Exception $exception) {
            return new Response($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}
