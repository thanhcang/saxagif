<!DOCTYPE html>
<html>
    <head>
        <title>Saxagift_home</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="<?php echo base_url('common/css/layout.css') ?>" type="text/css" rel="stylesheet" media="all"/>
        <link rel="stylesheet" href="<?php echo base_url('common/css/vertical.news.slider.css?v=1.0') ?>">
        <link rel="stylesheet" href="<?php echo base_url('common/css/jquery.popup.css') ?>" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('common/js/jssor.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('common/js/jssor.slider.js') ?>"></script>
        <script>
            jssor_slider1_starter = function(containerId) {
                var options = {
                    $DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                    $ArrowNavigatorOptions: {//[Optional] Options to specify and enable arrow navigator or not
                        $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 0, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                };

                var jssor_slider1 = new $JssorSlider$(containerId, options);
            };
        </script>
        <script>
            jssor_slider2_starter = function(containerId) {
                var options = {
                    $DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                    $ArrowNavigatorOptions: {//[Optional] Options to specify and enable arrow navigator or not
                        $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 0, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                };

                var jssor_slider1 = new $JssorSlider$(containerId, options);
            };
        </script>
    </head>
    <body>
        <div class="w_container">
            <div class="w_footer">
                <div class="w_header">
                    <div class="w_content">
                        <div class="w_logo">
                            <div class="logo"></div>
                            <div class="language">
                                <ul>
                                    <li class="normal"><a href="#">Eng</a></li>
                                    <li class="active"><a href="#">Vn</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="note_slogan">
                            <img src="<?php echo base_url('common/images/CAU-THONG-DIEP.gif') ?>"/>
                        </div>
                        <?php if(!empty($news_cat_position)): ?>
                        <ul class="list_slg">
                        <?php foreach ($news_cat_position as $news_cat): ?>
                            <?php if($news_cat['position'] == HEADER_POSITION): ?>
                            <li onclick="window.location.href='<?php echo base_url($news_cat['slug']) ?>'">
                                <?php echo htmlspecialchars($news_cat['name']) ?>
                            </li>
                            <?php endif ?>
                        <?php endforeach ?>
                        </ul>
                        <?php endif ?>
                        <div class="icon_share">
                            <a href="#"><img src="<?php echo base_url('common/images/icon_g+.png') ?>"/></a>
                            <a href="#"><img src="<?php echo base_url('common/images/icon_skype.png') ?>"/></a>
                            <a href="#"><img src="<?php echo base_url('common/images/icon_fb.png') ?>" class="last"/></a>
                        </div>
                        <div class="w_menu">
                            <div class="mn_left"><img src="<?php echo base_url('common/images/logo_menu.png') ?>"/></div>
                            <div class="mn_right">
                                <div class="search">
                                    <div class="btn_selectSearch selectSearch_home"><img src="<?php echo base_url('common/images/select_search.png') ?>"/></div>
                                    <input type="text" class="input_search"/>
                                    <button type="button"><img src="<?php echo base_url('common/images/icon_search.png') ?>"/></button>
                                </div>
                                <div class="menu">
                                    <ul>
                                        <li class="active">Trang chủ</li>
                                        <li class="category_product_mn" id="category_product_mn" onclick="showMask('submn_product')">Danh mục sản phẩm</li>
                                        <li><a href="9-QA.html">Thắc mắc và hướng dẫn</a></li>
                                        <li><a href="6-co-operate.html">Hợp tác</a></li>
                                        <li><a href="8-join-saxa.html">Gia nhập cùng SAXA</a></li>
                                        <li><a href="7-contact.html">Liên lạc với SAXA</a></li>
                                    </ul>
                                    <ul class="submn_product" id="submn_product">
                                        <li>
                                            <ul>
                                            <?php if(!empty($cat_menu)): ?>
                                            <?php foreach($cat_menu as $cat): ?>
                                            <?php if($cat['parent'] == '0'): ?>
                                                <li><?php echo htmlspecialchars($cat['name']) ?></li>
                                                <?php foreach ($cat_menu as $cat_child): ?>
                                                    <?php if($cat_child['parent'] == $cat['id']): ?>
                                                        <li class="submn" onclick="hideMask('submn_product')"><a href="15-product.html"><?php echo htmlspecialchars($cat_child['name']) ?></a></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="w_content">