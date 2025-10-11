<?php

namespace App\Helpers;

class StatusHelper
{
    /**
     * Get all available status options for products
     *
     * @return array
     */
    public static function getStatusOptions(): array
    {
        return [
            'active' => [
                'label' => 'Hoạt động',
                'class' => 'success',
                'description' => 'Sản phẩm đang được bán'
            ],
            'inactive' => [
                'label' => 'Không hoạt động',
                'class' => 'secondary',
                'description' => 'Sản phẩm tạm ngừng bán'
            ],
            'draft' => [
                'label' => 'Bản nháp',
                'class' => 'warning',
                'description' => 'Sản phẩm chưa hoàn thiện'
            ],
            'out_of_stock' => [
                'label' => 'Hết hàng',
                'class' => 'danger',
                'description' => 'Sản phẩm hết hàng'
            ],
            'discontinued' => [
                'label' => 'Ngừng sản xuất',
                'class' => 'dark',
                'description' => 'Sản phẩm đã ngừng sản xuất'
            ]
        ];
    }

    /**
     * Get status label by key
     *
     * @param string $status
     * @return string
     */
    public static function getStatusLabel(string $status): string
    {
        $options = self::getStatusOptions();
        return $options[$status]['label'] ?? ucfirst($status);
    }

    /**
     * Get status class by key
     *
     * @param string $status
     * @return string
     */
    public static function getStatusClass(string $status): string
    {
        $options = self::getStatusOptions();
        return $options[$status]['class'] ?? 'warning';
    }

    /**
     * Get status description by key
     *
     * @param string $status
     * @return string
     */
    public static function getStatusDescription(string $status): string
    {
        $options = self::getStatusOptions();
        return $options[$status]['description'] ?? '';
    }

    /**
     * Check if status is valid
     *
     * @param string $status
     * @return bool
     */
    public static function isValidStatus(string $status): bool
    {
        $options = self::getStatusOptions();
        return array_key_exists($status, $options);
    }

    /**
     * Get default status
     *
     * @return string
     */
    public static function getDefaultStatus(): string
    {
        return 'draft';
    }
}
