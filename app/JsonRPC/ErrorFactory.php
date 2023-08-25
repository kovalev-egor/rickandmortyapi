<?php

namespace App\JsonRPC;

use App\JsonRPC\Response\ErrorJsonRPCResponse;
use App\JsonRPC\Response\JsonRPCResponseBag;

class ErrorFactory
{
    public static function apiError(?int $id = null): void
    {
        $response = new ErrorJsonRPCResponse($id);

        $response->setError(1, 'api error');

        JsonRPCResponseBag::get()->addResponse($response);
    }
}