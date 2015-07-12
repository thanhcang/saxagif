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