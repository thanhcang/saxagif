/**
 *  product js
 */


$(function(){
//    $('#price').numberFormat({type: 'float'});
    confirmDelProduct();
});

function confirmDelProduct() {
    $('.delPro').click(function() {
        var _proId = $(this).attr('pro_attr');
        var _proName = $(this).attr('pro_name');
        var _urlCurrent = document.location.href;
        $('.dialogModal_content').text(MSG_DEL_PRO + _proName + '?');
        $('.dialog_content').dialogModal({
            topOffset: 0,
            onDocumentClickClose : true,
            onOkBut: function() {
                $.ajax({
                    type: 'POST',
                    data: { id: _proId },
                    url: URL_DEL_PRO,
                    contentType: "application/x-www-form-urlencoded",
                    success: function(result)
                    {
                       if(result) {
                           // 1.Reload url current:
                           //window.location = url_current;
                           //2.Remove row customer selected:
                           $('.pro_' + Base64.decode(_proId)).remove();
                       }
                    }
                });
            },
            onCancelBut: function() {
            },
            onLoad: function(el, current) {
            },
            onClose: function() {
            },
            onChange: function(el, current) {
                if (current == 3) {
                    el.find('.dialogModal_header span').text('Page 3');
                    $.ajax({url: 'ajax.html'}).done(function(content) {
                        el.find('.dialogModal_content').html(content);
                    });
                }
            }
        });
    });
}

function editCategory() {
    $('.editCat').on('click', function(){
       var _catId = $(this).attr('cat_attr');
       
       var _frmCat = $('#frmCategory');
       var _name = _frmCat.find('input[name="name"]');
       var _slug = _frmCat.find('input[name="slug"]');
       var _bgColor = _frmCat.find('input[name="bg_color"]');
       var _languageType = _frmCat.find('select[name="language_type"]');
       var _keywordSeo = _frmCat.find('input[name="keyword_seo"]');
       var _desSeo = _frmCat.find('input[name="des_seo"]');
       var _ID = _frmCat.find('input[name="category_id"]');
       var _logo = _frmCat.find('input[name="logo"]');
       
       $.ajax({
            type: 'POST',
            data: { id: _catId },
            dataType: "json",
            url: URL_EDIT_CAT,
            contentType: "application/x-www-form-urlencoded",
            success: function(result)
            {
                var obj = result.catDetail;
               if(result) {
                   console.log(obj);
                   _name.val(obj.name);
                   _slug.val(obj.slug);
                   _bgColor.val('#' + obj.bg_color);
                   _languageType.val(obj.language_type);
                   _keywordSeo.val(obj.keyword_seo);
                   _desSeo.val(obj.des_seo);
                   _ID.val(obj.id);
                   _logo.val(obj.logo);
               }
            }
        });
    });
}


