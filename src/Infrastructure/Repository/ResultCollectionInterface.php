<?php


namespace App\Infrastructure\Repository;


interface ResultCollectionInterface
{
    public function getSingleResult(string $className);

    public function getItems();

    public function hydrateResultsAs(string $className) : ResultCollectionInterface;
}