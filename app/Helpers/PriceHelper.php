<?php

namespace App\Helpers;

class PriceHelper
{
    /**
     * Format price with Vietnamese Dong currency
     * 
     * @param float|int $price
     * @param bool $showCurrency
     * @return string
     */
    public static function formatVND($price, $showCurrency = true)
    {
        $formatted = number_format($price, 0, ',', ',');
        
        return $showCurrency ? $formatted . ' ₫' : $formatted;
    }
    
    /**
     * Format price with comma separator for thousands
     * 
     * @param float|int $price
     * @return string
     */
    public static function formatWithCommas($price)
    {
        return number_format($price, 0, ',', ',');
    }

    /**
     * Format percentage value without unnecessary trailing zeros
     * Examples: 10 -> "10%", 12.5 -> "12.5%", 12.00 -> "12%"
     *
     * @param float|int $value
     * @return string
     */
    public static function formatPercentage($value)
    {
        $normalized = rtrim(rtrim(number_format((float)$value, 2, '.', ''), '0'), '.');
        return $normalized . '%';
    }
}



