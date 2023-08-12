<?php

use App\LuhnValidator;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertEquals;

$validNumbers = [
    "1234567890123452",
    "2345678901234560",
    "4532015112830366",
    "6011514433546201",
    "6771549495586802",
    "4716347184862961",
    "6011111111111117",
];

$invalidNumbers = [
    "3456789012345678",
    "4567890123456786",
    "5678901234567894",
    "6789012345678902",
    "6771549495586805",
    "4716347184862966",
    "6011111111111118",
];

foreach ($validNumbers as $index => $number) {
    it("validates card number {$number} is valid", function () use ($number) {
        assertTrue(LuhnValidator::isValid($number));
    });
}

foreach ($invalidNumbers as $index => $number) {
    it("validates card number {$number} is invalid", function () use ($number) {
        assertFalse(LuhnValidator::isValid($number));
    });
}

// tests for type of card

it('identifies Visa cards', function () {
    assertEquals('Visa', LuhnValidator::cardType('4111111111111111'));
});

it('identifies MasterCard cards', function () {
    assertEquals('MasterCard', LuhnValidator::cardType('5500000000000004'));
});

it('identifies American Express cards', function () {
    assertEquals('American Express', LuhnValidator::cardType('340000000000009'));
});

it('identifies Diners Club cards', function () {
    assertEquals('Diners Club', LuhnValidator::cardType('30000000000004'));
});

it('identifies Discover cards', function () {
    assertEquals('Discover', LuhnValidator::cardType('6011000000000004'));
});

it('identifies JCB cards', function () {
    assertEquals('JCB', LuhnValidator::cardType('3530111333300000'));
});

it('identifies other cards', function () {
    assertEquals('Other', LuhnValidator::cardType('9999999999999999'));
});
