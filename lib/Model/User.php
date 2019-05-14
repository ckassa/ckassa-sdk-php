<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;

class User
{
    const STATES = ['active', 'inactive', 'disable'];

    private $login;
    private $email;
    private $name;
    private $surName;
    private $middleName;
    private $state;
    private $userToken;

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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = (string)$value;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($value)
    {
        $this->login = (string)$value;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function setMiddleName($value)
    {
        $this->middleName = (string)$value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = (string)$value;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($value)
    {
        if (in_array($value, self::STATES)) {
            $this->state = $value;
        } else {
            throw new ApiException('Invalid user state');
        }
    }

    public function getSurName()
    {
        return $this->surName;
    }

    public function setSurName($value)
    {
        $this->surName = (string)$value;
    }

    public function getUserToken()
    {
        return $this->userToken;
    }

    public function setUserToken($value)
    {
        $this->userToken = (string)$value;
    }
}