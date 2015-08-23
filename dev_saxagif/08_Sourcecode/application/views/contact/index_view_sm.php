<style>.content_boder .frm_contact p { font-size: 3em; }</style>
<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('page_contact') ?></div>
    <p class="content_post">
        <img src="<?php echo base_url('common/images/pic_contact.png') ?>"/>
    </p> 
    <div class="frm_contact">
        <label><?php echo $this->lang->line('tutorial_choose_gift') ?></label>
        <p class="text_news">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </p>
        <form name="frmContact" id="frmContact" method="POST" action="">
            <div class="frm_cont">
                <div class="control_group">
                    <input type="text" name="cus_name" class="inbox_contact" value="" placeholder="<?php echo $this->lang->line('customer_name') ?>"/>
                    <span class="red">*</span>
                </div>
                <div class="control_group">
                    <input type="text" name="cus_email" class="inbox_contact" value="" placeholder="<?php echo $this->lang->line('email') ?>" />
                    <span class="red">*</span>
                </div>
                <div class="control_group">
                    <input type="text" name="cus_phone" class="inbox_contact" value="" placeholder="<?php echo $this->lang->line('phone') ?>" />
                </div>
                <div class="control_group">
                    <input type="text" name="cus_company" class="inbox_contact" value="" placeholder="<?php echo $this->lang->line('company') ?>" />
                </div>
                <div class="control_group">
                    <textarea name="cus_feeback" class="textarea_contact" placeholder="<?php echo $this->lang->line('phanhoi') ?>"></textarea>
                </div>
                <button type="submit" class="send_frm" style="cursor: pointer"><?php echo $this->lang->line('send') ?></button>
            </div>
        </form>
        <div class="info_contact">
            <label>SAXA GROUP co., ltd</label>
            <p>
                <b>Tell:</b> <?php if($setting_footer['phone']) echo $setting_footer['phone'] ?><br/>
                <b>Fax: </b><?php if($setting_footer['fax']) echo $setting_footer['fax'] ?><br/>
                <b>Email:</b>  <?php if($setting_footer['email']) echo $setting_footer['email'] ?><br/>
                <b> Add:</b> <?php if($setting_footer['address']) echo $setting_footer['address'] ?><br/>
                <b> HOTLINE:</b><span class="tell_contact"> <?php echo HOTLINE ?></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
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
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>