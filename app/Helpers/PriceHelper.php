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
}



