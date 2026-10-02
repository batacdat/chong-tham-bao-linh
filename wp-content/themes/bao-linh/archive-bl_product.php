<?php
/**
 * Template dùng chung cho Trang Sản Phẩm & Trang Danh Mục Sản Phẩm (2 Cột)
 * Theme: bao-linh
 */

get_header();

// Enqueue CSS chuẩn trang sản phẩm
wp_enqueue_style( 'bl-product-style', get_template_directory_uri() . '/assets/css/product.css', array(), '1.2.5' );

// Lấy ID danh mục hiện tại (nếu đang ở trang archive danh mục)
$current_term_id = 0;
if ( is_tax( 'bl_product_cat' ) ) {
    $current_term_id = get_queried_object_id();
} elseif ( is_single() ) {
    $terms           = get_the_terms( get_the_ID(), 'bl_product_cat' );
    $current_term_id = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->term_id : 0;
}

// Lấy sản phẩm mặc định đầu tiên
$args = array(
    'post_type'      => 'bl_product',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
);
if ( $current_term_id > 0 ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'bl_product_cat',
            'field'    => 'term_id',
            'terms'    => $current_term_id,
        ),
    );
}
$init_query         = new WP_Query( $args );
$current_product_id = $init_query->have_posts() ? $init_query->posts[0]->ID : 0;
wp_reset_postdata();
?>

