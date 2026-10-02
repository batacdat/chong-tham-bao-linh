<?php
/**
 * ==========================================================================
 * THEME FUNCTIONS & SETUP - CHỐNG THẤM BẢO LINH
 * Path: C:\xampp\htdocs\bao-linh\wp-content\themes\bao-linh\functions.php
 * ==========================================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ==========================================================================
 * 1. THIẾT LẬP CHỨC NĂNG CƠ BẢN CHO THEME
 * ==========================================================================
 */
function bl_theme_setup() {

    // Tự động thêm thẻ <title>
    add_theme_support( 'title-tag' );

    // Hỗ trợ ảnh đại diện
    add_theme_support( 'post-thumbnails' );

    // Đăng ký Menu
    register_nav_menus(
        array(
            'primary-menu' => __( 'Menu Chính (Header)', 'bao-linh' ),
            'footer-menu'  => __( 'Menu Chân Trang (Footer)', 'bao-linh' ),
        )
    );

    // Hỗ trợ HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );
}
add_action( 'after_setup_theme', 'bl_theme_setup' );


/**
 * ==========================================================================
 * 2. NẠP CSS & JAVASCRIPT
 * ==========================================================================
 */
function bao_linh_enqueue_scripts() {

    /* --- CSS CHUNG --- */
    $main_css_path = get_template_directory() . '/assets/css/main.css';
    if ( file_exists( $main_css_path ) ) {
        wp_enqueue_style(
            'bl-main-style',
            get_template_directory_uri() . '/assets/css/main.css',
            array(),
            filemtime( $main_css_path )
        );
    }

    $header_css_path = get_template_directory() . '/assets/css/header.css';
    if ( file_exists( $header_css_path ) ) {
        wp_enqueue_style(
            'bl-header-style',
            get_template_directory_uri() . '/assets/css/header.css',
            array( 'bl-main-style' ),
            filemtime( $header_css_path )
        );
    }

    $footer_css_path = get_template_directory() . '/assets/css/footer.css';
    if ( file_exists( $footer_css_path ) ) {
        wp_enqueue_style(
            'bl-footer-style',
            get_template_directory_uri() . '/assets/css/footer.css',
            array( 'bl-main-style' ),
            filemtime( $footer_css_path )
        );
    }

    /* --- HEADER JAVASCRIPT --- */
    $header_js_path = get_template_directory() . '/assets/js/header.js';
    if ( file_exists( $header_js_path ) ) {
        wp_enqueue_script(
            'bl-header-script',
            get_template_directory_uri() . '/assets/js/header.js',
            array(),
            filemtime( $header_js_path ),
            true
        );
    }

    /* --- TRANG CHỦ --- */
    if ( is_front_page() ) {
        wp_enqueue_style(
            'swiper-css',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
            array(),
            '11.0.0'
        );

        wp_enqueue_script(
            'swiper-js',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
            array(),
            '11.0.0',
            true
        );

        $front_css_path = get_template_directory() . '/assets/css/front-page.css';
        if ( file_exists( $front_css_path ) ) {
            wp_enqueue_style(
                'bl-front-page-style',
                get_template_directory_uri() . '/assets/css/front-page.css',
                array( 'bl-main-style' ),
                filemtime( $front_css_path )
            );
        }

        $front_js_path = get_template_directory() . '/assets/js/front-page.js';
        if ( file_exists( $front_js_path ) ) {
            wp_enqueue_script(
                'bl-front-page-script',
                get_template_directory_uri() . '/assets/js/front-page.js',
                array( 'swiper-js' ),
                filemtime( $front_js_path ),
                true
            );
        }
    }

    /* --- MODULE SẢN PHẨM & CÁC TRANG CÓ SỬ DỤNG AJAX --- */
    if (
        is_post_type_archive( 'bl_product' ) ||
        is_singular( 'bl_product' ) ||
        is_tax( 'bl_product_cat' ) ||
        is_page( 'san-pham' ) ||
        is_home() ||
        is_front_page()
    ) {
        $product_css_path = get_template_directory() . '/assets/css/product.css';
        if ( file_exists( $product_css_path ) ) {
            wp_enqueue_style(
                'bl-product-style',
                get_template_directory_uri() . '/assets/css/product.css',
                array( 'bl-main-style' ),
                filemtime( $product_css_path )
            );
        }

        $prod_cat_css_path = get_template_directory() . '/assets/css/product-category.css';
        if ( file_exists( $prod_cat_css_path ) ) {
            wp_enqueue_style(
                'bl-product-category-style',
                get_template_directory_uri() . '/assets/css/product-category.css',
                array( 'bl-main-style' ),
                filemtime( $prod_cat_css_path )
            );
        }

        // Đăng ký jQuery và nạp file JS xử lý AJAX Sản phẩm
        wp_enqueue_script( 'jquery' );

        $prod_js_path = get_template_directory() . '/assets/js/product-ajax.js';
        if ( file_exists( $prod_js_path ) ) {
            wp_enqueue_script(
                'bl-product-ajax-script',
                get_template_directory_uri() . '/assets/js/product-ajax.js',
                array( 'jquery' ),
                filemtime( $prod_js_path ),
                true
            );

            // Truyền đối tượng AJAX URL & Nonce vào JavaScript
            wp_localize_script(
                'bl-product-ajax-script',
                'bl_ajax_obj',
                array(
                    'ajax_url' => admin_url( 'admin-ajax.php' ),
                    'nonce'    => wp_create_nonce( 'bl_ajax_nonce' ),
                )
            );
        }
    }

    /* --- TRANG GIỚI THIỆU (ABOUT PAGE) --- */
    if (
        is_page_template( 'page-about.php' ) ||
        is_page( 'gioi-thieu' ) ||
        is_page( 'about' )
    ) {
        $about_css_path = get_template_directory() . '/assets/css/about.css';
        if ( file_exists( $about_css_path ) ) {
            wp_enqueue_style(
                'bl-about-style',
                get_template_directory_uri() . '/assets/css/about.css',
                array( 'bl-main-style' ),
                filemtime( $about_css_path )
            );
        }

        $about_js_path = get_template_directory() . '/assets/js/about.js';
        if ( file_exists( $about_js_path ) ) {
            wp_enqueue_script(
                'bl-about-script',
                get_template_directory_uri() . '/assets/js/about.js',
                array(),
                filemtime( $about_js_path ),
                true
            );
        }
    }

    /* --- TRANG LIÊN HỆ --- */
    if ( is_page_template( 'page-contact.php' ) || is_page( 'lien-he' ) || is_page( 'contact' ) ) {
        $contact_css_path = get_template_directory() . '/assets/css/contact.css';
        if ( file_exists( $contact_css_path ) ) {
            wp_enqueue_style(
                'bl-contact-style',
                get_template_directory_uri() . '/assets/css/contact.css',
                array( 'bl-main-style' ),
                filemtime( $contact_css_path )
            );
        }

        $contact_js_path = get_template_directory() . '/assets/js/contact.js';
        if ( file_exists( $contact_js_path ) ) {
            wp_enqueue_script(
                'bl-contact-script',
                get_template_directory_uri() . '/assets/js/contact.js',
                array(),
                filemtime( $contact_js_path ),
                true
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'bao_linh_enqueue_scripts' );


/**
 * ==========================================================================
 * 3. CONTACT PAGE - XỬ LÝ FORM TƯ VẤN (HTTP POST FALLBACK)
 * ==========================================================================
 */
function bl_handle_contact_form() {
    if (
        ! isset( $_POST['bl_contact_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bl_contact_nonce'] ) ), 'bl_contact_form_action' )
    ) {
        wp_safe_redirect( home_url( '/lien-he/?contact=error' ) );
        exit;
    }

    $name     = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $phone    = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $need     = isset( $_POST['need'] ) ? sanitize_text_field( wp_unslash( $_POST['need'] ) ) : '';
    $category = isset( $_POST['category'] ) ? sanitize_text_field( wp_unslash( $_POST['category'] ) ) : '';
    $message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || empty( $phone ) ) {
        wp_safe_redirect( home_url( '/lien-he/?contact=missing' ) );
        exit;
    }

    $to      = get_option( 'admin_email' );
    $subject = 'Yêu cầu tư vấn mới từ website Bảo Linh';

    $body  = "Có yêu cầu tư vấn mới từ website Bảo Linh.\n\n";
    $body .= "Họ và tên: " . $name . "\n";
    $body .= "Số điện thoại / Zalo: " . $phone . "\n";
    $body .= "Nhu cầu: " . ( $need ? $need : 'Chưa chọn' ) . "\n";
    $body .= "Hạng mục: " . ( $category ? $category : 'Chưa chọn' ) . "\n";
    $body .= "Thông tin công trình: " . ( $message ? $message : 'Không có' ) . "\n";

    $attachments = array();

    if ( ! empty( $_FILES['images']['name'][0] ) ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';

        $files = $_FILES['images'];
        $count = min( count( $files['name'] ), 5 );

        for ( $i = 0; $i < $count; $i++ ) {
            if ( empty( $files['name'][ $i ] ) ) {
                continue;
            }

            $file = array(
                'name'     => $files['name'][ $i ],
                'type'     => $files['type'][ $i ],
                'tmp_name' => $files['tmp_name'][ $i ],
                'error'    => $files['error'][ $i ],
                'size'     => $files['size'][ $i ],
            );

            if ( $file['error'] !== UPLOAD_ERR_OK || $file['size'] > 5 * MB_IN_BYTES ) {
                continue;
            }

            $upload = wp_handle_upload(
                $file,
                array(
                    'test_form' => false,
                    'mimes'     => array(
                        'jpg|jpeg|jpe' => 'image/jpeg',
                        'png'          => 'image/png',
                        'webp'         => 'image/webp',
                    ),
                )
            );

            if ( ! empty( $upload['file'] ) && empty( $upload['error'] ) ) {
                $attachments[] = $upload['file'];
            }
        }
    }

    $sent = wp_mail( $to, $subject, $body, array( 'Content-Type: text/plain; charset=UTF-8' ), $attachments );

    wp_safe_redirect( home_url( $sent ? '/lien-he/?contact=success' : '/lien-he/?contact=mail-error' ) );
    exit;
}
add_action( 'admin_post_bl_contact_form', 'bl_handle_contact_form' );
add_action( 'admin_post_nopriv_bl_contact_form', 'bl_handle_contact_form' );