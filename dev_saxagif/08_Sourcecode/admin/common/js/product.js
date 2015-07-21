/**
 *  product js
 */


$('document').ready(function(){
    // delete product
    $('.delPro').on('click', function(){
        var idDelete = $(this).attr('pro_attr');
        var nameDelete = $(this).attr('pro_name');
        var deleteOk = $('.deleteOk'); 
        var that = $(this);
        $('.messageDelete').text();
        // message delete
        $('#deleteModal').modal('show'); 
        $('.messageDelete').text('Bạn muốn xóa danh mục ' + nameDelete + ' ?');
        
        deleteOk.on('click', function(){
            $.ajax({
                dataType: "json",
                url: URL_DELETE_PRODUCT,
                type: 'POST',
                async : false,
                data: {
                    'is_ajax': 'ajax',
                    'id': idDelete,
                },
                beforeSend: function () {
                    $('#main_loader').removeClass('hide');
                }
            })
            .done(function(e){
                if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500) { // is hack 
                    window.location = e.href;
                } else if (Object.keys(e).length > 0 && e.result == 0 && e.code == 404)  {
                    $('#mesageModal').modal('show'); 
                    $('.messageDelete').text(e.error);
                } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 200) {
                    that.parent().parent().remove();
                } else { // nothing
                }
                $('#main_loader').addClass('hide');
            })
            .fail(function(){
                $('#main_loader').addClass('hide');
            });
        });
        
    });
    
    $('.viewProduct').on('click', function(){
        $('#viewProductModal').modal('show'); 
    });
    
});


