<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Set language type
$config['language_type'] = array(
    1 => 'Vietnam',
    2 => 'English'
);

// Set link css 

$config['css_path'] = array(
    'common/css/jquery-ui.min.css',
    'common/css/bootstrap.min.css',
//    'common/css/bootstrap-theme.min.css',
    'common/css/bootstrap-cerulean.min.css',
    'common/css/charisma-app.css',
    'common/css/admin.css',
    'common/css/customezie.css',
    'common/css/style.css',
);

// Set link js 
$config['js_path'] = array(
    'common/js/jquery-1.11.2.min.js',
    'common/js/jquery-ui.min.js',
    'common/js/bootstrap.min.js',
    'common/js/common.js',
    'contants',
);

$config['permission'] = array(
    1=>'Quản Lý',
    2=>'Biên tập',
);
$config['typeCategory'] = array(
    1=>'danh mục',
    2=>'sự kiện',
);
$config['page'] = array(
    '1' => 'Trang chủ',
    '2' => 'Giới thiệu',
    '3' => 'Liên hệ',
    '4' => 'Sản phẩm'
);

$config['position'] = array(
    1 => 'Slide show',
    2 => 'Left menu 1',
    3 => 'Left menu 2',
    4 => 'Right menu 1',
    5 => 'Footer',
    6 => 'Header',
 );
$config['typeCategory'] = array(
    1=>'danh mục sản phẩm',
    2=>'sự kiện',
);
$config['position_news'] = array(
    1 => 'Trang chủ',
    2 => 'Giới thiệu',
    3 => 'Liên hệ',
); 