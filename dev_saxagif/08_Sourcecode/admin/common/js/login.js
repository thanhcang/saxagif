$(function(){
    var submitButton = $('#submitButton');
    submitButton.on('click', function(){
       _initLogin(); 
    });
});

/**
 * 
 * @returns {Boolean}
 */
function _initLogin(){
    var _username = $('input[name=username]');
    var _password = $('input[name=password]');
    var _html   = '';
    var _is_submit = true;
    var _alert_info = $('.alert-info');
    if (_username.val() == '' || _username.val() == 'undefined'){ // username empty
        _html+='Please enter Username'+'<br/>';
        _is_submit= false;
    }
    if (_password.val() == '' || _password.val() == 'undefined'){ // password empty
        _html+='Please enter password';
        _is_submit= false;
    }
    if(_is_submit == false){
        _alert_info.html(_html);
        return false;
    }else{
        $('#frmLogin').submit();
    }
}
