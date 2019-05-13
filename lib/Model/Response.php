<?php
namespace Ckassa\Model;

class Response
{
    protected $code;
    protected $message;
    protected $userMessage;
    protected $body;

    public function __construct(string $response)
    {
        $this->body = $response;
        $response = json_decode($response, true);

        if (isset($response['code'])) {
            $this->code = $response['code'];
        }

        if (isset($response['message'])) {
            $this->message = $response['message'];
        }

        if (isset($response['userMessage'])) {
            $this->userMessage = $response['userMessage'];
        }
    }

    public function checkSign()
    {

    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getUserMessage()
    {
        return $this->userMessage;
    }

    public function getBody()
    {
        return $this->body;
    }
}