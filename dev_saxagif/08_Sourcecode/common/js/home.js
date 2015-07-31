$(document).ready(function(){
    getSendMail();
    //showCustomerSlide();
});

function getSendMail() {
    $('#sendMailCustomer').on('click', function(){
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
        if(_rel == true) {
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
                if(e == '202' ){
                    _mail.val('');
                    _customerName.val('');
                    $('.sendmail').dialogModal({
                        topOffset: 0
                    });
                }
            });
        }
        
    });
    
    // onclick youtube
    $('.youtubeVideos').on('click', function () {
        var iframeYoutube = '<iframe width="420" height="315" src="https://www.youtube.com/embed/AeubCtYhiic?autoplay=1" frameborder="0"></iframe>';
        $('.p_content').html(iframeYoutube);
        $('.sendmail').dialogModal({
            topOffset: 0,
        });
    });
}

/**
 * @author hnguyen0110@gmail.com
 * @date 2015/07/25
 * Show saxa customers slide
 */
function showCustomerSlide()
{
    $('.slideCus').on('click', function(){
        var _isThis = $(this);
        var _position = 1;
        
        var _position = parseInt($(this).attr('attr_num'));
        console.log(_position);
        if(_position.length > 0 && !isNaN(_position)) {
            
        }
        var _contCustomer = $('.contentCustomer');
         $.ajax({
            type: 'POST',
            dataType: "json",
            data: {
               num_position: 1,
               act_click: 'next',
            },
            url: URL_SHOW_CUSTOMER,
            async: false,
        }).done(function(data){
            //console.log(data);
            if(data.length != 0) {
                var result = data;
                var html = '';
                html+= '<div><img u="image" src="'+IMAGE_CUSTOMER_PATH+result.avatar+'" /></div>';
                _contCustomer.append(html);
                _position++;
                _isThis.attr('attr_num',_position);
            }
        });
    });
}

