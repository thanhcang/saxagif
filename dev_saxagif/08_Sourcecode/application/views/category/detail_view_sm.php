<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('products_saxa') ?></div>
    <div class="content_product">
        <header><?php if(!empty($listCategory[0])) echo $listCategory[0]['cat_name'] ?></header>
        <p>
            <?php if(!empty($listCategory[0])) echo $listCategory[0]['note'] ?>
        </p>
        <div class="product">
            <ul>
                <?php if(!empty($listCategory)): ?>
                    <?php foreach ($listCategory as $pro): ?>
                        <li>
                            <a href="javascript:;" attr_pro="<?php echo $pro['pro_id'] ?>" class="showDetailProduct">
                                <img src="<?php if(!empty($pro['pro_img']) && file_exists(IMG_PRODUCT_PATH . $pro['pro_img']) ) echo url_img(URL_PRODUCT_THUMB_IMAGE, $pro['pro_img']);else echo url_img(URL_IMAGES, 'no-img.png') ?>"/>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif ?>
            </ul>
        </div>
    </div>
    <div class="sort_view pull-right">
        <div class="sort_month">
            <ul>
                <li class="active"><</li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>