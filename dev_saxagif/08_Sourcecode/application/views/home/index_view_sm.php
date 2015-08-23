<div class="menu_hot">
        <label class="title"><?php echo $this->lang->line('info_hot') ?></label>
        <ul>
            <?php if(!empty($slideshow)): ?>
            <?php foreach ($slideshow as $key=>$slide): ?>
            <li>
                <a href="<?php echo base_url($slide['slug']) ?>"><?php if(!empty($slide['name'])) echo htmlspecialchars(ucfirst ($slide['name'])) ?></a>
            </li>
             <?php endforeach; ?>
            <?php endif ?>
        </ul>
    </div>
    <div class="choose_gift">
        <label class="title"><?php echo $this->lang->line('choose_gift_sm') ?></label>
        <p>
            <?php echo !empty($setting_footer['note_chose_present']) ?   $setting_footer['note_chose_present'] : ''; ?>
        </p>
        <?php if(!empty($cat_gift)): ?>
        <?php foreach ($cat_gift as $key=>$gift): $mask = $key+1; ?>
        <?php $choose_url = $this->lang->line('choose_gift_url') ?>
        <div class="category_product">
            <a href="<?php echo base_url($choose_url.'/'.$gift['slug']) ?>">
                <div class="img_product_t"><img src="<?php echo base_url('admin/common/multidata/cat_logo/' . $gift['logo']) ?>" /></div>
                <div class="topic_product">
                    <strong><?php echo ucwords($gift['name']) ?></strong><br/>
                    <small><?php if(!empty($gift['price'])) echo ($gift['price']) ?></small>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <?php endforeach; ?>
        <?php endif ?>

    </div>
    <div class="story_staff">
         <?php if(!empty($articleFooter)): ?>
            <?php foreach ($articleFooter as $key=>$value): ?>
                <div class="header_story"><?php echo $categoryFooter['name']  ?></div>
                <div class="see_more"><a href="<?php echo base_url($value['category_slug']) ?>"><?php echo $this->lang->line('view_more') ?></a></div>
                <div class="clearfix"></div>
                <div>
                    <div class="pic_staff"><img src="<?php echo url_img('admin/common/multidata/news/', $value['avatar']) ?>"/></div>
                    <div class="staff_say">
                        <label><?php echo htmlspecialchars($value['title']) ?></label>
                        <p><?php if(!empty($value['description'])) echo _substr(htmlspecialchars_decode($value['description']),200) ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
    </div>
    <div class="news_top">
         <?php if(!empty($articleFooter2)): ?>
            <?php foreach ($articleFooter2 as $key=>$value): ?>
                <div class="header_story"><?php echo !empty($categoryFooter2['name']) ? $categoryFooter2['name'] : $this->lang->line('customers_saxa') ?></div>
                <div class="see_more"><a href="<?php if(!empty($value['url'])) echo base_url($value['url']) ?>"><?php echo $this->lang->line('view_more') ?></a></div>
                <div class="clearfix"></div>
                <div class="pic_news"><img src="<?php echo base_url('common/images/news.png') ?>"/></div>
                <div class="news_cont">
                    <label><?php echo htmlspecialchars($value['name']) ?></label>
                    <p><?php if(!empty($value['description'])) echo _substr(htmlspecialchars_decode($value['description']),200) ?></p>
                </div>
                <div class="clearfix"></div>
            <?php endforeach; ?>
        <?php endif ?>
           
    </div>
    <div class="news_top">
        <?php if(!empty($articleFooter3)): ?>
        <div class="header_story"><?php echo !empty($categoryFooter3['name']) ? $categoryFooter3['name'] : $this->lang->line('saxa_program') ?></div>
        <?php foreach ($articleFooter3 as $key=>$value): ?>
            <div class="see_more"><a href="<?php echo base_url($value['category_slug'].'/'. $value['slug']) ?>"><?php echo $this->lang->line('view_more') ?></a></div>
            <div class="clearfix"></div>
            <div class="pic_news"><img src="<?php echo base_url('common/images/news.png') ?>"/></div>
            <div class="news_cont">
                <label><?php echo htmlspecialchars($value['title']) ?></label>
                <p><?php if(!empty($value['description'])) echo _substr(htmlspecialchars_decode($value['description']),200) ?></p>
            </div>
            <div class="clearfix"></div>
        <?php endforeach; ?>
        <?php endif ?>
            
    </div>
    <?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>
    <div class="clearfix"></div>
</div>