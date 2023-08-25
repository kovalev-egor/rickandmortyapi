<?php

namespace App\JsonRPC;

use App\Controllers\CharacterController;
use App\Controllers\LocationController;

class JsonRPCKernel
{
    public function __construct(
        public CharacterController $character,
        public LocationController $location
    )
    {
    }
}