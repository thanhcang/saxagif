<footer>
    <img src="<?php echo base_url('common/images/logo_footer_sm.png') ?>" class="logo_foot"/>
    <p class="slogan_foot">
         <?php if($setting_footer['slogan']) echo strtoupper($setting_footer['slogan']) ?>
    </p>
    <p class="address">
        <label>TELL: </label><?php if($setting_footer['phone']) echo $setting_footer['phone'] ?><br/>
        <label>FAX: </label><?php if($setting_footer['fax']) echo $setting_footer['fax'] ?><br/>
        <label>EMAIL:</label>  <?php if($setting_footer['email']) echo $setting_footer['email'] ?><br/>
        <label> ADD:</label> <?php if($setting_footer['address']) echo $setting_footer['address'] ?>
    </p>
    <p class="copyright">© Copyright <?php echo START_YEAR . ' - ' . END_YEAR  ?> SAXA Group. All rights reserved</p>
</footer>