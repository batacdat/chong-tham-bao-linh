/**
 * Contact Form & Interactive Logic - Chống Thấm Bảo Linh
 * File: assets/js/contact.js
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    /* ==========================================================================
       1. FORM LIÊN HỆ & UPLOAD HÌNH ẢNH CÔNG TRÌNH
       ========================================================================== */
    const contactForm = document.querySelector('.bl-contact-form');
    
    if (contactForm) {
        const fileInput = document.getElementById('bl-contact-images');
        const fileListContainer = document.getElementById('bl-contact-file-list');
        const submitBtn = contactForm.querySelector('.bl-submit-btn');
        const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';

        // Đội tượng quản lý danh sách file được chọn
        let dataTransfer = new DataTransfer();
        const MAX_FILES = 5;
        const MAX_SIZE_MB = 5;
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

        /* ----------------------------------------------------------------------
           1.1. Xử lý Upload & Render Danh Sách File
           ---------------------------------------------------------------------- */
        if (fileInput && fileListContainer) {
            fileInput.addEventListener('change', function (e) {
                const incomingFiles = Array.from(e.target.files);

                incomingFiles.forEach(file => {
                    // Kiểm tra giới hạn số lượng ảnh
                    if (dataTransfer.files.length >= MAX_FILES) {
                        alert(`Bạn chỉ được tải lên tối đa ${MAX_FILES} hình ảnh.`);
                        return;
                    }

                    // Kiểm tra định dạng ảnh
                    if (!ALLOWED_TYPES.includes(file.type)) {
                        alert(`File "${file.name}" không đúng định dạng (Chỉ nhận JPG, PNG, WEBP).`);
                        return;
                    }

                    // Kiểm tra dung lượng file
                    if (file.size > MAX_SIZE_MB * 1024 * 1024) {
                        alert(`File "${file.name}" vượt quá dung lượng tối đa ${MAX_SIZE_MB}MB.`);
                        return;
                    }

                    // Thêm file hợp lệ vào DataTransfer
                    dataTransfer.items.add(file);
                });

                // Cập nhật lại input files và hiển thị giao diện
                fileInput.files = dataTransfer.files;
                renderFileList();
            });

            // Hàm render danh sách file đã chọn
            function renderFileList() {
                fileListContainer.innerHTML = '';

                if (dataTransfer.files.length === 0) {
                    return;
                }

                Array.from(dataTransfer.files).forEach((file, index) => {
                    const item = document.createElement('div');
                    item.className = 'bl-file-item';
                    item.style.cssText = `
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        padding: 5px 10px;
                        background: var(--bl-blue-soft, #eef2ff);
                        color: var(--bl-blue, #3652cb);
                        border-radius: 6px;
                        font-size: 12px;
                        margin-top: 5px;
                    `;

                    const fileName = document.createElement('span');
                    fileName.textContent = file.name.length > 20 ? file.name.substring(0, 17) + '...' : file.name;

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.style.cssText = `
                        border: none;
                        background: transparent;
                        color: #ef4444;
                        font-weight: bold;
                        font-size: 14px;
                        cursor: pointer;
                        padding: 0 2px;
                        line-height: 1;
                    `;

                    // Xử lý sự kiện xoá file
                    removeBtn.addEventListener('click', function () {
                        removeFileAt(index);
                    });

                    item.appendChild(fileName);
                    item.appendChild(removeBtn);
                    fileListContainer.appendChild(item);
                });
            }

            // Hàm xoá file khỏi DataTransfer
            function removeFileAt(index) {
                const newDt = new DataTransfer();
                const files = Array.from(dataTransfer.files);

                files.forEach((file, i) => {
                    if (i !== index) {
                        newDt.items.add(file);
                    }
                });

                dataTransfer = newDt;
                fileInput.files = dataTransfer.files;
                renderFileList();
            }
        }

        /* ----------------------------------------------------------------------
           1.2. Validate Form & Gửi Yêu Cầu Tư Vấn Qua AJAX
           ---------------------------------------------------------------------- */
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Lấy dữ liệu các ô nhập
            const nameInput = document.getElementById('bl-contact-name');
            const phoneInput = document.getElementById('bl-contact-phone');

            // Kiểm tra Họ và tên
            if (!nameInput || !nameInput.value.trim()) {
                alert('Vui lòng nhập Họ và tên.');
                if (nameInput) nameInput.focus();
                return;
            }

            // Validate Số điện thoại/Zalo (Định dạng SĐT Việt Nam)
            const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
            if (!phoneInput || !phoneRegex.test(phoneInput.value.trim())) {
                alert('Vui lòng nhập số điện thoại / Zalo hợp lệ (vd: 0912345678).');
                if (phoneInput) phoneInput.focus();
                return;
            }

            // Chuẩn bị FormData để gửi Ajax
            const formData = new FormData(contactForm);

            // Bật trạng thái Loading trên nút Gửi
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
            submitBtn.innerHTML = '<span>Đang gửi yêu cầu...</span>';

            // Xoá thông báo cũ nếu có
            const existingNotice = contactForm.querySelector('.bl-form-notice-response');
            if (existingNotice) existingNotice.remove();

            // Gửi dữ liệu qua WP AJAX (hoặc admin-post nếu gửi truyền thống)
            const ajaxUrl = (typeof bl_contact_params !== 'undefined') ? bl_contact_params.ajax_url : contactForm.getAttribute('action');

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Có lỗi xảy ra kết nối Server.');
                }
                return response.text();
            })
            .then(data => {
                // Đưa nút về trạng thái ban đầu
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.innerHTML = originalBtnHtml;

                // Tạo hộp thông báo phản hồi
                const noticeBox = document.createElement('div');
                noticeBox.className = 'bl-form-notice-response';
                noticeBox.style.cssText = `
                    padding: 12px 16px;
                    border-radius: 8px;
                    margin-top: 15px;
                    font-size: 13.5px;
                    text-align: center;
                    font-weight: 600;
                    background: #dcfce7;
                    color: #15803d;
                    border: 1px solid #bbf7d0;
                `;
                noticeBox.innerHTML = '✓ Yêu cầu của bạn đã được gửi thành công! Đội ngũ Bảo Linh sẽ liên hệ lại trong thời gian sớm nhất.';

                contactForm.appendChild(noticeBox);

                // Reset Form dữ liệu
                contactForm.reset();
                dataTransfer = new DataTransfer();
                if (fileInput) fileInput.files = dataTransfer.files;
                if (fileListContainer) fileListContainer.innerHTML = '';

                // Tự động ẩn thông báo sau 8 giây
                setTimeout(() => {
                    noticeBox.remove();
                }, 8000);
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.innerHTML = originalBtnHtml;

                const errorBox = document.createElement('div');
                errorBox.className = 'bl-form-notice-response';
                errorBox.style.cssText = `
                    padding: 12px 16px;
                    border-radius: 8px;
                    margin-top: 15px;
                    font-size: 13.5px;
                    text-align: center;
                    font-weight: 600;
                    background: #fee2e2;
                    color: #b91c1c;
                    border: 1px solid #fecaca;
                `;
                errorBox.innerHTML = '❌ Tải yêu cầu thất bại. Vui lòng kiểm tra lại kết nối mạng hoặc gọi trực tiếp Hotline.';
                contactForm.appendChild(errorBox);
            });
        });
    }

    /* ==========================================================================
       2. CÁC CHỨC NĂNG TƯƠNG TÁC BỔ SUNG TRÊN TRANG LIÊN HỆ
       ========================================================================== */

    /* ----------------------------------------------------------------------
       2.1. Cuộn mượt (Smooth Scroll) tới Form khi bấm nút Tư Vấn / Nhận Báo Giá
       ---------------------------------------------------------------------- */
    const ctaButtons = document.querySelectorAll('a[href="#bl-contact-form-card"], a[href="#primary"]');
    ctaButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId.startsWith('#') && targetId.length > 1) {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    /* ----------------------------------------------------------------------
       2.2. Tracking / Ghi nhận sự kiện khi khách ấn Gọi Hotline hoặc Nhắn Zalo
       ---------------------------------------------------------------------- */
    const contactLinks = document.querySelectorAll('a[href^="tel:"], a[href*="zalo.me"]');
    contactLinks.forEach(link => {
        link.addEventListener('click', function () {
            const type = this.getAttribute('href').startsWith('tel:') ? 'Gọi điện Hotline' : 'Nhắn tin Zalo';
            console.log(`[Bảo Linh Contact Tracking]: Khách hàng đã click - ${type}`);
            
            // Tích hợp Google Analytics / Tag Manager (nếu có)
            if (typeof gtag === 'function') {
                gtag('event', 'contact_click', {
                    'event_category': 'Contact',
                    'event_label': type
                });
            }
        });
    });

    /* ----------------------------------------------------------------------
       2.3. Tự động lấy tham số nhu cầu từ URL (Nội dung động)
       Ví dụ: chongthambaolinh.com.vn/lien-he/?need=Tư vấn chống thấm
       ---------------------------------------------------------------------- */
    const urlParams = new URLSearchParams(window.location.search);
    const needParam = urlParams.get('need');
    const categoryParam = urlParams.get('category');

    if (needParam) {
        const selectNeed = document.getElementById('bl-contact-need');
        if (selectNeed) selectNeed.value = decodeURIComponent(needParam);
    }

    if (categoryParam) {
        const selectCategory = document.getElementById('bl-contact-category');
        if (selectCategory) selectCategory.value = decodeURIComponent(categoryParam);
    }
});