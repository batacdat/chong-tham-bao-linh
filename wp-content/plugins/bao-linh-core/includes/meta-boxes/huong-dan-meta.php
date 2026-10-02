<?php
/**
 * Custom Meta Boxes cho Hướng Dẫn Thi Công
 * Path: wp-content/plugins/bao-linh-core/includes/meta-boxes/huong-dan-meta.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class BL_Instruction_Meta_Boxes {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post_bl_instruction', array( $this, 'save_meta_boxes' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
    }

    public function enqueue_admin_assets( $hook ) {
        global $post_type;
        if ( ( $hook === 'post-new.php' || $hook === 'post.php' ) && $post_type === 'bl_instruction' ) {
            wp_enqueue_media();
            wp_enqueue_style( 'bl-instruction-admin-css', plugins_url( '../../assets/css/huong-dan-admin.css', __FILE__ ), array(), '1.0.0' );
            wp_enqueue_script( 'bl-instruction-admin-js', plugins_url( '../../assets/js/huong-dan-admin.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
        }
    }

    public function add_meta_boxes() {
        add_meta_box(
            'bl_instruction_details_mb',
            '🛠️ CẤU TRÚC BÀI HƯỚNG DẪN THI CÔNG',
            array( $this, 'render_meta_box_callback' ),
            'bl_instruction',
            'normal',
            'high'
        );
    }

    public function render_meta_box_callback( $post ) {
        wp_nonce_field( 'bl_save_instruction_meta', 'bl_instruction_meta_nonce' );

        $product_features = get_post_meta( $post->ID, '_bl_product_features', true );
        $steps            = get_post_meta( $post->ID, '_bl_instruction_steps', true );
        $youtube_url      = get_post_meta( $post->ID, '_bl_youtube_url', true );

        if ( ! is_array( $steps ) || empty( $steps ) ) {
            $steps = array(
                array( 'title' => '', 'content' => '', 'image_id' => '', 'image_url' => '' )
            );
        }
        ?>
        <div class="bl-meta-container">
            <!-- PHẦN I: ĐẶC ĐIỂM SẢN PHẨM -->
            <div class="bl-meta-box-card">
                <h3>I. ĐẶC ĐIỂM SẢN PHẨM</h3>
                <div class="bl-field-group">
                    <label>Nội dung giới thiệu đặc điểm:</label>
                    <?php 
                    wp_editor( 
                        $product_features, 
                        'bl_product_features', 
                        array( 'textarea_name' => 'bl_product_features', 'media_buttons' => true, 'textarea_rows' => 6 ) 
                    ); 
                    ?>
                </div>
            </div>

            <!-- PHẦN II: QUY TRÌNH THI CÔNG (DYNAMIC STEPS) -->
            <div class="bl-meta-box-card">
                <h3>II. QUY TRÌNH THI CÔNG (CÁC BƯỚC)</h3>
                <div id="bl-steps-wrapper">
                    <?php foreach ( $steps as $index => $step ) : ?>
                        <div class="bl-step-item" data-index="<?php echo $index; ?>">
                            <div class="bl-step-header">
                                <strong>Bước <span class="bl-step-number"><?php echo $index + 1; ?></span></strong>
                                <button type="button" class="button button-link-delete bl-remove-step">Xóa bước</button>
                            </div>
                            <div class="bl-step-body">
                                <p>
                                    <label>Tiêu đề bước:</label>
                                    <input type="text" name="bl_steps[<?php echo $index; ?>][title]" value="<?php echo esc_attr( $step['title'] ?? '' ); ?>" class="widefat" placeholder="Ví dụ: Vệ sinh bề mặt...">
                                </p>
                                <p>
                                    <label>Nội dung hướng dẫn:</label>
                                    <textarea name="bl_steps[<?php echo $index; ?>][content]" rows="4" class="widefat" placeholder="Mô tả chi tiết cách thực hiện bước này..."><?php echo esc_textarea( $step['content'] ?? '' ); ?></textarea>
                                </p>
                                <div class="bl-image-upload-box">
                                    <label>Hình minh họa bước:</label>
                                    <input type="hidden" name="bl_steps[<?php echo $index; ?>][image_id]" class="bl-step-img-id" value="<?php echo esc_attr( $step['image_id'] ?? '' ); ?>">
                                    <div class="bl-step-img-preview">
                                        <?php 
                                        $img_url = ! empty( $step['image_id'] ) ? wp_get_attachment_image_url( $step['image_id'], 'medium' ) : '';
                                        if ( $img_url ) : ?>
                                            <img src="<?php echo esc_url( $img_url ); ?>" style="max-width: 150px; display:block; margin-bottom:5px;">
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="button bl-upload-step-img">Chọn ảnh</button>
                                    <button type="button" class="button bl-remove-step-img" style="<?php echo $img_url ? '' : 'display:none;'; ?>">Xóa ảnh</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button button-primary" id="bl-add-step">+ Thêm bước tiếp theo</button>
            </div>

            <!-- PHẦN III: VIDEO THAM KHẢO -->
            <div class="bl-meta-box-card">
                <h3>III. VIDEO THAM KHẢO</h3>
                <div class="bl-field-group">
                    <label>YouTube Video URL:</label>
                    <input type="url" name="bl_youtube_url" value="<?php echo esc_url( $youtube_url ); ?>" class="widefat" placeholder="https://www.youtube.com/watch?v=...">
                </div>
            </div>
        </div>
        <?php
    }

    public function save_meta_boxes( $post_id ) {
        if ( ! isset( $_POST['bl_instruction_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bl_instruction_meta_nonce'], 'bl_save_instruction_meta' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Lưu Đặc điểm
        if ( isset( $_POST['bl_product_features'] ) ) {
            update_post_meta( $post_id, '_bl_product_features', wp_kses_post( $_POST['bl_product_features'] ) );
        }

        // Lưu Quy trình Các Bước
        if ( isset( $_POST['bl_steps'] ) && is_array( $_POST['bl_steps'] ) ) {
            $clean_steps = array();
            foreach ( $_POST['bl_steps'] as $step ) {
                if ( ! empty( $step['title'] ) || ! empty( $step['content'] ) ) {
                    $clean_steps[] = array(
                        'title'    => sanitize_text_field( $step['title'] ),
                        'content'  => sanitize_textarea_field( $step['content'] ),
                        'image_id' => absint( $step['image_id'] ),
                    );
                }
            }
            update_post_meta( $post_id, '_bl_instruction_steps', $clean_steps );
        } else {
            delete_post_meta( $post_id, '_bl_instruction_steps' );
        }

        // Lưu Youtube URL
        if ( isset( $_POST['bl_youtube_url'] ) ) {
            update_post_meta( $post_id, '_bl_youtube_url', esc_url_raw( $_POST['bl_youtube_url'] ) );
        }
    }
}
new BL_Instruction_Meta_Boxes();