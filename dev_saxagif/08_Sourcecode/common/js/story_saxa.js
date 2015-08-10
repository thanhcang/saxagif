$(document).ready(function () {
    $('.scrollbar').slimScroll({
        color: '#7eb235',
        size: '10px',
        height: '530px',
        width: '785px',
        alwaysVisible: true
    });

    $('.focusImg').on('mouseover', function () {
        $(this).addClass('mask_staff');
    });

    $('.focusImg').on('mouseleave', function () {
        $(this).removeClass('mask_staff');
    });
});

// show detail listen saxa
$(document).on('click', '.listenDetail', function () {
    var id = $(this).attr('attr-id');

    $.ajax({
        dataType: 'json',
        url: URL_DETAIL_YOUR_SAY,
        type: 'POST',
        data: {
            'id': id,
        },
        beforeSend: function () {
            $('#main_loader').removeClass('c_hide');
        }
    })
            .done(function (e) {
                var anotherSay = '';
                if (e.code == '202') {
                    $('.logoYourSay').attr('src', BASE_URL + 'admin/common/multidata/listen_to_them_say/' + e.data.logo);
                    $('.contentYourSay').html(e.data.comment);

                    $.each(e.anotherSay, function (index, value) {
                        anotherSay += '<li class="listenDetail" attr-id="' + value.id + '"><a href="javascript:;"><img src="' + BASE_URL + 'admin/common/multidata/listen_to_them_say/' + value.logo + '"></a></li>'
                    });
                    $('.other_talk').html(anotherSay);

                    var bodyWidth = $('body').outerWidth();

                    $('body').css('width', bodyWidth + 'px');
                    $('.sendmail').dialogModal({
                        topOffset: 0
                    });
                }
                $('#main_loader').addClass('c_hide');
            });
});

