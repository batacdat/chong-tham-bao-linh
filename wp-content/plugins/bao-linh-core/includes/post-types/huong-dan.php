<?php
/**
 * Post Type: Hướng Dẫn Thi Công (bl_instruction)
 * Path: wp-content/plugins/bao-linh-core/includes/post-types/huong-dan.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_register_instruction_cpt() {
    $labels = array(
        'name'               => _x( 'Hướng dẫn thi công', 'Post Type General Name', 'bao-linh-core' ),
        'singular_name'      => _x( 'Hướng dẫn thi công', 'Post Type Singular Name', 'bao-linh-core' ),
        'menu_name'          => __( 'Hướng Dẫn Thi Công', 'bao-linh-core' ),
        'all_items'          => __( 'Tất cả bài hướng dẫn', 'bao-linh-core' ),
        'add_new_item'       => __( 'Thêm bài hướng dẫn mới', 'bao-linh-core' ),
        'add_new'            => __( 'Thêm mới', 'bao-linh-core' ),
        'edit_item'          => __( 'Sửa bài hướng dẫn', 'bao-linh-core' ),
        'update_item'        => __( 'Cập nhật bài hướng dẫn', 'bao-linh-core' ),
        'search_items'       => __( 'Tìm kiếm hướng dẫn', 'bao-linh-core' ),
        'not_found'          => __( 'Không tìm thấy bài nào', 'bao-linh-core' ),
        'not_found_in_trash' => __( 'Không có bài nào trong thùng rác', 'bao-linh-core' ),
    );

    $args = array(
        'label'               => __( 'Hướng dẫn thi công', 'bao-linh-core' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail', 'excerpt' ), // Dùng Custom Meta Box làm Nội dung chính
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-hammer',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'huong-dan',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'huong-dan',
            'with_front' => false,
        ),
    );

    register_post_type( 'bl_instruction', $args );
}
add_action( 'init', 'bl_register_instruction_cpt' );