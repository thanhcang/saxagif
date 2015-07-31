$(function(){
    showDetailProduct();
});

function showDetailProduct() {
    $('.showDetailProduct').on('click', function(){
        var _product_id = $(this).attr('attr_pro');
        var _content = $('.detail-product .dialogModal_content');
        _content.html('');
        var _html = '';
        $.ajax({
            type: 'POST',
            dataType: "json",
            data: { product_id: _product_id },
            url: URL_DETAIL_PRODUCT,
            success: function(result)
            {
                //console.log(result);
               if(result.length != 0) {
                   var _obj = result;
                   var _price = (_obj[0].price);
                   if(_obj[0].pro_img == null) {
                        var _path_img_p = URL_IMAGES;
                        var _img_name_p = 'no-img.png';
                    } else {
                        var _path_img_p = URL_PRODUCT_IMAGE;
                        var _img_name_p = _obj[0].pro_img;
                    }
                   _html += '<div class="p_content p_cont_pro">';
                   _html += '<div class="product_detail">';
                   _html += '<div class="detail_l">';
                   _html += '<img src="'+_path_img_p+_img_name_p+'" class="product_large"/>';
                   _html += '<div class="img_detail">';
                        _html += '<ul>';
                        var _i = 0;
                        $.each(_obj, function(index, value){
                            if(value.p_product != null && _i < 3 ){
                                _i++;
                                _html += '<li><img src="'+URL_PRODUCT_THUMB_IMAGE+value.pro_img+'"/></li>';
                            }
                        });
                        _html += '</ul>';
                    _html += '</div>';
                    _html += '</div>';
                _html += '<div class="detail_r">';
                    _html += '<div class="tit_product_detail">'+_obj[0].name+'</div>';
                    _html += '<div class="info_product_detail">';
                        _html += '<p>';
                            _html += '<label>'+PRICE+':</label> '+_price+'VND';
                        _html += '</p>';
                        _html += '<p>';
                            _html += '<label>'+MATERIAL+':</label>';
                        _html += '</p>';
                        _html += '<p>';
                            _html += '<label>'+PRO_DESIGN+':</label>'; 
                        _html +='</p>';
                        _html +='<p>';
                            _html += '<label>'+MADE_IN+':</label>';
                        _html += '</p>';
                        _html += '<p>'
                            _html += '<label>'+DESCRIPTION+':</label> '+_obj[0].description;
                        _html += '</p>';
                    _html += '</div>';
                    _html += '<div class="share_product">';
                        _html += '<p><img src="'+URL_IMAGES+'btn_hotline.png"/></p>';
                        _html +='<a href="#"><img src="'+URL_IMAGES+'like_popup.png"/>&nbsp;</a>';
                        _html += '<a href="#"><img src="'+URL_IMAGES+'share_popup.png"/></a>';
                    _html += '</div>';
                _html += '</div>';
                _html += '<div class="clearfix"></div>';
            _html += '</div>';
            _html += '<h5 class="p_title">'+DISTRIBUTON+'</h5>';
            _html +='<ul class="giftset">';
            $.each(_obj, function(index, value){
                if(value.p_product == null) {
                    if(value.pro_img == null) {
                        var _path_img = URL_IMAGES;
                        var _img_name = 'no-img.png';
                    } else {
                        var _path_img = URL_PRODUCT_THUMB_IMAGE;
                        var _img_name = value.pro_img;
                    }
                    _html += '<li><a href="javascript:;"><img src="'+_path_img+_img_name+'"/></a></li>';
                }
            });
            _html += '</ul>';
            _html += '<h5 class="p_title">'+CUSTOMER_SELECT+'</h5>';
            if (_obj.customer != null) {
                _html += '<ul class="giftset">';
                $.each(_obj.customer, function(index, cus){
                   _html += '<li><a target="_blank" href="'+cus.url+'"><img src="'+URL_CUSTOMER_IMAGE+cus.logo+'"/></a></li>';
                });
               _html += '</ul>';
           }
            _html += '<h5 class="p_title">'+POST+'</h5>';
            _html += '<p>';
                _html += 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." sunt in culpa qui officia deserunt mollit ';
            _html += '</p>';
            _html += '<div class="clearfix" style="height:300px;"></div>';
                   _html += '</div>';
                   _content.append(_html);
                   $('.detail-product').dialogModal({
                        topOffset: 0,
                    });
//                    $('body').css('overflow', 'hidden');
               }
            }
        });
        
    });
}