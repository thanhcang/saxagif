<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex,nofollow" />
    <title><?php echo empty($page_title) ? DEFAULT_TITLE : $page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
        $css_path = $this->config->item('css_path');
        $js_path = $this->config->item('js_path');
        // css
        foreach ($css_path as $key) {
            echo link_tag($key);
        }
        // js
        foreach ($js_path as $key) {
            echo '<script src="'.base_url($key).'"></script>';
        }
    ?>
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
                        <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" class="currentLogin" attUser="<?php echo $this->session->userdata('user_id'); ?>">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('login/logOut'); ?>">Logout</a></li>
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
                            <input placeholder="Search" class="search-query form-control col-md-10" name="query" type="text">
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
                                <li class="nav-header">Danh mục quản lý</li>
                                <li><a class="ajax-link" href="manager_menu.html"><i class="glyphicon glyphicon-book"></i><span> Quản lý menu</span></a>
                                </li>
                                <li class="accordion"  onclick="showChildCat(this)">
                                    <a href="javascript:;"><i class="glyphicon glyphicon-plus"></i><span> Danh mục</span></a>
                                    <ul class="nav nav-pills nav-stacked child-cate" style="display: none;">
                                        <li><a href="<?php echo base_url('category/?&gift=1') ?>">Giúp bạn chọn quà</a></li>
                                        <li><a href="<?php echo base_url('category/?&gift=0') ?>"> Danh mục sản phẩm</a></li>
                                    </ul>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('product') ?>"><i class="glyphicon glyphicon-tags"></i><span> Sản phẩm</span></a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('news') ?>"><i
                                            class="glyphicon glyphicon-edit"></i><span> Tin tức</span></a></li>
                                <li><a class="ajax-link" href="customer_opinion.html"><i class="glyphicon glyphicon-comment"></i><span> Ý kiến khách hàng</span></a>
                                </li>
                                <li><a class="ajax-link" href="manager_banner"><i class="glyphicon glyphicon-book"></i><span> Banner</span></a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('partners') ?>"><i class="glyphicon glyphicon-user"></i><span> Đối tác</span></a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('customer') ?>"><i class="glyphicon glyphicon-book"></i><span> khách hàng</span></a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('user'); ?>"><i class="glyphicon glyphicon-user"></i><span>user</span></a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('cai-dat-chung'); ?>"><i class="glyphicon glyphicon-cog"></i><span> Cài đặt chung</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/span-->
                <!-- left menu ends -->
                <div id="content" class="col-lg-10 col-sm-10">
                    <div>
                        <ul class="breadcrumb">
                            <?php foreach ( $breadcrumb as $key => $value) : ?>
                                <li>
                                    <a href="<?php echo $key ?>"><?php echo $value ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php echo $main_content ?>
                </div><!--/#content.col-md-0-->
            </div><!--/fluid-row-->
            <?php require_once(VIEW_PATH.'templates/popup/_profile.php') ;?>
            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" target="_blank">Saxagift</a> 2015</p>
            </footer>

        </div><!--/.fluid-container-->
</body>
<script type="text/javascript">
    $(function(){
    });


function showChildCat(it) {
    $(it).find('.child-cate').css('display','block');
    $(it).attr('onclick','hideChildCat(this)');
}

function hideChildCat(it) {
    $(it).find('.child-cate').css('display','none');
    $(it).attr('onclick','showChildCat(this)');
}
</script>

