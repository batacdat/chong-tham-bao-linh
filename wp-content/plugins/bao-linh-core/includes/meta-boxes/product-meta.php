<?php
/**
 * Class BL_Product_Meta_Boxes - Custom UI Form Thêm Sản Phẩm & Tự Động Tạo Mã Sản Phẩm (Auto SKU)
 * Path: wp-content/plugins/bao-linh-core/includes/meta-boxes/product-meta.php
 */

if (!defined('ABSPATH')) {
    exit;
}

class BL_Product_Meta_Boxes {

    public function __construct() {
        add_filter('use_block_editor_for_post_type', array($this, 'disable_gutenberg_for_product'), 10, 2);
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_filter('enter_title_here', array($this, 'change_product_title_placeholder'), 10, 2);
        add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
        add_action('save_post_bl_product', array($this, 'save_product_data'), 10, 3);
    }

    public function disable_gutenberg_for_product($use_block_editor, $post_type) {
        if ($post_type === 'bl_product') {
            return false;
        }
        return $use_block_editor;
    }

    public function change_product_title_placeholder($title_placeholder, $post) {
        if ($post->post_type === 'bl_product') {
            return 'Nhập tên sản phẩm...';
        }
        return $title_placeholder;
    }

    public function enqueue_admin_assets($hook) {
        global $post_type;
        if (($hook === 'post-new.php' || $hook === 'post.php') && $post_type === 'bl_product') {
            wp_enqueue_media();
        }
    }

    public function register_meta_boxes() {
        add_meta_box(
            'bl_product_main_card_mb',
            '📦 QUẢN LÝ SẢN PHẨM BẢO LINH',
            array($this, 'render_product_main_card_callback'),
            'bl_product',
            'normal',
            'high'
        );

        add_meta_box(
            'bl_product_solutions_mb',
            '🛠️️ GIẢI PHÁP CHỐNG THẤM ÁP DỤNG',
            array($this, 'render_product_solutions_callback'),
            'bl_product',
            'side',
            'default'
        );
    }

