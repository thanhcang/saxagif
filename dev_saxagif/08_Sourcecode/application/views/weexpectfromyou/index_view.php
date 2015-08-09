<h3 class="topic"><?php echo $this->lang->line('WE_EXPECT_YOU'); ?></h3>

<div class="cont_topic" style=" width:1220px">
    <div class="scrollWeAreDo" style=" width:1220px;">
        <div class="articles" style=" width:1208px">
            <h4><a href="javascript:;" class=""><?php echo !empty($listData['title']) ?  $listData['title'] : '' ?></a></h4>
            <?php echo !empty($listData['content']) ? htmlspecialchars_decode($listData['content']) : ''  ?>
        </div>
    </div>
    <span class="pull-left" style="margin-top: 10px">
        <a href="#"><img src="<?php echo base_url('common/images/btn_shareFb.png'); ?>"/></a>
        <a href="#"><img src="<?php echo base_url('common/images/btn_likeFb.png'); ?>"/></a>
    </span>
</div>
<div class="gift_saxa">
    <label> <?php echo $this->lang->line('giftfromsaxa') ?></label>
    <ul id="scroller" class="scroller">
        <?php if(!empty($list_gift)): ?>
        <?php foreach ($list_gift as $gift): ?>
        <li>
            <a href="<?php echo base_url($gift['c_slug'].'/'.$gift['slug']) ?>">
                <img src="<?php echo url_img(URL_PRODUCT_THUMB_IMAGE, $gift['image_name']) ?>" />
            </a>
        </li>
        <?php endforeach; ?>
        <?php endif ?>
        <li>
        </li>
    </ul>
</div>
<div class="sale_saxa">
    <label><?php echo $this->lang->line('SALSE_SERVICE'); ?></label>
    <?php if(!empty($salse)): ?>
    <ul class="scrollerSalse">
        <?php foreach ($salse as $key) :?>
        <li>
        <div>
            <img src="<?php echo base_url('admin/common/multidata/salse'.'/'.$key['avatar']) ?>"/>
            <div class="bg_opacity"></div>
            <div class="name_sale">
                <p><?php echo $key['name']; ?></p>
                <p class="phone"><?php echo $key['phone']; ?></p>
            </div>
        </div>
        </li>
        <?php endforeach ?>
    </ul>
    <?php endif; ?>
</div>
<div class="clearfix"></div>
<a href="<?php echo base_url('contact');?>"><img src="<?php echo base_url('common/images/link-to-contact.png');?>" /></a>

<div class="border-dashed marT60"></div>

<script src="<?php echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/jquery.simplyscroll.js') ?>"></script>
<script src="<?php echo base_url('common/js/weexpectyou.js'); ?>"></script>