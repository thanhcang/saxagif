$(document).ready(function () {
    var cus_name = $('input[name=cus_name]');
    var cus_email = $('input[name=cus_email]');
    var cus_phone = $('input[name=cus_phone]');
    
    // slide bar gift
    $(".scroller").simplyScroll();

    // validate
    $('.send_frm').on('click', function () {
        var _parternMail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
        var is_sumbit = true;
        
        cus_name.removeAttr('style');
        cus_email.removeAttr('style');
        cus_phone.removeAttr('style');
        
        if (!cus_name.val().trim()) {
            cus_name.css('color', 'red');
            is_sumbit = false;
        }

        if (!cus_email.val().trim() || !_parternMail.test(cus_email.val())) {
            cus_email.css('color', 'red');
            is_sumbit = false;
        }
        
        if (cus_phone.val().trim() && isNaN(cus_phone.val())) {
            cus_phone.css('color', 'red');
            is_sumbit = false;
        }

        if (is_sumbit == true) {
            var formObj = $(document.getElementById('frmContact'));
            var formURL = formObj.attr("action");
            var formData = new FormData(document.getElementById('frmContact'));
            $.ajax({
//                dataType: "json",
                url: formURL,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                async: false,
                beforeSend: function () {
                    $('#main_loader').removeClass('c_hide');
                }
            })
                .done(function (e) {
                    if (e == 'okie') {
                        $('#frmContact').each(function(){
                           $(this).find('input').val(''); 
                           $(this).find('textarea').val(''); 
                        });
                        
                        var bodyWidth = $('body').outerWidth();

                        $('body').css('width', bodyWidth + 'px');
                        // show pop up
                        $('.sendmail').dialogModal({
                            topOffset: 0
                        });
                    }
                    $('#main_loader').addClass('c_hide');
                });
        }

    });
    
    // remove style input name
    cus_name.on('focus', function(){
        $(this).removeAttr('style');
    });
    
    // remove style input email
    cus_email.on('focus', function(){
        $(this).removeAttr('style');
    });
    
    // remove style input phone
    cus_phone.on('focus', function(){
        $(this).removeAttr('style');
    });
});