    public function render_product_main_card_callback($post) {
        wp_nonce_field('bl_save_product_meta', 'bl_product_meta_nonce');

        $sku          = get_post_meta($post->ID, '_bl_product_sku', true);
        $description  = get_post_meta($post->ID, '_bl_product_description', true);
        $gallery_ids  = get_post_meta($post->ID, '_bl_product_gallery', true);
        $gallery_arr  = !empty($gallery_ids) ? array_filter(explode(',', $gallery_ids)) : array();
        ?>

        <style>
            #poststuff #bl_product_main_card_mb { background: transparent; border: none; box-shadow: none; }
            #bl_product_main_card_mb .postbox-header { display: none; }
            #bl_product_main_card_mb .inside { padding: 0 !important; margin: 0 !important; }

            .bl-card {
                background: #ffffff;
                border: 1px solid #f1f5f9;
                border-radius: 16px;
                padding: 24px;
                margin-bottom: 24px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            }

            .bl-card-header {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
            }

            .bl-card-icon {
                width: 36px;
                height: 36px;
                background: #e0f2fe;
                color: #0284c7;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                font-size: 18px;
            }

            .bl-card-title {
                font-size: 14px;
                font-weight: 800;
                color: #0f172a;
                letter-spacing: 0.5px;
                text-transform: uppercase;
            }

            .bl-field-group {
                margin-bottom: 20px;
            }

            .bl-field-label {
                display: block;
                font-size: 12px;
                font-weight: 700;
                color: #94a3b8;
                text-transform: uppercase;
                margin-bottom: 8px;
                letter-spacing: 0.5px;
            }

            .bl-input-text, .bl-textarea {
                width: 100%;
                background: #f8fafc;
                border: 1px solid #f1f5f9;
                border-radius: 12px;
                padding: 14px 16px;
                font-size: 14px;
                color: #334155;
                outline: none;
                transition: all 0.2s ease;
                box-sizing: border-box;
            }

            .bl-input-text:focus, .bl-textarea:focus {
                background: #ffffff;
                border-color: #38bdf8;
                box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
            }

            .bl-upload-dropzone {
                border: 2px dashed #e2e8f0;
                background: #f8fafc;
                border-radius: 16px;
                padding: 32px 20px;
                text-align: center;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .bl-upload-dropzone:hover {
                border-color: #38bdf8;
                background: #f0f9ff;
            }

            .bl-upload-icon-circle {
                width: 52px;
                height: 52px;
                background: #ffffff;
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                margin-bottom: 12px;
            }

            .bl-upload-btn-text {
                font-size: 13px;
                font-weight: 700;
                color: #0f172a;
            }

            .bl-gallery-preview-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
                gap: 12px;
                margin-top: 16px;
            }

            .bl-gallery-thumb {
                position: relative;
                width: 100%;
                aspect-ratio: 1;
                border-radius: 10px;
                overflow: hidden;
                border: 1px solid #e2e8f0;
            }

            .bl-gallery-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .bl-gallery-thumb-remove {
                position: absolute;
                top: 4px;
                right: 4px;
                background: rgba(239, 68, 68, 0.9);
                color: #fff;
                border: none;
                width: 22px;
                height: 22px;
                border-radius: 50%;
                cursor: pointer;
                font-size: 12px;
                line-height: 1;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .bl-sku-badge {
                display: inline-block;
                background: #f1f5f9;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                color: #475569;
            }
        </style>

        <div class="bl-card">
            <div class="bl-card-header">
                <div class="bl-card-icon">ⓘ</div>
                <div class="bl-card-title">THÔNG TIN CƠ BẢN</div>
            </div>

            <?php if (!empty($sku)): ?>
                <div class="bl-field-group">
                    <span class="bl-field-label">MÃ SẢN PHẨM (TỰ ĐỘNG KHÓA):</span>
                    <span class="bl-sku-badge">🔑 <?php echo esc_html($sku); ?></span>
                </div>
            <?php endif; ?>

            <div class="bl-field-group">
                <label class="bl-field-label">MÔ TẢ</label>
                <textarea class="bl-textarea" name="bl_product_description" rows="5" placeholder="Mô tả sản phẩm chi tiết..."><?php echo esc_textarea($description); ?></textarea>
            </div>
        </div>

        <div class="bl-card">
            <div class="bl-card-header">
                <div class="bl-card-icon">☁</div>
                <div class="bl-card-title">HÌNH ẢNH SẢN PHẨM</div>
            </div>

            <div class="bl-field-group">
                <input type="hidden" id="bl_product_gallery" name="bl_product_gallery" value="<?php echo esc_attr($gallery_ids); ?>">
                
                <div class="bl-upload-dropzone" id="bl_btn_trigger_gallery">
                    <div class="bl-upload-icon-circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    </div>
                    <div class="bl-upload-btn-text">Tải ảnh lên từ thiết bị (Tối đa 9 ảnh)</div>
                    <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">Đã chọn: <strong id="bl_gallery_count"><?php echo count($gallery_arr); ?></strong>/9 ảnh</div>
                </div>

                <div class="bl-gallery-preview-grid" id="bl_gallery_preview">
                    <?php 
                    if (!empty($gallery_arr)) {
                        foreach ($gallery_arr as $img_id) {
                            $img_url = wp_get_attachment_image_url($img_id, 'thumbnail');
                            if ($img_url) {
                                echo '<div class="bl-gallery-thumb" data-id="' . esc_attr($img_id) . '">';
                                echo '<img src="' . esc_url($img_url) . '">';
                                echo '<button type="button" class="bl-gallery-thumb-remove">&times;</button>';
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            var frame;
            var $galleryInput = $('#bl_product_gallery');
            var $previewGrid  = $('#bl_gallery_preview');
            var $countText    = $('#bl_gallery_count');
            var maxImages     = 9;

            $('#bl_btn_trigger_gallery').on('click', function(e) {
                e.preventDefault();
                
                var currentIds = $galleryInput.val() ? $galleryInput.val().split(',').filter(Boolean) : [];
                if (currentIds.length >= maxImages) {
                    alert('Bạn chỉ được thêm tối đa ' + maxImages + ' hình ảnh.');
                    return;
                }

                if (frame) { frame.open(); return; }

                frame = wp.media({
                    title: 'Chọn ảnh minh họa sản phẩm',
                    button: { text: 'Thêm vào danh sách' },
                    multiple: true
                });

                frame.on('select', function() {
                    var attachments = frame.state().get('selection').toJSON();
                    var updatedIds  = $galleryInput.val() ? $galleryInput.val().split(',').filter(Boolean) : [];

                    attachments.forEach(function(attachment) {
                        if (updatedIds.length < maxImages && updatedIds.indexOf(attachment.id.toString()) === -1) {
                            updatedIds.push(attachment.id.toString());
                            var thumbUrl = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
                            $previewGrid.append(
                                '<div class="bl-gallery-thumb" data-id="' + attachment.id + '">' +
                                '<img src="' + thumbUrl + '">' +
                                '<button type="button" class="bl-gallery-thumb-remove">&times;</button>' +
                                '</div>'
                            );
                        }
                    });

                    $galleryInput.val(updatedIds.join(','));
                    $countText.text(updatedIds.length);
                });

                frame.open();
            });

            $previewGrid.on('click', '.bl-gallery-thumb-remove', function(e) {
                e.stopPropagation();
                var $item = $(this).closest('.bl-gallery-thumb');
                var idToRemove = $item.data('id').toString();
                var currentIds = $galleryInput.val().split(',').filter(Boolean);
                var updatedIds = currentIds.filter(function(id) { return id !== idToRemove; });
                
                $galleryInput.val(updatedIds.join(','));
                $countText.text(updatedIds.length);
                $item.remove();
            });
        });
        </script>
        <?php
    }

    public function render_product_solutions_callback($post) {
        $selected_solutions = get_post_meta($post->ID, '_bl_related_solutions', true);
        if (!is_array($selected_solutions)) {
            $selected_solutions = array();
        }

        $solutions = get_posts(array(
            'post_type'      => 'bl_solution',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ));

        if (empty($solutions)) {
            echo '<p style="font-size:12px; color:#64748b;">Chưa có giải pháp nào trong hệ thống.</p>';
            return;
        }

        echo '<p style="font-size:12px; color:#64748b; margin-bottom:10px;">Chọn giải pháp áp dụng sản phẩm này:</p>';
        foreach ($solutions as $sol) {
            $checked = in_array($sol->ID, $selected_solutions) ? 'checked="checked"' : '';
            echo '<label style="display:block; margin-bottom: 8px; font-size:13px; font-weight:500; color:#1e293b;">';
            echo '<input type="checkbox" name="bl_related_solutions[]" value="' . esc_attr($sol->ID) . '" ' . $checked . ' /> ';
            echo esc_html($sol->post_title);
            echo '</label>';
        }
    }

    public function save_product_data($post_id, $post, $update) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
        if (!current_user_can('edit_post', $post_id)) { return; }
        if (!isset($_POST['bl_product_meta_nonce']) || !wp_verify_nonce($_POST['bl_product_meta_nonce'], 'bl_save_product_meta')) { return; }

        $existing_sku = get_post_meta($post_id, '_bl_product_sku', true);
        if (empty($existing_sku)) {
            $auto_sku = 'BL-PRD-' . str_pad($post_id, 4, '0', STR_PAD_LEFT);
            update_post_meta($post_id, '_bl_product_sku', $auto_sku);
        }

        if (isset($_POST['bl_product_description'])) {
            update_post_meta($post_id, '_bl_product_description', sanitize_textarea_field($_POST['bl_product_description']));
        }

        if (isset($_POST['bl_product_gallery'])) {
            update_post_meta($post_id, '_bl_product_gallery', sanitize_text_field($_POST['bl_product_gallery']));
        }

        if (isset($_POST['bl_related_solutions']) && is_array($_POST['bl_related_solutions'])) {
            $solutions_ids = array_map('absint', $_POST['bl_related_solutions']);
            update_post_meta($post_id, '_bl_related_solutions', $solutions_ids);
        } else {
            delete_post_meta($post_id, '_bl_related_solutions');
        }
    }
}

new BL_Product_Meta_Boxes();