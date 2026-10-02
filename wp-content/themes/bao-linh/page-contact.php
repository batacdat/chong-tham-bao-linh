<?php
/**
 * Template Name: Trang Liên Hệ Bảo Linh
 * Description: Trang liên hệ, tư vấn chống thấm và báo giá vật tư Bảo Linh.
 * Path: wp-content/themes/bao-linh/page-contact.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$theme_uri = get_template_directory_uri();

$store_address = '188 Nguyễn Xiển, Thanh Xuân, Hà Nội';
$phone = '0369374410';
$phone_display = '0369.274.410';
$email = 'support@baolinh.com';
?>

<main id="primary" class="site-main bl-contact-page">

    <!-- =========================================================
         1. HERO
         ========================================================= -->
    <section class="bl-contact-hero">
        <div class="bl-contact-container">
            <div class="bl-contact-hero-inner">
                <span class="bl-contact-eyebrow">LIÊN HỆ BẢO LINH</span>
                <h1>TƯ VẤN GIẢI PHÁP CHỐNG THẤM<br><span>&amp; BÁO GIÁ VẬT TƯ</span></h1>
                <p>
                    Bạn đang gặp sự cố thấm dột, cần tư vấn giải pháp hoặc tìm vật tư phù hợp?
                    Đội ngũ Bảo Linh sẵn sàng hỗ trợ và đồng hành cùng bạn.
                </p>

                <div class="bl-contact-hero-actions">
                    <a class="bl-btn bl-btn-orange" href="tel:<?php echo esc_attr( $phone ); ?>">
                        <span class="bl-btn-icon" aria-hidden="true">☎</span>
                        GỌI NGAY
                    </a>
                    <a class="bl-btn bl-btn-outline" href="https://zalo.me/<?php echo esc_attr( $phone ); ?>" target="_blank" rel="noopener">
                        <span class="bl-btn-icon" aria-hidden="true">Z</span>
                        NHẮN ZALO
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         2. CONTACT INFO + FORM
         ========================================================= -->
    <section class="bl-contact-section bl-contact-main-section">
        <div class="bl-contact-container">
            <div class="bl-contact-main-grid">

                <!-- CONTACT INFO -->
                <aside class="bl-contact-info-panel">
                    <div class="bl-contact-section-label">THÔNG TIN LIÊN HỆ</div>
                    <h2>Kết nối với<br><span>Bảo Linh</span></h2>
                    <p class="bl-contact-info-intro">
                        Liên hệ trực tiếp với Bảo Linh để được tư vấn vật tư,
                        giải pháp chống thấm và hỗ trợ kỹ thuật.
                    </p>

                    <div class="bl-contact-info-list">
                        <a class="bl-contact-info-card" href="https://www.google.com/maps/search/?api=1&query=188%20Nguyen%20Xien%20Thanh%20Xuan%20Ha%20Noi" target="_blank" rel="noopener">
                            <span class="bl-contact-info-icon bl-icon-orange" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                            </span>
                            <span>
                                <strong>Địa chỉ cửa hàng</strong>
                                <small><?php echo esc_html( $store_address ); ?></small>
                            </span>
                        </a>

                        <a class="bl-contact-info-card" href="tel:<?php echo esc_attr( $phone ); ?>">
                            <span class="bl-contact-info-icon bl-icon-blue" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M6.5 3.5h3l1.5 4-2 1.5c1 2.1 2.4 3.5 4.5 4.5l1.5-2 4 1.5v3c0 1.1-.9 2-2 2C10.4 18 6 13.6 6 8.5c0-1.1.9-2 2-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span>
                                <strong>Hotline / Zalo</strong>
                                <small><?php echo esc_html( $phone_display ); ?></small>
                            </span>
                        </a>

                        <a class="bl-contact-info-card" href="mailto:<?php echo esc_attr( $email ); ?>">
                            <span class="bl-contact-info-icon bl-icon-orange" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                            </span>
                            <span>
                                <strong>Email hỗ trợ</strong>
                                <small><?php echo esc_html( $email ); ?></small>
                            </span>
                        </a>
                    </div>

                    <div class="bl-contact-quick-box">
                        <span class="bl-contact-quick-dot"></span>
                        <div>
                            <strong>Sẵn sàng hỗ trợ</strong>
                            <p>Gửi yêu cầu để đội ngũ Bảo Linh liên hệ tư vấn.</p>
                        </div>
                    </div>
                </aside>

                <!-- FORM -->
                <div class="bl-contact-form-card">
                    <div class="bl-form-heading">
                        <div>
                            <span class="bl-contact-section-label">NHẬN TƯ VẤN &amp; BÁO GIÁ</span>
                            <h2>Gửi yêu cầu cho Bảo Linh</h2>
                            <p>Điền thông tin bên dưới để chúng tôi có cơ sở tư vấn nhanh và chính xác hơn.</p>
                        </div>
                    </div>

                    <form class="bl-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="bl_contact_form">
                        <?php wp_nonce_field( 'bl_contact_form_action', 'bl_contact_nonce' ); ?>

                        <div class="bl-form-grid-2">
                            <div class="bl-form-field">
                                <label for="bl-contact-name">Họ và tên <span>*</span></label>
                                <input id="bl-contact-name" type="text" name="name" placeholder="Nhập họ và tên" required>
                            </div>

                            <div class="bl-form-field">
                                <label for="bl-contact-phone">Số điện thoại / Zalo <span>*</span></label>
                                <input id="bl-contact-phone" type="tel" name="phone" placeholder="Nhập số điện thoại" required>
                            </div>
                        </div>

                        <div class="bl-form-grid-2">
                            <div class="bl-form-field">
                                <label for="bl-contact-need">Bạn đang cần hỗ trợ về?</label>
                                <select id="bl-contact-need" name="need">
                                    <option value="">-- Chọn nhu cầu --</option>
                                    <option value="Tư vấn chống thấm">Tư vấn chống thấm</option>
                                    <option value="Mua vật tư chống thấm">Mua vật tư chống thấm</option>
                                    <option value="Báo giá vật tư">Báo giá vật tư</option>
                                    <option value="Tư vấn kỹ thuật thi công">Tư vấn kỹ thuật thi công</option>
                                    <option value="Khảo sát công trình">Khảo sát công trình</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>

                            <div class="bl-form-field">
                                <label for="bl-contact-category">Hạng mục cần xử lý</label>
                                <select id="bl-contact-category" name="category">
                                    <option value="">-- Chọn hạng mục --</option>
                                    <option value="Mái / sân thượng">Mái / sân thượng</option>
                                    <option value="Nhà vệ sinh">Nhà vệ sinh</option>
                                    <option value="Tường đứng">Tường đứng</option>
                                    <option value="Chân tường">Chân tường</option>
                                    <option value="Cổ ống">Cổ ống</option>
                                    <option value="Tầng hầm">Tầng hầm</option>
                                    <option value="Ban công">Ban công</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="bl-form-field">
                            <label for="bl-contact-message">Thông tin công trình</label>
                            <textarea id="bl-contact-message" name="message" rows="5" placeholder="Diện tích, tình trạng thấm, vị trí thấm, vật tư đang sử dụng..."></textarea>
                        </div>

                        <div class="bl-form-field">
                            <label for="bl-contact-images">Hình ảnh công trình <small>(không bắt buộc)</small></label>
                            <label class="bl-upload-box" for="bl-contact-images">
                                <span class="bl-upload-icon" aria-hidden="true">＋</span>
                                <span>
                                    <strong>Tải ảnh công trình</strong>
                                    <small>JPG, PNG – tối đa 5 hình ảnh</small>
                                </span>
                                <input id="bl-contact-images" type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple>
                            </label>
                            <div id="bl-contact-file-list" class="bl-file-list" aria-live="polite"></div>
                        </div>

                        <button class="bl-submit-btn" type="submit">
                            <span>GỬI YÊU CẦU TƯ VẤN</span>
                            <span class="bl-submit-arrow" aria-hidden="true">→</span>
                        </button>

                        <p class="bl-form-note">Thông tin của bạn chỉ được sử dụng để liên hệ và tư vấn theo yêu cầu.</p>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================
         3. WHY CONTACT BAO LINH
         ========================================================= -->
    <section class="bl-contact-section bl-contact-benefits-section">
        <div class="bl-contact-container">
            <div class="bl-contact-section-heading">
                <span class="bl-contact-section-label">BẢO LINH ĐỒNG HÀNH CÙNG BẠN</span>
                <h2>Hỗ trợ từ tư vấn đến thi công</h2>
                <p>Không chỉ cung cấp vật tư, Bảo Linh đồng hành cùng khách hàng trong việc lựa chọn giải pháp phù hợp.</p>
            </div>

            <div class="bl-benefits-grid">
                <article class="bl-benefit-card">
                    <span class="bl-benefit-number">01</span>
                    <span class="bl-benefit-icon">🎯</span>
                    <h3>Tư vấn đúng giải pháp</h3>
                    <p>Tiếp nhận tình trạng công trình và định hướng giải pháp phù hợp.</p>
                </article>

                <article class="bl-benefit-card">
                    <span class="bl-benefit-number">02</span>
                    <span class="bl-benefit-icon">🧰</span>
                    <h3>Tư vấn vật tư</h3>
                    <p>Hỗ trợ lựa chọn vật liệu theo hạng mục và nhu cầu sử dụng.</p>
                </article>

                <article class="bl-benefit-card">
                    <span class="bl-benefit-number">03</span>
                    <span class="bl-benefit-icon">📋</span>
                    <h3>Báo giá rõ ràng</h3>
                    <p>Cung cấp thông tin vật tư và chi phí để khách hàng dễ dàng tham khảo.</p>
                </article>

                <article class="bl-benefit-card">
                    <span class="bl-benefit-number">04</span>
                    <span class="bl-benefit-icon">👷</span>
                    <h3>Hỗ trợ kỹ thuật</h3>
                    <p>Hướng dẫn quy trình và lưu ý kỹ thuật trong quá trình thi công.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- =========================================================
         4. MAP + STORE
         ========================================================= -->
    <section class="bl-contact-section bl-contact-location-section">
        <div class="bl-contact-container">
            <div class="bl-contact-section-heading">
                <span class="bl-contact-section-label">GHÉ THĂM BẢO LINH</span>
                <h2>Tìm đến cửa hàng Bảo Linh</h2>
                <p>Ghé trực tiếp cửa hàng để tham khảo sản phẩm và nhận tư vấn vật tư, giải pháp chống thấm.</p>
            </div>

            <div class="bl-location-grid">
                <div class="bl-map-card">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.043542283084!2d105.80781707587713!3d20.988880389073105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acc486ca9801%3A0xb35a0f1fa2c2d495!2s188%20Nguy%E1%BB%85n%20Xi%E1%BB%83n%2C%20H%E1%BA%A1%20%C4%90%C3%ACnh%2C%20Thanh%20Xu%C3%A2n%2C%20H%C3%A0%20N%E1%BB%99i!5e0!3m2!1svi!2svn!4v1710000000000!5m2!1svi!2svn"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Bản đồ cửa hàng Bảo Linh tại 188 Nguyễn Xiển"
                    ></iframe>
                </div>

                <div class="bl-location-card">
                    <span class="bl-contact-section-label">CỬA HÀNG BẢO LINH</span>
                    <h3>Siêu thị vật tư &amp; giải pháp chống thấm</h3>
                    <p class="bl-location-description">Đến trực tiếp để được tư vấn sản phẩm và giải pháp phù hợp với công trình.</p>

                    <div class="bl-location-detail">
                        <span class="bl-location-detail-icon">⌖</span>
                        <div>
                            <strong>Địa chỉ</strong>
                            <p><?php echo esc_html( $store_address ); ?></p>
                        </div>
                    </div>

                    <div class="bl-location-detail">
                        <span class="bl-location-detail-icon">☎</span>
                        <div>
                            <strong>Hotline / Zalo</strong>
                            <p><?php echo esc_html( $phone_display ); ?></p>
                        </div>
                    </div>

                    <a class="bl-location-direction-btn" href="https://www.google.com/maps/dir/?api=1&destination=188%20Nguyen%20Xien%20Thanh%20Xuan%20Ha%20Noi" target="_blank" rel="noopener">
                        CHỈ ĐƯỜNG ĐẾN CỬA HÀNG <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         5. FINAL CTA
         ========================================================= -->
    <section class="bl-contact-final-cta">
        <div class="bl-contact-container">
            <div class="bl-final-cta-inner">
                <div>
                    <span class="bl-final-cta-label">CẦN HỖ TRỢ NGAY?</span>
                    <h2>Bạn đang gặp vấn đề thấm dột?</h2>
                    <p>Gửi hình ảnh công trình hoặc liên hệ trực tiếp để được Bảo Linh tư vấn giải pháp phù hợp.</p>
                </div>
                <div class="bl-final-cta-actions">
                    <a class="bl-btn bl-btn-white" href="tel:<?php echo esc_attr( $phone ); ?>">GỌI NGAY</a>
                    <a class="bl-btn bl-btn-orange" href="https://zalo.me/<?php echo esc_attr( $phone ); ?>" target="_blank" rel="noopener">NHẮN ZALO</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
