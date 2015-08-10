jQuery(document).ready(function () {
    var name = $('input[name=customer_name]');
    var email = $('input[name=customer_email]');
    var content = $('textarea[name=question]');
    var _parternMail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;

    // focus name
    name.on('focus', function () {
        name.removeAttr('style');
    });
    // focus name
    email.on('focus', function () {
        email.removeAttr('style');
    });
    // focus name
    content.on('focus', function () {
        content.removeAttr('style');
    });

    // submit form
    $('.send_frm_QA').on('click', function () {
        var is_submit = true;

        name.removeAttr('style');
        email.removeAttr('style');
        content.removeAttr('style');
        if (!name.val().trim()) {
            name.css('color', 'red');
            is_submit = false;
        }
        if (!email.val().trim() || !_parternMail.test(email.val())) {
            email.css('color', 'red');
            is_submit = false;
        }
        if (!content.val().trim()) {
            content.css('color', 'red');
            is_submit = false;
        }

        if (is_submit == true) {
            var formObj = $(document.getElementById('sendQa'));
            var formURL = formObj.attr("action");
            var formData = new FormData(document.getElementById('sendQa'));
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
                    name.val('');
                    email.val('');
                    content.val('');
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
    
    $('.questionCustomer').slimScroll({
        color: '#7eb235',
        size: '10px',
        height: '643px',
        alwaysVisible: true,
    });
    
    $('.scrollbar-external-QA').slimScroll({
        color: '#7eb235',
        size: '10px',
        height: '643px',
        alwaysVisible: true
    });
});
