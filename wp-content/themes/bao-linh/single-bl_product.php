<?php
/**
 * Shared Template: Giao diện 2 cột dùng chung cho cả Archive & Single Sản Phẩm
 * Theme: bao-linh
 */

get_header();

// Load CSS sản phẩm
wp_enqueue_style( 'bl-product-style', get_template_directory_uri() . '/assets/css/product.css', array(), '1.2.0' );

// Xác định Post ID hiện tại hoặc lấy sản phẩm mới nhất nếu ở trang Archive
if ( is_single() ) {
    $current_product_id = get_the_ID();
} else {
    $default_query = new WP_Query( array(
        'post_type'      => 'bl_product',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ) );
    $current_product_id = $default_query->have_posts() ? $default_query->posts[0]->ID : 0;
    wp_reset_postdata();
}

// Lấy danh mục sản phẩm hiện tại
$terms           = get_the_terms( $current_product_id, 'bl_product_cat' );
$current_term_id = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->term_id : 0;
?>

<main class="bl-product-wrapper">
    <!-- HEADER HERO BANNER -->
    <header class="bl-product-hero">
        <h1>SẢN PHẨM & VẬT TƯ CHỐNG THẤM BẢO LINH</h1>
        <p>Cung cấp màng chống thấm, phụ gia, keo xử lý sự cố công trình chất lượng cao</p>
    </header>

    <div class="bl-product-grid">
        <!-- CỘT BÊN TRÁI: SIDEBAR NAV & SẢN PHẨM -->
        <aside class="bl-product-sidebar">
            
            <!-- 1. KHỐI DANH MỤC SẢN PHẨM -->
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

            <!-- 2. KHỐI DANH SÁCH SẢN PHẨM (KÈM ẢNH) -->
            <div class="bl-sidebar-block">
                <div class="bl-sidebar-title">📦 DANH SÁCH SẢN PHẨM</div>
                <ul class="bl-product-list" id="bl-product-list-container">
                    <?php
                    $args = array(
                        'post_type'      => 'bl_product',
                        'posts_per_page' => -1,
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

                    $product_query = new WP_Query( $args );

                    if ( $product_query->have_posts() ) {
                        while ( $product_query->have_posts() ) {
                            $product_query->the_post();
                            $p_id      = get_the_ID();
                            $sku       = get_post_meta($p_id, '_bl_product_sku', true);
                            if (empty($sku)) $sku = get_post_meta($p_id, '_bl_sku', true);
                            
                            $thumb_url = get_the_post_thumbnail_url($p_id, 'thumbnail');
                            if (!$thumb_url) {
                                $thumb_url = get_template_directory_uri() . '/assets/images/no-image.jpg';
                            }
                            
                            $is_active = ( $p_id === $current_product_id ) ? 'active' : '';
                            ?>
                            <li class="bl-product-item">
                                <a href="#" class="bl-product-item-link <?php echo $is_active; ?>" data-product-id="<?php echo esc_attr($p_id); ?>">
                                    <div class="bl-product-item-thumb">
                                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <div class="bl-product-item-info">
                                        <span class="bl-product-item-name"><?php the_title(); ?></span>
                                        <?php if ($sku) : ?>
                                            <span class="bl-product-item-sku">Mã: <?php echo esc_html($sku); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<li style="font-size: 13px; color: #94a3b8;">Không có sản phẩm nào.</li>';
                    }
                    ?>
                </ul>
            </div>

        </aside>

        <!-- CỘT BÊN PHẢI: HIỂN THỊ CHI TIẾT SẢN PHẨM ĐANG CHỌN -->
        <section class="bl-product-content-area" id="bl-product-main-content">
            <div class="bl-loading-overlay" id="bl-product-loading-spinner">Đang tải sản phẩm...</div>
            
            <?php
            if ( $current_product_id > 0 ) :
                $sku         = get_post_meta($current_product_id, '_bl_product_sku', true);
                if (empty($sku)) $sku = get_post_meta($current_product_id, '_bl_sku', true);

                $description = get_post_meta($current_product_id, '_bl_product_description', true);
                if (empty($description)) $description = get_post_meta($current_product_id, '_bl_short_description', true);

                $gallery_ids = get_post_meta($current_product_id, '_bl_product_gallery', true);
                $gallery_arr = !empty($gallery_ids) ? array_filter(explode(',', $gallery_ids)) : array();

                $thumb_url = get_the_post_thumbnail_url($current_product_id, 'full');
                $post_obj  = get_post($current_product_id);
                ?>

                <div class="product-detail-layout">
                    <!-- Gallery Ảnh bên trái -->
                    <div class="product-gallery-container">
                        <div class="product-gallery-main">
                            <?php if (has_post_thumbnail($current_product_id)) : ?>
                                <img id="bl_main_product_img" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($post_obj->post_title); ?>">
                            <?php else : ?>
                                <img id="bl_main_product_img" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/no-image.jpg'); ?>" alt="<?php echo esc_attr($post_obj->post_title); ?>">
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($gallery_arr) || has_post_thumbnail($current_product_id)) : ?>
                            <div class="product-gallery-thumbs">
                                <?php if (has_post_thumbnail($current_product_id)) : ?>
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($current_product_id, 'thumbnail')); ?>" 
                                         data-full="<?php echo esc_url($thumb_url); ?>" 
                                         class="bl-thumb-item active" 
                                         alt="<?php echo esc_attr($post_obj->post_title); ?>">
                                <?php endif; ?>

                                <?php foreach ($gallery_arr as $g_id) : 
                                    $g_url   = wp_get_attachment_image_url($g_id, 'large');
                                    $g_thumb = wp_get_attachment_image_url($g_id, 'thumbnail');
                                    if ($g_thumb) : ?>
                                        <img src="<?php echo esc_url($g_thumb); ?>" 
                                             data-full="<?php echo esc_url($g_url); ?>" 
                                             class="bl-thumb-item" 
                                             alt="<?php echo esc_attr($post_obj->post_title); ?>">
                                    <?php endif;
                                endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Thông tin cơ bản bên phải -->
                    <div class="product-info-box">
                        <div class="product-info-section">
                            <div class="product-section-heading">📦 THÔNG TIN SẢN PHẨM</div>
                            <h1 class="product-main-title"><?php echo esc_html($post_obj->post_title); ?></h1>
                            <?php if ($sku) : ?>
                                <div class="product-sku-tag">Mã sản phẩm: <strong><?php echo esc_html($sku); ?></strong></div>
                            <?php endif; ?>
                        </div>

                        <?php if ($description) : ?>
                            <div class="product-info-section">
                                <div class="product-section-heading">💡 MÔ TẢ TÓM TẮT</div>
                                <div class="product-description-text">
                                    <?php echo nl2br(esc_html($description)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="product-cta-group">
                            <a href="tel:0903232492" class="btn-cta-call">LIÊN HỆ BÁO GIÁ</a>
                            <a href="https://zalo.me/0903232492" target="_blank" rel="nofollow" class="btn-cta-zalo">TƯ VẤN ZALO</a>
                        </div>
                    </div>
                </div>

                <!-- Bài viết chi tiết kỹ thuật bên dưới -->
                <?php if (!empty($post_obj->post_content)) : ?>
                    <div class="product-content-sections">
                        <h2 class="section-block-title">CHI TIẾT KỸ THUẬT & QUY TRÌNH THI CÔNG</h2>
                        <div class="product-description-body">
                            <?php echo apply_filters('the_content', $post_obj->post_content); ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <p style="color: #64748b;">Chưa có sản phẩm nào được chọn.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    var ajaxUrl = "<?php echo esc_url( admin_url('admin-ajax.php') ); ?>";

    // 1. Xử lý đổi ảnh Gallery khi click thumbnail
    $(document).on('click', '.bl-thumb-item', function() {
        var newSrc = $(this).attr('data-full') || $(this).attr('src');
        $('#bl_main_product_img').attr('src', newSrc);
        $('.bl-thumb-item').removeClass('active');
        $(this).addClass('active');
    });

    // 2. Bấm chọn Danh Mục
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
                action: 'bl_filter_products',
                cat_id: catId
            },
            success: function(response) {
                if(response.success) {
                    $('#bl-product-list-container').html(response.data.products_html);
                    if(response.data.first_product_id) {
                        loadProductDetail(response.data.first_product_id);
                    } else {
                        $('#bl-product-main-content').html('<p style="color:#64748b; padding:20px;">Không có sản phẩm nào trong danh mục này.</p>');
                        $('#bl-product-loading-spinner').removeClass('active');
                    }
                }
            }
        });
    });

    // 3. Bấm chọn Sản Phẩm bên cột trái
    $(document).on('click', '.bl-product-item-link', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        $('.bl-product-item-link').removeClass('active');
        $(this).addClass('active');

        loadProductDetail(productId);
    });

    function loadProductDetail(productId) {
        $('#bl-product-loading-spinner').addClass('active');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'bl_get_product_detail',
                product_id: productId
            },
            success: function(response) {
                if(response.success) {
                    $('#bl-product-main-content').html(response.data.content_html);
                }
                $('#bl-product-loading-spinner').removeClass('active');
            }
        });
    }
});
</script>

<?php
get_footer();