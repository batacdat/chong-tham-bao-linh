jQuery(document).ready(function ($) {

    let mediaFrame;


    $('#bao-linh-select-gallery').on('click', function (e) {

        e.preventDefault();


        if (mediaFrame) {
            mediaFrame.open();
            return;
        }


        mediaFrame = wp.media({

            title: 'Chọn hình ảnh sản phẩm',

            button: {
                text: 'Thêm hình ảnh'
            },

            multiple: true

        });


        mediaFrame.on('select', function () {

            const attachments = mediaFrame
                .state()
                .get('selection')
                .toJSON();


            let ids = $('#bao_linh_gallery')
                .val()
                .split(',')
                .filter(Boolean);


            attachments.forEach(function (attachment) {

                const id = String(attachment.id);


                if (!ids.includes(id)) {

                    ids.push(id);

                    addGalleryImage(
                        attachment.id,
                        attachment.url
                    );
                }

            });


            $('#bao_linh_gallery').val(
                ids.join(',')
            );

        });


        mediaFrame.open();

    });


    function addGalleryImage(id, url) {

        const html = `
            <div
                class="bao-linh-gallery-item"
                data-id="${id}"
                style="
                    position:relative;
                    width:100px;
                    height:100px;
                "
            >

                <img
                    src="${url}"
                    style="
                        width:100%;
                        height:100%;
                        object-fit:cover;
                        border:1px solid #ddd;
                    "
                >

                <button
                    type="button"
                    class="button bao-linh-remove-image"
                    style="
                        position:absolute;
                        top:3px;
                        right:3px;
                        padding:0 5px;
                    "
                >
                    ×
                </button>

            </div>
        `;


        $('#bao-linh-gallery-preview')
            .append(html);
    }


    $(document).on(
        'click',
        '.bao-linh-remove-image',
        function () {

            const item = $(this).closest(
                '.bao-linh-gallery-item'
            );


            const id = String(
                item.data('id')
            );


            item.remove();


            let ids = $('#bao_linh_gallery')
                .val()
                .split(',')
                .filter(Boolean);


            ids = ids.filter(function (value) {

                return String(value) !== id;

            });


            $('#bao_linh_gallery').val(
                ids.join(',')
            );

        }
    );

});