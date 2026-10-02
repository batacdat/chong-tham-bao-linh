jQuery(document).ready(function($) {
    // 1. Tải danh sách sản phẩm ban đầu khi vào trang
    if ($('#bl-product-list-container').length > 0) {
        loadProductsByCat(0);
    }

    // 2. Click chọn Danh mục
    $(document).on('click', '.bl-cat-link', function(e) {
        e.preventDefault();
        $('.bl-cat-link').removeClass('active');
        $(this).addClass('active');

        var catId = $(this).data('cat-id');
        loadProductsByCat(catId);
    });

    // 3. Click chọn Sản phẩm
    $(document).on('click', '.bl-prod-item-link', function(e) {
        e.preventDefault();
        $('.bl-prod-item-link').removeClass('active');
        $(this).addClass('active');

        var prodId = $(this).data('prod-id');
        loadProductDetail(prodId);
    });

    // Hàm gọi AJAX lấy danh sách sản phẩm
    function loadProductsByCat(catId) {
        $('#bl-product-list-container').html('<li style="font-size:13px; color:#94a3b8; padding:10px;">Đang tải sản phẩm...</li>');

        $.ajax({
            url: bl_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'bl_get_products_by_category',
                cat_id: catId
            },
            success: function(response) {
                if (response.success) {
                    $('#bl-product-list-container').html(response.data.html);
                    if (response.data.first_id > 0) {
                        loadProductDetail(response.data.first_id);
                    } else {
                        $('#bl-product-detail-container').html('<div style="text-align:center; padding:50px; color:#94a3b8;">Không có sản phẩm nào trong danh mục này.</div>');
                    }
                }
            }
        });
    }

    // Hàm gọi AJAX lấy chi tiết sản phẩm
    function loadProductDetail(prodId) {
        $('#bl-product-detail-container').html('<div style="text-align:center; padding:50px; color:#94a3b8;">Đang tải thông tin sản phẩm...</div>');

        $.ajax({
            url: bl_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'bl_get_product_detail_content',
                prod_id: prodId
            },
            success: function(response) {
                if (response.success) {
                    $('#bl-product-detail-container').html(response.data.html);
                }
            }
        });
    }
});