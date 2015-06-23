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
    'common/css/bootstrap-theme.min.css',
    'common/css/style.css',
    'common/css/charisma-app.css',
    'common/css/bootstrap-cerulean.min.css',
    'common/css/charisma-app.css',
);
// Set link js 

$config['js_path'] = array(
    'common/js/jquery-1.11.2.min.js',
    'common/js/jquery-ui.min.js',
    'common/js/bootstrap.min.js',
    'common/js/common.js',
    'common/js/charisma.js',
    'contants',
    
);

// setting default
$config['setting_default'] = array(
    'sitename' =>   'saxagif',
    'shorcut'  => base_url('/common/img/logo20.png'),
    'logo'    => base_url('/common/img/logo.png'),
    'key_google',
    'des_google',
    'phone',
    'fax',
    'email',
    'address',
    'slogan',
);