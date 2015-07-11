/**
 *  js for user
 *  @author  vtcanglt@gmail.com
 *  @data  20150807
 */
$(document).ready(function(){ // onload
    var submitForm = $('#buttonAddNewUser'); // button submit form
    submitForm.on('click', function(){
        _initValidateForm();
    });
    initNoAcceptSpaceKey($('input[name=username]'));
    $(".deleteUser").on('click', function(){
        var trActive = $(this).parent().parent(); 
        var user_id = $(this).attr('attr_del'); 
        var deleteOk = $('.deleteOk'); 
        $('#deleteModal').modal('show'); 
        $('.messageDelete').text('Bạn muốn xóa user này');
        deleteOk.on('click', function(){
           _initdeleteUser(user_id, trActive); 
        });
    });
});

/**
 * check validate form
 * @returns {Boolean}
 */
function _initValidateForm() {
    var _form = $('#frmAddNewUser');
    var _username = _form.find('input[name=username]');
    var _password = _form.find('input[name=password]');
    var _firstname = _form.find('input[name=first_name]');
    var _lastname = _form.find('input[name=last_name]');
    var _email = _form.find('input[name=email]');
    var _is_submit = true;
    var _error_message = '';
    var _block_error = $('#error');
    _block_error.addClass('hide');
    if (_username.val() == 'undefined' || !_username.val().trim()) { // user name
        _error_message += 'Nhập username' + '<br/>';
        _is_submit = false;
    }
    if (_password.val() == 'undefined' || !_password.val().trim()) { // password
        _error_message += 'Nhập password' + '<br/>';
        _is_submit = false;
    }
    if (_firstname.val() == 'undefined' || !_firstname.val().trim()) { // firstname
        _error_message += 'Nhập họ' + '<br/>';
        _is_submit = false;
    }
    if (_lastname.val() == 'undefined' || !_lastname.val().trim()) { // lastname
        _error_message += 'Nhập tên' + '<br/>';
        _is_submit = false;
    }
    if (_email.val() == 'undefined' || !_email.val().trim()) { // email
        _error_message += 'Nhập email' + '<br/>';
        _is_submit = false;
    }
    if (_is_submit == false) {
        _block_error.removeClass('hide');
        _block_error.html(_error_message);
    } else {
        _form.submit();
    }
    return _is_submit;
}

/**
 * delete user
 * @param {type} user_id
 * @returns {undefined}
 */
function _initdeleteUser(user_id, that) {
    if (!user_id.trim() || user_id == 'undefined' || !isNaN(user_id)) { // check user_id exist and is number
        $.ajax({
            dataType: "json",
            url: URL_AJAX_DELETE_USER,
            type: 'POST',
            data: {
                'is_ajax': 'ajax',
                'user_id': user_id
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
            } else {
                // nothing
            }
        })
        .fail(function (e) {
            // console.log(e);
        });
    }
}

