<style>
    .img_detail img { max-width: 120px;border: 1px solid #CCC; padding: 1px;margin-right: 2px; }
</style>
<div class="banner_t">
    <a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a>
</div>
<div class="product_detail">
    <div class="detail_l">
        <?php if(!empty($detailImage['0']['name']) && file_exists('admin/common/multidata/product_img/' . $detailImage[0]['name'])): ?>
        <img src="<?php echo base_url('admin/common/multidata/product_img/' . $detailImage[0]['name']) ?>" class="product_large"/>
        <?php else: ?>
        <img src="<?php echo base_url('common/images/no-img.png') ?>" class="product_large"/>
        <?php endif ?>
        <div class="img_detail">
            <ul>
                <?php if(!empty($detailImage)): ?>
                <?php foreach ($detailImage as $img): ?>
                    <?php if(!empty($img['name']) && file_exists('admin/common/multidata/product_img/thumb/' . $img['name'])): ?>
                        <img src="<?php echo base_url('admin/common/multidata/product_img/' . $img['name']) ?>"/>
                    <?php endif ?>
                <?php endforeach; ?>
                <?php endif ?>
            </ul>
        </div>
        <div class="share_product">
            <p><img src="<?php echo base_url('common/images/btn_hotline.png') ?>"/></p>
            <a href="#"><img src="<?php echo base_url('common/images/like_popup.png') ?>"/></a>
            <a href="#"><img src="<?php echo base_url('common/images/share_popup.png') ?>"/></a>
        </div>
    </div>
    <div class="detail_r">
        <div class="tit_product_detail"><?php echo $detailProduct['name'] ?></div>
        <div class="info_product_detail">
            <p>
                <label><?php echo $this->lang->line('pro_price') ?>:</label> <?php if(!empty($detailProduct['price'])) echo number_format($detailProduct['price']) ?> VND
            </p>
            <p>
                <label><?php echo $this->lang->line('material') ?>:</label>
            </p>
            <p>
                <label><?php echo $this->lang->line('pro_designs') ?>:</label> 
            </p>
            <p>
                <label><?php echo $this->lang->line('pro_made') ?>:</label> 
            </p>
            <p>
                <label><?php echo $this->lang->line('pro_description') ?>:</label><?php if(!empty($detailProduct['description'])) echo _substr($detailProduct['description'], 200) ?>
            </p>
        </div>

    </div>
    <div class="clearfix"></div>
</div>
<h5 class="p_title"><?php echo $this->lang->line('pro_distribution') ?></h5>
<ul class="giftset">
    <?php if(!empty($productCoordinator)): ?>
    <?php foreach ($productCoordinator as $coordinator): ?>
    <li>
        <a href="<?php echo base_url($coordinator['slug']) ?>">
             <?php if(!empty($coordinator['name']) && file_exists('admin/common/multidata/product_img/thumb/' . $coordinator['name'])): ?>
                <img src="<?php echo base_url('admin/common/multidata/product_img/thumb/' . $coordinator['name']) ?>" />
            <?php else: ?>
                <img src="<?php echo base_url('common/images/no-img.png') ?>" />
            <?php endif ?>
        </a>
    </li>
    <?php endforeach; ?>
    <?php endif; ?>
</ul>
<h5 class="p_title"><?php echo $this->lang->line('pro_customer_select') ?></h5>
<ul class="giftset">
    <?php if(!empty($customerChoosePro)): ?>
    <?php foreach ($customerChoosePro as $cus): ?>
    <li><a href="<?php if(!empty($cus['url'])) echo prep_url($cus['url']);else echo 'javascript:;' ?>" target="_blank"><img src="<?php echo base_url('admin/common/multidata/partners/' . $cus['logo']) ?>"/></a></li>
    <?php endforeach ?>
    <?php endif ?>
</ul>
<h5 class="p_title"><?php echo $this->lang->line('pro_post') ?></h5>
<p class="cont_post_product">
    <?php if(!empty($detailProduct['content'])) echo htmlspecialchars_decode($detailProduct['content']) ?>
</p>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>