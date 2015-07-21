<?php
if(!empty($news_cat_position)) {
    foreach ($news_cat_position as $news_cat):
        if($news_cat['position'] == LEFT_POSITION) {
            $name = htmlspecialchars($news_cat['name']);
            $title = (!empty($news_cat['title'])) ? _substr($news_cat['title'], 150) : '';
            $img_url = base_url('common/images/pic_1.png');
            $cat_left_one = <<<EOF
                <div class="box_head">{$name}</div>
                 <div class="box_main">
                     <p>{$title}</p>
                     <hr/>
                     <div class="header">{$name}</div>
                     <p class="pic_news"><img src="{$img_url}"/></p>
                     <p>{$title}</p>
                 </div>
                 <div class="box_foot"></div>     
            
EOF;
        }
        if($news_cat['position'] == LEFT_POSITION_2) {
            $name = htmlspecialchars($news_cat['name']);
            $title = (!empty($news_cat['title'])) ? _substr($news_cat['title'], 150) : '';
            $img_url = base_url('common/images/pic_1.png');
            $customer_name = $this->lang->line('customer_name');
            $btn_send = $this->lang->line('send');
            $cat_left_two = <<<EOF
                <div class="box_head">{$name}</div>
                <div class="box_main">
                    <p>{$title}</p>
                    <form name="frmSendCustomer" id="frmSendCustomer" class="send_mail_customer">
                        <input type="text" name="customer_name" placeholder="{$customer_name}"/><br/>
                        <input type="text" name="email_address" placeholder="Email"/><br/>
                        <input type="button" id="sendMailCustomer" value="{$btn_send}" class="js__p_start"/>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="box_foot"></div>     
EOF;
        }
        if ($news_cat['position'] == RIGHT_POSITION ) {
            $name = htmlspecialchars($news_cat['name']);
            $title = htmlspecialchars($news_cat['title']);
            $cat_right_one = <<<EOF
                <div class="box_head">{$name}</div>
                <div class="box_main">
                    <p>{$title}</p>
EOF;
        }
        if($news_cat['position'] == FOOTER_POSITION) {
            $name = htmlspecialchars($news_cat['name']);
            $slug = base_url($news_cat['slug']);
            $view_more = $this->lang->line('view_more');
            $image = base_url('common/images/nhay_kep.png');
            $title = (!empty($news_cat['title'])) ? $news_cat['title'] : '';
            $quotation = base_url('common/images/nhay_kep.png');
            $our_work = base_url('common/images/our_work.png');
            $cat_footer = <<<EOF
                    <div class="header_other_services">
                    <div class="tit_our_work">{$name}</div>
                    <div class="see_more"><a href="{$slug}">{$view_more}</a></div>
                    <div class="clearfix"></div>
                </div>
                <div class="content_our_work">
                    <div class="pic_character"><img src="{$our_work}"/></div>
                    <div class="talk_character">
                        <div class="text_cont" >
                            <img src="{$image}" class="pull-left"/>
                            <span class="pull-left">
                                {$title}
                            </span> 
                            <img src="{$quotation}" class="pull-right"/>
                        </div>
                    </div>
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
            <?php echo $cat_left_one; ?>
        </div>
        <div class="box_l">
            <?php echo $cat_left_two ?>   
        </div>
    </div>
    <div class="content_center">
        <div class="header_c"><?php echo $this->lang->line('choose_gift') ?></div>
        <p class="intro_c">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." sunt in culpa qui officia deserunt mollit </p>
        <ul class="list_gift">
            <?php if(!empty($cat_gift)): ?>
            <?php foreach ($cat_gift as $key=>$gift): $mask = $key+1; ?>
            <a href="<?php echo base_url($gift['slug']) ?>">
            <li class="<?php if($key == 1) echo 'last' ?>">
                <div onmouseover="showMask('<?php echo 'mask'.$mask; ?>')">
                    <img src="<?php echo base_url('admin/common/multidata/cat_logo/' . $gift['logo']) ?>" />
                    <div class="title_product">
                        <span><?php echo ucwords($gift['name']) ?></span><br/>
                        <span class="price_product">><?php if(!empty($gift['price'])) echo number_format($gift['price']) ?></span>
                    </div>
                </div>
                <div id="mask<?php echo $mask ?>" class="mask" style="background:<?php if(!empty($gift['bg_color'])) echo $gift['bg_color'];else echo '#000' ?>;" onmouseout="hideMask('<?php echo 'mask'. $mask ?>')">  
                    <img src="<?php echo base_url('common/images/plus_product_home.png') ?>"/>
                </div>
            </li>
            </a>
            <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div>

    <div class="content_right">
        <div class="box_l">
            <?php echo $cat_right_one ?>
                <p class='pic_news'><img src="<?php echo base_url('common/images/video.png') ?>"/></p>
                <hr/>
                <?php if(!empty($news_home)): ?>
                <?php foreach ($news_cat as $news): ?>
                <div class="header"><?php if(!empty($news['title'])) echo htmlspecialchars($news['title']) ?></div>
                    <p class="news_r">
                        <img src="<?php //echo base_url('common/images/'.$news['avatar']) ?>"/>
                        <span><?php if(!empty($news['description'])) echo htmlspecialchars($news['description']) ?></span>
                    </p>
                    <div class="clearfix"></div>
                <?php endforeach; ?>
                <?php endif; ?>
            <div class="box_foot"></div>
        </div>
    </div>
    <div class="clearfix"></div>

</div>
<div class="other_services">
    <div class="our_work">
        <?php echo $cat_footer; ?>
    </div>
    <div class="customer_saxa">
        <div class="header_other_services text-align-center">
            <div class="tit_customer_saxa"><?php echo $this->lang->line('customers_saxa') ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="slide_customer">
            <!--<img src="images/product_slide_sub.png"/>-->
            <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 226px; height: 209px; ">

                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:226px; height: 209px;
                     overflow: hidden;">
                    <div><img u="image" src="<?php echo base_url('common/images/product_slide_sub.png') ?>" /></div>
                    <div><img u="image" src="<?php echo base_url('common/images/product_slide_sub.png') ?>" /></div>
                    <div><img u="image" src="<?php echo base_url('common/images/product_slide_sub.png') ?>" /></div>
                </div>

                <span u="arrowleft" class="jssora11l" style="top: 76px; left: -14px;"></span>
                <span u="arrowright" class="jssora11r" style="top: 76px; right: -14px;"></span>
                <script>
                    jssor_slider1_starter('slider1_container');
                </script>
            </div>
        </div>
    </div>
    <div class="programe_saxa">
        <div class="header_other_services text-align-center">
            <div class="tit_customer_saxa"><?php echo $this->lang->line('saxa_program') ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="slide_customer">
            <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 226px; height: 209px; ">

                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:226px; height: 209px; overflow: hidden;">
                    <div><img u="image" src="<?php echo base_url('common/images/product_slide_sub.png') ?>" /></div>
                    <div><img u="image" src="<?php echo base_url('common/images/product_slide_sub.png') ?>" /></div>
                    <div><img u="image" src="<?php echo base_url('common/images/product_slide_sub.png') ?>" /></div>
                </div>

                <span u="arrowleft" class="jssora11l" style="top: 76px; left: -14px;"></span>
                <span u="arrowright" class="jssora11r" style="top: 76px; right: -14px;"></span>
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
