# Ckassa ShopAPI PHP SDK
Клиент для работы с Ckassa ShopAPI. 
<a href="https://cabinet.ckassa.ru/doc">Полная документация</a>

### Установка

#### Через Composer
Выполните команду

`composer require ckassa/ckassa-sdk-php`

Или добавьте 

`"ckassa/ckassa-sdk-php": "*"`

в секцию require вашего файла `composer.json`

#### Вручную
Скачайте архив проекта и поместите содержимое каталога lib в ваш проект.
Подключите автозагрузку SDK

`require __DIR__ . '/autoload.php'; `


### Использование
Подключение происходит через класс MerchantShop. Подходит для платежей по поездкам с оплатой на кошелек. Для остальных типов подключений используется MainShop

#### Создание подключения
```php
$shop = new MerchantShop(
    'Секретный ключ',
    'Токен магазина',
    'Путь до сертификата .pem',
    'Пароль от сертификата'
);
```

#### Тестовое подключение
```php
$shop = new TestMerchantShop(
    'Секретный ключ',
    'Токен магазина',
    'Путь до сертификата .pem',
    'Пароль от сертификата'
);
```

#### Регистрация пользователя
```php
$user = $shop->createUser([
    'login' => '79129999999',
    'email' => 'test@test.ru',
    'name' => 'Тест',
    'surName' => 'Тест',
    'middleName' => 'Тест'
]);
```

#### Регистрация мерчанта
```php
$merchant = $shop->createMerchant([
    'phone' => '79129999999'
]);
```

#### Регистрация карты
После вызова метода возвращается объект класса Payment, поскольку регистрация по факту является списанием и возвратом денежных средств с карты (платежом). В объекте содержится ссылка на интерфейс ввода данных карты для регистрации.
userToken можно получить в методе *Регистрация пользователя*
```php
$payment = $shop->createCard([
    'userToken' => $user->getUserToken()
]);
```

#### Получение списка карт
```php
$cards = $shop->getCardsList('токен пользователя');
```

#### Создание платежа в пользу мерчанта
* userToken - токен пользователя, может быть получен в методе *Регистрация пользователя*
* cardToken - токен карты, может быть получен в методе *Получение списка карт*
* merchantToken - токен мерчанта, может быть получен в методе *Регистрация мерчанта*
```php
$payment = $shop->createPayment([
    'serviceCode' => 'код услуги',
    'amount' => 'сумма списания',
    'comission' => 'сумма комиссии',
    'orderId' => 'номер заказа',
    'userToken' => 'токен пользователя',
    'cardToken' => 'токен карты',
    'merchantToken' => 'токен мерчанта'
]);
```

Пример запроса
```php
$payment = $shop->createPayment([
    'serviceCode' => '100-13864-4',
    'amount' => '2000',
    'comission' => 0,
    'orderId' => '006',
    'userToken' => $user->getUserToken(),
    'cardToken' => $card->getCardToken(),
    'merchantToken' => $merchant->getMerchantToken()
]);
```

Пример ответа
```php
Ckassa\Model\Payment Object
(
    [regPayNum:Ckassa\Model\Payment:private] => 13795357436
    [methodType:Ckassa\Model\Payment:private] => GET
    [userToken:Ckassa\Model\Payment:private] => Токен пользователя
    [userPhone:Ckassa\Model\Payment:private] => 
    [payUrl:Ckassa\Model\Payment:private] => https://ckassa.ru/ticket/123
    [merchantToken:Ckassa\Model\Payment:private] => Токен мерчанта
)
```

#### Получение статуса платежа
```php
$payment = $shop->getPaymentInfo('номер платежа');
```

#### Подтверждение оказания услуги
При передаче суммы платежа в данном случае вычитается комиссия. Например, при начальной сумме платежа 1100 коп. передается 1063 коп.
```php
$shop->confirmPayment('номер платежа', 'номер заказа', 1063);
```

### Использование для всех типов магазина, кроме оплаты поездок на кошелек
В данном случае для подключения используется класс MainShop

#### Создание платежа
В этом методе не требуется передавать токен карты
```php
$payment = $shop->createPayment([
    'serviceCode' => 'код услуги',
    'userToken' => 'токен пользовател',
    'amount' => 'сумма платежа в копейках',
    'comission' =>  'сумма комиссии',
    'enableSMSConfirm' => 'смс подтверждение',
    'properties' => 'реквизиты'
]);
```

Пример запроса
```php
$payment = $shop->createPayment([
    'serviceCode' => '979-13689-15',
    'userToken' => $user->getUserToken(),
    'amount' => 1000,
    'comission' => 40,
    'enableSMSConfirm' => 'true',
    'properties' => [
        ['name' => 'НОМЕР_ТЕЛЕФОНА', 'value' => '9129999999']
    ]
]);
```

#### Создание анонимного платежа
```php
$payment = $shop->createAnonymousPayment([
    'serviceCode' => 'код услуги',
    'amount' => 'сумма в копейках',
    'comission' => 'комиссия',
    'enableSMSConfirm' => 'смс подтверждение',
    'properties' => 'реквизиты платежа'
]);
```

Пример запроса
```php
$payment = $shop->createAnonymousPayment([
    'serviceCode' => '979-13689-15',
    'amount' => 1000,
    'comission' => 40,
    'enableSMSConfirm' => 'true',
    'properties' => [
        ['name' => 'НОМЕР_ТЕЛЕФОНА', 'value' => '9129999999']
    ]
]);
```
