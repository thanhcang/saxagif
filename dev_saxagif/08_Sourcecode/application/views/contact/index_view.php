<h3 class="topic"><?php echo $this->lang->line('ct_contact_saxa') ?></h3>
<div class="img_contact"><img src="<?php echo url_img('common/images/', 'pic_contact.png') ?>"/></div>
<div class="frm_contact">
    <label><?php echo $this->lang->line('ct_receive_gifts') ?></label>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
    </p>
    <form name="frmContact" id="frmContact" method="POST" action="<?php echo base_url('contact.html') ?>">
        <div class="frm_cont">
            <div class="error contactErr">
                <ul>
                    <?php if(!empty($ct_err)): ?>
                        <?php foreach ($ct_err as $err): ?>
                        <li><?php echo $err; ?></li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <div class="control_group">
                <input type="text" name="cus_name" class="inbox_contact" value="<?php if(!empty($params['cus_name'])) echo htmlspecialchars($params['cus_name']) ?>" placeholder="<?php echo $this->lang->line('ct_name') ?>"/>
                <span class="red">*</span>
            </div>
            <div class="control_group">
                <input type="text" name="cus_email" class="inbox_contact" value="<?php if(!empty($params['cus_email'])) echo htmlspecialchars($params['cus_email']) ?>" placeholder="<?php echo $this->lang->line('ct_email') ?>"/>
                <span class="red">*</span>
            </div>
            <div class="control_group">
                <input type="text" name="cus_phone" class="inbox_contact" value="<?php if(!empty($params['cus_phone'])) echo htmlspecialchars($params['cus_phone']) ?>" placeholder="<?php echo $this->lang->line('ct_phone') ?>"/>
            </div>
            <div class="control_group">
                <input type="text" name="cus_company" class="inbox_contact" value="<?php if(!empty($params['cus_company'])) echo htmlspecialchars($params['cus_company']) ?>" placeholder="<?php echo $this->lang->line('ct_company') ?>"/>
            </div>
            <div class="control_group">
                <textarea name="cus_feeback" class="textarea_contact" placeholder="<?php echo $this->lang->line('phanhoi') ?>"><?php if(!empty($params['cus_feeback'])) echo htmlspecialchars($params['cus_feeback']) ?></textarea>
            </div>
            <button type="submit" class="send_frm"><?php echo $this->lang->line('send') ?></button>
        </div>
    </form>
    <div class="info_contact">
        <label><?php echo COMPANY_NAME ?></label>
        <p>
            <b>Tell:</b> <?php if(!empty($setting_footer['phone'])) echo $setting_footer['phone'] ?><br/>
            <b>Fax: </b><?php if(!empty($setting_footer['fax'])) echo $setting_footer['fax'] ?><br/>
            <b>Email:</b>  <?php if(!empty($setting_footer['email'])) echo $setting_footer['email'] ?><br/>
            <b> Add:</b> <?php if(!empty($setting_footer['address'])) echo $setting_footer['address'] ?>
            <b> HOTLINE:</b><span class="tell_contact"> <?php echo HOTLINE ?></span>
        </p>
    </div>
    <div class="clearfix"></div>
</div>
<div class="gift_saxa">
    <label> <?php echo $this->lang->line('giftfromsaxa') ?></label>
    <ul id="scroller" class="scroller">
        <?php if(!empty($list_gift)): ?>
        <?php foreach ($list_gift as $gift): ?>
        <li><a href="<?php echo base_url($gift['slug']) ?>"><img src="<?php echo url_img('admin/common/multidata/product_img/thumb/', $gift['image_name']) ?>" /></a></li>
        <?php endforeach; ?>
        <?php endif ?>
    </ul>
</div>
 <div class="border-dashed marT60"></div>
<script src="<?php echo base_url('common/js/jquery.scrollbar.js') ?>"></script>
<script src="<?php //echo base_url('common/js/contact.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/jquery.simplyscroll.js') ?>"></script>
<script type="text/javascript">
    $(".scroller").simplyScroll();
</script>