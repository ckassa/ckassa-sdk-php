<?php
namespace Ckassa\Model;

/**
 * Мерчант
 *
 * @property string $phone Номер телефона без +
 * @property string $merchantToken Токен
 * @property string $state Статус
 *
 * @package Ckassa\Model
 */
class Merchant
{
    /**
     * @var string Номер телефона
     */
    private $phone;

    /**
     * @var string Токен мерчанта
     */
    private $merchantToken;

    /**
     * @var string Статус мерчанта
     */
    private $state;

    /**
     * Merchant constructor.
     * @param array $merchantInfo
     */
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

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $value
     */
    public function setPhone($value)
    {
        $this->phone = (string)$value;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param $value
     */
    public function setState($value)
    {
        $this->state = (string)$value;
    }

    /**
     * @return string
     */
    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    /**
     * @param $value
     */
    public function setMerchantToken($value)
    {
        $this->merchantToken = (string)$value;
    }
}