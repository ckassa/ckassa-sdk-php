<?php
namespace Ckassa;

use Ckassa\Exceptions\ApiException;
use Ckassa\Exceptions\ConnectionException;
use Ckassa\Helpers\DataHelper;
use Ckassa\Model\BaseShop;
use Ckassa\Model\Payment;

/**
 * Создание платежей (анонимный, рекуррентный, обычный)
 *
 * @package Ckassa
 */
class MainShop extends BaseShop
{
    public $url;

    public function __construct($key, $token, $certPath, $certPassword)
    {
        parent::__construct($key, $token, $certPath, $certPassword);
        $this->url = $this->baseUrl . '/rs/shop';
    }

    /**
     * Создание анонимного платежа
     * @param array $params
     *
     * @return Payment
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function createAnonymousPayment(array $params)
    {
        $path = $this->url . '/do/payment/anonymous';
        $params = DataHelper::transfigureData([
            'serviceCode',
            'amount',
            'comission',
            'cardToken',
            'payType',
            'clientType',
            'userPhone',
            'userEmail',
            'fiscalType',
            'properties'
        ], $params);
        return new Payment($this->sendRequest($path, $params));
    }

    /**
     * Создание платежа
     * @param array $params
     *
     * @return Payment
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function createPayment(array $params)
    {
        $path = $this->url . '/do/payment';
        $params = DataHelper::transfigureData([
            'serviceCode',
            'userToken',
            'amount',
            'comission',
            'cardToken',
            'enableSMSConfirm',
            'payType',
            'clientType',
            'userPhone',
            'userEmail',
            'fiscalType',
            'holdTtl',
            'properties'
        ], $params);
        return new Payment($this->sendRequest($path, $params));
    }
}