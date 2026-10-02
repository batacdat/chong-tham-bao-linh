<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Các hàm helper dùng chung cho toàn bộ Plugin & Theme Bảo Linh
 */

// Hàm định dạng giá bán chống thấm
if (!function_exists('bl_format_price')) {
    function bl_format_price($price) {
        if (empty($price) || $price == 0) {
            return 'Liên hệ báo giá';
        }
        return number_format($price, 0, ',', '.') . ' VNĐ';
    }
}