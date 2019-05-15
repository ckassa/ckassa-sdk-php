<?php
namespace Ckassa\Model;

/**
 * Платеж
 *
 * @property string $regPayNum Номер платежа
 * @property string $methodType Идентификатор мерчанта
 * @property string $userToken Идентификатор пользователя
 * @property string $userPhone Номер телефона пользователя
 * @property string $payUrl Url на страницу с чеком
 * @property string $merchantToken Идентификатор мерчанта
 *
 * @package Ckassa\Model
 */
class Payment
{
    /**
     * @var string Номер платежа
     */
    private $regPayNum;

    /**
     * @var string Идентификатор мерчанта
     */
    private $methodType;

    /**
     * @var string Идентификатор пользователя
     */
    private $userToken;

    /**
     * @var string Номер телефона пользователя
     */
    private $userPhone;

    /**
     * @var string Url на страницу с чеком
     */
    private $payUrl;

    /**
     * @var string Идентификатор мерчанта
     */
    private $merchantToken;

    /**
     * Payment constructor.
     * @param array $paymentInfo
     */
    public function __construct(array $paymentInfo)
    {
        if (isset($paymentInfo['merchantToken'])) {
            $this->setMerchantToken($paymentInfo['merchantToken']);
        }
        if (isset($paymentInfo['regPayNum'])) {
            $this->setRegPayNum($paymentInfo['regPayNum']);
        }
        if (isset($paymentInfo['methodType'])) {
            $this->setMethodType($paymentInfo['methodType']);
        }
        if (isset($paymentInfo['userToken'])) {
            $this->setUserToken($paymentInfo['userToken']);
        }
        if (isset($paymentInfo['userPhone'])) {
            $this->setUserPhone($paymentInfo['userPhone']);
        }
        if (isset($paymentInfo['payUrl'])) {
            $this->setPayUrl($paymentInfo['payUrl']);
        }
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

    /**
     * @return string
     */
    public function getMethodType()
    {
        return $this->methodType;
    }

    /**
     * @param $value
     */
    public function setMethodType($value)
    {
        $this->methodType = (string)$value;
    }

    /**
     * @return string
     */
    public function getPayUrl()
    {
        return $this->payUrl;
    }

    /**
     * @param $value
     */
    public function setPayUrl($value)
    {
        $this->payUrl = (string)$value;
    }

    /**
     * @return string
     */
    public function getRegPayNum()
    {
        return $this->regPayNum;
    }

    /**
     * @param $value
     */
    public function setRegPayNum($value)
    {
        $this->regPayNum = (string)$value;
    }

    /**
     * @return string
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * @param $value
     */
    public function setUserToken($value)
    {
        $this->userToken = (string)$value;
    }

    /**
     * @return string
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * @param $value
     */
    public function setUserPhone($value)
    {
        $this->userPhone = (string)$value;
    }
}