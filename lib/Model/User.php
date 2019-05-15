<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;

/**
 * Пользователь
 *
 * @property string $login Номер телефона
 * @property string $email Email (отправляются чеки после оплаты)
 * @property string $name Имя
 * @property string $surName Фамилия
 * @property string $middleName Отчество
 * @property string $state Статус
 * @property string $userToken Идентификатор пользователя
 *
 * @package Ckassa\Model
 */
class User
{
    const STATES = ['active', 'inactive', 'disable'];

    /**
     * @var string Номер телефона
     */
    private $login;

    /**
     * @var string Email
     */
    private $email;

    /**
     * @var string Имя
     */
    private $name;

    /**
     * @var string Фамилия
     */
    private $surName;

    /**
     * @var string Отчество
     */
    private $middleName;

    /**
     * @var string Статус
     */
    private $state;

    /**
     * @var string Идентификатор пользователя
     */
    private $userToken;

    /**
     * User constructor.
     * @param array $userInfo
     */
    public function __construct(array $userInfo)
    {
        if (isset($userInfo['login'])) {
            $this->setLogin($userInfo['login']);
        }
        if (isset($userInfo['email'])) {
            $this->setEmail($userInfo['email']);
        }
        if (isset($userInfo['name'])) {
            $this->setName($userInfo['name']);
        }
        if (isset($userInfo['surName'])) {
            $this->setSurName($userInfo['surName']);
        }
        if (isset($userInfo['middleName'])) {
            $this->setMiddleName($userInfo['middleName']);
        }
        if (isset($userInfo['state'])) {
            $this->setState($userInfo['state']);
        }
        if (isset($userInfo['userToken'])) {
            $this->setUserToken($userInfo['userToken']);
        }
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $value
     */
    public function setEmail($value)
    {
        $this->email = (string)$value;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param $value
     */
    public function setLogin($value)
    {
        $this->login = (string)$value;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param $value
     */
    public function setMiddleName($value)
    {
        $this->middleName = (string)$value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->name = (string)$value;
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
     *
     * @throws ApiException
     */
    public function setState($value)
    {
        if (in_array($value, self::STATES)) {
            $this->state = $value;
        } else {
            throw new ApiException('Invalid user state');
        }
    }

    /**
     * @return string
     */
    public function getSurName()
    {
        return $this->surName;
    }

    /**
     * @param $value
     */
    public function setSurName($value)
    {
        $this->surName = (string)$value;
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
}