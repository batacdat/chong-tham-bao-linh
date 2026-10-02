<?php
/**
 * Template Name: Trang Giới Thiệu (About Page)
 * Description: Page template chuyên biệt thiết kế chuẩn thương hiệu Chống Thấm Bảo Linh
 * Path: wp-content/themes/bao-linh/page-about.php
 */

get_header();
?>

<main id="primary" class="site-main about-page-wrapper">

    <!-- 1. HERO BANNER BẢO LINH (TÔNG XANH #3652cb & CAM #f7521c) -->
    <section class="about-hero-section">
        <div class="container header-container-wide">
            <div class="about-hero-content">
                <span class="hero-badge-tag">THƯƠNG HIỆU UY TÍN</span>
                <h1 class="hero-title">SIÊU THỊ VẬT TƯ & GIẢI PHÁP CHỐNG THẤM BẢO LINH</h1>
                <p class="hero-subtitle">Đơn vị chuyên sâu trong tư vấn kỹ thuật, cung cấp vật liệu và thi công xử lý dứt điểm sự cố thấm dột cho mọi công trình.</p>
            </div>
        </div>
    </section>

    <!-- 2. CÂU CHUYỆN BẢO LINH & STATS BAR (LAYOUT 2 CỘT) -->
    <section class="about-section story-section">
        <div class="container header-container-wide">
            <div class="story-grid">
                
                <!-- Cột Trái: Slideshow Hình Ảnh Câu Chuyện Bảo Linh -->
                <div class="story-thumb-wrap story-slideshow">

                    <?php
                    /*
                    * 5 hình ảnh giới thiệu về Bảo Linh.
                    *
                    * Bạn chỉ cần đưa 5 ảnh vào:
                    * /assets/images/
                    *
                    * và đặt tên:
                    * cau-chuyen-1.jpg
                    * cau-chuyen-2.jpg
                    * cau-chuyen-3.jpg
                    * cau-chuyen-4.jpg
                    * cau-chuyen-5.jpg
                    */

                    $story_images = array(
                        get_template_directory_uri() . '/assets/images/cau-chuyen1.jpg',
                        get_template_directory_uri() . '/assets/images/ch1.jpg',
                        get_template_directory_uri() . '/assets/images/ch2.jpg',
                        get_template_directory_uri() . '/assets/images/ch3.jpg',
                        get_template_directory_uri() . '/assets/images/banner gt cty.jpg',
                    );
                    ?>

                    <!-- Ảnh slideshow -->
                    <img
                        id="bl-story-slideshow-image"
                        class="story-slideshow-image"
                        src="<?php echo esc_url( $story_images[0] ); ?>"
                        data-images='<?php echo esc_attr( wp_json_encode( $story_images ) ); ?>'
                        alt="Câu chuyện thương hiệu Bảo Linh"
                    >

                    <!-- Lớp phủ nhẹ giúp ảnh đẹp hơn -->
                    <div class="story-image-overlay"></div>

                    <!-- Badge 10+ vẫn giữ nguyên -->
                    <div class="story-experience-badge">
                        <span class="exp-num">10+</span>
                        <span class="exp-text">Năm Kinh Nghiệm Thực Chiến</span>
                    </div>

                    <!-- Dấu chấm chỉ báo ảnh -->
                    <div class="story-slide-dots" aria-hidden="true">
                        <span class="story-dot active"></span>
                        <span class="story-dot"></span>
                        <span class="story-dot"></span>
                        <span class="story-dot"></span>
                        <span class="story-dot"></span>
                    </div>

                </div>

                <!-- Cột Phải: Nội Dung Giới Thiệu -->
                <div class="story-info">
                    <span class="section-badge-orange">CÂU CHUYỆN THƯƠNG HIỆU</span>
                    <h2 class="about-heading">Bảo Vệ Vững Chắc Cho Mọi Công Trình Xây Dựng</h2>
                    <p class="story-desc">
                        <strong>CÔNG TY TNHH THƯƠNG MẠI VÀ PHÁT TRIỂN XÂY DỰNG BẢO LINH</strong> chuyên cung cấp, tư vấn và phân phối vật liệu, hóa chất xây dựng và các giải pháp chống thấm. Với nhiều năm kinh nghiệm trong lĩnh vực chống thấm, Bảo Linh luôn hướng đến việc mang đến cho khách hàng những sản phẩm chất lượng, giải pháp thi công hiệu quả và chi phí hợp lý.
                    </p>
                    <p class="story-desc">
                        Bảo Linh phân phối các dòng sản phẩm chuyên dụng như <strong>Màng PE, Phụ gia Smax S1F, Sơn KPB PU500, Grout G-1...</strong>, đáp ứng nhu cầu của các đại lý, nhà thầu và khách hàng trong nhiều hạng mục xây dựng.
                    </p>
                    <p class="story-desc">
                       <strong>Chất lượng sản phẩm – Uy tín phục vụ – Giải pháp hiệu quả</strong> là những giá trị Bảo Linh luôn đặt lên hàng đầu. Chúng tôi không chỉ cung cấp vật tư mà còn đồng hành cùng khách hàng trong việc <strong>tư vấn giải pháp, hướng dẫn kỹ thuật và lựa chọn vật liệu phù hợp</strong>, hướng tới hiệu quả chống thấm lâu dài cho mỗi công trình.
                    </p>

                    <ul class="about-checklist-grid">
                        <li><span class="icon-check">✓</span> 100% Sản phẩm chính hãng, chứng chỉ CO/CQ rõ ràng.</li>
                        <li><span class="icon-check">✓</span> Khảo sát hiện trạng & lập phương án miễn phí tận nơi.</li>
                        <li><span class="icon-check">✓</span> Đội ngũ kỹ sư trực tiếp hướng dẫn thi công chuẩn quy trình.</li>
                        <li><span class="icon-check">✓</span> Cam kết bảo hành dài hạn - Xử lý dứt điểm 100%.</li>
                    </ul>
                </div>
            </div>

            <!-- Khối Con Số Kinh Nghiệm (Đồng bộ với Front-Page) -->
            <div class="bl-stats-grid about-stats-override">
                <div class="stat-box">
                    <span class="stat-number">10+</span>
                    <span class="stat-title">Năm Kinh Nghiệm</span>
                    <p class="stat-desc">Đồng hành cùng hàng ngàn công trình lớn nhỏ</p>
                </div>
                <div class="stat-box">
                    <span class="stat-number">1,500+</span>
                    <span class="stat-title">Công Trình Hoàn Thành</span>
                    <p class="stat-desc">Nhà dân, chung cư, tầng hầm, sân thượng</p>
                </div>
                <div class="stat-box">
                    <span class="stat-number">3,000+</span>
                    <span class="stat-title">Khách Hàng Hài Lòng</span>
                    <p class="stat-desc">Tin tưởng giải pháp & vật tư Bảo Linh</p>
                </div>
                <div class="stat-box">
                    <span class="stat-number">100%</span>
                    <span class="stat-title">Bảo Hành Dài Hạn</span>
                    <p class="stat-desc">Xử lý dứt điểm, hỗ trợ 24/7 tận tâm</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. TẦM NHÌN - SỨ MỆNH - GIÁ TRỊ CỐT LÕI (CARD GRID) -->
    <section class="about-section values-section bg-light">
        <div class="container header-container-wide">
            <div class="section-title-center">
                <span class="section-badge-orange">ĐỊNH HƯỚNG PHÁT TRIỂN</span>
                <h2 class="about-heading-center">TẦM NHÌN - SỨ MỆNH - GIÁ TRỊ CỐT LÕI</h2>
            </div>

            <div class="values-grid-3">
                <!-- Card 1 -->
                <div class="value-card">
                    <div class="card-icon-box">👁️</div>
                    <h3 class="card-title-blue">TẦM NHÌN STRATEGIC</h3>
                    <p class="card-text">
                        Trở thành Siêu thị vật tư và Đơn vị cung cấp giải pháp chống thấm uy tín top đầu tại Hà Nội và toàn quốc, nâng cao tuổi thọ cho mọi công trình Việt.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="value-card active-border">
                    <div class="card-icon-box orange-bg">🎯</div>
                    <h3 class="card-title-orange">SỨ MỆNH CAO CẢ</h3>
                    <p class="card-text">
                        Mang đến cho chủ nhà, nhà thầu và đội thợ giải pháp chống thấm tận gốc với chi phí tối ưu, quy trình thi công an toàn và vật tư đạt chuẩn.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="value-card">
                    <div class="card-icon-box">💎</div>
                    <h3 class="card-title-blue">GIÁ TRỊ CỐT LÕI</h3>
                    <p class="card-text">
                        <strong>Trung thực</strong> trong tư vấn - <strong>Minh bạch</strong> về giá cả - <strong>Tận tâm</strong> trong hỗ trợ kỹ thuật và <strong>Trách nhiệm</strong> trọn đời công trình.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. QUY TRÌNH 4 BƯỚC THI CÔNG CHUẨN KỸ THUẬT -->
    <section class="about-section process-section">
        <div class="container header-container-wide">
            <div class="section-title-center">
                <span class="section-badge-orange">QUY TRÌNH LÀM VIỆC</span>
                <h2 class="about-heading-center">4 BƯỚC TỪ TƯ VẤN ĐẾN THI CÔNG GIẢI PHÁP</h2>
            </div>

            <div class="process-grid-4">
                <div class="process-step-card">
                    <div class="step-badge">01</div>
                    <h4 class="step-title">Tiếp Nhận Yêu Cầu</h4>
                    <p class="step-desc">Lắng nghe mô tả sự cố thấm, vị trí công trình và diện tích từ khách hàng qua Hotline/Zalo.</p>
                </div>
                <div class="process-step-card">
                    <div class="step-badge">02</div>
                    <h4 class="step-title">Khảo Sát Thực Tế</h4>
                    <p class="step-desc">Kỹ sư kiểm tra tận nơi, xác định chính xác nguyên nhân gây thấm (cổ ống, nứt sàn, khe co giãn...).</p>
                </div>
                <div class="process-step-card">
                    <div class="step-badge">03</div>
                    <h4 class="step-title">Phương Án & Báo Giá</h4>
                    <p class="step-desc">Đề xuất quy trình thi công tối ưu kèm báo giá chi tiết vật tư chống thấm chuyên dụng.</p>
                </div>
                <div class="process-step-card">
                    <div class="step-badge">04</div>
                    <h4 class="step-title">Giao Hàng & Hướng Dẫn</h4>
                    <p class="step-desc">Vận chuyển vật tư tận chân công trình và cử cán bộ kỹ thuật giám sát, hướng dẫn thi công chuẩn.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. ĐỐI TÁC THƯƠNG HIỆU LỚN -->
    <section class="about-section partners-section bg-light">
        <div class="container header-container-wide">
            <div class="partner-section-title">
                <span class="title-line"></span>
                <h2>THƯƠNG HỆU ĐỐI TÁC ĐỒNG HÀNH</h2>
                <span class="title-line"></span>
            </div>

            <div class="partner-logos-grid">
                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/sika-seeklogo.svg" alt="Sika" loading="lazy"></div>
                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-neomax.jpg" alt="Neomax" loading="lazy"></div>
                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-maxbond.jpg" alt="Maxbond" loading="lazy"></div>
                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-bestmix.jpg" alt="Bestmix" loading="lazy"></div>
                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-cosy.jpg" alt="Cosy" loading="lazy"></div>

                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-jotun.jpg" alt="Jotun" loading="lazy"></div>
                <div class="partner-card"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dulux-seeklogo.png" alt="Dulux" loading="lazy"></div>
            </div>
        </div>
    </section>

    <!-- 6. THÔNG TIN CỬA HÀNG & BẢN ĐỒ GOOGLE MAPS -->
    <section class="about-section location-section">
        <div class="container header-container-wide">
            <div class="section-title-center">
                <span class="section-badge-orange">GHÉ THĂM BẢO LINH</span>
                <h2 class="about-heading-center">CỬA HÀNG & VĂN PHÒNG GIAO DỊCH</h2>
            </div>

            <div class="location-grid-2">
                <!-- Thông tin liên hệ -->
                <div class="location-info-card">
                    <h3 class="company-name">CÔNG TY TNHH THƯƠNG MẠI VÀ PHÁT TRIỂN XÂY DỰNG BẢO LINH</h3>
                    
                    <div class="info-row">
                        <span class="info-icon">📍</span>
                        <div>
                            <strong>Văn phòng & Cửa hàng trưng bày:</strong>
                            <p>188 Nguyễn Xiển, Phường Hạ Đình, Quận Thanh Xuân, Hà Nội</p>
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="info-icon">🏭</span>
                        <div>
                            <strong>Trụ sở chính & Kho hàng:</strong>
                            <p>Cụm công nghiệp Bích Hòa, Huyện Thanh Oai, Hà Nội</p>
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="info-icon">📞</span>
                        <div>
                            <strong>Hotline tư vấn kỹ thuật 24/7:</strong>
                            <p><a href="tel:0903232492" class="hotline-link">0903.232.492</a> - <a href="tel:0985594631" class="hotline-link">0985.594.631</a></p>
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="info-icon">🌐</span>
                        <div>
                            <strong>Website chính thức:</strong>
                            <p>chongthambaolinh.com.vn</p>
                        </div>
                    </div>
                </div>

                <!-- Bản đồ Google Maps 188 Nguyễn Xiển -->
                <div class="map-embed-wrap">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.043542283084!2d105.80781707587713!3d20.988880389073105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acc486ca9801%3A0xb35a0f1fa2c2d495!2s188%20Nguy%E1%BB%85n%20Xi%E1%BB%83n%2C%20H%E1%BA%A1%20%C4%90%C3%ACnh%2C%20Thanh%20Xu%C3%A2n%2C%20H%E1%BA%A1%20N%E1%BB%99i!5e0!3m2!1svi!2svn!4v1710000000000!5m2!1svi!2svn" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();