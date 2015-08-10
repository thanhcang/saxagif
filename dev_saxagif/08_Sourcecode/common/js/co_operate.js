$(document).ready(function () {
    $('.detailCoOperate').on('click', function () {
        var id = $(this).attr('attr-id');
        var more = '';
        $.ajax({
            type: 'POST',
            dataType: "json",
            data: {
                id: id,
            },
            url: URL_SHOW_COOPERATE,
//            async: false,
            beforeSend: function () {
                $('#main_loader').removeClass('c_hide');
            }
        }).done(function (data) {
            if (data.code == 202) {
                var bodyWidth = $('body').outerWidth();
                
                $('body').css('width',bodyWidth+'px');
                // show content post
                $('.titleDetail').html(data.title);
                $('.pDetailCoOperate').html(data.description);
                // show content more
                if (data.more != false){
                    $.each(data.more, function(key, index){
                        more += '<li>';
                        more += '<a href="javascript:;" class="pMore" attr-id="'+index.id+'">'+index.title+'</a>';
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
    
    $('.scrollbar-external').slimScroll({
        color: '#7eb235',
        size: '10px',
        height: '374px',
        alwaysVisible: true
    });
});

/**
 * on click view detail post in popup
 */
$(document).on('click', '.pMore', function () {
    var id = $(this).attr('attr-id');
    var more = '';
    $.ajax({
        type: 'POST',
        dataType: "json",
        data: {
            id: id,
        },
        url: URL_SHOW_COOPERATE,
//            async: false,
        beforeSend: function () {
            $('#main_loader').removeClass('c_hide');
        }
    }).done(function (data) {
        if (data.code == 202) {
            var bodyWidth = $('body').outerWidth();

            $('body').css('width', bodyWidth + 'px');
            // show content post
            $('.pDetailCoOperate').html(data.description);
            // show content more
            if (data.more != false) {
                $.each(data.more, function (key, index) {
                    more += '<li>';
                    more += '<a href="javascript:;" class="pMore" attr-id="' + index.id + '">' + index.title + '</a>';
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