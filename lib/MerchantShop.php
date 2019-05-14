<?php
namespace Ckassa;

use Ckassa\Helpers\DataHelper;
use Ckassa\Model\BaseShop;
use Ckassa\Model\Merchant;

class MerchantShop extends BaseShop
{
    public $url = 'https://api.autopays.ru/api-shop/rs/merchant/';

    public function createMerchant(array $params)
    {
        $path = $this->url . '/registration/merchant';
        return new Merchant($this->sendRequest($path, $this->prepareCreateMerchantData($params)));
    }

    public function createPayment(array $params)
    {
        $path = $this->url . '/do/payment';
        return $this->sendRequest($path, $this->prepareCreatePaymentData($params));
    }

    public function getBalance(string $merchantToken)
    {
        $path = $this->url . '/get/merchant/wallet/balance';
        return $this->sendRequest($path, ['merchantToken' => $merchantToken]);
    }

    public function loadMerchant(string $login)
    {
        $path = $this->url . '/merchant/status';
        return new Merchant($this->sendRequest($path, ['login' => $login]));
    }

    private function prepareCreateMerchantData($data)
    {
        $data = DataHelper::transfigureData([
            'phone',
            'email',
            'name',
            'surName',
            'middleName',
            'callName',
            'region',
            'docList'
        ], $data);
        if (isset($data['docList'])) {
            foreach ($data['docList'] as $key => $item) {
                $data['docList'][$key] = DataHelper::transfigureData(['type','number'], $item);
            }
        }
        return $data;
    }

    private function prepareCreatePaymentData($data)
    {
        return DataHelper::transfigureData([
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
        ], $data);
    }
}