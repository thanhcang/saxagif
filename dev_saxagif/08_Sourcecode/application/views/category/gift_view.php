<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">
<h3 class="topic"><?php echo $this->lang->line('choose_gift'); ?></h3>
<div id="tabs_gift" class="tabs_choose_gift">
    <ul class="tabs_gift">
        <?php if(!empty($listPresent)): ?>
        <?php foreach ($listPresent as $key => $gift): ?>
        <li class="<?php echo ($gift['slug'] == $this->uri->segment(2)) ? 'ui-tabs-active' : '' ?>"><a href="<?php echo base_url('giup-ban-chon-qua'.'/'.$gift['slug']) ?>">
            <?php echo $gift['name'] ?></a></li>
        <?php endforeach; ?>
        <?php endif; ?> 
    </ul>
    <p>
        <?php echo !empty($detailPresent['note']) ? htmlspecialchars_decode($detailPresent['note']) : '' ?>
    </p>
    <?php if(!empty($giftName)): ?>
    <?php foreach ($giftName as $key=>$gift_p): ?>
    <div id="tabs-1">
        <div class="srollbarProduct" style="width: 1220px !important;">
                <div class="product" style="width: 1200px !important;">
                    <ul>
                        <?php if(!empty($listGift)): ?>
                        <?php foreach ($listGift as $gift): ?>
                        <?php if($gift['category_id'] == $gift_p['category_id']): ?>
                        <li>
                            <a href="javascript:;" attr_pro="<?php echo $gift['id'] ?>" class="showDetailProduct">
                                <img src="<?php echo url_img(URL_PRODUCT_IMAGE, $gift['product_img']) ?>"/>
                                <p class="name_product"><?php echo $gift['name'] ?></p>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
        </div>
<!--        <div class="sort_view">
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
    <?php endforeach; ?>
    <?php endif; ?> 

<div class="border-dashed marT60"></div>
        <script>

            function widthTopbanner() {
                var w_window = $('.w_header_sub').innerWidth();
                var w_content_bannerT = 1220;
                var left_right = w_window - w_content_bannerT;
                $('.content_bannerT').css('left', (left_right / 2));
            }
            widthTopbanner();
        </script>
<?php $this->load->view('popup/detail_product'); ?>
<script>
    var URL_DETAIL_PRODUCT = '<?php echo base_url('ajax/detailProduct') ?>';
    var URL_PRODUCT_IMAGE = '<?php echo URL_PRODUCT_IMAGE ?>';
    var URL_PRODUCT_THUMB_IMAGE = '<?php echo URL_PRODUCT_THUMB_IMAGE ?>';
    var URL_IMAGES = '<?php echo URL_IMAGES ?>';
    var PRICE = '<?php echo $this->lang->line('pro_price') ?>';
    var MATERIAL = '<?php echo $this->lang->line('material') ?>';
    var PRO_DESIGN = '<?php echo $this->lang->line('pro_designs') ?>';
    var MADE_IN = '<?php echo $this->lang->line('pro_made') ?>';
    var CODE = '<?php echo $this->lang->line('pro_code') ?>';
    var DISTRIBUTON = '<?php echo $this->lang->line('pro_distribution') ?>';
    var CUSTOMER_SELECT = '<?php echo $this->lang->line('pro_customer_select') ?>';
    var DESCRIPTION = '<?php echo $this->lang->line('pro_description') ?>';
    var CLOSE = '<?php echo $this->lang->line('close') ?>';
    var URL_CUSTOMER_IMAGE = '<?php echo base_url('admin/common/multidata/partners').'/' ?>';
    var POST = '<?php echo $this->lang->line('pro_post') ?>';
</script>
<script src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script src="<?php   echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('common/js/gift.js') ?>"></script>