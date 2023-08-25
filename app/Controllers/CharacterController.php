<?php

namespace App\Controllers;

use App\Services\CharacterService;

class CharacterController
{
    public function __construct(
        private CharacterService $characterService
    )
    {
    }

    public function getListByEpisodeId(int $id): ?array
    {
        return $this->characterService->getListByEpisodeId($id);
    }
}