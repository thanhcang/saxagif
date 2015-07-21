$(document).ready(function(){
    var desSeo = $('textarea[name=des_seo]');
    var pageHomeTemp = $('.pageHomeTemp');
    var pricePresentTemp = $('.pricePresent');
    var type = $('select[name=type]');
    var form = $('form#frmCategory');
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
    
    // set up image and show home
    if (type.find('option:selected').val() == 2) {
        form.find('.pageHome').remove();
        form.find('.pricePresent').remove();
        type.after(pageHomeTemp.html());
    }
    
    // set up price for presetnt
    if (type.find('option:selected').val() == 3) {
        form.find('.pageHome').remove();
        form.find('.pricePresent').remove();
        type.after(pricePresentTemp.html());
    }
    
    // set up image and show home when check
    type.on('change', function(){ // choose show home
        form.find('.pageHome').remove();
        form.find('.pricePresent').remove();
        
        // event
        if ($(this).find('option:selected').val() == 2){
            $(this).parent().after(pageHomeTemp.html());
        }
        
        // price present
        if ($(this).find('option:selected').val() == 3){
            $(this).parent().after(pricePresentTemp.html());
        }
        
    });
    
    //view child category
    $('.viewChildCategory').on('click', function(){
       initViewChildCategory(this); 
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

/**
 * view child category
 * @returns {undefined}
 */
function initViewChildCategory(that) {
    var _id = $(that).attr('attr-category');
    if (!_id.trim() || _id == 'undefined' || !isNaN(_id)) { // check catogry id exist and is number
        $.ajax({
            dataType: "json",
            url: URL_VIEW_CHILD_CATEGORY,
            type: 'POST',
            data: {
                'is_ajax': 'ajax',
                'id': _id
            },
            async: false,
        })
        .done(function (e) {
            $('#viewChildCategoryModal').modal('hide');
            if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500) { // is hack 
                window.location = e.href;
            } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202) { // is success
                var _modal_header = $('.modal-header');
                var _vCategoryLanguage = $('#vCategoryLanguage');
                var _vCategoryName = $('#vCategoryName');
                var _vChildCategoryName = $('#vChildCategoryName');
                var _vCategorylogo = $('#vCategorylogo');
                var _vCategoryBackground = $('#vCategoryBackground');
                var _vCategoryKeyword = $('#vCategoryKeyword');
                var _vCategoryDescription = $('#vCategoryDescription');
                var _vpCategoryLink = $('#vpCategoryLink');
                
                _modal_header.html(e.data.name);
                if (e.data.language_type == 1){
                    _vCategoryLanguage.html('Vietnam');
                } else {
                    _vCategoryLanguage.html('English');
                }
                _vCategoryLanguage.html();
                _vCategoryName.html(e.data.parent_name);
                _vChildCategoryName.html(e.data.name);
                if (e.data.logo != null &&  e.data.logo.trim()){
                    _vCategorylogo.html('<img src="'+URL_CATEGORY_IMAGE+'/'+e.data.logo+'" />');
                } else {
                    _vCategorylogo.html('');
                }                
                if (e.data.bg_color != null && e.data.bg_color.trim()){
                    _vCategoryBackground.html('<input type="color" value="'+e.data.bg_color+'" />');
                } else {
                    _vCategoryBackground.html('');
                }
                _vCategoryKeyword.html(e.data.keyword_seo);
                _vCategoryDescription.html(e.data.des_seo);
                _vpCategoryLink.attr('href',BASE_URL+'category/edit/'+e.data.id);
                
                $('#viewChildCategoryModal').modal('show');
            } else {
                // nothing
            }
        })
        .fail(function (e) {
        });
    }
}