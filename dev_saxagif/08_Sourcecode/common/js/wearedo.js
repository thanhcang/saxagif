$(document).ready(function () {
    // custome scroll bar
    if ($('.cont_topic').height() >= 1132) {
        $('.scrollWeAreDo').slimScroll({
            color: '#7eb235',
            size: '10px',
            height: '1132px',
            alwaysVisible: true
        });
    }

});

// show detail listen saxa
$(document).on('click', '.detailWeAreDo', function () {
    var id = $(this).attr('attr-id');

    $.ajax({
        dataType: 'json',
        url: URL_DETAIL_WE_ARE_DO,
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

