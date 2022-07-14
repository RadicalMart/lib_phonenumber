# Бибилотека стандартизации номеров телефонов

Библиотека для разбора, форматирования и проверки международных телефонных номеров. 
Эта библиотека - "обёртка" для библиотеки [giggsey/libphonenumber-for-php](https://github.com/giggsey/libphonenumber-for-php), основанной на libphonenumber от Google.

## Установка

```bash
$ composer require radicalmart/libphonenumber
```

## Применение

### Создание экземпляра класса
Для начала работы необходимо создать экземпляр класса `PhoneNumber` и передать, в качестве аргумента, строку, с номером телефона.

```php
use RadicalMart\PhoneNumber\PhoneNumber;

$phone_number = new PhoneNumber('88124445566');
```

По-умолчанию все номера телефона разбираются для России, а информация о номерах телефонов возвращается на русском языке.
Конструктор класса имеет два необязатеьных параметра - `region` (код страны, в соответсвии с двузначным обозначением по [ISO 3166-1](https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes)) и `language_code` (код языка по [ISO](http://www.lingoes.net/en/translator/langcode.htm))

```php
$phone_number = new PhoneNumber('88124445566', 'RU', 'ru_RU');
```

### Получение отформатированного номера телефона

Для получения отформатированного номера телефона, необходимо вызвать метод format(),  качестве аргумента, передаётся индекс формата. По-умолчанию применяется формат `E164`

```php
use RadicalMart\PhoneNumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;

$phone_number = new PhoneNumber('88124445566');

echo $phone_number->format(); // +78124445566
echo $phone_number->format(PhoneNumberFormat::E164); // +78124445566
echo $phone_number->format(PhoneNumberFormat::INTERNATIONAL); // +7 812 444-55-66
echo $phone_number->format(PhoneNumberFormat::NATIONAL); // 8 (812) 444-55-66
echo $phone_number->format(PhoneNumberFormat::RFC3966); // tel:+7-812-444-55-66
```

### Получение номеров телефонов других стран

Чтобы разбирать номера телефонов других стран, необходимо указать код страны, при создании экземпляра класса

```php
use RadicalMart\PhoneNumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;

$phone_number_ua = new PhoneNumber('0679998877', 'UA');

echo $phone_number_ua->format(PhoneNumberFormat::INTERNATIONAL); // +380 67 999 8877
```

### Получение информации о регионе привязки номера

Для получения информации о регионе привязки номера необходимо вызвать метод `geocode()`. По-умолчанию, информация о регионе вернётся на языке, заданном в конструкторе, но можно передать код языка, в качестве аргумента метода

```php
use RadicalMart\PhoneNumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;

$phone_number_ua = new PhoneNumber('0445554488', 'UA', 'uk-UA');
$phone_number_ru = new PhoneNumber('88124445566', 'RU');

echo $phone_number_ru->geocode(); // г. Санкт-Петербург
echo $phone_number_ru->geocode('en_GB'); // St Petersburg
echo $phone_number_ua->geocode(); // м. Київ
echo $phone_number_ua->geocode('en_GB'); // Kyiv city
```

### Получение информации об операторе связи

Для получения информации об операторе связи, к которому привязан номер телефона, необходимо вызвать метод `carrier()`. По-умолчанию, информация об операторе связи вернётся на языке, заданном в конструкторе, но можно передать код языка, в качестве аргумента метода

```php
use RadicalMart\PhoneNumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;

$phone_number_ua = new PhoneNumber('0679988877', 'UA', 'uk-UA');
$phone_number_ru = new PhoneNumber('9204445566', 'RU');

echo $phone_number_ru->carrier(); // МегаФон
echo $phone_number_ru->carrier('en_GB'); // MegaFon
echo $phone_number_ua->carrier(); // Київстар
echo $phone_number_ua->carrier('en_GB'); // Kyivstar
```