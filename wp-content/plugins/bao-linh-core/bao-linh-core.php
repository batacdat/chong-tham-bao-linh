<?php
/**
 * Plugin Name: Bảo Linh Core Logic
 * Plugin URI:  https://chongthambaolinh.com.vn
 * Description: Plugin quản lý Custom Post Types, Taxonomies, Meta Boxes và Logic nghiệp vụ cho Chống Thấm Bảo Linh.
 * Version:     1.0.0
 * Author:      Bảo Linh Development Team
 * Text Domain: bao-linh-core
 * Domain Path: /languages
 */

// Chống truy cập trực tiếp vào file từ trình duyệt
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Định nghĩa các hằng số cấu hình của Plugin
define( 'BL_CORE_VERSION', '1.0.0' );
define( 'BL_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'BL_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Hàm hỗ trợ tự động require toàn bộ file .php trong một thư mục
 */
function bl_core_require_all_in_dir( $dir_path ) {
    if ( is_dir( $dir_path ) ) {
        $files = glob( rtrim( $dir_path, '/' ) . '/*.php' );
        if ( ! empty( $files ) && is_array( $files ) ) {
            foreach ( $files as $file ) {
                if ( file_exists( $file ) ) {
                    require_once $file;
                }
            }
        }
    }
}

/**
 * 1. Tự động nạp toàn bộ Custom Post Types
 */
bl_core_require_all_in_dir( BL_CORE_DIR . 'includes/post-types' );

/**
 * 2. Tự động nạp toàn bộ Taxonomies
 */
bl_core_require_all_in_dir( BL_CORE_DIR . 'includes/taxonomies' );

/**
 * 3. Tự động nạp toàn bộ Meta Boxes
 */
bl_core_require_all_in_dir( BL_CORE_DIR . 'includes/meta-boxes' );

/**
 * 4. Tự động nạp các file Xử lý AJAX
 */
bl_core_require_all_in_dir( BL_CORE_DIR . 'includes/ajax' );

/**
 * 5. Nạp file Helper chung (nếu tồn tại)
 */
if ( file_exists( BL_CORE_DIR . 'includes/helpers.php' ) ) {
    require_once BL_CORE_DIR . 'includes/helpers.php';
}

/**
 * Cấu hình Hook Kích hoạt Plugin
 */
function bl_core_activate() {
    // Tải lại các đường dẫn tĩnh (Flush Rewrite Rules) khi kích hoạt plugin
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'bl_core_activate' );

/**
 * Cấu hình Hook Hủy kích hoạt Plugin
 */
function bl_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'bl_core_deactivate' );