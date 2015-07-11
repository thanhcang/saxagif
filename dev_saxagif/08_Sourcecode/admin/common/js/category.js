$(document).ready(function(){
    setBgColor();
    //defaultFocus();
    //confirmDelCategory();
    //editCategory();
    
    $(".delCat").on('click', function(){
        var trActive = $(this).parent().parent(); 
        var cat_id = $(this).attr('cat_attr');
        var cat_name = $(this).attr('cat_name');
        var deleteOk = $('.deleteOk'); 
        $('#deleteModal').modal('show'); 
        $('.messageDelete').text('Bạn muốn xóa danh mục ' + cat_name + ' ?');
        deleteOk.on('click', function(){
           _initdeleteCat(cat_id, trActive);
        });
    });
});

function defaultFocus() {
    frmSearch = $('#searchCategory');
    var name = frmSearch.find('input[name="name"]');
    name.focus();
}

function setBgColor() {
    var bg_color = $('#bg_color');
    if(bg_color.length) {
        $('#bg_color').colorpicker({
            hideButton: true
        });
    }
}
/*
function confirmDelCategory() {
    $('.delCat').click(function() {
        var cat_id = $(this).attr('cat_attr');
        var cat_name = $(this).attr('cat_name');
        var url_current = document.location.href;
        $('.dialogModal_content').text(MSG_DEL_CAT + cat_name + '?');
        $('.dialog_content').dialogModal({
            topOffset: 0,
            onDocumentClickClose : true,
            onOkBut: function() {
                $.ajax({
                    type: 'POST',
                    data: { id: cat_id },
                    url: URL_DEL_CAT,
                    contentType: "application/x-www-form-urlencoded",
                    success: function(result)
                    {
                       if(result) {
                           // 1.Reload url current:
                           //window.location = url_current;
                           //2.Remove row customer selected:
                           $('.cat_' + Base64.decode(cat_id)).remove();
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
*/

/**
 * delete user
 * @param {type} user_id
 * @returns {undefined}
 */
function _initdeleteCat(cat_id, that) {
    if (!cat_id.trim() || cat_id == 'undefined' || !isNaN(cat_id)) { // check user_id exist and is number
        $.ajax({
            dataType: "json",
            url: URL_DEL_CAT,
            type: 'POST',
            data: {
                'is_ajax': 'ajax',
                'id': cat_id
            },
            async: false,
        })
        .done(function (e) {
            $('#deleteModal').modal('hide');
            if (Object.keys(e).length > 0 && e.result == 0 && e.code == 304) { // not modifield
                $('#mesageModal').modal('show');
                $('.messageDelete').text(e.data);
            } else if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500) { // is hack 
                window.location = e.href;
            } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202) { // is success
                that.remove();
            } else {
                // nothing
            }
        })
        .fail(function (e) {
            // console.log(e);
        });
    }
}
