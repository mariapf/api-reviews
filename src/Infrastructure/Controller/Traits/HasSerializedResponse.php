<?php


namespace App\Infrastructure\Controller\Traits;


use App\Infrastructure\Repository\ResultCollection;
use App\Infrastructure\Transformer\ReviewOutputNameConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait HasSerializedResponse
{

    /**
     * Converts Camel case to underscore
     */
    private function setNormalizedResponse()
    {
        $nameConverter = new ReviewOutputNameConverter();
        $this->normalizer = new ObjectNormalizer(null, $nameConverter);
        $this->serializer = new Serializer([$this->normalizer], [new JsonEncoder()]);
    }

    /**
     * Retuens a json object serialized
     * @param ResultCollection $collection
     * @return JsonResponse
     */
    public function getSerializedResponse(ResultCollection $collection)
    {
        return new JsonResponse(
            $this->serializer->serialize(
                $collection->getItems(),
                'json'
            ),
            Response::HTTP_OK,
            [],
            true
        );
    }

}