<?php

/**
 * Validate that a value is a number and not negative.
 *
 * @param mixed $value The value to check.
 * @return bool True when the value is numeric and >= 0, false otherwise.
 */
function validateNumber($value)
{
    if (!is_numeric($value)) {
        return false;
    }
    return ($value + 0) >= 0;
}

/**
 * Calculate total price for given price and quantity.
 *
 * @param float $price
 * @param int $qty
 * @return float
 */
function totalPrice($price, $qty)
{
    return $price * $qty;
}
