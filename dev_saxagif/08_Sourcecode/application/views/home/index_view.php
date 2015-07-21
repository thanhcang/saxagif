<div class="content">
    <div class="content_left">
        <div class="box_l">
            <?php if(!empty($news_cat_position)): ?>
            <?php foreach ($news_cat_position as $news_cat): ?>
            <?php if($news_cat['position'] == LEFT_POSITION): ?>
            <div class="box_head"><?php echo htmlspecialchars($news_cat['name']) ?></div>
                <div class="box_main">
                    <p><?php if(!empty($news_cat['title'])) echo _substr($news_cat['title'], 150) ?></p>
                    <hr/>
                    <div class="header"><?php echo htmlspecialchars($news_cat['name']) ?></div>
                    <p class="pic_news"><img src="<?php echo base_url('common/images/pic_1.png') ?>"/></p>
                    <p><?php if(!empty($news_cat['title'])) echo _substr($news_cat['title'], 100) ?></p>
                </div>
                <div class="box_foot"></div>
            <?php endif ?>
            <?php endforeach ?>
            <?php endif ?>
        </div>
        <div class="box_l">
            <div class="box_head">Chia sáº» vÃ  káº¿t ná»‘i</div>
            <div class="box_main">
                <p>Chia sáº» email vá»›i chÃºng tÃ´i Ä‘á»ƒ nháº­n nhá»¯ng thÃ´ng tin sá»± kiá»‡n má»›i nháº¥t tá»« Saxa báº¡n nhÃ©!Chia sáº» email vá»›i chÃºng tÃ´i Ä‘á»ƒ nháº­n nhá»¯ng thÃ´ng tin sá»± kiá»‡n </p>
                <form name="frmSendCustomer" id="frmSendCustomer" class="send_mail_customer">
                    <input type="text" name="customer_name" placeholder="<?php echo $this->lang->line('customer_name') ?>"/><br/>
                    <input type="text" name="email_address" placeholder="Email"/><br/>
                    <input type="button" id="sendMailCustomer" value="<?php echo $this->lang->line('send') ?>" class="js__p_start"/>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="box_foot"></div>
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
            <div class="box_head">Truyá»�n cáº£m há»©ng</div>
            <div class="box_main">
                <p>Náº¿u báº¡n khÃ´ng giÃ u vÃ¬ sá»‘ lÆ°á»£ng, thÃ¬ hÃ£y lÃ m giÃ u báº±ng cháº¥t lÆ°á»£ng!</p>
                <p class='pic_news'><img src="<?php echo base_url('common/images/video.png') ?>"/></p>
                <hr/>
                <div class="header">Marketing</div>
                <p class="news_r">
                    <img src="<?php echo base_url('common/images/pic_1.png') ?>"/>
                    <span>totam rem aperiam, eaque ipsa quae ab. </span>
                </p>
                <div class="clearfix"></div>
                <hr/>
                <div class="header">Quan niá»‡m thá»�i gian</div>
                <p class="news_r">
                    <img src="<?php echo base_url('common/images/pic_1.png') ?>"/>
                    <span>totam rem aperiam, eaque ipsa quae ab.</span>
                </p>
                <div class="clearfix"></div>
                <hr/>
                <div class="header">Cáº£m há»©ng sá»‘ng</div>
                <p class="news_r">
                    <img src="<?php echo base_url('common/images/pic_1.png') ?>"/>
                    <span>totam rem aperiam, eaque ipsa quae ab.</span>
                </p>
                <div class="clearfix"></div>
                <a href="#" class="link">Xem thÃªm</a>
                <div class="clearfix"></div>
            </div>
            <div class="box_foot"></div>
        </div>
    </div>
    <div class="clearfix"></div>

</div>
<div class="other_services">
    <div class="our_work">
        <div class="header_other_services">
            <?php if(!empty($news_cat_position)): ?>
            <?php foreach ($news_cat_position as $news_cat): ?>
                <?php if($news_cat['position'] == FOOTER_POSITION): ?>
                <div class="tit_our_work"><?php echo htmlspecialchars($news_cat['name']) ?></div>
                <div class="see_more"><a href="<?php echo $news_cat['slug'] ?>"><?php echo $this->lang->line('view_more') ?></a></div>
                <div class="clearfix"></div>
                <?php endif ?>
            <?php endforeach ?>
            <?php endif ?>
        </div>

        <div class="content_our_work">
            <div class="pic_character"><img src="<?php echo base_url('common/images/our_work.png') ?>"/></div>
            <div class="talk_character">
                <div class="text_cont" >
                    <img src="<?php echo base_url('common/images/nhay_kep.png') ?>" class="pull-left"/>
                    <span class="pull-left">
                        <font>Chá»‹ Nguyá»…n GÃ¬ GÃ¬ Ä�Ã³ - Marketing</font><br/>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut 
                    </span> 
                    <img src="<?php echo base_url('common/images/nhay_kep.png') ?>" class="pull-right"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="customer_saxa">
        <div class="header_other_services text-align-center">
            <div class="tit_customer_saxa">khÃ¡ch hÃ ng cá»§a saxa</div>
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
            <div class="tit_customer_saxa">chÆ°Æ¡ng trÃ¬nh cá»§a saxa</div>
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
