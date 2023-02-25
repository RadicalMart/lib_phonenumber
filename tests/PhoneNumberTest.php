<?php

namespace RadicalMart\PhoneNumber\Tests;

use libphonenumber\PhoneNumberFormat;
use PHPUnit\Framework\TestCase;
use RadicalMart\PhoneNumber\Exception\InvalidRegionCodeException;
use RadicalMart\PhoneNumber\PhoneNumber;

class PhoneNumberTest extends TestCase
{
    private $phoneNumberRU;
    private $phoneNumberRUStatic;
    private $phoneNumberUA;
    private $phoneNumberUAStatic;
    private $phoneNumberDPR;

    private $cases_matrix
        = [
            'phoneNumberRU',
            'phoneNumberRUStatic',
            'phoneNumberUA',
            'phoneNumberUAStatic',
            'phoneNumberDPR',
        ];

    public function setUp(): void
    {
        $this->phoneNumberRU       = new PhoneNumber('9534368115');
        $this->phoneNumberRUStatic = new PhoneNumber('88124445566');
        $this->phoneNumberUA       = new PhoneNumber('0679998877', 'UA');
        $this->phoneNumberUAStatic = new PhoneNumber('0445554488', 'UA');
        $this->phoneNumberDPR      = new PhoneNumber('9491312011');
    }

    public function testInvalidRegionCodeException()
    {
        $this->expectException(InvalidRegionCodeException::class);
        new PhoneNumber('8 495 625 35 81', 'UA');
    }

    public function testGeocode()
    {
        $language_codes_matrix = [
            'ru-RU',
            'uk-UA',
            'en-GB'
        ];

        $expected_results = [
            'phoneNumberRU'       => [
                'Россия',
                'Росія',
                'Russia',
            ],
            'phoneNumberRUStatic' => [
                'г. Санкт-Петербург',
                'St Petersburg',
                'St Petersburg',
            ],
            'phoneNumberUA'       => [
                'Украина',
                'Україна',
                'Ukraine',
            ],
            'phoneNumberUAStatic' => [
                'Kyiv city',
                'м. Київ',
                'Kyiv city',
            ],
            'phoneNumberDPR'      => [
                'Россия',
                'Росія',
                'Russia',
            ],
        ];

        foreach ($this->cases_matrix as $case) {
            $this->assertEquals($expected_results[$case][0], $this->{$case}->geocode());
            foreach ($language_codes_matrix as $k => $language_code) {
                $this->assertEquals($expected_results[$case][$k], $this->{$case}->geocode($language_code));
            }
        }
    }

    public function testCarrier()
    {
        $language_codes_matrix = [
            'ru-RU',
            'uk-UA',
            'en-GB'
        ];

        $expected_results = [
            'phoneNumberRU'       => [
                'Tele2',
                'Tele2',
                'Tele2',
            ],
            'phoneNumberRUStatic' => [
                '',
                '',
                '',
            ],
            'phoneNumberUA'       => [
                'Kyivstar',
                'Київстар',
                'Kyivstar',
            ],
            'phoneNumberUAStatic' => [
                '',
                '',
                '',
            ],
            'phoneNumberDPR'      => [
                'АО ГЛОНАСС',
                'GLONASS',
                'GLONASS',
            ],
        ];

        foreach ($this->cases_matrix as $case) {
            $this->assertEquals($expected_results[$case][0], $this->{$case}->carrier());
            foreach ($language_codes_matrix as $k => $language_code) {
                $this->assertEquals($expected_results[$case][$k], $this->{$case}->carrier($language_code));
            }
        }
    }

    public function testFormat()
    {
        $formats_matrix = [
            PhoneNumberFormat::E164,
            PhoneNumberFormat::INTERNATIONAL,
            PhoneNumberFormat::NATIONAL,
            PhoneNumberFormat::RFC3966,
        ];

        $expected_results = [
            'phoneNumberRU'       => [
                '+79534368115',
                '+7 953 436-81-15',
                '8 (953) 436-81-15',
                'tel:+7-953-436-81-15',
            ],
            'phoneNumberRUStatic' => [
                '+78124445566',
                '+7 812 444-55-66',
                '8 (812) 444-55-66',
                'tel:+7-812-444-55-66',
            ],
            'phoneNumberUA'       => [
                '+380679998877',
                '+380 67 999 8877',
                '067 999 8877',
                'tel:+380-67-999-8877',
            ],
            'phoneNumberUAStatic' => [
                '+380445554488',
                '+380 44 555 4488',
                '044 555 4488',
                'tel:+380-44-555-4488',
            ],
            'phoneNumberDPR'      => [
                '+79491312011',
                '+7 949 131-20-11',
                '8 (949) 131-20-11',
                'tel:+7-949-131-20-11',
            ],
        ];

        foreach ($this->cases_matrix as $case) {
            $this->assertEquals($expected_results[$case][0], $this->{$case}->format());
            foreach ($formats_matrix as $k => $format) {
                $this->assertEquals($expected_results[$case][$k], $this->{$case}->format($format));
            }
        }
    }
}
