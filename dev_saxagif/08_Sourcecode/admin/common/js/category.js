$(document).ready(function(){
    var desSeo = $('textarea[name=des_seo]');
    setBgColor();
    // Show category navigation:
    if(typeof IS_CAT != 'undefined') {
       $('.accordion').find('.child-cate').css('display','block');
    }
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
    // vtcanglt add code 20150712
    initNoAcceptEnterKey(desSeo);
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
