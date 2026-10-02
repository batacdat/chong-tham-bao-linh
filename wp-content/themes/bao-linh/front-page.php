<?php
/**
 * Template Name: Trang Chủ Bảo Linh
 * Description: Trang chủ tối ưu SEO, tốc độ cao, tách CSS riêng biệt.
 * Path: wp-content/themes/bao-linh/front-page.php
 */

get_header();
?>

<main id="primary" class="site-main front-page-wrapper">

    <!-- ==========================================================================
         1. HERO SECTION: SLIDER 5 ẢNH (5-8S) + BANNER GIỚI THIỆU BẢO LINH
         ========================================================================== -->
    <section class="bl-hero-section">
        <div class="container header-container-wide">
            <div class="bl-hero-grid">
                
                <!-- Cột Trái: Slider 5 Hình Ảnh (Chuyển 5-8 giây) -->
                <div class="bl-hero-slider-wrap">
                    <div class="swiper bl-hero-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ch3.jpg" alt="Vật tư chống thấm Bảo Linh" loading="eager">
                                <div class="slide-caption">Tổng kho vật tư chống thấm chính hãng</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ch6.jpg" alt="Sản phẩm màng chống thấm PE, PET" loading="lazy">
                                <div class="slide-caption">Màng chống thấm cao cấp chuẩn kỹ thuật</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ct_mai2.jpg" alt="Thi công chống thấm sân thượng" loading="lazy">
                                <div class="slide-caption">Giải pháp xử lý dứt điểm 100% thấm dột</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ch2.jpg" alt="Keo và phụ gia chống thấm" loading="lazy">
                                <div class="slide-caption">Phụ gia & Keo chống thấm gốc Polymer</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner gt cty.jpg" alt="Đội ngũ kỹ sư Bảo Linh" loading="lazy">
                                <div class="slide-caption">Đội ngũ kỹ sư khảo sát tận nơi miễn phí</div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <!-- Cột Phải: Sidebar Banner Quảng Cáo & Giới Thiệu Đôi Nét (Ảnh 2 & 3) -->
                <div class="bl-hero-sidebar">
                    <div class="bl-banner-card bl-card-intro">
                        <span class="bl-badge">VỀ CHÚNG TÔI</span>
                        <h3 class="card-title">BẢO LINH - KIẾN TẠO GIẢI PHÁP CHỐNG THẤM</h3>
                        <p class="card-desc">Chuyên cung cấp giải pháp, vật tư và kỹ thuật chống thấm toàn diện cho mọi công trình dân dụng & công nghiệp.</p>
                        <ul class="card-check-list">
                            <li>✔️ 100% Sản phẩm chính hãng, kiểm định chặt chẽ</li>
                            <li>✔️ Tư vấn giải pháp gốc rễ tiết kiệm chi phí</li>
                            <li>✔️ Hỗ trợ kỹ thuật 24/7 tận tâm, chuyên nghiệp</li>
                        </ul>
                    </div>

                    <div class="bl-banner-card bl-card-promo">
                        <div class="promo-tag">⚡ KHUYẾN MÃI DỰ ÁN</div>
                        <h4>ƯU ĐÃI VẬT TƯ & BÁO GIÁ ĐẠI LÝ</h4>
                        <p>Giảm tới 15% cho đơn hàng vật tư chống thấm số lượng lớn.</p>
                        <a href="tel:0903232492" class="btn-promo-call">📞 Hotline: 0903.232.492</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

   <!-- ==========================================================================
         2. SECTION THƯƠNG HỆU ĐỐI TÁC & CÁC CON SỐ NĂNG LỰC (CHUẨN HÌNH 6)
         ========================================================================== -->
    <section class="home-section bl-brands-experience-section">
        <div class="container header-container-wide">
            
            <!-- Khối Tiêu Đề Căn Giữa Chuẩn Hình 6 -->
            <div class="partner-section-title">
                <span class="title-line"></span>
                <h2>THƯƠNG HỆU ĐỐI TÁC</h2>
                <span class="title-line"></span>
            </div>

            <!-- Khối Thẻ Logo Thực Tế Các Hãng Tương Tác Với Bảo Linh -->
            <div class="partner-logos-grid">
                <?php
                // Danh sách logo các hãng đối tác thực tế của Chống Thấm Bảo Linh
                $partner_brands = array(
                    array(
                        'name' => 'Maxbond',
                        'logo' => get_template_directory_uri() . '/assets/images/logo-maxbond.jpg',
                        'url'  => '#'
                    ),
                    array(
                        'name' => 'Neomax',
                        'logo' => get_template_directory_uri() . '/assets/images/logo-neomax.jpg',
                        'url'  => '#'
                    ),
                    array(
                        'name' => 'Cosy',
                        'logo' => get_template_directory_uri() . '/assets/images/logo-cosy.jpg',
                        'url'  => '#'
                    ),
                    array(
                        'name' => 'Sika',
                        'logo' => get_template_directory_uri() . '/assets/images/sika-seeklogo.svg',
                        'url'  => '#'
                    ),
                    array(
                        'name' => 'Bestmix',
                        'logo' => get_template_directory_uri() . '/assets/images/logo-bestmix.jpg',
                        'url'  => '#'
                    ),
                    array(
                        'name' => 'Jotun',
                        'logo' => get_template_directory_uri() . '/assets/images/logo-jotun.jpg',
                        'url'  => '#'
                    ),
                    array(
                        'name' => 'Dulux',
                        'logo' => get_template_directory_uri() . '/assets/images/dulux-seeklogo.png',
                        'url'  => '#'
                    ),
                );

                foreach ( $partner_brands as $brand ) : ?>
                    <div class="partner-card">
                        <a href="<?php echo esc_url( $brand['url'] ); ?>" title="Đối tác <?php echo esc_attr( $brand['name'] ); ?>">
                            <img src="<?php echo esc_url( $brand['logo'] ); ?>" alt="Logo <?php echo esc_attr( $brand['name'] ); ?>" loading="lazy" />
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Khối Con Số Kinh Nghiệm & Công Trình Đã Làm -->
            <div class="bl-stats-grid">
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
                    <p class="stat-desc">Tin tưởng sử dụng giải pháp & vật tư Bảo Linh</p>
                </div>
                <div class="stat-box">
                    <span class="stat-number">100%</span>
                    <span class="stat-title">Cam Kết Chất Lượng</span>
                    <p class="stat-desc">Xử lý triệt để, bảo hành dài hạn rõ ràng</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ==========================================================================
         3. SECTION DANH MỤC SẢN PHẨM CHỐNG THẤM (GIAO DIỆN MỚI TÔNG CAM/XANH)
         ========================================================================== -->
    <section class="home-section section-products bg-light">
        <div class="container header-container-wide">
            
            <!-- Header Khối Sản Phẩm Theo Phong Cách Thẻ Tab/Banner Dải Cam (Lấy cảm hứng từ Hình 2) -->
            <div class="bl-product-section-header">
                <div class="product-header-badge-title">
                    <span class="badge-tag">VẬT TƯ CHỐNG THẤM</span>
                    <h2 class="section-title">SẢN PHẨM CHỐNG THẤM BẢO LINH</h2>
                </div>
                <div>
                    <a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>" class="btn-see-all-products">
                        Xem Tất Cả Sản Phẩm <span class="arrow">→</span>
                    </a>
                </div>
            </div>

            <!-- Lưới Sản Phẩm Grid 4 Cột -->
            <div class="products-grid-4">
                <?php
                $args_products = array(
                    'post_type'      => 'bl_product',
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                );
                $query_products = new WP_Query( $args_products );

                if ( $query_products->have_posts() ) :
                    while ( $query_products->have_posts() ) : $query_products->the_post();
                        $sku = get_post_meta( get_the_ID(), '_bl_product_sku', true );
                        $permalink = get_permalink();
                        ?>
                        <div class="product-card">
                            <div class="product-thumb">
                                <a href="<?php echo esc_url( $permalink ); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                                    <?php else : ?>
                                        <div class="product-placeholder">VẬT TƯ BẢO LINH</div>
                                    <?php endif; ?>
                                </a>

                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="<?php echo esc_url( $permalink ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <div class="product-action">
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="btn-product-detail">
                                        Xem Chi Tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
             else :
                    // Dữ liệu mẫu hiển thị kèm đường dẫn hình ảnh thực tế
                    $dummy_products = array(
                        array(
                            'title' => 'Màng Chống Thấm PE Bảo Linh 3 lớp', 
                            'code'  => 'Màng PE',
                            'image' => get_template_directory_uri() . '/assets/images/mct1.png'
                        ),
                        array(
                            'title' => 'Keo Phụ Gia Chống Thấm Smax S1F', 
                            'code'  => 'S1F',
                            'image' => get_template_directory_uri() . '/assets/images/5l.png'
                        ),
                        array(
                            'title' => 'Sơn Phủ Chống Thấm KPB PU500', 
                            'code'  => 'PU500',
                            'image' => get_template_directory_uri() . '/assets/images/kpb pu500.png'
                        ),
                        array(
                            'title' => 'Vật Liệu Xử Lý Cổ Ống Grout G-1', 
                            'code'  => 'GR-G1',
                            'image' => get_template_directory_uri() . '/assets/images/grout G-1 25kg (2).png'
                        ),
                    );
                    foreach ( $dummy_products as $item ) : ?>
                        <div class="product-card">
                            <div class="product-thumb">
                                <a href="#">
                                    <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
                                </a>
                                <span class="product-sku-badge">MÃ: <?php echo esc_html( $item['code'] ); ?></span>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a href="#"><?php echo esc_html( $item['title'] ); ?></a></h3>
                                <div class="product-action">
                                    <a href="#" class="btn-product-detail">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                endif;
                ?>
            </div>

        </div>
    </section>


