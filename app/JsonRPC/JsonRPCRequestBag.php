<?php

namespace App\JsonRPC;

use App\JsonRPC\Response\ErrorJsonRPCResponse;
use App\JsonRPC\Response\JsonRPCResponseBag;

final class JsonRPCRequestBag
{
    private static ?JsonRPCRequestBag $object = null;

    /** @var JsonRPCRequest[] $requests */
    private $requests = [];

    private function __construct()
    {
        $this->parseInput();
    }

    public static function get(): JsonRPCRequestBag
    {
        return self::$object ?? self::$object = new JsonRPCRequestBag();
    }

    private function parseInput(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $body = json_decode(file_get_contents('php://input'), true);

        if ($method != 'POST' || !$body) $this->setError();

        if (!isset($body[0])) $body = [$body];

        foreach ($body as $item) {
            if ($this->validateRequest($item)) $this->requests[] = new JsonRPCRequest(
                jsonrpc: '2.0',
                id: $item['id'],
                method: $item['method'],
                params: $item['params']
            );
        }
    }

    private function setError(?int $id = null): void
    {
        $error = new ErrorJsonRPCResponse($id);
        $error->setError(1, 'error in parsing json');
        JsonRPCResponseBag::get()->addResponse($error);
    }

    private function validateRequest(array $request): bool
    {
        $id = $request['id'] ?? null;

        if (!$id) {
            ErrorFactory::apiError();
            return false;
        }

        if (
            ($request['jsonrpc'] ?? '') != '2.0' ||
            !isset($request['method']) ||
            !isset($request['params'])
        ) {
            ErrorFactory::apiError($id);
            return false;
        }

        return true;
    }

    public function getRequests(): array
    {
        return $this->requests;
    }
}