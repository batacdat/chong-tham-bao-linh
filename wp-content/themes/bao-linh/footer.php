<?php
/**
 * The Footer for Bao Linh Theme
 * Path: wp-content/themes/bao-linh/footer.php
 */
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Cột 1: Thông tin công ty -->
            <div class="footer-col">
                <h4>CÔNG TY TNHH TM VÀ PT XÂY DỰNG BẢO LINH</h4>
                <p>Chuyên cung cấp vật liệu chống thấm cao cấp, tư vấn và thi công các giải pháp chống thấm triệt để cho mọi công trình dân dụng & công nghiệp.</p>
                <p style="margin-top: 12px;"><strong>Địa chỉ:</strong> Cụm công nghiệp Bích Hòa, Thanh Oai, Hà Nội</p>
                <p><strong>Hotline:</strong> <a href="tel:0987654321" style="color: var(--bl-orange); text-decoration: none; font-weight:700;">0987.654.321</a></p>
            </div>

            <!-- Cột 2: Sản phẩm -->
            <div class="footer-col">
                <h4>Sản Phẩm Chính</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Màng chống thấm</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Keo & Phụ gia</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Vật liệu chống thấm</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Vật liệu xử lý mối nối</a></li>
                </ul>
            </div>

            <!-- Cột 3: Giải pháp -->
            <div class="footer-col">
                <h4>Giải Pháp Chống Thấm</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/giai-phap' ) ); ?>">Chống thấm nhà vệ sinh</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/giai-phap' ) ); ?>">Chống thấm sân thượng</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/giai-phap' ) ); ?>">Chống thấm tầng hầm</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/giai-phap' ) ); ?>">Xử lý vết nứt bê tông</a></li>
                </ul>
            </div>

            <!-- Cột 4: Tư vấn kỹ thuật -->
            <div class="footer-col">
                <h4>Tư Vấn Kỹ Thuật</h4>
                <p>Đăng ký nhận phương án thi công & báo giá chi tiết từ đội ngũ kỹ sư Bảo Linh.</p>
                <div class="footer-cta-box">
                    <a href="tel:0903232492" class="footer-cta-btn">
                        <span>Gọi Kỹ Sư: 0903.232.492</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thanh Bản quyền phía dưới -->
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> BẢO LINH WATERPROOF. All Rights Reserved. Thiết kế tối ưu SEO & Hiệu năng.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>