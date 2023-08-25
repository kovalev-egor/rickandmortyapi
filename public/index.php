<?php

declare(strict_types = 1);

error_reporting(E_ALL ^ E_DEPRECATED);

use AdvancedJsonRpc\Dispatcher;
use App\Container;
use App\Handler;
use App\JsonRPC\ErrorFactory;
use App\JsonRPC\JsonRPCKernel;
use App\JsonRPC\Response\JsonRPCResponseBag;
use App\Log;
use Psr\Log\LoggerInterface;

require_once '../vendor/autoload.php';

$container = new Container();

$container->bind(LoggerInterface::class, Log::class);

try {
    $dispatcher = new Dispatcher($container->resolve(JsonRPCKernel::class), '.');
    (new Handler($dispatcher))->run();
} catch (Exception $e) {
    ErrorFactory::apiError();
}

header('Content-Type:text/json');
echo json_encode(JsonRPCResponseBag::get()->getResponse());

