document.addEventListener("DOMContentLoaded", function () {

    const statsSection = document.querySelector(".bl-stats-grid");

    if (!statsSection) {
        return;
    }

    const statNumbers = statsSection.querySelectorAll(".stat-number");

    let hasStarted = false;

    function animateNumber(element) {

        const originalText = element.textContent.trim();

        // Lấy hậu tố + hoặc %
        let suffix = "";

        if (originalText.includes("%")) {
            suffix = "%";
        } else if (originalText.includes("+")) {
            suffix = "+";
        }

        // Chuyển 1,500+ thành 1500
        const numericValue = parseInt(
            originalText.replace(/[^\d]/g, ""),
            10
        );

        if (isNaN(numericValue)) {
            return;
        }

        const duration = numericValue >= 1000 ? 2200 : 1600;
        const startTime = performance.now();

        function updateNumber(currentTime) {

            const elapsed = currentTime - startTime;

            const progress = Math.min(
                elapsed / duration,
                1
            );

            // Ease-out: chạy nhanh lúc đầu,
            // chậm dần khi gần đạt giá trị cuối.
            const easedProgress =
                1 - Math.pow(1 - progress, 3);

            const currentValue = Math.floor(
                numericValue * easedProgress
            );

            element.textContent =
                currentValue.toLocaleString("en-US") + suffix;

            if (progress < 1) {

                requestAnimationFrame(updateNumber);

            } else {

                element.textContent =
                    numericValue.toLocaleString("en-US") + suffix;

                element.classList.add("counter-done");
            }
        }

        requestAnimationFrame(updateNumber);
    }


    /*
     * Theo dõi khi khối số liệu xuất hiện trong màn hình.
     */
    const observer = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (
                    entry.isIntersecting &&
                    !hasStarted
                ) {

                    hasStarted = true;

                    /*
                     * Cho 4 card xuất hiện lần lượt.
                     */
                    statNumbers.forEach(function (element, index) {

                        const card =
                            element.closest(".stat-box");

                        if (card) {

                            setTimeout(function () {

                                card.classList.add(
                                    "stat-visible"
                                );

                            }, index * 120);
                        }
                    });


                    /*
                     * Bắt đầu chạy số.
                     */
                    statNumbers.forEach(function (element, index) {

                        setTimeout(function () {

                            animateNumber(element);

                        }, 250 + index * 120);

                    });

                    observer.disconnect();
                }
            });

        },
        {
            threshold: 0.25
        }
    );


    observer.observe(statsSection);

});
/* ==========================================================================
   CÂU CHUYỆN BẢO LINH - AUTO IMAGE SLIDESHOW
   ========================================================================== */

document.addEventListener("DOMContentLoaded", function () {

    const slideshowImage = document.getElementById(
        "bl-story-slideshow-image"
    );

    if (!slideshowImage) {
        return;
    }


    /* ----------------------------------------------------------
       Lấy danh sách 5 hình ảnh từ data-images
       ---------------------------------------------------------- */

    let images = [];

    try {

        images = JSON.parse(
            slideshowImage.getAttribute("data-images")
        );

    } catch (error) {

        console.error(
            "Bảo Linh Slideshow: Không thể đọc danh sách hình ảnh.",
            error
        );

        return;
    }


    /*
     * Kiểm tra số lượng ảnh
     */
    if (!Array.isArray(images) || images.length < 2) {
        return;
    }


    /* ----------------------------------------------------------
       Các thành phần
       ---------------------------------------------------------- */

    const dots = document.querySelectorAll(
        ".story-slide-dots .story-dot"
    );


    let currentIndex = 0;

    /*
     * 9 giây / ảnh.
     *
     * Bạn có thể đổi thành:
     *
     * 8000  = 8 giây
     * 9000  = 9 giây
     * 10000 = 10 giây
     */
    const slideDuration = 9000;

    /*
     * Thời gian fade.
     * Phải khớp tương đối với transition CSS.
     */
    const fadeDuration = 800;


    /* ----------------------------------------------------------
       PRELOAD TOÀN BỘ 5 ẢNH
       ---------------------------------------------------------- */

    images.forEach(function (imageUrl) {

        const preloadImage = new Image();

        preloadImage.src = imageUrl;

    });


    /* ----------------------------------------------------------
       Cập nhật dấu chấm
       ---------------------------------------------------------- */

    function updateDots() {

        dots.forEach(function (dot, index) {

            if (index === currentIndex) {

                dot.classList.add("active");

            } else {

                dot.classList.remove("active");

            }

        });
    }


    /* ----------------------------------------------------------
       Chuyển sang ảnh tiếp theo
       ---------------------------------------------------------- */

    function changeSlide() {

        /*
         * Làm ảnh hiện tại mờ dần.
         */
        slideshowImage.classList.add("is-changing");


        /*
         * Chờ fade-out hoàn tất.
         */
        setTimeout(function () {

            currentIndex++;

            /*
             * Khi đến ảnh cuối thì quay lại ảnh đầu.
             */
            if (currentIndex >= images.length) {

                currentIndex = 0;

            }


            /*
             * Thay ảnh.
             */
            slideshowImage.src =
                images[currentIndex];


            /*
             * Cập nhật dấu chấm.
             */
            updateDots();


            /*
             * Cho ảnh mới hiện ra.
             */
            requestAnimationFrame(function () {

                slideshowImage.classList.remove(
                    "is-changing"
                );

            });

        }, fadeDuration);

    }


    /* ----------------------------------------------------------
       Chạy slideshow
       ---------------------------------------------------------- */

    setInterval(
        changeSlide,
        slideDuration
    );


    /* ----------------------------------------------------------
       Trạng thái ban đầu
       ---------------------------------------------------------- */

    updateDots();

});