<!-- ==========================================================================
         4. SECTION BÀI VIẾT QUY TRÌNH THI CÔNG & CHUYÊN MÔN (LẤY DỮ LIỆU CHUẨN TỪ DATABASE)
         ========================================================================== -->
    <section class="home-section section-knowledge-standard">
        <div class="container header-container-wide">
            
            <!-- Header Khối Bài Viết (Được căn lề đồng bộ tuyệt đối) -->
            <div class="knowledge-section-header">
                <div class="knowledge-header-left">
                    <span class="knowledge-badge">HƯỚNG DẪN KỸ THUẬT</span>
                    <h2 class="knowledge-title">QUY TRÌNH THI CÔNG CHỐNG THẤM CHUẨN</h2>
                </div>
                <div class="knowledge-header-right">
                    <a href="<?php echo esc_url( home_url( '/huong-dan' ) ); ?>" class="btn-see-all-knowledge">
                        Xem Tất Cả Bài Viết <span class="arrow">→</span>
                    </a>
                </div>
            </div>

            <!-- Khối Lưới 3 Thẻ Card Bài Viết -->
            <div class="knowledge-grid-3">
                <?php
                // Truy vấn 3 bài hướng dẫn thi công mới nhất từ CPT bl_instruction
                $args_instructions = array(
                    'post_type'      => 'bl_instruction',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $query_instructions = new WP_Query( $args_instructions );

                if ( $query_instructions->have_posts() ) :
                    while ( $query_instructions->have_posts() ) : $query_instructions->the_post();
                        $permalink = get_permalink();
                        $date      = get_the_date( 'd/m/Y' );
                        $excerpt   = get_the_excerpt();
                        if ( empty( $excerpt ) ) {
                            $excerpt = wp_trim_words( get_the_content(), 20, '...' );
                        }
                        ?>
                        <article class="knowledge-card">
                            <div class="knowledge-thumb">
                                <a href="<?php echo esc_url( $permalink ); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/banner combo nvs 3m2.png' ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                    <?php endif; ?>
                                </a>
                                <span class="knowledge-tag-badge">QUY TRÌNH CHUẨN</span>
                            </div>
                            <div class="knowledge-content">
                                <span class="knowledge-date">📅 <?php echo esc_html( $date ); ?></span>
                                <h3 class="knowledge-card-title">
                                    <a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="knowledge-excerpt"><?php echo esc_html( $excerpt ); ?></p>
                                <div class="knowledge-action">
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="btn-read-more">
                                        Xem Quy Trình Thi Công <span class="arrow">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Dữ liệu mẫu dự phòng khi database chưa có bài viết CPT bl_instruction
                    $dummy_articles = array(
                        array(
                            'title'   => 'Quy Trình Chống Thấm Sàn Nhà Vệ Sinh Dứt Điểm 100%',
                            'date'    => '25/09/2026',
                            'excerpt' => 'Chi tiết quy trình đục tẩy bề mặt, xử lý cổ ống xuyên sàn, quét màng chống thấm PE/PET Bảo Linh và ngâm nước kiểm tra.',
                            'image'   => get_template_directory_uri() . '/assets/images/banner combo nvs 3m2.png',
                            'link'    => '#'
                        ),
                        array(
                            'title'   => 'Kỹ Thuật Xử Lý Chống Thấm Sân Thượng Bị Nứt Nẻ Tường',
                            'date'    => '24/09/2026',
                            'excerpt' => 'Hướng dẫn thi công màng chống thấm đa lớp kết hợp sơn phủ PU500 xử lý triệt để đốm thấm và khe nứt co giãn sân thượng.',
                            'image'   => get_template_directory_uri() . '/assets/images/banner combo nvs 5m2.png',
                            'link'    => '#'
                        ),
                        array(
                            'title'   => 'Giải Pháp Chống Thấm Mạch Co Giãn & Khe Tiếp Giáp Tường',
                            'date'    => '22/09/2026',
                            'excerpt' => 'Quy trình bơm keo xốp Foam, dán màng butyl chống thấm và trám khe tiếp giáp bằng phụ gia Polymer S1F chuyên dụng.',
                            'image'   => get_template_directory_uri() . '/assets/images/banner mua 5 cuộn PE.png',
                            'link'    => '#'
                        ),
                    );

                    foreach ( $dummy_articles as $article ) : ?>
                        <article class="knowledge-card">
                            <div class="knowledge-thumb">
                                <a href="<?php echo esc_url( $article['link'] ); ?>" title="<?php echo esc_attr( $article['title'] ); ?>">
                                    <img src="<?php echo esc_url( $article['image'] ); ?>" alt="<?php echo esc_attr( $article['title'] ); ?>" loading="lazy">
                                </a>
                                <span class="knowledge-tag-badge">QUY TRÌNH CHUẨN</span>
                            </div>
                            <div class="knowledge-content">
                                <span class="knowledge-date">📅 <?php echo esc_html( $article['date'] ); ?></span>
                                <h3 class="knowledge-card-title">
                                    <a href="<?php echo esc_url( $article['link'] ); ?>"><?php echo esc_html( $article['title'] ); ?></a>
                                </h3>
                                <p class="knowledge-excerpt"><?php echo esc_html( $article['excerpt'] ); ?></p>
                                <div class="knowledge-action">
                                    <a href="<?php echo esc_url( $article['link'] ); ?>" class="btn-read-more">
                                        Xem Quy Trình Thi Công <span class="arrow">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach;
                endif;
                ?>
            </div>

        </div>
    </section>
    <!-- ==========================================================================
         5. SECTION FORM LIÊN HỆ & TƯ VẤN BÁO GIÁ
         ========================================================================== -->
    <section class="home-section section-cta-form bg-light">
        <div class="container header-container-wide">
            <div class="cta-form-box">
                <div class="cta-info-text">
                    <span class="section-badge">LIÊN HỆ BẢO LINH</span>
                    <h2>NHẬN TƯ VẤN KỸ THUẬT & BÁO GIÁ VẬT TƯ</h2>
                    <p>Hãy gửi thông tin nhu cầu của bạn, đội ngũ kỹ sư Chống Thấm Bảo Linh sẽ liên hệ hỗ trợ nhanh chóng trong 15 phút.</p>
                    <ul class="cta-check-list">
                        <li>✅ Khảo sát hiện trạng tận nơi hoàn toàn miễn phí</li>
                        <li>✅ Tư vấn vật tư chuẩn kỹ thuật & tiết kiệm</li>
                        <li>✅ Báo giá chi tiết minh bạch, bảo hành dài hạn</li>
                    </ul>
                </div>
                <div class="cta-form-wrapper">
                    <form action="#" method="post" class="bl-consultation-form">
                        <div class="form-group">
                            <input type="text" name="bl_fullname" placeholder="Họ và tên của bạn *" required />
                        </div>
                        <div class="form-group">
                            <input type="tel" name="bl_phone" placeholder="Số điện thoại / Zalo *" required />
                        </div>
                        <div class="form-group">
                            <select name="bl_category">
                                <option value="">--- Chọn hạng mục cần chống thấm ---</option>
                                <option value="nhave-sinh">Chống thấm Nhà Vệ Sinh</option>
                                <option value="san-thuong">Chống thấm Sân Thượng / Mái</option>
                                <option value="tuong-nha">Chống thấm Tường / Khe Giáp Ranh</option>
                                <option value="tang-ham">Chống thấm Tầng Hầm / Bể Nước</option>
                                <option value="vat-tu">Đăng ký Mua Vật Tư / Báo Giá Đại Lý</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="bl_note" rows="3" placeholder="Ghi chú thêm thông tin (Diện tích, tình trạng thấm...)"></textarea>
                        </div>
                        <button type="submit" class="bl-btn bl-btn-primary btn-block">GỬI YÊU CẦU TƯ VẤN BÁO GIÁ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();