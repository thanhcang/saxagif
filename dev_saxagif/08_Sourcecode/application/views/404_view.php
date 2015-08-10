<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('common/css/layout.css') ?>"/>
    </head>
    <body style="position: relative">
        <div class="error"><img src="<?php echo base_url('common/images/bg_error.png') ?>"/></div>
        <div class="link_home"><a href="<?php echo base_url() ?>">trở về trang chủ</a></div>
        <script src="<?php echo base_url('common/js/jquery-1.8.1.min.js') ?>"></script>
        <script>
            function marLeft() {
                var w_win = window.innerWidth;
                var w_link_home = $('.link_home').innerWidth();
                var marginLeft = (w_win / 2) - (w_link_home / 2);
                $('.link_home').css('margin-left',marginLeft+40);
            }
            $(function(){
                marLeft();
            });
        </script>
    </body>
</html>
