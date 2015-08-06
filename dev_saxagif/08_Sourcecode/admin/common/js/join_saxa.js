$(document).ready(function () {
    $('.delNews').on('click', function () {
        var trActive = $(this).parent().parent();
        var cat_id = $(this).attr('cat_attr');
        var cat_name = $(this).attr('cat_name');
        var deleteOk = $('.deleteOk');
        var that = $(this).parent().parent();

        $('#deleteModal').modal('show');
        $('.messageDelete').text('Bạn muốn xóa danh mục  ?');
        deleteOk.on('click', function () {
            if (!cat_id.trim() || cat_id == 'undefined' || !isNaN(cat_id)) { // check user_id exist and is number
                $.ajax({
                    dataType: "json",
                    url: URL_DEL_JOINXA,
                    type: 'POST',
                    data: {
                        'is_ajax': 'ajax',
                        'id': cat_id
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
                    } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 200) { // is success
                        window.location = e.href;
                    } else {
                        // nothing
                    }
                })
                .fail(function (e) {
                    // console.log(e);
                });
            }
        });
    });
    
    // off news
    $('.onNews').on('click', function(){
        var cat_id = $(this).attr('cat_attr');
        var deleteOk = $('.deleteOk');
        var that = $(this);
        
        $('.messageDelete').html('');
        $('#deleteModal').modal('show');
        $('.messageDelete').text('Bạn muốn off tin này');
        deleteOk.on('click', function () {
            if (!cat_id.trim() || cat_id == 'undefined' || !isNaN(cat_id)) { // check user_id exist and is number
                $.ajax({
                    dataType: "json",
                    url: URL_OFF_JOINXA,
                    type: 'POST',
                    data: {
                        'is_ajax': 'ajax',
                        'id': cat_id
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
                    } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 200) { // is success
                        window.location = BASE_URL+'joinSaxa';
                    } else {
                        // nothing
                    }
                })
                .fail(function (e) {
                    // console.log(e);
                });
            }
        });
    });
    
    // on news
    $('.offNews').on('click', function(){
        var trActive = $(this).parent().parent();
        var cat_id = $(this).attr('cat_attr');
        var cat_name = $(this).attr('cat_name');
        var deleteOk = $('.deleteOk');
        var that = $(this).parent().parent();

        $('#deleteModal').modal('show');
        $('.messageDelete').text('Bạn muốn on tin này  ?');
        deleteOk.on('click', function () {
            if (!cat_id.trim() || cat_id == 'undefined' || !isNaN(cat_id)) { // check user_id exist and is number
                $.ajax({
                    dataType: "json",
                    url: URL_ON_JOINXA,
                    type: 'POST',
                    data: {
                        'is_ajax': 'ajax',
                        'id': cat_id
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
                    } else if (Object.keys(e).length > 0 && e.result == 1 && e.code == 200) { // is success
                        window.location = BASE_URL+'joinSaxa';
                    } else {
                        // nothing
                    }
                })
                .fail(function (e) {
                    // console.log(e);
                });
            }
        });
    });
});

