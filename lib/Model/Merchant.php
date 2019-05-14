<?php
namespace Ckassa\Model;

class Merchant
{
    private $phone;
    private $merchantToken;
    private $state;

    public function __construct(array $merchantInfo)
    {
        if (isset($merchantInfo['phone'])) {
            $this->setPhone($merchantInfo['phone']);
        }
        if (isset($merchantInfo['state'])) {
            $this->setState($merchantInfo['state']);
        }
        if (isset($merchantInfo['merchantToken'])) {
            $this->setMerchantToken($merchantInfo['merchantToken']);
        }
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($value)
    {
        $this->phone = (string)$value;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($value)
    {
        $this->state = (string)$value;
    }

    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    public function setMerchantToken($value)
    {
        $this->merchantToken = (string)$value;
    }
}