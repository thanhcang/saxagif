/**
 *  product new js
 *  cangtv 20150717
 */

/**
 * onload page
 * @param {type} param
 */
$(document).ready(function(){
    var formProduct = $('#frmProduct');

    // preview image
    $("#imageProduct").on("change", function () {
        // init
        var files = !!this.files ? this.files : [];
        var is_image = true;
        
        // remove image when choose new image 
        $("#imagePreview").html('');
        // check is load file and it exists
        if (!files.length || !window.FileReader){
            is_image = false;
        }
        if (is_image == true) {
            $("#imagePreview").addClass('hide');
            // check all file is image
            $.each(files, function (key, value) {
                var checkImage = /^image/.test(value.type);
                if (!checkImage) {
                    $('#mesageModal').modal('show');
                    $('.messageDelete').text('Hãy chọn file hình ảnh');
                    is_image = false;
                }
            });
        }
    
        if (is_image == true) {
            $("#imagePreview").removeClass('hide');
            // preview image
            $.each(files, function (key, value) {
                var reader = new FileReader();
                reader.readAsDataURL(value);
                reader.onloadend = function () {
                    // create div base image
                    var htmlClass = '<div class="tPreviewImage">' + '<img src="' + this.result + '"/>' + '</div>';

                    // append div in block
                    $("#imagePreview").append(htmlClass);
                }
            });
        }
        
        // reset input image
        if (is_image == false){
            $('#imageProduct').val('');
        }
    });
    
    // category
    var typeCategory = $('select[name=type]');
    
    typeCategory.on('change', function () {
        var form = $('#frmProduct');
        var type = $(this).children('option:selected').val();
        var that = $(this);
        
        // remove child option
        form.find('.childCategory').remove();
        
        // drawing child option
        if (type == 1 || type == 3 || type == 2) {
            var tChildCategory = $('.tChildCategory');
            tChildCategory.find('form-group').html('');
            $.ajax({
                dataType: "json",
                url: URL_GET_CHILD_CATEGORY,
                type: 'POST',
                data: {
                    'is_ajax': 'ajax',
                    'id': type,
                },
                beforeSend : function(){
                    $('#main_loader').removeClass('hide');
                }
            })
            .done(function (e) {
        
                 if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500) { // is hack 
                    window.location = e.href;
                } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202 && type == 1) { // is success, category
                    var option = '<select name="catname" class="form-control" >';
                  
                    $.each(e.data, function(key , value){
                        option += '<optgroup label="'+key+'">';
                        $.each(value, function(t_k, t_v){
                           option += '<option value="' + t_v.id + '">' + t_v.child_name + '</option>'; 
                        });
                        option += '</optgroup>';
                    });
                    option += "</select>";
                    
                    tChildCategory.find('.childCategory').html(option);
                    that.parent().after(tChildCategory.html());
                    
                } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202 && (type == 3 || type == 2)) { // is success choose present
                    
                    var option = '<select name="catname" class="form-control" >';
                    
                    $.each(e.data, function(key , value){
                        option += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    option += '</select>';
                    tChildCategory.find('.childCategory').html(option);
                    that.parent().after(tChildCategory.html());
                } else {
                    // nothing
                }
                $('#main_loader').addClass('hide');
            })
            .fail(function (e) {
                // console.log(e);
            });
        }
    });
    
    // search giftset
    $('#add-giftset').on('click', function () {
        var searchName = $('input[name=searchProduct]');
        $.ajax({
            dataType: "json",
            url: URL_GET_PRODUCT,
            type: 'POST',
            data: {
                'is_ajax': 'ajax',
                'name': searchName.val(),
            },
            beforeSend: function () {
                $('#main_loader').removeClass('hide');
            }
        })
        .done(function (e) {

            if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500) { // is hack 
                window.location = e.href;
            } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202) { // is success have category
                var trData = '';
                var pSearchProduct = $('#pSearchProduct').find('tbody');
                
                // show data when search
                
                $.each(e.data, function(key, value){
                    trData += '<tr>';
                    
                    trData += '<td>';
                    trData += key+1;
                    trData += '</td>';
                    
                    trData += '<td>';
                    trData += '<input type="checkbox" value="'+value.product_code+","+value.name+'" name="sProductCode[]" />';
                    trData += '</td>';
                    
                    trData += '<td>';
                    trData += value.name;
                    trData += '</td>';
                    
                    trData += '<td>';
                    trData += value.product_code;
                    trData += '</td>';
                    
                    trData += '</tr>';
                });
                
                // render data 
                pSearchProduct.html(trData);
                $('#viewSearchProductModal').modal('show');
            } else if (Object.keys(e).length > 0 && e.result == 0 ) { // is not data
                $('#mesageModal').modal('show');
                $('.messageDelete').html('');
                $('.messageDelete').text('Không tim thấy mã code tương ứng');
                searchName.val('');
            } else {
                // nothing
            }
            $('#main_loader').addClass('hide');
        })
        .fail(function () {
            $('#main_loader').addClass('hide');
        });
    });
    
    //get product_code is choose
    $('#okSearchProduct').on('click', function(){

        var formObj = $(document.getElementById('frmPopupSearchProduct'));
        var formURL = formObj.attr("action");
        var formData = new FormData(document.getElementById('frmPopupSearchProduct'));
        $.ajax({
            dataType: "json",
            url: formURL,
            type: 'POST',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            beforeSend: function () {
                $('#main_loader').removeClass('hide');
            }
        })
        .done(function(e){
            var trData = '';
            var tbTempSearchProduct = $('#tbTempResultSearchProduct').find('.form-group').find('table > tbody');
            var searchProduct = $('input[name=searchProduct]');
            var tbTempResultSearchProduct =  formProduct.find('.tbRenderProduct');
            var trTbTempResultSearchProduct = tbTempResultSearchProduct.find('tbody > tr');
            var is_add = true;
            
            // show data when search

            $.each(e.data, function(key, value){
                $(trTbTempResultSearchProduct).each(function(){
                    if ($(this).find('td').first().text() == value.name ){
                        is_add = false;
                    }
                });
                if (is_add == true) {
                    trData += '<tr>';

                    trData += '<td>';
                    trData += value.name;
                    trData += '</td>';

                    trData += '<td>';
                    trData += value.product_code;
                    trData += '</td>';

                    trData += '<td class="center-text">';
                    trData += '<button type="button" class="removeProductGift" attr-code="' + value.product_code + '"><i class="glyphicon glyphicon-remove red"></i></button>';
                    trData += '<input type="hidden" name="pro_distribution[]" value="' + value.product_code + '" />';
                    trData += '</td>';

                    trData += '</tr>';
                }
            });
            
            // render data 
            tbTempSearchProduct.html(trData);
            
            // drawing data
            if (tbTempResultSearchProduct.length == 0){
                searchProduct.parent().parent().after($('#tbTempResultSearchProduct').html());        
            } else {
                tbTempResultSearchProduct.find('tbody').append(trData);
            }
            initRemoveProductGift();
            $('#main_loader').addClass('hide');
        })
        .fail(function(){
            $('#main_loader').addClass('hide');
        });

    });

});

/**
 * remove product gift
 * @returns {undefined}
 */
function initRemoveProductGift(){
    var formProduct = $('#frmProduct');
    var tbTempResultSearchProduct =  formProduct.find('.tbRenderProduct');
    $('.removeProductGift').on('click', function(){
        $(this).parent().parent().remove();
        console.log(tbTempResultSearchProduct.find('table > tbody').length);
        if (tbTempResultSearchProduct.find('table > tbody > tr').length == 0){
            tbTempResultSearchProduct.remove();
        }
    });
}
