<h3 class="topic">Gia nhập cùng SAXA</h3>

<div class="content_join">
    <div class="people_join">
        <ul>
            <li>
                <img src="<?php echo url_img('common/images/', 'img_join.png') ?>"/>
                <div class="bg_joiner"></div>
                <div class="name_joiner">
                    <span class="pull-left">LOUIS</span>
                    <span class="pull-right">
                        <a href="#"><img src="<?php echo url_img('common/images/', 'icon_skype_join.png') ?>"/></a>
                        <a href="#"><img src="<?php echo url_img('common/images/', 'icon_fb_join.png') ?>"/></a>
                    </span>
                    <span class="clearfix"></span>
                </div>
            </li>
            <li>
                <img src="<?php echo url_img('common/images/', 'img_join.png') ?>"/>
                <div class="bg_joiner"></div>
                <div class="name_joiner">
                    <span class="pull-left">LOUIS</span>
                    <span class="pull-right">
                        <a href="#"><img src="<?php echo url_img('common/images/', 'icon_skype_join.png') ?>"/></a>
                        <a href="#"><img src="<?php echo url_img('common/images/', 'icon_fb_join.png') ?>"/></a>
                    </span>
                    <span class="clearfix"></span>
                </div>
            </li>
        </ul>
    </div>
    <div class="scrollbar-external_wrapper pull-left" style="height:796px !important; width:875px !important; margin-top:0">
        <div class="scrollbar-external width_875 height_796">
            <div class="join_us">
                <?php if (!empty($listData)) : ?>
                <?php foreach ($listData as $key =>$value) : ?>
                <div class="cont_join">
                    <header>
                        <div class="pull-left"><?php echo ($key+1).'.'. $value['name'] ?></div>
                        <div class="more_join"><a href="<?php echo base_url('gia-nhap-cung-saxa'.'/'.$value['slug']); ?>"><?php echo $this->lang->line('DETAIL'); ?></a> </div>
                        <div class="clearfix"></div>
                    </header>
                    <div class="join">
                        <?php echo $value['des'] ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif ?>
            </div>
        </div>
        
    </div>
    <div class="clearfix"></div>
</div>