<?php

namespace App\Controllers;

use App\Services\LocationService;

class LocationController
{
    public function __construct(
        private LocationService $locationService
    )
    {
    }

    public function getList(array $ids): ?array
    {
        return $this->locationService->getList($ids) ?? [];
    }

    public function charactersCount(int $id): ?array
    {
        return $this->locationService->charactersCount($id);
    }
}