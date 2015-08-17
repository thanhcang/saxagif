<?php
$data = array(
    'positionCategory' => $positionCategory,
);
$this->load->view('templates/_parts/master_sidebar_category_view',$data);
?>   
<div class="content_product">
        <header><?php if(!empty($list_category['parent_name'])) echo htmlspecialchars($list_category['parent_name']) ?></header>
            <p>
                <?php if(!empty($list_category['note'])) echo htmlspecialchars($list_category['note']) ?>
            </p>
        <div <?php echo !empty($listCategory) ? 'class="srollbarProduct"' : ''  ?>  style=" width: 803px">    
        <div class="scrollbar-external_wrapper " style=" width: 788px !important">
            <!--porduct 1-->
            <?php if(!empty($listCategory)): ?>
            <?php foreach ($listCategory as $key=> $cat_child): ?>
                <div class="name_catalog_product padT10"><?php echo $key ?></div>
                <div class="menu_catalog_product padT10">
                    <a href="<?php echo base_url($parent_category.'/'.$listCategory[$key][0]['cat_slug']) ?>"><span onclick="showMask('sub_mn_product')"><?php echo $this->lang->line('view_more') ?></span></a>
                </div>
                <div class="clearfix"></div>
                <div class="product">
                <ul>
                    <?php foreach ($cat_child as $key=>$pro): ?>
                    <li>
                        <a href="javascript:;" class="showDetailProduct" attr_pro="<?php echo $pro['pro_id'] ?>">
                            <img src="<?php echo base_url('admin/common/multidata/product_img/thumb/' . $pro['product_img']) ?>"/>
                            <p class="name_product"><?php if(!empty($pro['product_sname'])) echo htmlspecialchars($pro['product_name']) ?></p>
                        </a>
                    </li>
                    <?php //endif; ?>
                    <?php endforeach; ?>
                </ul>
                </div>
            <?php endforeach; ?>
            <?php endif ?>
        </div>
        </div>
    </div>
    <div class="clearfix"></div>
<div class="border-dashed marT60"></div>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">
<?php require_once( APPPATH.'views/popup/detail_product.php'); ?>
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
<script src="<?php   echo base_url('common/js/category.js'); ?>"></script>
