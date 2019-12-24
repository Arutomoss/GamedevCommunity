jQuery(document).ready(function ($) {

    var basic;

    $('.add-photo').on('click', function () {

        $("#c_input24").trigger('click');
        return false;
    });

    $('.js-main-image').on('click', function () {
        basic.croppie('result', 'base64').then(function (html) {
            $.ajaxSetup({
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'server.php',
                type: "POST",
                data: 'photo=' + html + "&photo_c=" + $('input[name="photo_c"]').val(),
                dataType: "json"
            })
            .done(function(html) {
                if (html.status = "success"){
                    $('input[name="photo_i"]').val(html.file_mini);
                    $('.content-source img').attr('src', html.path_mini);
                    $('.profile-modal-photo').arcticmodal('close');
                }
            });
        });
    });

    $("#c_input24").on('change', function () {
        var formData = new FormData();
        formData.append('file', $(this)[0].files[0]);
        $.ajaxSetup({
            headers: {
                //headers
            }
        });
        $.ajax({
            url: 'server.php',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json"
        })
            .done(function (html) {
                if (html.status == "success") {
                    $('input[name="photo_c"]').val(html.file_max);
                    $('.profile_photo_i').attr('src', html.path_max);

                    basic = $('.profile_photo_i').croppie({
                        viewport: {
                            width: 200,
                            height: 200,
                            type: 'circle'
                        }
                    });

                    $('.profile-modal-photo').arcticmodal({
                        beforeOpen: function () {

                        },
                        afterClose: function () {
                            $('.profile_photo_i').croppie('destroy');
                        }
                    });
                }
            })

    });
}); 