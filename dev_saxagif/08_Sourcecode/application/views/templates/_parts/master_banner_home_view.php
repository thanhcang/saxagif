<div class="slide_top">
    <div class="news-holder cf">
        <div class="news-preview">
            <?php if(!empty($slideshow)): ?>
            <?php foreach ($slideshow as $key=>$slide): ?>
                <div class="news-content <?php if($key === "0") echo 'top-content' ?>">
                    <a href="<?php echo base_url($slide['slug']) ?>">
                    <img src="<?php echo url_img(URL_SLIDESHOW_IMAGE, $slide['avatar']) ?>"/>
                    <div class="title_slide">
                        <div class="topic_slide"><?php if(!empty($slide['name'])) echo htmlspecialchars($slide['name']) ?></div>
                        <div class="cont_slide">
                            <?php if(!empty($slide['title'])) echo _substr(htmlspecialchars($slide['title']), 200) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <?php endif ?>
        </div><!-- .news-preview -->
        <ul class="news-headlines">
            <?php if(!empty($slideshow)): ?>
            <?php foreach ($slideshow as $key=>$slide): ?>
            <li class="selected">
                <?php if(!empty($slide['name'])) echo htmlspecialchars(ucfirst ($slide['name'])) ?>
                <div class="line_news"></div>
            </li>
             <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div><!-- .news-holder -->
</div>