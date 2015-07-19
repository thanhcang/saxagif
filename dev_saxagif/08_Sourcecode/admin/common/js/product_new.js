/**
 *  product new js
 *  cangtv 20150717
 */

/**
 * onload page
 * @param {type} param
 */
$(document).ready(function(){

    // preview image
    $("#imageProduct").on("change", function () {
        // init
        var files = !!this.files ? this.files : [];
        var is_image = true;
        
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

});
