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
    <link rel="shortcut icon" href="<?php echo base_url(IMAGE_PATH . 'thong.png') ?>" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/jquery-ui.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/bootstrap-theme.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/jquery-ui.structure.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/jquery-ui.theme.min.css') ?>" />
    
    <link id="bs-css" href="<?php echo base_url('common/css/bootstrap-cerulean.min.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('common/css/charisma-app.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('common/bower_components/fullcalendar/dist/fullcalendar.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/bower_components/fullcalendar/dist/fullcalendar.print.css') ?>" rel='stylesheet' media='print'>
    <link href="<?php echo base_url('common/bower_components/chosen/chosen.min.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/bower_components/colorbox/example3/colorbox.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/bower_components/responsive-tables/responsive-tables.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/jquery.noty.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/noty_theme_default.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/elfinder.min.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/elfinder.theme.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/jquery.iphone.toggle.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/uploadify.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/animate.min.css') ?>" rel='stylesheet'>
    <link href="<?php echo base_url('common/css/style.css') ?>" rel='stylesheet'>
</head>
<body>
    <!-- topbar starts -->
        <div class="navbar navbar-default" role="navigation">

            <div class="navbar-inner">
                <button type="button" class="navbar-toggle pull-left animated flip">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"> <img alt="Charisma Logo" src="<?php  echo base_url('common/img/logo20.png') ?>" class="hidden-xs"/>
                    <span>Charisma</span></a>

                <!-- user dropdown starts -->
                <div class="btn-group pull-right">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> admin</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <!-- user dropdown ends -->


                <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                    <li><a href="#"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Dropdown <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    <li>
                        <form class="navbar-search pull-left">
                            <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                                   type="text">
                        </form>
                    </li>
                </ul>

            </div>
        </div>
        <!-- topbar ends -->
        <div class="ch-container">
            <div class="row">

                <!-- left menu starts -->
                <div class="col-sm-2 col-lg-2">
                    <div class="sidebar-nav">
                        <div class="nav-canvas">
                            <div class="nav-sm nav nav-stacked">

                            </div>
                            <ul class="nav nav-pills nav-stacked main-menu">
                                <li class="nav-header">Main</li>
                                <li class="accordion">
                                    <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Category</span></a>
                                    <!--                                    <ul class="nav nav-pills nav-stacked">
                                                                            <li><a href="#">Add new</a></li>
                                                                            <li><a href="#">Child Menu 2</a></li>
                                                                        </ul>-->
                                </li>
                                <li><a class="ajax-link" href="product.html"><i class="glyphicon glyphicon-eye-open"></i><span> Products</span></a>
                                </li>
                                <li><a class="ajax-link" href="news.html"><i
                                            class="glyphicon glyphicon-edit"></i><span> News</span></a></li>
                                <li><a class="ajax-link" href="customer_opinion.html"><i class="glyphicon glyphicon-list-alt"></i><span> Ý kiến khách hàng</span></a>
                                </li>
                                <li><a class="ajax-link" href="manager_menu.html"><i class="glyphicon glyphicon-book"></i><span> Quản lý menu</span></a>
                                </li>
                                <li><a class="ajax-link" href="manager_banner"><i class="glyphicon glyphicon-book"></i><span> Banner</span></a>
                                </li>
                                <li><a class="ajax-link" href="manager_partner"><i class="glyphicon glyphicon-user"></i><span> Đối tác</span></a>
                                </li>
                                <li><a class="ajax-link" href="manager_customer"><i class="glyphicon glyphicon-book"></i><span> Quản lý khách hàng</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/span-->
                <!-- left menu ends -->


                <div id="content" class="col-lg-10 col-sm-10">
                    
                    <?php echo $main_content ?>
                    
                </div><!--/#content.col-md-0-->
            </div><!--/fluid-row-->



            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" target="_blank">Saxagift</a> 2015</p>

                <!--                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                                        href="#">Charisma</a></p>-->
            </footer>

        </div><!--/.fluid-container-->
        
        <!-- external javascript -->
        <script src="<?php echo base_url('contants') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('common/js/jquery-1.11.2.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('common/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('common/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('common/js/common.js') ?>" type="text/javascript"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- library for cookie management -->
        <script src="<?php echo base_url('common/js/jquery.cookie.js') ?>"></script>
        <!-- calender plugin -->
        <script src="<?php echo base_url('common/bower_components/moment/min/moment.min.js') ?>"></script>
        <script src='bower_components/fullcalendar/dist/fullcalendar.min.js') ?>"></script>
        <!-- data table plugin -->
        <script src="<?php echo base_url('common/js/jquery.dataTables.min.js') ?>"></script>

        <!-- select or dropdown enhancer -->
        <script src="<?php echo base_url('common/bower_components/chosen/chosen.jquery.min.js') ?>"></script>
        <!-- plugin for gallery image view -->
        <script src="<?php echo base_url('common/bower_components/colorbox/jquery.colorbox-min.js') ?>"></script>
        <!-- notification plugin -->
        <script src"<?php echo base_url('common/js/jquery.noty.js') ?>"></script>
        <!-- library for making tables responsive -->
        <script src="<?php echo base_url('common/bower_components/responsive-tables/responsive-tables.js') ?>"></script>
        <!-- tour plugin -->
        <script src="<?php echo base_url('common/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js') ?>"></script>
        <!-- star rating plugin -->
        <script src="<?php echo base_url('common/js/jquery.raty.min.js') ?>"></script>
        <!-- for iOS style toggle switch -->
        <script src="<?php echo base_url('common/js/jquery.iphone.toggle.js') ?>"></script>
        <!-- autogrowing textarea plugin -->
        <script src="<?php echo base_url('common/js/jquery.autogrow-textarea.js') ?>"></script>
        <!-- multiple file upload plugin -->
        <script src="<?php echo base_url('common/js/jquery.uploadify-3.1.min.js') ?>"></script>
        <!-- history.js for cross-browser state change on ajax -->
        <script src="<?php echo base_url('common/js/jquery.history.js') ?>"></script>
        <!-- application script for Charisma demo -->
        <script src="<?php echo base_url('common/js/charisma.js') ?>"></script>
</body>

