<?php
namespace Ckassa\Model;

/**
 * Класс для работы с ответами ShopAPI
 *
 * @property string $code Код ответа
 * @property string $message Сообщение в ответе
 * @property string $userMessage Сообщение для пользователя
 * @property string $body Тело ответа
 *
 * @package Ckassa\Model
 */
class Response
{
    /**
     * @var string Код ответа
     */
    protected $code;

    /**
     * @var string Сообщение в ответе
     */
    protected $message;

    /**
     * @var string Сообщения для пользователя
     */
    protected $userMessage;

    /**
     * @var string Тело ответа
     */
    protected $body;

    /**
     * Response constructor.
     * @param string $response
     */
    public function __construct($response)
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

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getUserMessage()
    {
        return $this->userMessage;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}