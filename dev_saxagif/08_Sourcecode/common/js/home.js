$(document).ready(function(){
    getSendMail();
});

function getSendMail() {
    $('#sendMailCustomer').on('click', function(){
        $(".js__p_start, .js__p_another_start").simplePopup();
        var _isThis = $(this);
        _isThis.addClass('js__p_start');
        var _parternMail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
        var _frmCustomer = $('#frmSendCustomer');
        var _mail = _frmCustomer.find('input[name="email_address"]');
        var _customerName = _frmCustomer.find('input[name="customer_name"]');
        var _txtMail = '';
        var _txtCustomer = '';
        var _rel = true;
        
        if (_mail.val() == '' && !_parternMail.test(_mail.val())) {
            _mail.css('border','1px solid red').focus();
            _rel = false;
        } else {
            _txtMail = _mail.val();
            
        }
        
        if (_customerName.val() == '') {
            _customerName.css('border','1px solid red').focus();
            _rel = false;
        } else {
            _txtCustomer = _customerName.val();
        }
        if(_rel) {
            $.ajax({
            url: URL_SEND_MAIL_CUSTOMER,
            type: 'POST',
            data: {
                'email': _txtMail,
                'name': _txtCustomer,
            },
            async: false,
        })
        .done(function(e){
            if(e.length() == null )
            $(".js__p_start, .js__p_another_start").simplePopup();
        });
        }
        
    });
}

