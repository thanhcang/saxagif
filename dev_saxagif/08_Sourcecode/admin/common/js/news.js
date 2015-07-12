$(document).ready(function(){
    
    
    $(".delNews").on('click', function(){
        var trActive = $(this).parent().parent(); 
        var news_id = $(this).attr('news_attr');
        var news_name = $(this).attr('news_name');
        var deleteOk = $('.deleteOk'); 
        $('#deleteModal').modal('show'); 
        $('.messageDelete').text('Bạn muốn xóa danh mục ' + news_name + ' ?');
        deleteOk.on('click', function(){
           _initdeleteNews(news_id, trActive);
        });
    });
});
/**
 * delete user
 * @param {type} user_id
 * @returns {undefined}
 */
function _initdeleteNews(news_id, that) {
    if (!news_id.trim() || news_id == 'undefined' || !isNaN(news_id)) { // check user_id exist and is number
        $.ajax({
            dataType: "json",
            url: URL_DEL_NEWS,
            type: 'POST',
            data: {
                'is_ajax': 'ajax',
                'id': news_id
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
