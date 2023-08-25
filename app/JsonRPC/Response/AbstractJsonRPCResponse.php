<?php

namespace App\JsonRPC\Response;

abstract class AbstractJsonRPCResponse
{
    public function __construct(
        public ?int $id
    )
    {
    }

    public abstract function getResponse(): array;
}