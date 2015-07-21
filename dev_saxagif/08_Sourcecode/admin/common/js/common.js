/**
 * @author hnguyen0110@gmail.com
 * @date 2015/06/14
 */
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
$(function(){
    // function numberFormat(): allow input text number or float:
    (function(b) {
        b.fn.numberFormat = function(e) {
            var d = {type: "int", auto: false}, f = function(a) {
                a = a.which ? a.which : event.keyCode;
                return a > 31 && (a < 48 || a > 57) ? false : true
            }, h = function(a, g) {
                var c, b;
                if (window.event)
                    c = window.event.keyCode;
                else if (g)
                    c = g.which;
                else
                    return true;
                b = String.fromCharCode(c);
                return c == null || c == 0 || c == 8 || c == 9 || c == 13 || c == 27 ? true : a.val().indexOf(".") > -1 ? "0123456789".indexOf(b) > -1 ? true : false : "0123456789.".indexOf(b) > -1 ? true : false
            };
            return this.each(function() {
                var a = b(this);
                e && b.extend(d, e);
                if (d.auto)
                    a.find("input[int]").each(function() {
                        b(this).keypress(function(a) {
                            return f(a)
                        })
                    }),
                            a.find("input[float]").each(function() {
                        b(this).keypress(function(a) {
                            return h(b(this), a)
                        })
                    });
                else
                    switch (d.type) {
                        case "float":
                            a.keypress(function(a) {
                                return h(b(this), a)
                            });
                            break;
                        default:
                            a.keypress(function(a) {
                                return f(a)
                            })
                    }
            })
        }
    })(jQuery);
});

$(document).ready(function(){
    $(".currentLogin").on('click', function(){
        var user_id = $(this).attr('attUser') 
        ajaxProfile(user_id);
    });
    
    // no enter
    initNoAcceptEnterKey();
    
    // no space
    initNoAcceptSpaceKeyCommon();
    
    // noComma
    initNoAcceptcommaKeyCommon();
});

/**
 * show popup profile user
 * @param {int} user_id
 * @returns 
 */
function ajaxProfile(user_id) {
    $.ajax({
        dataType: "json",
        url: URL_AJAX_PROFILE,
        type: 'POST',
        data:{
                'is_ajax':'ajax', 
                'user_id':user_id
            },
        async: false,
    })
    .done(function (e) {
        if (Object.keys(e).length > 0 && e.result == 0 && e.code == 404 ) { // not find                  
        } else if (Object.keys(e).length > 0 && e.result == 0 && e.code == 500 ) { // is hack 
        } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 202 ){ // is success
            var _image =BASE_URL+'common/img/logo_member/no-img.jpg';
            var _pUserName  = $('#pUserName');
            var _pFirstName = $('#pFirstName');
            var _pLastName  = $('#pLastName');
            var _pEmail  = $('#pEmail');
            var _pImage = $('#pImage');
            var _pLink = $('#pLink');
            _pUserName.val(e.data.username);
            _pFirstName.val(e.data.first_name);
            _pLastName.val(e.data.last_name);
            _pEmail.val(e.data.email);
            _pLink.attr('href',BASE_URL+'user/edit/'+e.data.id);
            if (e.data.image && e.data.image.trim()){
               _image = BASE_URL+'common/img/logo_member/'+e.data.image;
            } 
            _pImage.attr('src',_image);
            $('#profileModal').modal('show'); 
        } else {
            // nothing
        }
    })
    .fail(function (e) {
        // console.log(e);
    });
}

/**
 * not accpt space key 
 * @param {type} element
 * @returns {undefined}
 */
function initNoAcceptSpaceKey(element) {
    element.keypress(function (event) {
        var keycode = event.charCode || event.keyCode;
        if (keycode == 32) {
            event.preventDefault();
            return false;
        }
    });
}

/**
 * not accpt enter key 
 * @param {type} element
 * @returns {undefined}
 */
function initNoAcceptEnterKey() {
    $('.noEnter').keypress(function (event) {
        var keycode = event.charCode || event.keyCode;
        if (keycode == 13) {
            event.preventDefault();
            return false;
        }
    });
}

/**
 * not accpet space key 
 * @param {type} element
 * @returns {undefined}
 */
function initNoAcceptSpaceKeyCommon() {
    $('.noSpace').keypress(function (event) {
        var keycode = event.charCode || event.keyCode;
        if (keycode == 32) {
            event.preventDefault();
            return false;
        }
    });
}

/**
 * not accpet comma key 
 * @param {type} element
 * @returns {undefined}
 */
function initNoAcceptcommaKeyCommon() {
    $('.noComma').keypress(function (event) {
        var keycode = event.charCode || event.keyCode;
        if (keycode == 188) {
            event.preventDefault();
            return false;
        }
    });
}