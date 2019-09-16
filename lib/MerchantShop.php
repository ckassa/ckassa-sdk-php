<?php
namespace Ckassa;

use Ckassa\Exceptions\ApiException;
use Ckassa\Exceptions\ConnectionException;
use Ckassa\Helpers\DataHelper;
use Ckassa\Model\BaseShop;
use Ckassa\Model\Merchant;
use Ckassa\Model\Payment;

/**
 * Класс для Merchant ShopAPI
 *
 * @package Ckassa
 */
class MerchantShop extends BaseShop
{
    public $url = 'https://api.autopays.ru/api-shop/rs/merchant';

    /**
     * Регистрация мерчанта
     * @param array $params
     *
     * @return Merchant
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function createMerchant(array $params)
    {
        $path = $this->url . '/registration/merchant';
        return new Merchant($this->sendRequest($path, $this->prepareCreateMerchantData($params)));
    }

    /**
     * Создание платежа в пользу мерчанта, оплата с баланса сотового телефона
     * @param array $params
     *
     * @return Payment
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function createMobilePayment(array $params)
    {
        $path = $this->url . '/do/payment/mobile';
        $params = DataHelper::transfigureData([
            'serviceCode',
            'amount',
            'comission',
            'orderId',
            'description',
            'userToken',
            'merchantToken',
            'userPhone',
            'userEmail',
            'fiscalType'
        ], $params);
        return new Payment($this->sendRequest($path, $params));
    }

    /**
     * Создание платежа в пользу мерчанта
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
            'amount',
            'comission',
            'orderId',
            'description',
            'userToken',
            'cardToken',
            'gPayToken',
            'enableSMSConfirm',
            'merchantToken',
            'callName',
            'extraPhone',
            'holdTtl',
            'payType',
            'userEmail',
            'fiscalType'
        ], $params);
        return new Payment($this->sendRequest($path, $params));
    }

    /**
     * Получение баланса мерчанта
     * @param string $merchantToken
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function getBalance($merchantToken)
    {
        $path = $this->url . '/get/merchant/wallet/balance';
        return $this->sendRequest($path, ['merchantToken' => $merchantToken]);
    }

    /**
     * Загрузка информации о мерчанте
     * @param string $login
     *
     * @return Merchant
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function loadMerchant($login)
    {
        $path = $this->url . '/merchant/status';
        return new Merchant($this->sendRequest($path, ['login' => $login]));
    }

    /**
     * Подготовка данных при создании мерчанта
     * @param $data
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    private function prepareCreateMerchantData($data)
    {
        return DataHelper::transfigureData([
            'phone',
            'email',
            'name',
            'surName',
            'middleName',
            'callName',
            'region',
            'docList'
        ], $data);
    }

    /**
     * Бронирование суммы
     * @param array $params
     *
     * @return Payment
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function reservePayment(array $params)
    {
        $path = $this->url . '/do/payment-reserv';
        $params = DataHelper::transfigureData([
            'serviceCode',
            'amount',
            'comission',
            'orderId',
            'description',
            'userToken',
            'cardToken',
            'gPayToken',
            'enableSMSConfirm',
            'holdTtl',
            'payType',
            'userEmail',
            'fiscalType'
        ], $params);
        return new Payment($this->sendRequest($path, $params));
    }

    /**
     * Обновление получателя забронироных средств
     * @param array $params
     *
     * @return Payment
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function updatePaymentMerchant(array $params)
    {
        $path = $this->url . '/update/payment/merchant';
        $params = DataHelper::transfigureData([
            'regPayNum',
            'merchantToken',
            'callName',
            'extraPhone'
        ], $params);
        return new Payment($this->sendRequest($path, $params));
    }
}