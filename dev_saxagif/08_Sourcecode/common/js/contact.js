$(document).ready(function(){
    contact();
});

function contact() {
    $('.send_frm').on('click', function(){
        var _parternMail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
        var _contentErr = $('.contactErr');
        var _frmContact = $('#frmContact');
        var _name = _frmContact.find('input[name="cus_name"]');
        var _email = _frmContact.find('input[name="cus_email"]');
        var _rel = true;
               
        if (_email.val() == '') {
            _contentErr.html(CT_MISSING_EMPTY_EMAIL);
            _rel = false;
            _email.focus();
        }
        
        if(_email.val() != '' && !_parternMail.test(_email.val())) {
            _contentErr.html(CT_MISSING_EMAIL_INVALID);
            _rel = false;
            _email.focus();
        }
        
        if (_name.val() == '') {
            _contentErr.html(CT_MISSING_EMPTY_NAME);
            _rel = false;
            _name.focus();
        }
        
        if(_rel) {
            frmContact.submit();
        }
    });
}

