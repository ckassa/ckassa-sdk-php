# Ckassa ShopAPI PHP SDK
Клиент для работы с <a href="https://cabinet.ckassa.ru/doc">Ckassa ShopAPI</a>

###Установка

####Через Composer
Выполните команду

`composer require yandex-money/yandex-checkout-sdk-php`

Или добавьте 

`"ckassa/ckassa-sdk-php": "*"`

в секцию require вашего файла `composer.json`

####Вручную
Скачайте архив проекта и поместите содержимое каталога lib в ваш проект
Подключте автозагрузку SDK

`require __DIR__ . '/autoload.php'; `


###Использование
```php
$shop = new MerchantShop($key, $token, $certPath, $certPassword);
$shop->createMerchant([
    'phone' => '79000000000'
]);
$user = $shop->createUser([
    'login' => '79029999999',
    'email' => 'test@ckassa.ru',
    'name' => 'Тест',
    'surName' => 'Тестовый',
    'middleName' => 'Тестович'
]);
```