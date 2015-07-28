$(document).ready(function(){
    
    $(".delCatNews").on('click', function(){
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
    
    $(".btnShowDetail").on('click', function(){
        var _catNewsId = $(this).attr('attrCatNews');
        showDetailCatNews(_catNewsId);
    });
    
    // cangtv add code start 20150728
    var position = $('select[name=position]');
    position.on('change', function(){
        $('.imageSlide').remove();
        
        var valuePosition = $(this).find('option:selected').val();
        
        if (valuePosition.trim() && valuePosition != 'undefined' && valuePosition == 1){
            
            var image_html = '<div class="form-group imageSlide">';
            image_html += '<label>Hình slideshow</label>';
            image_html += '<input type="file" name="avatar">';
            image_html += '</div>';
            
            $(this).parent().after(image_html);
        } else if (valuePosition.trim() && valuePosition != 'undefined' && (valuePosition == 2 || valuePosition == 3 || valuePosition == 4)) {
                var image_html = '<div class="form-group imageSlide">';
                image_html += '<label>Ảnh đại diện</label>';
                image_html += '<input type="file" name="avatar">';
                image_html += '</div>';

                $(this).parent().after(image_html);
        }
        
    });
    // cangtv add code start 20150728
    
});

function showDetailCatNews(catNewsId) {
    $.ajax({
        dataType: "json",
        url: URL_DETAIL_CAT_NEWS,
        type: "POST",
        data: {
            'is_ajax':'ajax',
            'catNewsId': catNewsId
        },
        async:false,
    })
            .done(function(e){
                if (Object.keys(e).length > 0 && e.result == 0 && e.code == 404 ) {
                } else if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500 ) { // is hack 
                } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202 ){ // is success
                    var _image =BASE_URL+'common/img/logo_member/NoImage.jpg';
                    var _catNewsName = $('.catNewsName');
                    var _catNewsSlug = $('.catNewsSlug');
                    var _catNewsPosition = $('.catNewsPosition');
                    var _catNewsKeyWord = $('.catNewsKeyWord');
                    var _catNewsDes = $('.catNewsDes');
                    var _cLink = $('#catLink');
                    _catNewsName.text(e.data.name);
                    _catNewsSlug.text(e.data.slug);
                    _catNewsPosition.text(e.data.position_name);
                    _catNewsKeyWord.text(e.data.keyword_seo);
                    _catNewsDes.text(e.data.des_seo);
                    _cLink.attr('href',BASE_URL+'category_news/edit/'+e.data.id);
                    $('#detailCatNewsModal').modal('show'); 
                } else {
                    // nothing
                }
            })
            .fail(function(e){
                
            })
    ;
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
            url: URL_DEL_CAT_NEWS,
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
