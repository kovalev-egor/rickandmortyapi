<?php

namespace App\JsonRPC\Response;

class ResultJsonRPCResponse extends AbstractJsonRPCResponse
{
    private mixed $result;
    public function setResult($result): void
    {
        $this->result = $result;
    }

    public function getResponse(): array
    {
        return [
            'jsonrpc' => '2.0',
            'result' => $this->result,
            'id' => $this->id
        ];
    }
}