<?php

namespace App;

use AdvancedJsonRpc\Dispatcher;
use AdvancedJsonRpc\Error;
use App\JsonRPC\ErrorFactory;
use App\JsonRPC\JsonRPCRequestBag;
use App\JsonRPC\Response\JsonRPCResponseBag;
use App\JsonRPC\Response\ResultJsonRPCResponse;

class Handler
{
    public function __construct(
        private readonly Dispatcher $dispatcher
    )
    {
    }

    public function run(): void
    {
        foreach (JsonRPCRequestBag::get()->getRequests() as $request) {
            try {
                $result = $this->dispatcher->dispatch($request->toJson());

                $response = new ResultJsonRPCResponse($request->id);

                $response->setResult($result);

                JsonRPCResponseBag::get()->addResponse($response);
            } catch (Error $e) {
                ErrorFactory::apiError($request->id);
            }
        }
    }
}