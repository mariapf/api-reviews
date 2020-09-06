<?php


namespace App\Infrastructure\Repository;


use App\Dto\ReviewOutput;

final class ResultCollection implements ResultCollectionInterface
{
    /**
     * @var array
     */
    public $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
    /**
     * This will return a single element. It can be of any return type
     */
    public function getSingleResult(string $className)
    {
        $hydratedItems = [];
        foreach ($this->items as $item) {
            $hydratedItems[] = $className::fromArray($item);
        }
        return new self($hydratedItems);
    }

    public function getItems(){
        return $this->items;
    }

    /**
     * Hydrate our result to a DTO object
     * @param string $className
     * @return mixed
     */
    public function hydrateResultsAs(string $className): ResultCollectionInterface
    {
        $hydratedItems = [];
        foreach ($this->items as $item) {
            $hydratedItems[] = $className::fromArray($item);
        }
        return new self($hydratedItems);
    }
}