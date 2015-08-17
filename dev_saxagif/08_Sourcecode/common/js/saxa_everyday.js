$(document).ready(function () {
    // custome scroll bar
    if ($('.programe_saxa_cont').height() >= 643) {
        $('.programe_saxa_cont').slimScroll({
            color: '#7eb235',
            size: '10px',
            height: '730px',
            alwaysVisible: true
        });
    }

    $('.box_main_QA').slimScroll({
        color: '#7eb235',
        size: '10px',
        height: '643px',
        alwaysVisible: true
    });
    
    $('.bullet_partner_l').css('margin-top', (Math.ceil($('.partner').height() / 2) + 7)+'px');
    $('.bullet_partner_r').css('margin-top', (Math.ceil($('.partner').height() / 2) + 7)+'px');
});

// show detail listen saxa
$(document).on('click', '.detailWeAreDo', function () {
    var id = $(this).attr('attr-id');

    $.ajax({
        dataType: 'json',
        url: URL_DETAIL_WE_ARE_DONE,
        type: 'POST',
        data: {
            'id': id,
        },
        beforeSend: function () {
            $('#main_loader').removeClass('c_hide');
        }
    })
    .done(function (data) {
        var more = '';
        if (data.code == 202) {
            var bodyWidth = $('body').outerWidth();

            $('body').css('width', bodyWidth + 'px');
            // show content post
            $('.titleDetail').html(data.detail.title);
            $('.pDetailCoOperate').html(data.detail.content);
            // show content more
            if (data.more != false) {
                $.each(data.more, function (key, index) {
                    more += '<li>';
                    more += '<a href="javascript:;" class="detailWeAreDo" attr-id="' + index.id + '">' + index.title + '</a>';
                    more += '</li>';
                });
                $("ul.link_posts").html(more);
            }

            $('.pdetail').dialogModal({
                topOffset: 0
            });
        }

        $('#main_loader').addClass('c_hide');
    });
});

