<?php
if(!empty($news_cat_position)) {
    foreach ($news_cat_position as $news_cat):
        
        if($news_cat['position'] == FOOTER_POSITION) {
            $name = htmlspecialchars($news_cat['name']);
            $slug = base_url($news_cat['slug']);
            $view_more = $this->lang->line('view_more');
            $title = (!empty($news_cat['title'])) ? $news_cat['title'] : '';

            $our_work = base_url('common/images/our_work.png');
            $cat_footer = <<<EOF
                    <div class="header_other_services">
                        <div class="tit_our_work">{$name}</div>
                        <div class="see_more"><a href="{$slug}">{$view_more}</a></div>
                        <div class="clearfix"></div>
                    </div>
EOF;
        }
    endforeach;
}
?>
<div class="content">
    <div class="content_left">
        <div class="box_l">
            <div class="box_head"><?php echo $this->lang->line('CUSTOMER_STORY'); ?></div>
            <div class="box_main">
                <p style="height:100px"><?php echo !empty($setting_footer['note_story']) ?  $setting_footer['note_story'].'...' : ''?></p>
                <hr>
                <?php if(!empty($menu_left_1)) : ?>
                <div class="header"><a href=""><?php echo !empty($menu_left_1['name']) ? $menu_left_1['name'] : '' ;?></a></div>
                <p class="pic_news"><a href=""><img src="<?php echo !empty($menu_left_1['avatar']) ? base_url('admin/common/multidata/cat_news'.'/'.$menu_left_1['avatar']) : base_url('common/images/images/pic_1.png') ;?>"></a></p>
                <p style="height:57px"><?php echo !empty($menu_left_1['title']) ? $menu_left_1['title'] : '' ;?></p>
                <?php endif ?>
            </div>
            <div class="box_foot"></div>
        </div>
        
        <!--customer save email-->
        <div class="box_l">
                <div class="box_head"><?php echo $this->lang->line('SHARE_CONNECT'); ?></div>
                <div class="box_main">
                    <p><?php echo !empty($setting_footer['note_share']) ?  $setting_footer['note_share'].'...' : ''?></p>
                    <form class="send_mail_customer" id="frmSendCustomer" name="frmSendCustomer">
                        <input type="text" placeholder="Tên khách hàng" name="customer_name"><br>
                        <input type="text" placeholder="Email" name="email_address"><br>
                        <input type="button" class="js__p_start" value="Gửi" id="sendMailCustomer">
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="box_foot"></div>        
        </div>
        
    </div>
    <div class="content_center">
        <div class="header_c"><?php echo $this->lang->line('choose_gift') ?></div>
        <p class="intro_c"><?php echo !empty($setting_footer['note_chose_present']) ?   $setting_footer['note_chose_present'] : ''; ?></p>
        <ul class="list_gift">
            <?php if(!empty($cat_gift)): ?>
            <?php foreach ($cat_gift as $key=>$gift): $mask = $key+1; ?>
            <li class="<?php if($key == 1) echo 'last' ?>">
                <a href="<?php echo base_url($gift['slug']) ?>">
                <div onmouseover="showMask('<?php echo 'mask'.$mask; ?>')">
                    <img src="<?php echo base_url('admin/common/multidata/cat_logo/' . $gift['logo']) ?>" />
                    <div class="title_product">
                        <span><?php echo ucwords($gift['name']) ?></span><br/>
                        <span class="price_product"><?php if(!empty($gift['price'])) echo ($gift['price']) ?></span>
                    </div>
                </div>
                <div id="mask<?php echo $mask ?>" class="mask" style="background:<?php if(!empty($gift['bg_color'])) echo $gift['bg_color'];else echo '#000' ?>;" onmouseout="hideMask('<?php echo 'mask'. $mask ?>')">  
                    <img src="<?php echo base_url('common/images/plus_product_home.png') ?>"/>
                </div>
                </a>
            </li>
            <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div>

    <div class="content_right">
        <div class="box_l">
            <div class="box_head"><?php echo $this->lang->line('SHARE_FUNNY') ?></div>
            <div class="box_main">
                <p class="height_45"><?php echo !empty($setting_footer['note_funny']) ?   $setting_footer['note_funny'] : ''; ?></p>
                <p class="pic_news">
                    <a class="js__p_start">
                        <img src="<?php echo base_url('common/images/video.png'); ?>">
                    </a>
                </p>
                <?php if (!empty($menu_left_2))  : ?>
                <?php foreach ($menu_left_2 as $key): ?>
                <hr>
                <div class="header"><?php echo $key['name']; ?></div>
                <div class="news_r">
                    <img src="<?php echo base_url('admin/common/multidata/cat_news'.'/'.$key['avatar']); ?>">
                    <p><?php echo !empty($key['title']) ? $key['title'].'...' : ''  ?></p>
                </div>
                <div class="clearfix"></div>
                <?php endforeach; ?>
                <?php endif; ?>
                <div class="clearfix"></div>
                <a class="link" href="18-inspirational.html"><?php echo $this->lang->line('view_more') ?></a>
                <div class="clearfix"></div>
            </div>
            <div class="box_foot"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="other_services">
    <div class="our_work" id="slider3_container" style="position: relative; top: 0px; left: 0px; width: 656px; height: 219px; ">
        <?php if (!empty($categoryFooter)): ?>
        <div class="header_other_services">
            <div class="tit_our_work"><?php echo $categoryFooter['name']  ?></div>
            <div class="see_more"><a href="19-what-worked-we.html"><?php echo $this->lang->line('view_more'); ?></a></div>
            <div class="clearfix"></div>
        </div>
        <?php endif ?>
        <?php if(!empty($articleFooter)): ?>
            <?php foreach ($articleFooter as $key=>$value): ?>
                <div class="content_our_work">
                        <div class="pic_character"><img src="<?php echo url_img('admin/common/multidata/news/', $value['avatar']) ?>"/></div>
                        <div class="talk_character">
                            <div class="text_cont" >
                                <img src="<?php echo base_url('common/images/nhay_kep.png'); ?>" class="pull-left"/>
                                <span class="pull-left">
                                    <?php  if(!empty($value['description'])) echo _substr(htmlspecialchars_decode($value['description']),200) ?>
                                </span> 
                                <img src="<?php echo base_url('common/images/nhay_kep.png'); ?>" class="pull-right"/>
                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
        <span u="arrowleft" class="jssora11l slideCus" attr_num="first" style="top: 110px; left: -14px;"></span>
        <span u="arrowright" class="jssora11r slideCus" attr_num="last" style="top: 110px; right: -14px;"></span>
        <script>
            jssor_slider3_starter('slider3_container');
        </script>
    </div>
    <div class="customer_saxa">
        <div class="header_other_services text-align-center">
            <div class="tit_customer_saxa"><?php echo !empty($categoryFooter2['name']) ? $categoryFooter2['name'] : $this->lang->line('customers_saxa') ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="slide_customer">
            
            <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 226px; height: 209px; ">

                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:226px; height: 209px; overflow: hidden;">
                    <?php if(!empty($articleFooter2)): ?>
                    <?php foreach ($articleFooter2 as $key=>$value): ?>
                        <div>
                            <a href="<?php echo base_url($value['category_slug'].'/'. $value['slug']) ?>"><img u="image" src="<?php echo url_img('admin/common/multidata/news/', $value['avatar'])  ?>" /></a>
                        </div>
                    <?php endforeach; ?>
                    <?php endif ?>
                </div>

                <span u="arrowleft" class="jssora11l slideCus" attr_num="first" style="top: 76px; left: -14px;"></span>
                <span u="arrowright" class="jssora11r slideCus" attr_num="last" style="top: 76px; right: -14px;"></span>
                <script>
                    jssor_slider1_starter('slider1_container');
                </script>
            </div>
        </div>
    </div>
    
    <div class="programe_saxa">
        <div class="header_other_services text-align-center">
            <div class="tit_customer_saxa"><?php echo !empty($categoryFooter3['name']) ? $categoryFooter3['name'] : $this->lang->line('saxa_program') ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="slide_customer">
            <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 226px; height: 209px; ">

                <!-- Slides Container -->
                <div u="slides" class="contentCustomer" style="cursor: move; position: absolute; left: 0px; top: 0px; width:226px; height: 209px; overflow: hidden;">
                    <?php if(!empty($articleFooter3)): ?>
                    <?php foreach ($articleFooter3 as $key=>$value): ?>
                        <div>
                            <a href="<?php echo base_url($value['category_slug'].'/'. $value['slug']) ?>"><img u="image" src="<?php echo url_img('admin/common/multidata/news/', $value['avatar'])  ?>" /></a>
                        </div>
                    <?php endforeach; ?>
                    <?php endif ?>
                </div>

                <span u="arrowleft" class="jssora11l slideProgramLeft" attr_num="first" style="top: 76px; left: -14px;"></span>
                <span u="arrowright" class="jssora11r slideProgramRight" attr_num="last" style="top: 76px; right: -14px;"></span>
                <script>
                    jssor_slider2_starter('slider2_container');
                </script>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript">
    var URL_SEND_MAIL_CUSTOMER = '<?php echo base_url('home/sendMailCustomer') ?>';
</script>
