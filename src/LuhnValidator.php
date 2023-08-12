<?php
// Luhn Validator
namespace App;

class LuhnValidator {
    public static function isValid($number): bool {
        $sum = 0;
        $length = strlen($number);
        for($i = 0; $i < $length; $i++) {
            $digit = intval($number[$length - 1 - $i]);

            if ($i % 2 === 1) {
                // double every other number starting with rightmost
                $digit *= 2;
                // if two digit number, add the two digit number together and add to the sum
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }
        // if the number ends in zero it is valid
        return $sum % 10 === 0;
    }

    public static function cardType($number): string {
        // Reference: https://stackoverflow.com/questions/72768/how-do-you-detect-credit-card-type-based-on-number/72801#72801
        if (preg_match('/^4[0-9]{6,}$/', $number)) {
            return "Visa";
        }
        elseif (preg_match('/^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$/', $number)) {
            return "MasterCard";
        }
        elseif (preg_match('/^3[47][0-9]{5,}$/', $number)) {
            return "American Express";
        }
        elseif (preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{4,}$/', $number)) {
            return "Diners Club";
        }
        elseif (preg_match('/^6(?:011|5[0-9]{2})[0-9]{3,}$/', $number)) {
            return "Discover";
        }
        elseif (preg_match('/^(?:2131|1800|35[0-9]{3})[0-9]{3,}$/', $number)) {
            return "JCB";
        }
        else {
            return "Other";
        }
    }
}