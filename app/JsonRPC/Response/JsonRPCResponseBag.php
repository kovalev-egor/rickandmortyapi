<?php

namespace App\JsonRPC\Response;

class JsonRPCResponseBag
{
    private static ?JsonRPCResponseBag $object = null;

    private array $bag = [];
    private function __construct()
    {
    }

    public static function get(): JsonRPCResponseBag
    {
        return self::$object ?? self::$object = new JsonRPCResponseBag();
    }

    public function addResponse(AbstractJsonRPCResponse $response): void
    {
        $this->bag[] = $response;
    }

    public function getResponse()
    {
        return count($this->bag) == 1
            ? $this->bag[0]->getResponse()
            : array_map(fn ($response) => $response->getResponse(), $this->bag);
    }
}