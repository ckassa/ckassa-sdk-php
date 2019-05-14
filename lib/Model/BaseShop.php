<?php
namespace Ckassa\Model;

use Ckassa\Helpers\DataHelper;

class BaseShop extends Shop
{
    const URL = 'https://tst.autopays.ru/api-shop';
    //public $url = 'https://api.autopays.ru/api-shop';
    public $url = 'https://tst.autopays.ru/api-shop';

    public function createCard(array $params)
    {
        $path = self::URL . '/card/registration';
        $params = DataHelper::transfigureData([
            'clientType',
            'userToken',
            'clientInfo'
        ], $params);
        $result = $this->sendRequest($path, $params);
        return new Card($result);
    }

    public function deactivateCard(string $userToken, string $cardToken)
    {
        $path = self::URL . '/card/deactivation/';
        return $this->sendRequest($path, ['userToken' => $userToken, 'cardToken' => $cardToken]);
    }

    public function getCardsList(string $userToken)
    {
        $path = self::URL . '/ver2/get/cards';
        return $this->sendRequest($path, ['userToken' => $userToken]);
    }

    public function createUser(array $params)
    {
        $path = self::URL . '/user/registration';
        $params = DataHelper::transfigureData([
            'login',
            'email',
            'name',
            'surName',
            'middleName'
        ], $params);
        $result = $this->sendRequest($path, $params);
        return new User($result);
    }

    public function loadUser($login)
    {
        $path = self::URL . '/user/status';
        $result = $this->sendRequest($path, ['login' => $login]);
        return new User($result);
    }
}