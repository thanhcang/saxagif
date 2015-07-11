$('document').ready(function(){
    $(".deletePartner").on('click', function(){
        var trActive = $(this).parent().parent().parent(); 
        var partersId = $(this).attr('attr_id'); 
        var name = $(this).attr('attr_name'); 
        var deleteOk = $('.deleteOk'); 
        $('#deleteModal').modal('show'); 
        $('.messageDelete').text('Bạn muốn xóa đối tác'+name);
        deleteOk.on('click', function(){
           _initdeletePartners(partersId, trActive); 
        });
    });
});

/**
 * delete user
 * @param {type} user_id
 * @returns {undefined}
 */
function _initdeletePartners(partersId, that) {
    if (!partersId.trim() || partersId == 'undefined' || !isNaN(partersId)) { // check user_id exist and is number
        $.ajax({
            dataType: "json",
            url: URL_AJAX_DELETE_PARTERS,
            type: 'POST',
            data: {
                'is_ajax': 'ajax',
                'id': partersId
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
                if ($('#tablePartners >tbody >tr').length == 0){
                    window.location = e.href;
                }
            } else {
                // nothing
            }
        })
        .fail(function (e) {
            // console.log(e);
        });
    }
}


