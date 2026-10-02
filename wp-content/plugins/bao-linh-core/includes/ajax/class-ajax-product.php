<?php
/**
 * AJAX Handler: Xử lý Lọc Sản Phẩm & Xem Chi Tiết (Bảo Linh)
 * Path: wp-content/plugins/bao-linh-core/includes/ajax/class-ajax-product.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class BL_Ajax_Product {

    public static function init() {
        // Filter danh sách sản phẩm theo danh mục
        add_action( 'wp_ajax_bl_get_products_by_category', array( __CLASS__, 'get_products_by_category' ) );
        add_action( 'wp_ajax_nopriv_bl_get_products_by_category', array( __CLASS__, 'get_products_by_category' ) );

        // Load chi tiết sản phẩm ở cột bên phải
        add_action( 'wp_ajax_bl_get_product_detail_content', array( __CLASS__, 'get_product_detail_content' ) );
        add_action( 'wp_ajax_nopriv_bl_get_product_detail_content', array( __CLASS__, 'get_product_detail_content' ) );
    }

    public static function get_products_by_category() {
        check_ajax_referer( 'bl_ajax_nonce', 'security' );

        $cat_id = isset( $_POST['cat_id'] ) ? intval( $_POST['cat_id'] ) : 0;

        $args = array(
            'post_type'      => 'bl_product',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        if ( $cat_id > 0 ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'bl_product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            );
        }

        $query    = new WP_Query( $args );
        $html     = '';
        $first_id = 0;

        if ( $query->have_posts() ) {
            $count = 0;
            while ( $query->have_posts() ) {
                $query->the_post();
                $p_id = get_the_ID();
                if ( $count === 0 ) {
                    $first_id = $p_id;
                }

                $active_class = ( $count === 0 ) ? ' active' : '';
                $thumb        = get_the_post_thumbnail_url( $p_id, 'thumbnail' ) ?: get_template_directory_uri() . '/assets/images/no-image.jpg';
                $sku          = get_post_meta( $p_id, '_bl_product_sku', true ) ?: get_post_meta( $p_id, '_bl_sku', true );
                if ( empty( $sku ) ) {
                    $sku = 'BL-PRD-' . $p_id;
                }

                $html .= '<li class="bl-product-item">';
                $html .= '<a href="#" class="bl-product-item-link' . esc_attr( $active_class ) . '" data-product-id="' . esc_attr( $p_id ) . '">';
                $html .= '<div class="bl-product-item-thumb"><img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title() ) . '"></div>';
                $html .= '<div class="bl-product-item-info">';
                $html .= '<span class="bl-product-item-name">' . esc_html( get_the_title() ) . '</span>';
                $html .= '<span class="bl-product-item-sku">Mã: ' . esc_html( $sku ) . '</span>';
                $html .= '</div>';
                $html .= '</a>';
                $html .= '</li>';

                $count++;
            }
            wp_reset_postdata();
        } else {
            $html = '<li style="font-size:13px; color:#94a3b8; padding:10px;">Không có sản phẩm nào trong danh mục này.</li>';
        }

        wp_send_json_success( array(
            'products_html'    => $html,
            'first_product_id' => $first_id,
        ) );
    }

    public static function get_product_detail_content() {
        check_ajax_referer( 'bl_ajax_nonce', 'security' );

        $prod_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;

        if ( ! $prod_id ) {
            wp_send_json_error( 'Sản phẩm không hợp lệ.' );
        }

        $post = get_post( $prod_id );
        if ( ! $post || $post->post_type !== 'bl_product' ) {
            wp_send_json_error( 'Không tìm thấy dữ liệu sản phẩm.' );
        }

        $sku         = get_post_meta( $prod_id, '_bl_product_sku', true ) ?: get_post_meta( $prod_id, '_bl_sku', true );
        $description = get_post_meta( $prod_id, '_bl_product_description', true ) ?: get_post_meta( $prod_id, '_bl_short_description', true );
        $gallery_ids = get_post_meta( $prod_id, '_bl_product_gallery', true );
        $gallery_arr = ! empty( $gallery_ids ) ? array_filter( explode( ',', $gallery_ids ) ) : array();

        $thumb_url   = get_the_post_thumbnail_url( $prod_id, 'full' ) ?: get_template_directory_uri() . '/assets/images/no-image.jpg';
        $thumb_small = get_the_post_thumbnail_url( $prod_id, 'thumbnail' ) ?: $thumb_url;

        ob_start();
        ?>
        <div class="product-detail-layout">
            <!-- Cột Ảnh & Gallery -->
            <div class="product-gallery-container">
                <div class="product-gallery-main">
                    <img id="bl_main_product_img" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>">
                </div>
                <div class="product-gallery-thumbs">
                    <img src="<?php echo esc_url( $thumb_small ); ?>" data-full="<?php echo esc_url( $thumb_url ); ?>" class="bl-thumb-item active" alt="<?php echo esc_attr( $post->post_title ); ?>">
                    <?php foreach ( $gallery_arr as $g_id ) : 
                        $g_url   = wp_get_attachment_image_url( $g_id, 'large' );
                        $g_thumb = wp_get_attachment_image_url( $g_id, 'thumbnail' );
                        if ( $g_thumb ) : ?>
                            <img src="<?php echo esc_url( $g_thumb ); ?>" data-full="<?php echo esc_url( $g_url ); ?>" class="bl-thumb-item" alt="<?php echo esc_attr( $post->post_title ); ?>">
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>

            <!-- Cột Thông Tin Căn Bản -->
            <div class="product-info-box">
                <div class="product-info-section">
                    <div class="product-section-heading">📦 THÔNG TIN SẢN PHẨM</div>
                    <h1 class="product-main-title"><?php echo esc_html( $post->post_title ); ?></h1>
                    <?php if ( $sku ) : ?>
                        <div class="product-sku-tag">Mã sản phẩm: <strong><?php echo esc_html( $sku ); ?></strong></div>
                    <?php endif; ?>
                </div>

                <?php if ( $description ) : ?>
                    <div class="product-info-section">
                        <div class="product-section-heading">💡 MÔ TẢ TÓM TẮT</div>
                        <div class="product-description-text">
                            <?php echo nl2br( esc_html( $description ) ); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="product-cta-group">
                    <a href="tel:0903232492" class="btn-cta-call">LIÊN HỆ BÁO GIÁ</a>
                    <a href="https://zalo.me/0903232492" target="_blank" rel="nofollow" class="btn-cta-zalo">TƯ VẤN ZALO</a>
                </div>
            </div>
        </div>

        <!-- Chi tiết kỹ thuật & Quy trình thi công bên dưới -->
        <?php if ( ! empty( $post->post_content ) ) : ?>
            <div class="product-content-sections">
                <h2 class="section-block-title">CHI TIẾT KỸ THUẬT & QUY TRÌNH THI CÔNG</h2>
                <div class="product-description-body">
                    <?php echo apply_filters( 'the_content', $post->post_content ); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php
        $content_html = ob_get_clean();

        wp_send_json_success( array(
            'content_html' => $content_html,
        ) );
    }
}

BL_Ajax_Product::init();