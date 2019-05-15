<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;
use Ckassa\Exceptions\ConnectionException;
use Ckassa\Helpers\DataHelper;

/**
 * Класс для оснвного вида ShopAPI
 *
 * @package Ckassa\Model
 */
class BaseShop extends Shop
{
    const URL = 'https://tst.autopays.ru/api-shop';
    //public $url = 'https://api.autopays.ru/api-shop';
    public $url = 'https://tst.autopays.ru/api-shop';

    /**
     * Подтверждение оказания услуги/заморозки
     * @param string $regPayNum Номер платежа (выдается при создании платежа)
     * @param string $orderId Уникальный номер заказа на стороне магазина
     * @param int $amount Сумма платежа в копейках.
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function confirmPayment(string $regPayNum, string $orderId, int $amount = 0)
    {
        $path = self::URL . '/provision-services/confirm';
        return $this->sendRequest($path, [
            'regPayNum' => $regPayNum,
            'orderId' => $orderId,
            'amount' => $amount
        ]);
    }

    /**
     * Регистрация карты
     * @param array $params
     *
     * @return Payment
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function createCard(array $params)
    {
        $path = self::URL . '/card/registration';
        $params = DataHelper::transfigureData([
            'clientType',
            'userToken',
            'clientInfo'
        ], $params);
        $result = $this->sendRequest($path, $params);
        return new Payment($result);
    }

    /**
     * Регистрация пользователя
     * @param array $params
     *
     * @return User
     *
     * @throws ApiException
     * @throws ConnectionException
     */
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

    /**
     * Деактивация/удаление карты
     * @param string $userToken
     * @param string $cardToken
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function deactivateCard(string $userToken, string $cardToken)
    {
        $path = self::URL . '/card/deactivation/';
        return $this->sendRequest($path, ['userToken' => $userToken, 'cardToken' => $cardToken]);
    }

    /**
     * Получение списка карт
     * @param string $userToken
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function getCardsList(string $userToken)
    {
        $path = self::URL . '/ver2/get/cards';
        $result = $this->sendRequest($path, ['userToken' => $userToken]);
        $cards = [];
        if (isset($result['cards'])) {
            foreach ($result['cards'] as $card) {
                $cards[] = new Card($card);
            }
        }
        return $cards;
    }

    /**
     * Получение статуса платежа
     * @param string $regPayNum
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function getPaymentInfo(string $regPayNum)
    {
        $path = self::URL . '/check/payment/state';
        return $this->sendRequest($path, ['regPayNum' => $regPayNum]);
    }

    /**
     * Загрузка информации о пользователе
     * @param $login
     *
     * @return User
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function loadUser($login)
    {
        $path = self::URL . '/user/status';
        $result = $this->sendRequest($path, ['login' => $login]);
        return new User($result);
    }

    /**
     * Отмена замороженных/забронированных средств
     * @param string $regPayNum
     * @param string $orderId
     *
     * @return array
     *
     * @throws ApiException
     * @throws ConnectionException
     */
    public function refundPayment(string $regPayNum, string $orderId)
    {
        $path = self::URL . '/provision-services/refund';
        return $this->sendRequest($path, [
            'regPayNum' => $regPayNum,
            'orderId' => $orderId
        ]);
    }
}