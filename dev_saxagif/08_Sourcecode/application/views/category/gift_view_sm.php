<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('choose_gift') ?></div>
    <div id="tabs">
        <ul  class="tab_menu">
            <?php if(!empty($listPresent)): ?>
            <?php $giftUrl = $this->lang->line('choose_gift_url') ?>
            <?php foreach ($listPresent as $key => $gift): ?>
                <li class="<?php echo ($gift['slug'] == $this->uri->segment(2)) ? 'ui-tabs-active' : '' ?>">
                    <a href="<?php echo base_url($giftUrl.'/'.$gift['slug']) ?>">
                        <?php echo $gift['name'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>   
        </ul>
        <br />
        <div class="tab-content">
            <?php if(!empty($giftName)): ?>
                <?php $i=1; foreach ($giftName as $key=>$gift_p): ?>
                <div id="tabs-<?php echo $i ?>" class="tab">
                    <div class="content_product">
                        <p>
                            On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that 
                        </p>
                        <div class="product">
                            <ul>
                                <?php if(!empty($listGift)): ?>
                                <?php foreach ($listGift as $gift): ?>
                                <?php if($gift['category_id'] == $gift_p['category_id']): ?>
                                <li>
                                    <a href="<?php echo base_url($gift['slug']) ?>" attr_pro="<?php echo $gift['id'] ?>" class="showDetailProduct">
                                        <img src="<?php echo url_img(URL_PRODUCT_IMAGE, $gift['product_img']) ?>"/>
                                    </a>
                                </li>
                                <?php endif ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        </div>
                        <!--<div class="sort_view pull-right">
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
                        <div class="clearfix"></div>
                    </div>
                <?php $i++; endforeach; ?>
            <?php endif; ?>  
        </div>
    </div>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>
<script>
    //var _giftIndex = '<?php //echo $giftIndex; ?>';
    //$("#tabs").tabs({active: _giftIndex});
</script>
