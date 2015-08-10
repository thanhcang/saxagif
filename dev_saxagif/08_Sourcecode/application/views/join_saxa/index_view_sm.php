<div class="banner_t"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('page_join_saxa') ?></div>
    <div class="people_join">
        <div class="mem_join pull-left">
            <img class="pic_join" src="<?php echo base_url('common/images/img_join.png') ?>"/>
            <div class="bg_joiner"></div>
            <div class="name_joiner">
                <span class="pull-left">LOUIS</span>
                <span class="pull-right">
                    <a href="#"><img src="<?php echo base_url('common/images/icon_skype_join.png') ?>"/></a>
                    <a href="#"><img src="<?php echo base_url('common/images/icon_fb_join.png') ?>"/></a>
                </span>
                <span class="clearfix"></span>
            </div>
        </div>
        <div class="mem_join pull-right">
            <img class="pic_join" src="<?php echo base_url('common/images/img_join.png') ?>"/>
            <div class="bg_joiner"></div>
            <div class="name_joiner">
                <span class="pull-left">LOUIS</span>
                <span class="pull-right">
                    <a href="#"><img src="<?php echo base_url('common/images/icon_skype_join.png') ?>"/></a>
                    <a href="#"><img src="<?php echo base_url('common/images/icon_fb_join.png') ?>"/></a>
                </span>
                <span class="clearfix"></span>
            </div>
        </div>
        <div class="clearfix"></div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </p>
    </div>
    <section>
        <?php if (!empty($listData)) : ?>
            <?php foreach ($listData as $key =>$value): ?>
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
    </section>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>