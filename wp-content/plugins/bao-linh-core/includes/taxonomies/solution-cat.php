<?php
/**
 * Đăng ký Custom Taxonomy: Danh mục giải pháp (bl_solution_cat)
 * Path: wp-content/plugins/bao-linh-core/includes/taxonomies/solution-cat.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_register_taxonomy_solution_cat() {
    $solution_cat_labels = array(
        'name'              => _x( 'Danh mục giải pháp', 'taxonomy general name', 'bao-linh-core' ),
        'singular_name'     => _x( 'Danh mục giải pháp', 'taxonomy singular name', 'bao-linh-core' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'bao-linh-core' ),
        'all_items'         => __( 'Tất cả danh mục', 'bao-linh-core' ),
        'parent_item'       => __( 'Danh mục cha', 'bao-linh-core' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'bao-linh-core' ),
        'edit_item'         => __( 'Sửa danh mục', 'bao-linh-core' ),
        'update_item'       => __( 'Cập nhật danh mục', 'bao-linh-core' ),
        'add_new_item'      => __( 'Thêm danh mục mới', 'bao-linh-core' ),
        'new_item_name'     => __( 'Tên danh mục mới', 'bao-linh-core' ),
        'menu_name'         => __( 'Danh mục giải pháp', 'bao-linh-core' ),
    );

    $solution_cat_args = array(
        'hierarchical'      => true,
        'labels'            => $solution_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array(
            'slug'         => 'danh-muc-giai-phap',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy( 'bl_solution_cat', array( 'bl_solution' ), $solution_cat_args );
}
add_action( 'init', 'bl_register_taxonomy_solution_cat' );