<?php
namespace Ckassa;

use Ckassa\Helpers\DataHelper;

class MerchantShop extends Shop
{
    public $url = 'https://api.autopays.ru/api-shop/rs/merchant/';

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

    public function createMerchant(array $params)
    {
        $path = $this->url . '/registration/merchant';
        return $this->sendRequest($path, $this->prepareCreateMerchantData($params));
    }
}