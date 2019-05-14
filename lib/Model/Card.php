<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;

class Card
{
    const TYPES = ['web', 'mobile'];

    private $clientType;
    private $clientInfo;
    private $regPayNum;
    private $methodType;
    private $userToken;
    private $payUrl;

    public function __construct(array $cardInfo)
    {
        if (isset($cardInfo['clientType'])) {
            $this->setClientType($cardInfo['clientType']);
        }
        if (isset($cardInfo['clientInfo'])) {
            $this->setClientInfo($cardInfo['clientInfo']);
        }
        if (isset($cardInfo['regPayNum'])) {
            $this->setRegPayNum($cardInfo['regPayNum']);
        }
        if (isset($cardInfo['methodType'])) {
            $this->setMethodType($cardInfo['methodType']);
        }
        if (isset($cardInfo['userToken'])) {
            $this->setUserToken($cardInfo['userToken']);
        }
        if (isset($cardInfo['payUrl'])) {
            $this->setPayUrl($cardInfo['payUrl']);
        }
    }

    public function getClientInfo()
    {
        return $this->clientInfo;
    }

    public function setClientInfo($value)
    {
        $this->clientInfo = (string)$value;
    }

    public function getClientType()
    {
        return $this->clientType;
    }

    public function setClientType($value)
    {
        if (in_array($value, self::TYPES)) {
            $this->clientType = $value;
        } else {
            throw new ApiException('Invalid client type');
        }
    }

    public function getMethodType()
    {
        return $this->methodType;
    }

    public function setMethodType($value)
    {
        $this->methodType = (string)$value;
    }

    public function getPayUrl()
    {
        return $this->payUrl;
    }

    public function setPayUrl($value)
    {
        $this->payUrl = (string)$value;
    }

    public function getRegPayNum()
    {
        return $this->regPayNum;
    }

    public function setRegPayNum($value)
    {
        $this->regPayNum = (string)$value;
    }

    public function getUserToken()
    {
        return $this->userToken;
    }

    public function setUserToken($value)
    {
        $this->userToken = (string)$value;
    }
}