<main class="bl-product-wrapper">
    <!-- HERO BANNER -->
    <header class="bl-product-hero">
        <h1>SẢN PHẨM & VẬT TƯ CHỐNG THẤM BẢO LINH</h1>
        <p>Cung cấp màng chống thấm, phụ gia, keo xử lý sự cố công trình chất lượng cao</p>
    </header>

    <div class="bl-product-grid">
        <!-- CỘT BÊN TRÁI: DANH MỤC & DANH SÁCH SẢN PHẨM -->
        <aside class="bl-product-sidebar">
            
            <!-- Khối 1: Danh Mục -->
            <div class="bl-sidebar-block">
                <div class="bl-sidebar-title">📁 DANH MỤC SẢN PHẨM</div>
                <ul class="bl-cat-list">
                    <?php
                    $all_categories = get_terms( array(
                        'taxonomy'   => 'bl_product_cat',
                        'hide_empty' => false,
                    ) );

                    $active_all = ( $current_term_id === 0 ) ? 'active' : '';
                    echo '<li class="bl-cat-item"><a href="#" class="bl-cat-link ' . $active_all . '" data-cat-id="0"><span>• Tất cả sản phẩm</span></a></li>';

                    if ( ! empty( $all_categories ) && ! is_wp_error( $all_categories ) ) {
                        foreach ( $all_categories as $cat ) {
                            $is_active = ( $current_term_id === $cat->term_id ) ? 'active' : '';
                            echo '<li class="bl-cat-item">';
                            echo '<a href="#" class="bl-cat-link ' . $is_active . '" data-cat-id="' . esc_attr( $cat->term_id ) . '">';
                            echo '<span>• ' . esc_html( $cat->name ) . '</span>';
                            echo '<span class="bl-cat-count">' . esc_html( $cat->count ) . '</span>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- Khối 2: Danh Sách Sản Phẩm -->
            <div class="bl-sidebar-block">
                <div class="bl-sidebar-title">📦 DANH SÁCH SẢN PHẨM</div>
                <ul class="bl-product-list" id="bl-product-list-container">
                    <?php
                    $list_args = array(
                        'post_type'      => 'bl_product',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                    );

                    if ( $current_term_id > 0 ) {
                        $list_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'bl_product_cat',
                                'field'    => 'term_id',
                                'terms'    => $current_term_id,
                            ),
                        );
                    }

                    $product_query = new WP_Query( $list_args );

                    if ( $product_query->have_posts() ) {
                        while ( $product_query->have_posts() ) {
                            $product_query->the_post();
                            $p_id      = get_the_ID();
                            $sku       = get_post_meta( $p_id, '_bl_product_sku', true ) ?: get_post_meta( $p_id, '_bl_sku', true );
                            if ( empty( $sku ) ) { $sku = 'BL-PRD-' . $p_id; }
                            
                            $thumb_url = get_the_post_thumbnail_url( $p_id, 'thumbnail' ) ?: get_template_directory_uri() . '/assets/images/no-image.jpg';
                            $is_active = ( $p_id === $current_product_id ) ? 'active' : '';
                            ?>
                            <li class="bl-product-item">
                                <a href="#" class="bl-product-item-link <?php echo $is_active; ?>" data-product-id="<?php echo esc_attr( $p_id ); ?>">
                                    <div class="bl-product-item-thumb">
                                        <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <div class="bl-product-item-info">
                                        <span class="bl-product-item-name"><?php the_title(); ?></span>
                                        <span class="bl-product-item-sku">Mã: <?php echo esc_html( $sku ); ?></span>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<li style="font-size:13px; color:#94a3b8; padding:10px;">Không tìm thấy sản phẩm nào.</li>';
                    }
                    ?>
                </ul>
            </div>

        </aside>

        <!-- CỘT BÊN PHẢI: CHI TIẾT SẢN PHẨM -->
        <section class="bl-product-content-area" id="bl-product-main-content">
            <div class="bl-loading-overlay" id="bl-product-loading-spinner">Đang tải sản phẩm...</div>
            <div id="bl-product-detail-inner">
                <?php
                if ( $current_product_id > 0 ) :
                    $sku         = get_post_meta( $current_product_id, '_bl_product_sku', true ) ?: get_post_meta( $current_product_id, '_bl_sku', true );
                    $description = get_post_meta( $current_product_id, '_bl_product_description', true ) ?: get_post_meta( $current_product_id, '_bl_short_description', true );
                    $gallery_ids = get_post_meta( $current_product_id, '_bl_product_gallery', true );
                    $gallery_arr = ! empty( $gallery_ids ) ? array_filter( explode( ',', $gallery_ids ) ) : array();

                    $thumb_url = get_the_post_thumbnail_url( $current_product_id, 'full' ) ?: get_template_directory_uri() . '/assets/images/no-image.jpg';
                    $post_obj  = get_post( $current_product_id );
                    ?>

                    <div class="product-detail-layout">
                        <!-- Gallery -->
                        <div class="product-gallery-container">
                            <div class="product-gallery-main">
                                <img id="bl_main_product_img" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $post_obj->post_title ); ?>">
                            </div>
                            <div class="product-gallery-thumbs">
                                <img src="<?php echo esc_url( get_the_post_thumbnail_url( $current_product_id, 'thumbnail' ) ?: $thumb_url ); ?>" data-full="<?php echo esc_url( $thumb_url ); ?>" class="bl-thumb-item active" alt="<?php echo esc_attr( $post_obj->post_title ); ?>">
                                <?php foreach ( $gallery_arr as $g_id ) : 
                                    $g_url   = wp_get_attachment_image_url( $g_id, 'large' );
                                    $g_thumb = wp_get_attachment_image_url( $g_id, 'thumbnail' );
                                    if ( $g_thumb ) : ?>
                                        <img src="<?php echo esc_url( $g_thumb ); ?>" data-full="<?php echo esc_url( $g_url ); ?>" class="bl-thumb-item" alt="<?php echo esc_attr( $post_obj->post_title ); ?>">
                                    <?php endif;
                                endforeach; ?>
                            </div>
                        </div>

                        <!-- Thông Tin -->
                        <div class="product-info-box">
                            <div class="product-info-section">
                                <div class="product-section-heading">📦 THÔNG TIN SẢN PHẨM</div>
                                <h1 class="product-main-title"><?php echo esc_html( $post_obj->post_title ); ?></h1>
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

                    <!-- Nội dung bài viết kỹ thuật -->
                    <?php if ( ! empty( $post_obj->post_content ) ) : ?>
                        <div class="product-content-sections">
                            <h2 class="section-block-title">CHI TIẾT KỸ THUẬT & QUY TRÌNH THI CÔNG</h2>
                            <div class="product-description-body">
                                <?php echo apply_filters( 'the_content', $post_obj->post_content ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php else : ?>
                    <div style="text-align:center; padding:50px; color:#94a3b8;">
                        Không tìm thấy sản phẩm phù hợp.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    var ajaxUrl = "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>";
    var ajaxNonce = "<?php echo wp_create_nonce( 'bl_ajax_nonce' ); ?>";

    // 1. Click thumbnail gallery
    $(document).on('click', '.bl-thumb-item', function() {
        var newSrc = $(this).attr('data-full') || $(this).attr('src');
        $('#bl_main_product_img').attr('src', newSrc);
        $('.bl-thumb-item').removeClass('active');
        $(this).addClass('active');
    });

    // 2. Click Chọn Danh Mục Sản Phẩm
    $(document).on('click', '.bl-cat-link', function(e) {
        e.preventDefault();
        var catId = $(this).data('cat-id');

        $('.bl-cat-link').removeClass('active');
        $(this).addClass('active');

        $('#bl-product-loading-spinner').addClass('active');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'bl_get_products_by_category',
                security: ajaxNonce,
                cat_id: catId
            },
            success: function(response) {
                if (response.success) {
                    $('#bl-product-list-container').html(response.data.products_html);
                    
                    // Nếu danh mục có sản phẩm -> tự động load sản phẩm đầu tiên
                    if (response.data.first_product_id > 0) {
                        loadProductDetail(response.data.first_product_id);
                    } else {
                        $('#bl-product-detail-inner').html('<div style="text-align:center; padding:50px; color:#94a3b8;">Không tìm thấy sản phẩm nào trong danh mục này.</div>');
                        $('#bl-product-loading-spinner').removeClass('active');
                    }
                }
            }
        });
    });

    // 3. Click Chọn Sản Phẩm ở Cột Trái
    $(document).on('click', '.bl-product-item-link', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        $('.bl-product-item-link').removeClass('active');
        $(this).addClass('active');

        loadProductDetail(productId);
    });

    // Hàm load chi tiết sản phẩm lên cột phải
    function loadProductDetail(productId) {
        $('#bl-product-loading-spinner').addClass('active');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'bl_get_product_detail_content',
                security: ajaxNonce,
                product_id: productId
            },
            success: function(response) {
                if (response.success) {
                    $('#bl-product-detail-inner').html(response.data.content_html);
                }
                $('#bl-product-loading-spinner').removeClass('active');
            }
        });
    }
});
</script>

<?php
get_footer();