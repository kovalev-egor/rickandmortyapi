<?php

namespace App\JsonRPC\Response;

class ErrorJsonRPCResponse extends AbstractJsonRPCResponse
{
    private $code;
    private $message;
    public function setError(int $code, string $message): void
    {
        $this->code = $code;
        $this->message = $message;
    }
    public function getResponse(): array
    {
        return [
            'jsonrpc' => '2.0',
            'error' => [
                'code' => $this->code,
                'message' => $this->message
            ],
            'id' => $this->id
        ];
    }
}