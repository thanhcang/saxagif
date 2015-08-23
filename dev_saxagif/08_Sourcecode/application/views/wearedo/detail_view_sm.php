<style>
    .content_boder p{ font-size:3em; }
</style>
<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo htmlspecialchars($detailWearedo['title']) ?></div>
    <p>
        <?php if(!empty($detailWearedo)) echo htmlspecialchars_decode($detailWearedo['content']) ?>
    </p>
    <p class="social">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php $slug = end($this->uri->segment_array()); echo base_url($slug) ?>" target="_blank"><img src="<?php echo base_url('common/images/share_fb.png') ?>"/></a>
        <a href="#"><img src="<?php echo base_url('common/images/like_fb.png') ?>"/></a>
    </p>
    <div class="block_comment">
        <h6 class="tit_comment">Bình luận</h6>
         <div class='post-footer-line post-footer-line-2'>
            <b:if cond='data:blog.pageType == &quot;item&quot;'>
                <div class="fb-comments" data-href="http://namkna.blogspot.com/" data-width="470" data-num-posts="10"></div>
            </b:if>
        </div>
    </div>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>
<div class="clearfix"></div>