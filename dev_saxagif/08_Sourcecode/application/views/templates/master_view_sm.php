<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" href="<?php echo base_url('common/css/menu_sm.css') ?>">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('common/css/layout_sm.css') ?>"/>
        <script src="<?php echo base_url('common/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('common/js/jquery-ui.js') ?>"></script>
        
        <!--[if lt IE 9]>-1.8.1.min
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo base_url('contants') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('common/js/jssor.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('common/js/jssor.slider.js') ?>"></script>
    </head>
    <body>
        <div class="container">
            <div class="<?php if(isset($class) && $class =='home') echo 'w_header';elseif(isset ($class) && $class !='home') echo 'w_header_p' ?>">
                <header class="main">
                    <a href="#menu" class="menu-trigger ss-icon"><img src="<?php echo base_url('common/images/icon_menu.png') ?>"/></a>
                    <nav>
                        <ul>
                        <?php if(!empty($news_cat_position)): ?>
                        <?php foreach ($news_cat_position as $news_cat): ?>
                            <?php if($news_cat['position'] == HEADER_POSITION): ?>
                            <li>
                                <a class="block-menu" href='<?php echo base_url($news_cat['slug']) ?>'><?php echo htmlspecialchars($news_cat['name']) ?></a>
                            </li>
                            <?php endif ?>
                        <?php endforeach ?>
                        <?php endif ?>
                            <li><a href="<?php echo base_url() ?>"><?php echo $this->lang->line('page_home') ?></a></li>
                            <li><a href="<?php echo base_url('thac-mac-huong-dan'); ?>"><?php echo $this->lang->line('page_question_answer') ?></a></li>
                            <li><a href="<?php echo base_url('hop-tac'); ?>"><?php echo $this->lang->line('page_operate') ?></a></li>
                            <li><a href="<?php echo base_url('gia-nhap-cung-saxa') ?>"><?php echo $this->lang->line('page_join_saxa') ?></a></li>
                            <li><a href="<?php echo base_url('contact'); ?>"><?php echo $this->lang->line('page_contact') ?></a></li>
                            <li class="search">
                                <a>
                                    <input type="text"/>
                                    <button type="button" class="btn_search"><img src="<?php echo base_url('common/images/btn_search.png') ?>"/></button>
                                </a>
                            </li>
                            <li>
                                <ul class="mn_share">
                                    <li><img src="<?php echo base_url('common/images/share_g_mn.png') ?>"/></li>
                                    <li><img src="<?php echo base_url('common/images/share_sk_mn.png') ?>"/></li>
                                    <li><img src="<?php echo base_url('common/images/share_f_mn.png') ?>"/></li>
                                </ul>
                            </li>
                            <li class="slogan_mn">
                                <a>
                                    <?php //if($setting_footer['slogan']) echo strtoupper($setting_footer['slogan']) ?>
                                    sứ mệnh của một công ty là gì?
                                    nếu không phải là đem lại hạnh phúc 
                                    cho khách hàng của mình
                                </a>
                            </li>
                        </ul>
                    </nav>
                </header>
                <div class="language">
                    <a href="javascript:;" style="border-right:1px solid #fff;padding-right: 6px;" class="lang_type" attr_val="<?php echo LANG_EN ?>">Eng</a>
                    <a href="javascript:;" class="lang_type" attr_val="<?php echo LANG_VN ?>">Vn</a>
                </div>
                <div class="hotline_top">Hotline: <?php echo HOTLINE ?></div>
                <div class="slogan_top">
                    <img src="<?php echo base_url('common/images/CAU-THONG-DIEP.gif') ?>"/>
                </div>
                <div class="icon_share">
                    <a href="#"><img src="<?php echo base_url('common/images/icon_google_plus.png') ?>"/></a>
                    <a href="#"><img src="<?php echo base_url('common/images/icon_skype.png') ?>"/></a>
                    <a href="#"><img src="<?php echo base_url('common/images/icon_face.png') ?>" class="last"/></a>
                </div>
            </div>
            <div class="w_main">
                <div class="w_content">
                    <?php if(isset($class) && $class == 'home'): ?>
                        <?php $this->load->view('templates/_parts/master_banner_view_sm'); ?>
                    <?php endif ?>
                    <div class="content_main">
                        
                        <?php echo $the_view_content;?>    
                    </div>
            </div>
            <?php $this->load->view('templates/_parts/master_footer_view_sm'); ?>
        </div>
        <script src="<?php echo base_url('common/js/common_sm.js') ?>"></script>
        <script src="<?php echo base_url('common/js/menu.min.js') ?>"></script>
    </body>
</html>
