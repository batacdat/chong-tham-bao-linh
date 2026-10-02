<?php
/**
 * Đăng ký Taxonomy: Danh mục sản phẩm (bl_product_cat)
 * Path: wp-content/plugins/bao-linh-core/includes/taxonomies/product-category.php
 */

if (!defined('ABSPATH')) {
    exit;
}

function bl_register_product_taxonomy() {
    $product_cat_labels = array(
        'name'              => _x('Danh mục sản phẩm', 'taxonomy general name', 'bao-linh-core'),
        'singular_name'     => _x('Danh mục sản phẩm', 'taxonomy singular name', 'bao-linh-core'),
        'search_items'      => __('Tìm kiếm danh mục', 'bao-linh-core'),
        'all_items'         => __('Tất cả danh mục', 'bao-linh-core'),
        'parent_item'       => __('Danh mục cha', 'bao-linh-core'),
        'parent_item_colon' => __('Danh mục cha:', 'bao-linh-core'),
        'edit_item'         => __('Sửa danh mục', 'bao-linh-core'),
        'update_item'       => __('Cập nhật danh mục', 'bao-linh-core'),
        'add_new_item'      => __('Thêm danh mục mới', 'bao-linh-core'),
        'new_item_name'     => __('Tên danh mục mới', 'bao-linh-core'),
        'menu_name'         => __('Danh mục sản phẩm', 'bao-linh-core'),
    );

    $product_cat_args = array(
        'hierarchical'      => true,
        'labels'            => $product_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array(
            'slug'         => 'danh-muc-san-pham',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy('bl_product_cat', array('bl_product'), $product_cat_args);
}
add_action('init', 'bl_register_product_taxonomy');