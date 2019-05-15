<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;

/**
 * Платежная карта
 *
 * @property string $cardMask Маскированый номер карты
 * @property string $exp Время действия в формате MMyyyy
 * @property string $cardToken Токен (используется для создания рекуррентного платежа, активации карты)
 * @property string $cardType Тип карты
 *
 * @package Ckassa\Model
 */
class Card
{
    const CARD_TYPES = ['undefined', 'visa', 'master_card', 'maestro', 'mir'];

    /**
     * @var string Маскированый номер
     */
    private $cardMask;

    /**
     * @var string Время действия
     */
    private $exp;

    /**
     * @var string Токен
     */
    private $cardToken;

    /**
     * @var string Тип карты
     */
    private $cardType;

    /**
     * Card constructor.
     * @param array $cardInfo
     */
    public function __construct(array $cardInfo)
    {
        if (isset($cardInfo['cardMask'])) {
            $this->setCardMask($cardInfo['cardMask']);
        }
        if (isset($cardInfo['exp'])) {
            $this->setExp($cardInfo['exp']);
        }
        if (isset($cardInfo['cardToken'])) {
            $this->setCardToken($cardInfo['cardToken']);
        }
        if (isset($cardInfo['cardType'])) {
            $this->setCardType($cardInfo['cardType']);
        }
    }

    /**
     * @return string
     */
    public function getCardMask()
    {
        return $this->cardMask;
    }

    /**
     * @param $value
     */
    public function setCardMask($value)
    {
        $this->cardMask = (string)$value;
    }

    /**
     * @return string
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param $value
     */
    public function setExp($value)
    {
        $this->exp = (string)$value;
    }

    /**
     * @return string
     */
    public function getCardToken()
    {
        return $this->cardToken;
    }

    /**
     * @param $value
     */
    public function setCardToken($value)
    {
        $this->cardToken = (string)$value;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @param $value
     *
     * @throws ApiException
     */
    public function setCardType($value)
    {
        if (in_array($value, self::CARD_TYPES)) {
            $this->cardType = $value;
        } else {
            throw new ApiException('Invalid card type');
        }
    }
}