<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('WE_ARE_DONE'); ?></div>
    <div class="content_noboder">
    <div class="label"><?php echo $this->lang->line('customers_review'); ?></div>
        <?php if (!empty($idealCustomer)): ?>
        <?php foreach($idealCustomer as $key): ?>
            <div class="cont_tab">
                <div class="img_tab"><a href="javascript:;"><img src="<?php echo base_url('admin/common/multidata/comment').'/'.$key['logo']; ?>"></a></div>
                <div class="main_tab">
                    <label><a href="javascript:;" class="js__p_start"><?php echo $key['name']; ?></a></label>
                    <div class="des_tab">
                        <?php echo htmlspecialchars_decode($key['idea']); ?>
                    </div>
    
                </div>
                <div class="clearfix"></div>
            </div>
        <?php endforeach ?>
        <?php endif ?>
    </div>
    <div class="content_noboder">
    <?php //echo '<pre>'; print_r($eventSaxa) ?>
        <div class="label"><?php echo $this->lang->line('programs_saxa') ?></div>
        <?php if (!empty($eventSaxa)): ?>
            <?php foreach($eventSaxa as $key): ?>
                <div class="cont_tab">
                <div class="img_tab"><a href="<?php echo base_url('admin/common/multidata/news'.'/'.$key['avatar']); ?>"><img src="<?php echo base_url('common/multidata/wearedone/' . $key['avatar']) ?>"/></a></div>
                <div class="main_tab">
                    <label><a href="<?php echo base_url($key['slug'] ) ?>" class="js__p_start"><?php echo $key['title']; ?></a></label>
                    <div class="des_tab">
                        <?php echo htmlspecialchars_decode($key['description']); ?>
                    </div>
                    <p class="see_more"><a href="<?php echo base_url($key['slug'] ) ?>"><?php echo $this->lang->line('view_more') ?></a></p>
    
                </div>
                <div class="clearfix"></div>
        </div>
            <?php endforeach; ?>
            <?php endif; ?>
    </div>
    <div class="content_noboder">
        <div class="label"><?php echo $this->lang->line('we_are_dones') ?></div>
        <?php if (!empty($partnerSaxa)): ?>
        <ul class="partner">
             <?php foreach($partnerSaxa as $key): ?>
                <li><img src="<?php echo base_url('common/images/logo_partner.png') ?>"/></li>
             <?php endforeach; ?>
        </ul>
        <?php if (!empty($numberPagination)): ?>
        <div class="pagination pull-right">
            <ul>
                <li class="active"><</li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">></a></li>
            </ul>
        </div>
        <?php endif ?>
        <div class="clearfix"></div>
        <?php endif ?>
    </div>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>