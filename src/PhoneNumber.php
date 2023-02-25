<?php

namespace RadicalMart\PhoneNumber;

use libphonenumber\geocoding\PhoneNumberOfflineGeocoder;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;
use RadicalMart\PhoneNumber\Exception\InvalidRegionCodeException;

class PhoneNumber extends \libphonenumber\PhoneNumber
{
    /**
     * Код страны. Устанавливает правила разбора и форматирования номера телефона
     *
     * @var string
     */
    protected $region;

    /**
     * Код языка. Устанавливает код языка, на котором будет выводиться информация о номере телефона
     *
     * @var string
     */
    protected $language_code;

    /**
     * Экземпляр класса утилиты разбора номеров телефонов
     *
     * @var PhoneNumberUtil
     */
    protected $phone_util;

    /**
     * @param string $input Входящая строка, содержит номер телефона, который необходимо отформатированть
     * @param string $region Код страны. Устанавливает правила разбора и форматирования номера телефона
     * @param string $language_code Код языка. Устанавливает код языка, на котором будет выводиться информация о номере телефона
     *
     * @throws \libphonenumber\NumberParseException
     */
    public function __construct(string $input, string $region = 'RU', string $language_code = 'ru-RU')
    {
        $this->region = $region;
        $this->language_code = $language_code;
        $this->phone_util = PhoneNumberUtil::getInstance();

        $this->phone_util->parse($input, $this->region, $this, true);

        if (!$this->phone_util->isValidNumber($this)) {
            throw new InvalidRegionCodeException();
        }
    }

    /**
     * Вернёт отформатированную строку с номером телефона
     *
     * @param int $numberFormat Индекс формата
     *
     * @return string
     */
    public function format(int $numberFormat = PhoneNumberFormat::E164): string
    {
        return $this->phone_util->format($this, $numberFormat);
    }

    /**
     * Вернёт данные о привязке номера к региону
     *
     * @param string|null $language_code Код языка, на котором будет выводиться информация о привязке номера к региону
     *
     * @return string
     */
    public function geocode(string $language_code = null): string
    {
        if (empty($language_code)) {
            $language_code = $this->language_code;
        }

        return PhoneNumberOfflineGeocoder::getInstance()->getDescriptionForNumber($this, $language_code);
    }

    /**
     * Вернёт данные о привязке номера к оператору связи
     *
     * @param string|null $language_code Код языка, на котором будет выводиться информация о привязке номера к оператору связи
     *
     * @return string
     */
    public function carrier(string $language_code = null): string
    {
        if (empty($language_code)) {
            $language_code = $this->language_code;
        }

        return PhoneNumberToCarrierMapper::getInstance()->getNameForNumber($this, $language_code);
    }
}