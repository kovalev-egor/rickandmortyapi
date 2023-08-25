<?php

namespace App\Services;

class LocationService
{
    public function __construct(
        private readonly RickAndMortyApi $rickAndMortyApi
    )
    {
    }

    public function getList(array $ids): ?array
    {
        $implodedIds = implode(',', $ids);
        return $this->rickAndMortyApi->get("location/$implodedIds");
    }

    public function charactersCount(int $id): ?array
    {
        $location = $this->rickAndMortyApi->get("location/$id");

        return $location ? ['count' => count($location['residents'])] : null;
    }
}