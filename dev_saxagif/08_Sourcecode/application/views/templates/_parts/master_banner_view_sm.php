<div class="cont-slideshow">
    <div class="banner_t" id="banner_t" style="position: relative; top: 0px; left: 0px;">
        <!--<img src="<?php echo base_url('common/images/banner.png') ?>"/>-->
        <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px;">
            <?php if(!empty($slideshow)): ?>
            <?php foreach ($slideshow as $key=>$slide): ?>
            <div>
                <a href="<?php echo base_url($slide['slug']) ?>">
                    <img u="image" src="<?php echo url_img(URL_SLIDESHOW_IMAGE, $slide['avatar']) ?>"/>
                </a>
                </div>
            <?php endforeach; ?>
            <?php endif ?>
        </div>
    </div>
</div>
<script>
    $(function(){
        setAnimationSlishow();
    });
    
    function setAnimationSlishow() {
        var widthCont = $('.cont-slideshow').width();
        var heightCont = widthCont / 2.5;
        $('.banner_t').css({'width':widthCont, 'height':heightCont});
        $('.banner_t').find('div').css({'width':widthCont, 'height':heightCont});
        jssor_slider1_starter = function(containerId) {
            var options = {
                $AutoPlay: true,
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
        jssor_slider1_starter('banner_t');
    }
</script>
