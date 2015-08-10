<!--close div conent-->
<!--</div>-->
<div class="category_product_foot marT15">
    <div class="tit_category_foot"><?php echo $this->lang->line('product_category') ?></div>
    <ul class="list_category">
        <?php if (!empty($cat_menu)): ?>
            <?php foreach ($cat_menu as $cat): ?>
                <?php if ($cat['parent'] == '0'): ?>
                    <li  style="width:240px;">
                        <div class="header"><?php echo htmlspecialchars($cat['name']) ?></div>
                        <ul class="sub_category">
                            <?php foreach ($cat_menu as $cat_child): ?>
                                <?php if ($cat_child['parent'] == $cat['id']): ?>
                                    <li><a href="<?php echo base_url($cat['slug'] . '/' . $cat_child['slug']) ?>"><?php echo htmlspecialchars($cat_child['name']) ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>
<div class="footer">
    <div class="logo_foot"><img src="<?php echo url_img(URL_IMAGES, 'logo_footer.png') ?>"/></div>
    <div class="slogan_foot">
        <?php if ($setting_footer['slogan']) echo strtoupper($setting_footer['slogan']) ?>
    </div>
    <div class="address_foot">
        <span>TELL:</span><?php if ($setting_footer['phone']) echo $setting_footer['phone'] ?><br/>
        <span>FAX: </span><?php if ($setting_footer['fax']) echo $setting_footer['fax'] ?><br/>
        <span>EMAIL: </span><?php if ($setting_footer['email']) echo $setting_footer['email'] ?><br/>
        <span>ADD: </span><?php if ($setting_footer['address']) echo $setting_footer['address'] ?><br/>
        <span class="copyright">© Copyright <?php echo START_YEAR . ' - ' . END_YEAR ?> SAXA Group. All right reserved</span>
    </div>
    <div class="clearfix"></div>
</div>
<!--close w_content-->
</div>
<!--close w_main_foot-->
</div>
<!--close w_container-->
</div>
<script src="<?php echo base_url('common/js/vertical.news.slider.js') ?>"></script>
<script src="<?php echo base_url('common/js/common.js') ?>"></script>
<script src="<?php echo base_url('common/js/home.js') ?>"></script>

<script>
    function showMask(id) {
        document.getElementById(id).style.display = 'block';
    }
    function hideMask(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
</body>
</html>
