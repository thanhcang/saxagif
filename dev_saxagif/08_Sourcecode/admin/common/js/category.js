$(document).ready(function(){
    setBgColor();
    defaultFocus();
    confirmDelCategory();
});

function defaultFocus() {
    frmSearch = $('#searchCategory');
    var name = frmSearch.find('input[name="name"]');
    name.focus();
}

function setBgColor() {
    var bg_color = $('#bg_color');
    if(bg_color.length) {
        $('#bg_color').colorpicker({
            //hideButton: true
        });
    }
}

function confirmDelCategory() {
    $('.delCat').click(function() {
        var cat_id = $(this).attr('cat_attr');
        var cat_name = $(this).attr('cat_name');
        var url_current = document.location.href;
        $('.dialogModal_content').text(MSG_DEL_CAT + cat_name + '?');
        $('.dialog_content').dialogModal({
            topOffset: 0,
            onOkBut: function() {
                $.ajax({
                    type: 'POST',
                    data: { id: cat_id },
                    url: URL_DEL_CAT,
                    contentType: "application/x-www-form-urlencoded",
                    success: function(result)
                    {
                       if(result) {
                           // 1.Reload url current:
                           //window.location = url_current;
                           //2.Remove row customer selected:
                           $('.cat_' + Base64.decode(cat_id)).remove();
                       }
                    }
                });
            },
            onCancelBut: function() {
            },
            onLoad: function(el, current) {
            },
            onClose: function() {
            },
            onChange: function(el, current) {
                if (current == 3) {
                    el.find('.dialogModal_header span').text('Page 3');
                    $.ajax({url: 'ajax.html'}).done(function(content) {
                        el.find('.dialogModal_content').html(content);
                    });
                }
            }
        });
    });
}

