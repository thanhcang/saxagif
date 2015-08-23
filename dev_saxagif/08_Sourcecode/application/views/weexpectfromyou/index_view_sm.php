<style>
.content_boder p { font-size: 3em; }
</style>
<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('we_expect_from_you') ?></div>
    <p class="content_post">
        <?php echo !empty($listData['content']) ? htmlspecialchars_decode($listData['content']) : ''  ?> 
    </p>
    <p class="social">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php $slug = end($this->uri->segment_array()); echo base_url($slug) ?>" target="_blank"><img src="<?php echo base_url('common/images/share_fb.png') ?>"/></a>
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
    <?php if(!empty($salse)): ?>
    <?php foreach ($salse as $key) :?>
        <div class="staff_sale">
            <div class="arrow">
                <a href="">
                    <div class="pic_staff_"><img src="<?php echo base_url('admin/common/multidata/salse'.'/'.$key['avatar']) ?>"/></div>
                    <div class="group_staff_"><?php echo $key['name']; ?><br/><small><?php echo $key['phone']; ?></small></div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    <?php endforeach ?>
    <?php endif ?>
    
    <p><a href="<?php echo base_url('contact');?>"><img src="<?php echo base_url('common/images/button_contact.png') ?>"/></a></p>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>