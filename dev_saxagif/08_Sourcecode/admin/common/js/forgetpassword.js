$(document).ready(function () {
    var submitButton = $('#submitButton');
    submitButton.on('click', function(){
        initValidForm();
    })
});

/**
 * check form
 * @returns html || submit form
 */
function initValidForm() {
    var _email = $('input[name=email]');
    var _reEmail = $('input[name=reEmail]');
    var _is_submit = true;
    var _html = '';
    var _alert_info = $('.alert-info');
    var _form = $('#frmForgetPassword');
    var _pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (!_email.val().trim() || _email.val() == 'undefined' || !_pattern.test(_email.val())) { // check email
        _is_submit = false
        _html = 'Nhap email';
    }
    if (!_reEmail.val().trim() || _reEmail.val() == 'undefined' || !_pattern.test(_reEmail.val())) { // check reemail
        _is_submit = false
        _html = 'Nhap email';
    }
    if (_reEmail.val().trim() && _email.val().trim() && (_reEmail.val().trim() != _email.val().trim()) ){
        _is_submit = false
        _html = 'Email không giống nhau';
    }
    if (_is_submit == false) {
        _alert_info.removeClass('hide');
        _alert_info.html(_html);
    } else {
        _form.submit();
    }

}