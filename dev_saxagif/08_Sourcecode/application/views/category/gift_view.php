<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">
<h3 class="topic">Giúp bạn chọn quà</h3>
<div id="tabs_gift" class="tabs_choose_gift">
    <ul class="tabs_gift">
        <?php if(!empty($giftName)): ?>
        <?php foreach ($giftName as $key=>$gift): ?>
        <li><a href="#tabs-<?php echo $key+1; ?>"><?php echo $key ?></a></li>
        <?php endforeach; ?>
        <?php endif; ?> 
    </ul>
    <p>
        On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in 
    </p>
    <?php if(!empty($giftName)): ?>
    <?php foreach ($giftName as $key=>$gift_p): ?>
    <div id="tabs-1">
        <div class="scrollbar-external_wrapper" style="width: 1220px !important;">
            <div class="scrollbar-external width_1200">
                <div class="product">
                    <?php //echo '<pre>'; print_r($listGift) ?>
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
        <div class="sort_view">
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
    </div>
    <?php endforeach; ?>
    <?php endif; ?> 

<div class="border-dashed marT60"></div>
<script>
            $(function() {
                $("#tabs_gift").tabs();
            });
        </script>
        <script>

            function widthTopbanner() {
                var w_window = $('.w_header_sub').innerWidth();
                var w_content_bannerT = 1220;
                var left_right = w_window - w_content_bannerT;
                $('.content_bannerT').css('left', (left_right / 2));
            }
            widthTopbanner();
        </script>


        <script src="<?php echo base_url('common/js/jquery.scrollbar.js') ?>"></script>

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
                    //                    "scrollx": $('.external-scroll_x'),
                    "scrolly": $('.external-scroll_y')
                });
            });
        </script>

        <!--=============Popup=============-->
        <script type="text/javascript">
            $(function() {
                $(".js__p_start, .js__p_another_start").simplePopup();
            });
        </script>
        <!--=============simplyscroll=============-->
        <script type="text/javascript" src="<?php echo base_url('common/js/jquery.simplyscroll.js') ?>"></script>
        <script type="text/javascript">
            (function($) {
                $(function() {
                    $(".scroller").simplyScroll();
                });
            })(jQuery);
        </script>
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