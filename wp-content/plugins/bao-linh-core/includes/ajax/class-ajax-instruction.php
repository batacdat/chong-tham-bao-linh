<?php
/**
 * AJAX Handler: Xử lý Lọc & Tải Bài viết Hướng dẫn thi công (Bảo Linh)
 * Path: wp-content/plugins/bao-linh-core/includes/ajax/class-ajax-instruction.php
 * 
 * @package BaoLinhCore
 */

if (!defined('ABSPATH')) {
    exit; // Chống truy cập trực tiếp
}

class BL_Ajax_Instruction {

    public static function init() {
        // Lọc bài viết hướng dẫn theo danh mục
        add_action('wp_ajax_bl_filter_instruction_posts', array(__CLASS__, 'filter_instruction_posts'));
        add_action('wp_ajax_nopriv_bl_filter_instruction_posts', array(__CLASS__, 'filter_instruction_posts'));

        // Lấy nội dung chi tiết bài viết hướng dẫn
        add_action('wp_ajax_bl_get_instruction_content', array(__CLASS__, 'get_instruction_content'));
        add_action('wp_ajax_nopriv_bl_get_instruction_content', array(__CLASS__, 'get_instruction_content'));
    }

    public static function filter_instruction_posts() {
        $cat_id = isset($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;

        $args = array(
            'post_type'      => 'bl_instruction',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        if ($cat_id > 0) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'bl_instruction_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                ),
            );
        }

        $query = new WP_Query($args);
        $posts_html    = '';
        $first_post_id = 0;

        if ($query->have_posts()) {
            $count = 0;
            while ($query->have_posts()) {
                $query->the_post();
                $p_id = get_the_ID();

                if ($count === 0) {
                    $first_post_id = $p_id;
                }

                $active_class = ($count === 0) ? ' active' : '';

                $posts_html .= '<li class="bl-post-item">';
                $posts_html .= '<a href="#" class="bl-post-link' . esc_attr($active_class) . '" data-post-id="' . esc_attr($p_id) . '">';
                $posts_html .= esc_html(get_the_title());
                $posts_html .= '</a>';
                $posts_html .= '</li>';

                $count++;
            }
            wp_reset_postdata();
        } else {
            $posts_html = '<li class="bl-no-post" style="font-size:13px; color:#94a3b8; padding:10px 0;">Không có bài viết nào trong danh mục này.</li>';
        }

        wp_send_json_success(array(
            'posts_html'    => $posts_html,
            'first_post_id' => $first_post_id,
        ));
    }

    public static function get_instruction_content() {
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

        if (!$post_id) {
            wp_send_json_error('Mã bài viết không hợp lệ.');
        }

        $post = get_post($post_id);

        if (!$post || $post->post_type !== 'bl_instruction' || $post->post_status !== 'publish') {
            wp_send_json_error('Nội dung không tồn tại hoặc không hợp lệ.');
        }

        $product_features = get_post_meta($post_id, '_bl_product_features', true);
        $steps            = get_post_meta($post_id, '_bl_instruction_steps', true);
        $youtube_url      = get_post_meta($post_id, '_bl_youtube_url', true);
        $post_terms       = get_the_terms($post_id, 'bl_instruction_cat');

        ob_start();
        ?>
        <div class="bl-loading-overlay" id="bl-loading-spinner" style="display:none;">Đang tải nội dung...</div>

        <header class="bl-post-header">
            <h1 class="bl-post-title"><?php echo esc_html($post->post_title); ?></h1>
            <div class="bl-post-meta">
                <span class="bl-meta-item">🗓️ <?php echo get_the_date('d/m/Y', $post_id); ?></span>
                <?php if ($post_terms && !is_wp_error($post_terms)) : ?>
                    <span class="bl-meta-item">📁 <?php echo esc_html($post_terms[0]->name); ?></span>
                <?php endif; ?>
            </div>
        </header>

        <?php if (!empty($product_features)) : ?>
            <section class="bl-section-features">
                <h2 class="bl-section-title">I. ĐẶC ĐIỂM SẢN PHẨM</h2>
                <div class="bl-features-body">
                    <?php echo wp_kses_post($product_features); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($steps) && is_array($steps)) : ?>
            <section class="bl-section-steps">
                <h2 class="bl-section-title">II. QUY TRÌNH THI CÔNG</h2>
                <div class="bl-steps-list">
                    <?php foreach ($steps as $idx => $step) : ?>
                        <?php 
                        $step_title   = !empty($step['title']) ? $step['title'] : '';
                        $step_content = !empty($step['content']) ? $step['content'] : '';
                        $step_img_id  = !empty($step['image_id']) ? intval($step['image_id']) : 0;
                        ?>
                        <div class="bl-step-card">
                            <h3 class="bl-step-title">BƯỚC <?php echo ($idx + 1); ?> – <?php echo esc_html($step_title); ?></h3>
                            
                            <?php if ($step_content) : ?>
                                <div class="bl-step-text">
                                    <p><?php echo nl2br(esc_html($step_content)); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ($step_img_id > 0) : 
                                $img_src = wp_get_attachment_image_url($step_img_id, 'large');
                                if ($img_src) : ?>
                                    <div class="bl-step-image">
                                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($step_title); ?>" loading="lazy">
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($youtube_url)) : 
            $video_id = '';
            if (preg_match("#(?<=v=|\/)([\w-]+)(?=&|$)#", $youtube_url, $matches)) {
                $video_id = $matches[0];
            }
            if ($video_id) : ?>
                <section class="bl-section-video">
                    <h2 class="bl-section-title">III. VIDEO THAM KHẢO</h2>
                    <div class="bl-video-wrapper">
                        <iframe 
                            src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" 
                            title="<?php echo esc_attr($post->post_title); ?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </section>
            <?php endif;
        endif; ?>

        <?php
        $content_html = ob_get_clean();

        wp_send_json_success(array(
            'content_html' => $content_html,
        ));
    }
}

// Khởi tạo Class
BL_Ajax_Instruction::init();