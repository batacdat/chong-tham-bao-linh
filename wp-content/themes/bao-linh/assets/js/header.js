/**
 * Header JavaScript - Chống Thấm Bảo Linh
 * Path: wp-content/themes/bao-linh/assets/js/header.js
 */
document.addEventListener('DOMContentLoaded', function() {
    // 1. Mobile Drawer Elements
    const openBtn = document.getElementById('openMobileDrawer');
    const closeBtn = document.getElementById('closeMobileDrawer');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');

    function openMenu() {
        if (drawer) drawer.classList.add('active');
        if (overlay) overlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Khóa cuộn trang khi mở menu
    }

    function closeMenu() {
        if (drawer) drawer.classList.remove('active');
        if (overlay) overlay.classList.remove('active');
        document.body.style.overflow = ''; // Mở lại cuộn trang khi đóng
    }

    if (openBtn) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openMenu();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeMenu();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }

    // Đóng drawer bằng phím ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMenu();
        }
    });

    // 2. Dropdown Danh mục Sản phẩm (Desktop)
    const catBtn = document.getElementById('catDropdownBtn');
    const catDropdown = document.querySelector('.product-category-dropdown');

    if (catBtn && catDropdown) {
        catBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            catDropdown.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!catDropdown.contains(e.target)) {
                catDropdown.classList.remove('active');
            }
        });
    }
});