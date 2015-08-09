<div class="banner_t">
    <img src="<?php echo base_url('common/images/banner.png') ?>"/>
    <?php if(!empty($slideshow)): ?>
    <?php foreach ($slideshow as $key=>$slide): ?>
        <!--<a href="<?php echo base_url($slide['slug']) ?>">
            <img src="<?php echo url_img(URL_SLIDESHOW_IMAGE, $slide['avatar']) ?>"/>
        </a>-->
    <?php endforeach; ?>
    <?php endif ?>
</div>