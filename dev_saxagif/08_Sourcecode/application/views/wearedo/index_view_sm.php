<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('WE_ARE_DO') ?></div>
    <p class="content_post">
        <?php echo !empty($detailMaster['title']) ? $detailMaster['title'] :''  ?>
    </p>
    <?php if (!empty($listData)) : ?>
    <?php foreach ($listData as $key) : ?>
        <div class="posts_new">
            <?php if(!empty($key['avatar'])): ?>
            <img  class="img_post" src="<?php echo base_url('admin/common/multidata/news'.'/'.$key['avatar']); ?>">
            <?php endif; ?>
            <label><a href="<?php echo base_url($key['slug']) ?>"><?php echo $key['title']; ?></a></label><br/>
            <?php echo htmlspecialchars_decode($key['description']) ?>
            <p class="social">
                <a href="#"><img src="<?php echo base_url('common/images/share_fb.png') ?>"/></a>
                <a href="#"><img src="<?php echo base_url('common/images/like_fb.png') ?>"/></a>
            </p>
        </div>
    <?php endforeach; ?>
    <?php endif ?>
     <p><a href="<?php echo base_url('contact') ?>"><img src="<?php echo base_url('common/images/button_contact.png') ?>"/></a></p>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>