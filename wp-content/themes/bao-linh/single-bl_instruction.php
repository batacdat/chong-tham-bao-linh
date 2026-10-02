<?php
/**
 * Shared Template: Giao diện 2 cột dùng chung cho cả Archive & Single Hướng Dẫn Thi Công
 * Theme: bao-linh
 */

get_header();

// Load CSS giao diện hướng dẫn
wp_enqueue_style( 'bl-instruction-style', get_template_directory_uri() . '/assets/css/instruction-layout.css', array(), '1.1.0' );

// Xác định Post ID hiện tại hoặc lấy bài viết mới nhất nếu đang ở trang Archive
if ( is_single() ) {
    $current_post_id = get_the_ID();
} else {
    $default_query = new WP_Query( array(
        'post_type'      => 'bl_instruction',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ) );
    $current_post_id = $default_query->have_posts() ? $default_query->posts[0]->ID : 0;
    wp_reset_postdata();
}

// Lấy danh mục của bài viết hiện tại
$terms           = get_the_terms( $current_post_id, 'bl_instruction_cat' );
$current_term_id = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->term_id : 0;
?>

<main class="bl-instruction-wrapper">
    <!-- HEADER HERO BANNER -->
    <header class="bl-instruction-hero">
        <h1>HƯỚNG DẪN THI CÔNG CHỐNG THẤM</h1>
        <p>Quy trình thi công thực tế – dễ hiểu – dễ áp dụng</p>
    </header>

    <div class="bl-instruction-grid">
        <!-- CỘT BÊN TRÁI: SIDEBAR NAV -->
        <aside class="bl-instruction-sidebar">
            <!-- 1. DANH MỤC -->
            <div class="bl-sidebar-block">
                <div class="bl-sidebar-title">📁 DANH MỤC</div>
                <ul class="bl-cat-list">
                    <?php
                    $all_categories = get_terms( array(
                        'taxonomy'   => 'bl_instruction_cat',
                        'hide_empty' => false,
                    ) );

                    $active_all = ( $current_term_id === 0 ) ? 'active' : '';
                    echo '<li class="bl-cat-item"><a href="#" class="bl-cat-link ' . $active_all . '" data-cat-id="0"><span>• Tất cả</span></a></li>';

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

            <!-- 2. BÀI HƯỚNG DẪN -->
            <div class="bl-sidebar-block">
                <div class="bl-sidebar-title">📝 BÀI HƯỚNG DẪN</div>
                <ul class="bl-post-list" id="bl-post-list-container">
                    <?php
                    $args = array(
                        'post_type'      => 'bl_instruction',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                    );

                    if ( $current_term_id > 0 ) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'bl_instruction_cat',
                                'field'    => 'term_id',
                                'terms'    => $current_term_id,
                            ),
                        );
                    }

                    $instruction_query = new WP_Query( $args );

                    if ( $instruction_query->have_posts() ) {
                        while ( $instruction_query->have_posts() ) {
                            $instruction_query->the_post();
                            $p_id      = get_the_ID();
                            $is_active = ( $p_id === $current_post_id ) ? 'active' : '';
                            echo '<li class="bl-post-item">';
                            echo '<a href="#" class="bl-post-link ' . $is_active . '" data-post-id="' . esc_attr( $p_id ) . '">';
                            echo esc_html( get_the_title() );
                            echo '</a>';
                            echo '</li>';
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<li style="font-size: 13px; color: #94a3b8;">Không có bài hướng dẫn nào.</li>';
                    }
                    ?>
                </ul>
            </div>
        </aside>

        <!-- CỘT BÊN PHẢI: NỘI DUNG HIỂN THỊ ĐỘNG -->
        <section class="bl-instruction-content-area" id="bl-instruction-main-content">
            <div class="bl-loading-overlay" id="bl-loading-spinner">Đang tải nội dung...</div>
            
            <?php
            if ( $current_post_id > 0 ) :
                $post_obj         = get_post( $current_post_id );
                $product_features = get_post_meta( $current_post_id, '_bl_product_features', true );
                $steps            = get_post_meta( $current_post_id, '_bl_instruction_steps', true );
                $youtube_url      = get_post_meta( $current_post_id, '_bl_youtube_url', true );
                $post_terms       = get_the_terms( $current_post_id, 'bl_instruction_cat' );
                ?>

                <!-- HEADER BÀI VIẾT -->
                <header class="bl-post-header">
                    <h1 class="bl-post-title"><?php echo esc_html( $post_obj->post_title ); ?></h1>
                    <div class="bl-post-meta">
                        <span>🗓️ <?php echo get_the_date( 'd/m/Y', $current_post_id ); ?></span>
                        <?php if ( $post_terms && ! is_wp_error( $post_terms ) ) : ?>
                            <span>📁 <?php echo esc_html( $post_terms[0]->name ); ?></span>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- I. ĐẶC ĐIỂM SẢN PHẨM -->
                <?php if ( ! empty( $product_features ) ) : ?>
                    <section class="bl-section-features">
                        <h2 class="bl-section-title">I. ĐẶC ĐIỂM SẢN PHẨM</h2>
                        <div class="bl-features-body">
                            <?php echo wp_kses_post( $product_features ); ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- II. QUY TRÌNH THI CÔNG -->
                <?php if ( ! empty( $steps ) && is_array( $steps ) ) : ?>
                    <section class="bl-section-steps">
                        <h2 class="bl-section-title">II. QUY TRÌNH THI CÔNG</h2>
                        
                        <?php foreach ( $steps as $idx => $step ) : ?>
                            <div class="bl-step-card">
                                <h3>BƯỚC <?php echo $idx + 1; ?> – <?php echo esc_html( $step['title'] ); ?></h3>
                                <p><?php echo nl2br( esc_html( $step['content'] ) ); ?></p>
                                <?php if ( ! empty( $step['image_id'] ) ) : 
                                    $img_src = wp_get_attachment_image_url( $step['image_id'], 'large' );
                                    if ( $img_src ) : ?>
                                        <div class="bl-step-image">
                                            <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $step['title'] ); ?>">
                                        </div>
                                    <?php endif;
                                endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </section>
                <?php endif; ?>

                <!-- III. VIDEO THAM KHẢO -->
                <?php if ( ! empty( $youtube_url ) ) : 
                    preg_match("#(?<=v=|\/)([\w-]+)(?=&|$)#", $youtube_url, $matches);
                    $video_id = $matches[0] ?? '';
                    if ( $video_id ) : ?>
                        <section class="bl-section-video">
                            <h2 class="bl-section-title">III. VIDEO THAM KHẢO</h2>
                            <div class="bl-video-wrapper">
                                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" allowfullscreen></iframe>
                            </div>
                        </section>
                    <?php endif;
                endif; ?>

            <?php else : ?>
                <p style="color: #64748b;">Chưa có bài hướng dẫn thi công nào được cập nhật.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    var ajaxUrl = "<?php echo esc_url( admin_url('admin-ajax.php') ); ?>";

    // Bấm chọn Danh Mục
    $(document).on('click', '.bl-cat-link', function(e) {
        e.preventDefault();
        var catId = $(this).data('cat-id');

        $('.bl-cat-link').removeClass('active');
        $(this).addClass('active');

        $('#bl-loading-spinner').addClass('active');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'bl_filter_instruction_posts',
                cat_id: catId
            },
            success: function(response) {
                if(response.success) {
                    $('#bl-post-list-container').html(response.data.posts_html);
                    if(response.data.first_post_id) {
                        loadPostContent(response.data.first_post_id);
                    } else {
                        $('#bl-instruction-main-content').html('<p style="color:#64748b; padding:20px;">Không có bài viết nào trong danh mục này.</p>');
                        $('#bl-loading-spinner').removeClass('active');
                    }
                }
            }
        });
    });

    // Bấm chọn Bài Hướng Dẫn
    $(document).on('click', '.bl-post-link', function(e) {
        e.preventDefault();
        var postId = $(this).data('post-id');

        $('.bl-post-link').removeClass('active');
        $(this).addClass('active');

        loadPostContent(postId);
    });

    function loadPostContent(postId) {
        $('#bl-loading-spinner').addClass('active');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'bl_get_instruction_content',
                post_id: postId
            },
            success: function(response) {
                if(response.success) {
                    $('#bl-instruction-main-content').html(response.data.content_html);
                }
                $('#bl-loading-spinner').removeClass('active');
            }
        });
    }
});
</script>

<?php
get_footer();