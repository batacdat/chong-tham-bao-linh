<?php
/**
 * Đăng ký Custom Post Type: Sản phẩm (bl_product)
 * Path: wp-content/plugins/bao-linh-core/includes/post-types/product.php
 */

if (!defined('ABSPATH')) {
    exit;
}

function bl_register_product_post_type() {
    $product_labels = array(
        'name'               => _x('Sản phẩm', 'Post Type General Name', 'bao-linh-core'),
        'singular_name'      => _x('Sản phẩm', 'Post Type Singular Name', 'bao-linh-core'),
        'menu_name'          => __('Sản phẩm Bảo Linh', 'bao-linh-core'),
        'all_items'          => __('Tất cả sản phẩm', 'bao-linh-core'),
        'add_new_item'       => __('Thêm sản phẩm mới', 'bao-linh-core'),
        'add_new'            => __('Thêm mới', 'bao-linh-core'),
        'edit_item'          => __('Sửa sản phẩm', 'bao-linh-core'),
        'update_item'        => __('Cập nhật sản phẩm', 'bao-linh-core'),
        'search_items'       => __('Tìm kiếm sản phẩm', 'bao-linh-core'),
        'not_found'          => __('Không tìm thấy sản phẩm nào', 'bao-linh-core'),
        'not_found_in_trash' => __('Không có sản phẩm nào trong thùng rác', 'bao-linh-core'),
    );

    $product_args = array(
        'label'               => __('Sản phẩm', 'bao-linh-core'),
        'labels'              => $product_labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-products',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'san-pham',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'san-pham',
            'with_front' => false,
        ),
    );

    register_post_type('bl_product', $product_args);
}
add_action('init', 'bl_register_product_post_type');