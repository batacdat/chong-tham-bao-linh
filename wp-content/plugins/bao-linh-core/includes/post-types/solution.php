<?php
/**
 * Đăng ký Custom Post Type: Giải pháp chống thấm (bl_solution)
 * Path: wp-content/plugins/bao-linh-core/includes/post-types/solution.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_register_cpt_solution() {
    $solution_labels = array(
        'name'               => _x( 'Giải pháp', 'Post Type General Name', 'bao-linh-core' ),
        'singular_name'      => _x( 'Giải pháp', 'Post Type Singular Name', 'bao-linh-core' ),
        'menu_name'          => __( 'Giải pháp Chống Thấm', 'bao-linh-core' ),
        'all_items'          => __( 'Tất cả giải pháp', 'bao-linh-core' ),
        'add_new_item'       => __( 'Thêm giải pháp mới', 'bao-linh-core' ),
        'add_new'            => __( 'Thêm mới', 'bao-linh-core' ),
        'edit_item'          => __( 'Sửa giải pháp', 'bao-linh-core' ),
        'update_item'        => __( 'Cập nhật giải pháp', 'bao-linh-core' ),
        'search_items'       => __( 'Tìm kiếm giải pháp', 'bao-linh-core' ),
        'not_found'          => __( 'Không tìm thấy giải pháp nào', 'bao-linh-core' ),
        'not_found_in_trash' => __( 'Không có giải pháp nào trong thùng rác', 'bao-linh-core' ),
    );

    $solution_args = array(
        'label'               => __( 'Giải pháp', 'bao-linh-core' ),
        'labels'              => $solution_labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-shield',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'giai-phap',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'giai-phap',
            'with_front' => false,
        ),
    );

    register_post_type( 'bl_solution', $solution_args );
}
add_action( 'init', 'bl_register_cpt_solution' );