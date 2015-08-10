<div class="banner_t"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('we_expect_from_you') ?></div>
    <p class="content_post">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
    </p>
    <p class="social">
        <a href="javascript:;"><img src="<?php echo base_url('common/images/share_fb.png') ?>"/></a>
        <a href="javascript:;"><img src="<?php echo base_url('common/images/like_fb.png') ?>"/></a>
    </p>
</div>
<div class="content_noboder gift">
    <div class="label"><?php echo $this->lang->line('special_gifts_from_saxa') ?></div>
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 980px; height: 150px; overflow: hidden; "><!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px; height: 150px; overflow: hidden;">
            <?php if(!empty($list_gift)): ?>
            <?php foreach ($list_gift as $gift): ?>
            <div class="img_gift">
                <a href="<?php echo base_url($gift['slug']) ?>">
                    <img u="image" alt="<?php //echo htmlspecialchars($gift['product_name']) ?>" src="<?php echo url_img(URL_PRODUCT_THUMB_IMAGE, $gift['image_name']) ?>" />
                </a>
            </div>
            <?php endforeach; ?>
            <?php endif ?>
        </div>
    </div>
    <script src="<?php echo base_url('common/js/contact_sm.js') ?>"></script>
    <script>
        jssor_slider1_starter('slider1_container');
    </script>
    <div class="clearfix"></div>
</div>

<div class="content_noboder border-top marTop20">
    <div class="label"><?php echo $this->lang->line('sale_you_will_serve_you') ?></div>
    <div class="staff_sale">
        <div class="arrow">
            <a href="">
                <div class="pic_staff_"><img src="<?php echo base_url('common/images/staff.png') ?>"/></div>
                <div class="group_staff_">LOUIS<br/><small>09865668</small></div>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
    <div class="staff_sale">
        <div class="arrow">
            <a href="">
                <div class="pic_staff_"><img src="<?php echo base_url('common/images/staff.png') ?>"/></div>
                <div class="group_staff_">LOUIS<br/><small>09865668</small></div>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
    <div class="staff_sale">
        <div class="arrow">
            <a href="">
                <div class="pic_staff_"><img src="<?php echo base_url('common/images/staff.png') ?>"/></div>
                <div class="group_staff_">louis<br/><small>09865668</small></div>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
    <div class="staff_sale">
        <div class="arrow">
            <a href="">
                <div class="pic_staff_"><img src="<?php echo base_url('common/images/staff.png') ?>"/></div>
                <div class="group_staff_">louis<br/><small>09865668</small></div>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
    <div class="staff_sale">
        <div class="arrow">
            <a href="">
                <div class="pic_staff_"><img src="<?php echo base_url('common/images/staff.png') ?>"/></div>
                <div class="group_staff_">louis<br/><small>09865668</small></div>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
    <p><a href="7-lien-lac.html"><img src="<?php echo base_url('common/images/button_contact.png') ?>"/></a></p>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>