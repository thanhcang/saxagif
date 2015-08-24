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
            echo '<script src="' . base_url($key) . '"></script>';
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
                <a class="navbar-brand" href="<?php echo base_url(); ?>"> <img alt="Charisma Logo" src="<?php echo base_url('common/img/logo20.png') ?>" class="hidden-xs"/>
                    <span>Saxagif</span></a>
                <!-- user dropdown starts -->
                <div class="btn-group pull-right">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></span>
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
                    <li><a href=""><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
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
                                <li class="nav-header">
                                    <i class="glyphicon glyphicon-book"></i><span> menu quản lý </span>
                                </li>
                                <li>
                                    <a class="ajax-link" href="<?php echo base_url('category') ?>"> <i class="glyphicon glyphicon-plus"></i><span> Danh mục</span></a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('product') ?>"> <i class="glyphicon glyphicon-tags"></i><span> Sản phẩm</span></a>
                                </li>
                                <li>
                                    <a class="ajax-link" href="<?php echo base_url('category_news') ?>">
                                        <i class="glyphicon glyphicon-align-justify"></i><span> Danh mục page</span>
                                    </a>
                                </li>
                                <li><a class="ajax-link" href="<?php echo base_url('news') ?>"><i class="glyphicon glyphicon-edit"></i><span> Nội dung của page</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('saxa_everyday') ?>"><i class="glyphicon glyphicon-book"></i><span> Danh mục tin tức </span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('news_saxa_everyday') ?>"><i class="glyphicon glyphicon-edit"></i><span> Tin tức</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('commentCustomer'); ?>"><i class="glyphicon glyphicon-question-sign"></i><span> câu hỏi khách hàng</span></a></li>
                                <!--ý kiên khách hàng-->
                                <li><a class="ajax-link" href="<?php echo base_url('ideaCustomer'); ?>"><i class="glyphicon glyphicon-comment"></i><span> Ý kiến khách hàng</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('joinSaxa'); ?>"><i class="glyphicon glyphicon-book"></i><span> JoinSaxa</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('partners') ?>"><i class="glyphicon glyphicon-user"></i><span> Đối tác</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('customer') ?>"><i class="glyphicon glyphicon-book"></i><span> khách hàng</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('listenThemSay') ?>"><i class="glyphicon glyphicon-earphone"></i><span> Nghe họ nói</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('salesService') ?>"><i class="glyphicon glyphicon-flash"></i><span> Sales phục vụ bạn</span></a></li>
                                <li><a class="ajax-link" href="<?php echo base_url('user'); ?>"><i class="glyphicon glyphicon-user"></i><span>user</span></a></li>
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
                            <?php foreach ($breadcrumb as $key => $value) : ?>
                                <li>
                                    <a href="<?php echo $key ?>"><?php echo $value ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php echo $main_content ?>
                </div><!--/#content.col-md-0-->
            </div><!--/fluid-row-->
            <?php require_once(VIEW_PATH . 'templates/popup/_profile.php'); ?>
            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" target="_blank">Saxagift</a> 2015</p>
            </footer>

        </div><!--/.fluid-container-->
    </body>
    <script type="text/javascript">
        $(function () {
        });


        function showChildCat(it) {
            $(it).find('.child-cate').css('display', 'block');
            $(it).attr('onclick', 'hideChildCat(this)');
        }

        function hideChildCat(it) {
            $(it).find('.child-cate').css('display', 'none');
            $(it).attr('onclick', 'showChildCat(this)');
        }
    </script>

