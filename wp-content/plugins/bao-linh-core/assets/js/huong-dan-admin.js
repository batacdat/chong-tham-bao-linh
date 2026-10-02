jQuery(document).ready(function($) {
    // 1. Thêm bước mới
    $('#bl-add-step').on('click', function(e) {
        e.preventDefault();
        var index = $('#bl-steps-wrapper .bl-step-item').length;
        var html = `
            <div class="bl-step-item" data-index="${index}">
                <div class="bl-step-header">
                    <strong>Bước <span class="bl-step-number">${index + 1}</span></strong>
                    <button type="button" class="button button-link-delete bl-remove-step">Xóa bước</button>
                </div>
                <div class="bl-step-body">
                    <p>
                        <label>Tiêu đề bước:</label>
                        <input type="text" name="bl_steps[${index}][title]" class="widefat" placeholder="Ví dụ: Vệ sinh bề mặt...">
                    </p>
                    <p>
                        <label>Nội dung hướng dẫn:</label>
                        <textarea name="bl_steps[${index}][content]" rows="4" class="widefat" placeholder="Mô tả chi tiết..."></textarea>
                    </p>
                    <div class="bl-image-upload-box">
                        <label>Hình minh họa bước:</label>
                        <input type="hidden" name="bl_steps[${index}][image_id]" class="bl-step-img-id" value="">
                        <div class="bl-step-img-preview"></div>
                        <button type="button" class="button bl-upload-step-img">Chọn ảnh</button>
                        <button type="button" class="button bl-remove-step-img" style="display:none;">Xóa ảnh</button>
                    </div>
                </div>
            </div>`;
        $('#bl-steps-wrapper').append(html);
    });

    // 2. Xóa bước
    $('#bl-steps-wrapper').on('click', '.bl-remove-step', function(e) {
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa bước này?')) {
            $(this).closest('.bl-step-item').remove();
            reindexSteps();
        }
    });

    function reindexSteps() {
        $('#bl-steps-wrapper .bl-step-item').each(function(i) {
            $(this).attr('data-index', i);
            $(this).find('.bl-step-number').text(i + 1);$(this).find('input[type="text"]').attr('name', `bl_steps[${i}][title]`);
            $(this).find('textarea').attr('name', `bl_steps[${i}][content]`);
            $(this).find('.bl-step-img-id').attr('name', `bl_steps[${i}][image_id]`);
        });
    }

    // 3. Upload ảnh minh họa cho bước
    $('#bl-steps-wrapper').on('click', '.bl-upload-step-img', function(e) {
        e.preventDefault();
        var $btn =$(this);
        var $box =$btn.closest('.bl-image-upload-box');
        var frame = wp.media({
            title: 'Chọn ảnh minh họa bước',
            button: { text: 'Dùng ảnh này' },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $box.find('.bl-step-img-id').val(attachment.id);$box.find('.bl-step-img-preview').html(`<img src="${attachment.url}" style="max-width: 150px; display:block; margin-bottom:5px;">`);
            $box.find('.bl-remove-step-img').show();
        });
        frame.open();
    });

    // 4. Xóa ảnh
    $('#bl-steps-wrapper').on('click', '.bl-remove-step-img', function(e) {
        e.preventDefault();
        var $box = $(this).closest('.bl-image-upload-box');$box.find('.bl-step-img-id').val('');
        $box.find('.bl-step-img-preview').html('');$(this).hide();
    });
});