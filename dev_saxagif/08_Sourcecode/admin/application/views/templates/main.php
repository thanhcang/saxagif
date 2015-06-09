<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex,nofollow" />
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="<?php echo empty($des_seo) ? DEFAULT_DES_SEO : $des_seo ?>" name="description"/>
    <meta content="<?php echo empty($keyword_seo) ? DEFAULT_KEYWORD_SEO : $keyword_seo ?>" name="keywords" />
    <meta content="kamara" name="author"/>
    <title><?php echo empty($page_title) ? DEFAULT_TITLE : $page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--<link rel="shortcut icon" href="<?php echo base_url('favicon.ico') ?>" type="image/x-icon">-->
    <link rel="shortcut icon" href="<?php echo IMAGE_PATH . 'thong.png' ?>" type="image/x-icon" />
    <link rel="icon" href="<?php echo base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/jquery-ui.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/bootstrap-theme.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/jquery-ui.structure.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/jquery-ui.theme.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/style.css') ?>" />
    
    <script src="<?php echo base_url('contants') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('common/js/jquery-1.11.2.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('common/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('common/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('common/js/common.js') ?>" type="text/javascript"></script>
</head>
<body>
    <div id="container">
        <div class="main" id="body">
            <div class="container">
                <?php echo $main_content ?>
            </div>
        </div>
    </div>
</body>

