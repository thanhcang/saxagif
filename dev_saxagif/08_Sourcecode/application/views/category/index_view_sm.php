<div class="banner_t"><img src="images/logo_p.png"/></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('products_saxa') ?></div>
    <div class="content_product">
        <header><?php if(!empty($list_category['parent_name'])) echo htmlspecialchars($list_category['parent_name']) ?></header>
        <p>
            <?php if(!empty($list_category['note'])) echo htmlspecialchars($list_category['note']) ?>
        </p>
        <?php if(!empty($listCategory)): ?>
            <?php foreach ($listCategory as $key=> $cat_child): ?>
                <div class="name_catalog_product padT10"><?php echo $key ?></div>
                <div class="menu_catalog_product padT10">
                    <a href="<?php echo base_url($listCategory[$key][0]['cat_slug']) ?>"><span onclick="showMask('sub_mn_product')"><?php echo $this->lang->line('view_more') ?></span></a>
                </div>
                <div class="clearfix"></div>
                <div class="product">
                    <ul>
                        <?php foreach ($cat_child as $key=>$pro): ?>
                        <li>
                            <a href="javascript:;">
                                <img src="<?php echo base_url('admin/common/multidata/product_img/thumb/' . $pro['product_img']) ?>"/>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
    </div>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>