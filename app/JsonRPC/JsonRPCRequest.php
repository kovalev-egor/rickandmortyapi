<?php

namespace App\JsonRPC;

class JsonRPCRequest
{
    public function __construct(
        public $jsonrpc = "2.0",
        public int $id,
        public string $method,
        public array $params
    )
    {
    }

    public function toJson(): string
    {
        return json_encode((array)$this);
    }
}