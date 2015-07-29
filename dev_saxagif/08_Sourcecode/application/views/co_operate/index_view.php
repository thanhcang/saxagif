<h3 class="topic"><?php echo $this->lang->line('CONNECT'); ?></h3>
<?php if (!empty($listData)): ?>
<?php foreach ($listData as $key): ?>
<div class="cont_topic">
    <div class="scrollbar-external_wrapper" style="height:374px !important;">
        <div class="scrollbar-external height_374">
            <div class="">
                <h4><a href="#" class="js__p_start"><?php echo $key['title'] ?></a></h4>
                <p>
                    <?php echo !empty($key['description']) ? htmlspecialchars_decode($key['description']) : '' ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($key['avatar'])) : ?>
<div class="img_co-operate_r"><img src="<?php echo url_img('admin/common/multidata/news/', $key['avatar']) ?>"/></div>
<?php endif ?>
<div class="clearfix"></div>
<div class="marT60 marB20">
    <a href="#"><img src="<?php echo url_img('common/images/', 'btn_shareFb.png') ?>"/></a>
    <a href="#"><img src="<?php echo url_img('common/images/', 'btn_likeFb.png') ?>"/></a>
</div>
<hr/>
<?php endforeach ?>
<?php endif ?>
<div class="clearfix"></div>
<a href="<?php echo base_url('contact'); ?>"><img src="<?php echo url_img('common/images/', 'link-to-contact.png') ?>"/></a>
<div class="border-dashed marT60"></div>