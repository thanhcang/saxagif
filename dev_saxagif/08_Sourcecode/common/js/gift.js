$('html,body').animate({
    scrollTop: $("#tabs_gift").offset().top},
'slow');

$(function () {
//    showDetailProduct(); 
    if ($('.srollbarProduct').height >= 530) {
        $('.srollbarProduct').slimScroll({
            color: '#7eb235',
            size: '10px',
            height: '530px',
            width: '1220px',
            alwaysVisible: true,
        });
    }

});

$(document).on('click', '.showDetailProduct', function () {

    var _product_id = $(this).attr('attr_pro');
    var _content = $('.detail-product .dialogModal_content');
    _content.html('');
    var _html = '';
    $.ajax({
        type: 'POST',
        dataType: "json",
        data: {
            product_id: _product_id,
            gift : 1
        },
        url: URL_DETAIL_PRODUCT,
        beforeSend: function () {
            $('#main_loader').removeClass('c_hide');
        },
        success: function (result)
        {

            if (result.code == 200) {

                _html += '<a title="Close" class="p_close js__p_close" href="javascript:;"></a>';
                _html += '<div class="p_content p_cont_pro">';
                _html += '<div class="product_detail">';
                _html += '<div class="detail_l">';
                _html += '<img src="' + BASE_URL + URL_PRODUCT_IMAGE + result.image[0]['name'] + '" class="product_large"/>';
                _html += '<div class="img_detail">';
                _html += '<ul class="popImageThumb">';
                var _i = 0;
                $.each(result.image, function (index, value) {
                    _html += '<li attr-logo="' + value.name + '" class="showImageThumb"><img src="' + BASE_URL + URL_PRODUCT_THUMB_IMAGE + value.name + '"/></li>';
                });
                _html += '</ul>';
                _html += '</div>';
                _html += '</div>';
                _html += '<div class="detail_r">';
                _html += '<div class="tit_product_detail">' + result.detail.name + '</div>';
                _html += '<div class="info_product_detail">';
                _html += '<p>';
                _html += '<label>' + PRICE + ':</label> ' + result.detail.name + 'VND';
                _html += '</p>';
                _html += '<p>';
                _html += '<label>' + MATERIAL + ':</label>';
                _html += '</p>';
                _html += '<p>';
                _html += '<label>' + PRO_DESIGN + ':</label>';
                _html += '</p>';
                _html += '<p>';
                _html += '<label>' + MADE_IN + ':</label>';
                _html += '</p>';
                _html += '<p class="detailProductPopup">'
                _html += '<label>' + DESCRIPTION + ':</label> ' + result.detail.description;
                _html += '</p>';
                _html += '</div>';
                _html += '<div class="share_product">';
                _html += '<p><img src="' + BASE_URL + URL_IMAGES + 'btn_hotline.png"/></p>';
                _html += '<a href="#"><img src="' + BASE_URL + URL_IMAGES + 'like_popup.png"/>&nbsp;</a>';
                _html += '<a href="#"><img src="' + BASE_URL + URL_IMAGES + 'share_popup.png"/></a>';
                _html += '</div>';
                _html += '</div>';
                _html += '<div class="clearfix"></div>';
                _html += '</div>';
                _html += '<h5 class="p_title">' + DISTRIBUTON + '</h5>';
                _html += '<ul class="giftset">';

                if (result.coordinator != false && result.coordinator != 'undefined') {
                    $.each(result.coordinator, function (index, value) {
                        _html += '<li><a href="javascript:;" class="showDetailProduct" attr_pro="' + value.id + '"><img src="' + BASE_URL + URL_PRODUCT_IMAGE + value.name + '"/></a></li>';
                    });
                }

                _html += '</ul>';
                _html += '<h5 class="p_title">' + CUSTOMER_SELECT + '</h5>';
                _html += '<ul class="giftset">';

                if (result.customer != false && result.customer != 'undefined') {
                    $.each(result.customer, function (index, cus) {
                        _html += '<li><a target="_blank" href="javascript:;"><img src="' + URL_CUSTOMER_IMAGE + cus.logo + '"/></a></li>';
                    });
                }

                _html += '</ul>';
                _html += '<h5 class="p_title">' + POST + '</h5>';
                _html += '<p>';
                _html += result.detail.content;
                _html += '</p>';
                _html += '<div class="clearfix" style="height:300px;"></div>';
                _html += '</div>';
                _content.append(_html);

                var bodyWidth = $('body').outerWidth();
                $('body').css('width', bodyWidth + 'px');
                // show content post
                $('.detail-product').dialogModal({
                    topOffset: 0,
                });
            }

            $('#main_loader').addClass('c_hide');
        }
    });
});