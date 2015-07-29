<?php $this->load->view('templates/_parts/master_sidebar_category_view'); ?>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">
<div class="content_product">
    <header><?php if(!empty($listCategory[0])) echo $listCategory[0]['cat_name'] ?></header>
        <p>
            <?php if(!empty($listCategory[0])) echo $listCategory[0]['note'] ?>
        </p>
        <div class="scrollbar-external_wrapper">
            <div class="scrollbar-external width_785">
                <div class="product">
                    <ul>
                        <?php if(!empty($listCategory)): ?>
                        <?php foreach ($listCategory as $pro): ?>
                        <li>
                            <a href="javascript:;" attr_pro="<?php echo $pro['pro_id'] ?>" class="showDetailProduct">
                                <img src="<?php if(!empty($pro['pro_img']) && file_exists(IMG_PRODUCT_PATH . $pro['pro_img']) ) echo url_img(URL_PRODUCT_THUMB_IMAGE, $pro['pro_img']);else echo url_img(URL_IMAGES, 'no-img.png') ?>"/>
                                <p class="name_product"><?php if(!empty($pro['pro_name'])) echo htmlspecialchars($pro['pro_name']) ?></p>
                            </a>
                        </li>
                        
                        <?php endforeach; ?>
                        <?php endif ?>
                    </ul>
                </div>
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
    </div>
    <div class="clearfix"></div>
<div class="border-dashed marT60"></div>
<!--Layout Popup-->
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
<script src="<?php echo base_url('common/js/category.js') ?>"></script>
        <script>
            jQuery(function($) {

                function getAlignedText(text) {
                    text = text.split('\n');
                    while (text.length > 0 && $.trim(text[0]) == '') {
                        text.shift();
                    }
                    var tabs = (text[0] || '').replace(/^(\s+).+$/, '$1');
                    for (var i = 0; i < text.length; i++) {
                        text[i] = text[i].replace(tabs, '');
                    }
                    if (text.length > 0 && text[text.length - 1].match(/^\s*$/)) {
                        text.pop();
                    }
                    return text.join('\n');
                }

                $('.container').each(function() {

                    var content = $(this).find('.content');
                    var controls = $(this).find('.controls');

                    $('<pre></pre>').addClass('prettyprint linenums lang-html').text(getAlignedText(content.find('.demo').html())).appendTo(content.find('.html'));
                    $('<pre></pre>').addClass('prettyprint linenums lang-css').text(getAlignedText($('#css-common').html()) + "\n" + getAlignedText(content.find('style').html())).appendTo(content.find('.css'));
                    $('<pre></pre>').addClass('prettyprint linenums lang-js').text(getAlignedText(content.find('script').html())).appendTo(content.find('.js'));

                    controls.on('click', 'span', function() {
                        content.find('.' + $(this).removeClass('active').attr('class')).show().siblings('div').hide();
                        $(this).addClass('active').siblings('span').removeClass('active');
                    });
                    controls.find('.demo').click();
                });

                $('.container').on('click', '.add-content', function() {
                    $('#lorem-ipsum').clone().removeAttr('id').appendTo($(this).closest('.container').find('.scroll-content'));
                    return false;
                });
                $('.container').on('click', '.remove-content', function() {
                    $(this).closest('.container').find('.scroll-content').find('p').not('.permanent').last().remove();
                    return false;
                });

                window.prettyPrint && prettyPrint();
                $('.wrapper').scrollbar();
            });
        </script>

        <script>
            jQuery(document).ready(function() {
                jQuery('.scrollbar-external').scrollbar({
                    "autoScrollSize": false,
                    "scrolly": $('.external-scroll_y')
                });
            });
        </script>
        <script>
            function showMask(id) {
                document.getElementById(id).style.display = 'block';
            }
            function hideMask(id) {
                document.getElementById(id).style.display = 'none';
            }
        </script>