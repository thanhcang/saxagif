<style>
.content_boder p { font-size: 13px!important; }
</style>
<div class="banner_t"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></div>
<div class="content_boder">
    <div class="label"><?php echo substr($this->lang->line('story_saxa'), 0,15) ?></div>
    <?php if($listData): ?>
    <p class="content_post">
        <?php echo htmlspecialchars_decode($listData['content']); ?>
    </p>
    <p><img src="<?php echo base_url('common/images/hot_line.png') ?>"/></p>
    <p class="social">
        <a href="javascript:;"><img src="<?php echo base_url('common/images/share_fb.png') ?>"/></a>
        <a href="javascript:;"><img src="<?php echo base_url('common/images/like_fb.png') ?>"/></a>
    </p>
    <?php endif ?>
</div>
<p><a href="<?php echo base_url('contact') ?>"><img src="<?php echo base_url('common/images/button_contact.png') ?>"/></a></p>
<div class="content_noboder">
    <?php if (!empty($yourSayPer)): ?>
        <div class="label"><?php echo $this->lang->line('LISTEN_YOUR_SAY') ?></div>
        <?php foreach ($yourSayPer as $key=>$value):?>
            <div class="staff_talk">
                <div class="arrow">
                    <a href="">
                        <div class="pic_staff_"><img src="<?php echo base_url('admin/common/multidata/listen_to_them_say'.'/'.$value['logo']); ?>"/></div>
                        <div class="group_staff_"><?php echo $value['name'] ?></div>
                        <div class="clearfix"></div>
                    </a>
                </div>
            </div>
        <?php endforeach?>
    <?php endif; ?>
        
    <?php if (!empty($yourSayGroup)): ?>
    <?php foreach ($yourSayGroup as $key=>$value):?>
        <div class="staff_talk">
            <div class="arrow">
                <a href="<?php echo base_url('') ?>">
                    <div class="pic_staff_"><img src="<?php echo base_url('admin/common/multidata/listen_to_them_say'.'/'.$value['logo']); ?>"/></div>
                    <div class="group_staff_"><?php echo $value['name'] ?></div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    <?php endforeach?>
    <?php endif; ?>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>