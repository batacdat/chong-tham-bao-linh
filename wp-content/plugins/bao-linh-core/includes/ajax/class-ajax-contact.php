<?php
/**
 * AJAX Handler: Xử lý Gửi Form Yêu Cầu Tư Vấn & Upload Ảnh (Bảo Linh)
 * Path: wp-content/plugins/bao-linh-core/includes/ajax/class-ajax-contact.php
 * 
 * @package BaoLinhCore
 */

if (!defined('ABSPATH')) {
    exit; // Chống truy cập trực tiếp
}

class BL_Ajax_Contact {

    public static function init() {
        add_action('wp_ajax_bl_contact_form', array(__CLASS__, 'handle_contact_form_submit'));
        add_action('wp_ajax_nopriv_bl_contact_form', array(__CLASS__, 'handle_contact_form_submit'));
    }

    public static function handle_contact_form_submit() {
        // 1. Kiểm tra xác thực Bảo mật (Nonce)
        if (!isset($_POST['bl_contact_nonce']) || !wp_verify_nonce($_POST['bl_contact_nonce'], 'bl_contact_form_action')) {
            wp_send_json_error(array('message' => 'Lỗi xác thực bảo mật (Nonce không hợp lệ). Vui lòng tải lại trang.'));
        }

        // 2. Làm sạch dữ liệu đầu vào (Sanitize Input)
        $name     = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $phone    = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
        $need     = isset($_POST['need']) ? sanitize_text_field($_POST['need']) : 'Chưa chọn';
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'Chưa chọn';
        $message  = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

        // Validate các trường bắt buộc
        if (empty($name) || empty($phone)) {
            wp_send_json_error(array('message' => 'Vui lòng điền đầy đủ Họ và tên và Số điện thoại.'));
        }

        // 3. Xử lý Upload file ảnh công trình đính kèm
        $attachments = array();
        if (!empty($_FILES['images']['name'][0])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            $files = $_FILES['images'];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $file = array(
                        'name'     => $files['name'][$key],
                        'type'     => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error'    => $files['error'][$key],
                        'size'     => $files['size'][$key]
                    );

                    $_FILES['single_image'] = $file;
                    $attachment_id = media_handle_upload('single_image', 0);

                    if (!is_wp_error($attachment_id)) {
                        $attachments[] = get_attached_file($attachment_id);
                    }
                }
            }
        }

        // 4. Soạn cấu trúc Email gửi đi
        $to      = 'muinv2512@gmail.com'; 
        $subject = '[YÊU CẦU TƯ VẤN MỚI] - ' . $name . ' (' . $phone . ')';
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Chống Thấm Bảo Linh <no-reply@' . parse_url(get_site_url(), PHP_URL_HOST) . '>'
        );

        $email_body  = '<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">';
        $email_body .= '<h2 style="color: #0284c7; border-bottom: 2px solid #0284c7; padding-bottom: 8px;">Thông Tin Yêu Cầu Tư Vấn Mới</h2>';
        $email_body .= '<table style="width: 100%; border-collapse: collapse; margin-top: 15px;">';
        $email_body .= '<tr style="background-color: #f8fafc;"><td style="padding: 10px; border: 1px solid #e2e8f0; font-weight: bold; width: 30%;">Họ và tên:</td><td style="padding: 10px; border: 1px solid #e2e8f0;">' . esc_html($name) . '</td></tr>';
        $email_body .= '<tr><td style="padding: 10px; border: 1px solid #e2e8f0; font-weight: bold;">Số điện thoại:</td><td style="padding: 10px; border: 1px solid #e2e8f0;"><a href="tel:' . esc_attr($phone) . '" style="color: #0284c7; font-weight: bold;">' . esc_html($phone) . '</a></td></tr>';
        $email_body .= '<tr style="background-color: #f8fafc;"><td style="padding: 10px; border: 1px solid #e2e8f0; font-weight: bold;">Nhu cầu hỗ trợ:</td><td style="padding: 10px; border: 1px solid #e2e8f0;">' . esc_html($need) . '</td></tr>';
        $email_body .= '<tr><td style="padding: 10px; border: 1px solid #e2e8f0; font-weight: bold;">Hạng mục xử lý:</td><td style="padding: 10px; border: 1px solid #e2e8f0;">' . esc_html($category) . '</td></tr>';
        $email_body .= '<tr style="background-color: #f8fafc;"><td style="padding: 10px; border: 1px solid #e2e8f0; font-weight: bold;">Nội dung/Tình trạng:</td><td style="padding: 10px; border: 1px solid #e2e8f0;">' . nl2br(esc_html($message)) . '</td></tr>';
        $email_body .= '<tr><td style="padding: 10px; border: 1px solid #e2e8f0; font-weight: bold;">Thời gian gửi:</td><td style="padding: 10px; border: 1px solid #e2e8f0;">' . current_time('d/m/Y H:i:s') . '</td></tr>';
        $email_body .= '</table>';
        $email_body .= '</div>';

        // 5. Tiến hành gửi email
        $sent = wp_mail($to, $subject, $email_body, $headers, $attachments);

        if ($sent) {
            wp_send_json_success(array('message' => 'Yêu cầu tư vấn của bạn đã được gửi thành công! Kỹ thuật viên Bảo Linh sẽ liên hệ sớm nhất.'));
        } else {
            wp_send_json_error(array('message' => 'Lỗi: Hệ thống không thể gửi mail. Vui lòng kiểm tra lại cấu hình WP Mail SMTP trên website.'));
        }
    }
}

// Khởi tạo Class
BL_Ajax_Contact::init();