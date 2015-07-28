<?php $this->load->view('templates/_parts/master_sidebar_category_view'); ?>   
<div class="content_product">
        <header><?php if(!empty($list_category['parent_name'])) echo htmlspecialchars($list_category['parent_name']) ?></header>
            <p>
                <?php if(!empty($list_category['note'])) echo htmlspecialchars($list_category['note']) ?>
            </p>
        <div class="scrollbar-external_wrapper">
            <div class="scrollbar-external width_785">
                <!--porduct 1-->
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
                        <?php //if($key < 4): ?>
                        <li>
                            <a href="<?php echo base_url(htmlspecialchars($pro['product_slug'])) ?>">
                                <img src="<?php echo base_url('common/multidata/product_img/' . $pro['product_img']) ?>"/>
                                <p class="name_product"><?php if(!empty($pro['product_name'])) echo htmlspecialchars($pro['product_name']) ?></p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    </div>
                <?php endforeach; ?>
                <?php endif ?>
            </div>
            <div class="external-scroll_x">
                <div class="scroll-element_outer">
                    <div class="scroll-element_size"></div>
                    <div class="scroll-element_track"></div>
                    <div class="scroll-bar"></div>
                </div>
            </div>

            <div class="external-scroll_y">
                <div class="scroll-element_outer">
                    <div class="scroll-element_size"></div>
                    <div class="scroll-element_track"></div>
                    <div class="scroll-bar" style="height:100px;"></div>
                </div>
            </div>
        </div>
        <!--<div class="sort_view">
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
        </div>-->
    </div>
    <div class="clearfix"></div>
<div class="border-dashed marT60"></div>
</div>