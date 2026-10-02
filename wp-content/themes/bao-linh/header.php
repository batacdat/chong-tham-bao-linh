<?php
/**
 * Header Template - Chống Thấm Bảo Linh
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <!-- 1. TOPBAR (MÀU CAM) -->
    <div class="header-topbar">
        <div class="container header-container-wide">
            <div class="topbar-left">
                <span class="topbar-brand-title">SIÊU THỊ VẬT TƯ CHỐNG THẤM BẢO LINH</span>
            </div>
            <div class="topbar-right desktop-only">
                <div class="topbar-item">
                    <span> Cửa Hàng: 188 Nguyễn Xiển, Thanh Xuân, Hà Nội</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MIDDLE HEADER (DESKTOP) -->
    <div class="header-middle desktop-only">
        <div class="container header-container-wide">
            <!-- LOGO LỚN -->
            <div class="site-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-bao-linh.svg' ); ?>" alt="Bảo Linh Waterproof Logo" />
                </a>
            </div>

            <!-- SEARCH BAR -->
            <div class="header-search-wrapper">
                <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" class="search-input-field" placeholder="Tìm kiếm sản phẩm, giải pháp chống thấm..." value="<?php echo get_search_query(); ?>" name="s" required />
                    <button type="submit" class="search-submit-btn">
                        <span> TÌM KIẾM</span>
                    </button>
                </form>
            </div>

            <!-- KHỐI LIÊN HỆ ZALO & HOTLINE -->
            <div class="header-contacts-wrapper">
                <a href="https://zalo.me/0903232492" target="_blank" rel="nofollow" class="contact-card contact-zalo">
                    <div class="contact-icon zalo-icon-bg">
                        <span>Zalo</span>
                    </div>
                    <div class="contact-info">
                        <span class="contact-label">ZALO</span>
                        <strong class="contact-number">0903.232.492</strong>
                    </div>
                </a>

                <a href="tel:0903232492" class="contact-card contact-hotline">
                    <div class="contact-icon hotline-icon-bg">
                        <span>📞</span>
                    </div>
                    <div class="contact-info">
                        <span class="contact-label">HOTLINE</span>
                        <strong class="contact-number">0903.232.492</strong>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- 3. BOTTOM HEADER (NAVBAR DESKTOP) -->
    <div class="header-bottom desktop-only">
        <div class="container header-container-wide">
            <div class="nav-bar-wrapper">
                <!-- DROPDOWN DANH MỤC SẢN PHẨM -->
                <div class="product-category-dropdown">
                    <button class="cat-dropdown-btn" id="catDropdownBtn" type="button">
                        <span class="cat-btn-icon">☰</span>
                        <span class="cat-btn-text">DANH MỤC SẢN PHẨM</span>
                        <span class="cat-btn-arrow">▼</span>
                    </button>
                    <div class="cat-dropdown-content" id="catDropdownMenu">
                        <ul class="cat-menu-list">
                            <?php
                            $categories = get_terms( array(
                                'taxonomy'   => 'bl_product_cat',
                                'hide_empty' => false,
                            ) );

                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                foreach ( $categories as $cat ) {
                                    echo '<li><a href="' . esc_url( get_term_link( $cat ) ) . '"><span class="cat-icon">🔹</span> ' . esc_html( $cat->name ) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#"> <span class="cat-icon">🔹</span> Keo & Phụ Gia Chống Thấm</a></li>';
                                echo '<li><a href="#"> <span class="cat-icon">🔹</span> Màng Chống Thấm</a></li>';
                                echo '<li><a href="#"> <span class="cat-icon">🔹</span> Vật Liệu Xử Lý Mối Nối</a></li>';
                                echo '<li><a href="#"> <span class="cat-icon">🔹</span> Sơn & Phủ Chống Thấm</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- MENU ĐIỀU HƯỚNG CHÍNH -->
                <nav class="primary-menu-desktop">
                    <ul>
                        <li class="<?php echo is_front_page() ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
                        <li class="<?php echo is_page( 'gioi-thieu' ) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">
                                Giới thiệu
                            </a>
                        </li>
                        <li><a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Sản phẩm</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/huong-dan/' ) ); ?>">Hướng dẫn thi công</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- 4. MOBILE / TABLET HEADER LAYOUT -->
    <div class="header-mobile-main mobile-only">
        <!-- Icon Menu Toggle Bar -->
        <button class="mobile-nav-toggle" id="openMobileDrawer" type="button" aria-label="Open Menu">
            <span class="bar-icon-box">
                <span class="icon-line"></span>
                <span class="icon-line"></span>
                <span class="icon-line"></span>
            </span>
        </button>

        <!-- Logo Bảo Linh Căn Giữa -->
        <div class="site-logo-mobile">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-bao-linh.svg' ); ?>" alt="Bảo Linh Logo" />
            </a>
        </div>

        <!-- Khối trống giữ cân bằng Grid Flex -->
        <div class="mobile-header-placeholder"></div>
    </div>

    <!-- Mobile Search Bar Nằm Phía Dưới -->
    <div class="mobile-search-bar mobile-only">
        <form role="search" method="get" class="mobile-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" placeholder="Tìm kiếm sản phẩm, giải pháp..." value="<?php echo get_search_query(); ?>" name="s" required />
            <button type="submit"> TÌM KIẾM</button>
        </form>
    </div>

    <!-- Popup Drawer Navigation Menu -->
    <div class="mobile-drawer-overlay mobile-only" id="drawerOverlay"></div>
    <div class="mobile-nav-drawer mobile-only" id="mobileDrawer">
        <div class="mobile-drawer-header">
            <strong>MENU ĐIỀU HƯỚNG</strong>
            <button class="mobile-drawer-close" id="closeMobileDrawer" type="button" aria-label="Close Menu">✕</button>
        </div>
        <ul class="mobile-drawer-menu">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
           
            <li class="<?php echo is_page( 'gioi-thieu' ) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">
                    Giới thiệu
                </a>
            </li>
            <li><a href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Sản phẩm</a></li>
            <li><a href="<?php echo esc_url( home_url( '/huong-dan/' ) ); ?>">Hướng dẫn thi công</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Liên hệ</a></li>
        </ul>
    </div>
</header>