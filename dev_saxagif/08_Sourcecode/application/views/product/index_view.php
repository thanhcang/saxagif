<h3 class="topic"><?php echo $this->lang->line('products_saxa') ?></h3>
<div class="content">
    <div class="content_left_QA">
        <div class="box_l">
            <div class="box_head_QA"><?php echo $this->lang->line('product_category') ?></div>
            <div class="box_main_product">
                <div id="accordion" class="menu_product">
                    <?php if(!empty($cat_menu)): ?>
                    <?php foreach($cat_menu as $cat): ?>
                    <?php if($cat['parent'] == '0'): ?>
                        <h3><?php echo htmlspecialchars($cat['name']) ?></h3>
                        <ul>
                        <?php foreach ($cat_menu as $cat_child): ?>
                            <?php if($cat_child['parent'] == $cat['id']): ?>
                            <li><a href="<?php echo base_url($cat['slug'].'/'.$cat_child['slug']) ?>"><?php echo htmlspecialchars($cat_child['name']) ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif ?>
                    <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="box_foot_QA"></div>
        </div>
    </div>
    <div class="content_product">
        <?php //print_r($list_category) ?>
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
                        <a href="15-product.html"><span onclick="showMask('sub_mn_product')">Xem thêm</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="product">
                    <ul>
                        <?php foreach ($cat_child as $key=>$pro): ?>
                        <?php //if($key < 4): ?>
                        <li>
                            <a href="<?php echo base_url($pro['product_slug']) ?>">
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

<script src="<?php echo base_url ('common/js/jquery-ui.min.js') ?>"></script>
        <!--<script src="js/vertical.news.slider.js"></script>-->
        <script>
            $(function() {
                $("#accordion").accordion();
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


        <script src="<?php echo base_url ('common/js/jquery.scrollbar.js') ?>"></script>

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

        <!--=============Popup=============-->
        <script type="text/javascript" src="<?php echo base_url ('common/js/jquery.popup.js') ?>"></script>
        <script type="text/javascript">
            $(function() {
                $(".js__p_start, .js__p_another_start").simplePopup();
            });
        </script>
        <!--=============simplyscroll=============-->
        <script type="text/javascript" src="<?php echo base_url ('common/js/jquery.simplyscroll.js') ?>"></script>
        <script type="text/javascript">
            (function($) {
                $(function() {
                    $(".scroller").simplyScroll();
                });
            })(jQuery);
        </script>