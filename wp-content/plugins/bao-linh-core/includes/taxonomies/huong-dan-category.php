<?php
/**
 * Taxonomy: Danh Mục Hướng Dẫn Thi Công (bl_instruction_cat)
 * Path: wp-content/plugins/bao-linh-core/includes/taxonomies/huong-dan-category.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_register_instruction_taxonomy() {
    $labels = array(
        'name'              => _x( 'Danh mục hướng dẫn', 'taxonomy general name', 'bao-linh-core' ),
        'singular_name'     => _x( 'Danh mục hướng dẫn', 'taxonomy singular name', 'bao-linh-core' ),
        'search_items'      => __( 'Tìm danh mục', 'bao-linh-core' ),
        'all_items'         => __( 'Tất cả danh mục', 'bao-linh-core' ),
        'parent_item'       => __( 'Danh mục cha', 'bao-linh-core' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'bao-linh-core' ),
        'edit_item'         => __( 'Sửa danh mục', 'bao-linh-core' ),
        'update_item'       => __( 'Cập nhật danh mục', 'bao-linh-core' ),
        'add_new_item'      => __( 'Thêm danh mục mới', 'bao-linh-core' ),
        'new_item_name'     => __( 'Tên danh mục mới', 'bao-linh-core' ),
        'menu_name'         => __( 'Danh mục hướng dẫn', 'bao-linh-core' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array(
            'slug'         => 'danh-muc-huong-dan',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy( 'bl_instruction_cat', array( 'bl_instruction' ), $args );
}
add_action( 'init', 'bl_register_instruction_taxonomy' );