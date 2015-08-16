<link rel="stylesheet" href="<?php echo base_url('common/css/customize.css') ?>" type="text/css">
<h3 class="topic"><?php echo $this->lang->line('WE_ARE_DONE'); ?></h3>
<div class="content">
    <div class="content_left_QA">
        <div class="box_l">
            <div class="box_head_QA"><?php echo $this->lang->line('CUSTOMER_QUESTION'); ?></div>
            <div class="box_main_QA">
                <div style="width:330px !important;">
                    <?php if (!empty($idealCustomer)): ?>
                    <?php foreach($idealCustomer as $key): ?>
                    <div class="idea">
                        <div class="img_customer"><img src="<?php echo base_url('admin/common/multidata/comment').'/'.$key['logo']; ?>"></div>
                        <div class="idea_customer">
                            <label><?php echo $key['name']; ?></label>
                            <p>
                                <?php echo htmlspecialchars_decode($key['idea']); ?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box_foot_QA"></div>
        </div>
    </div>
    <div class="content_QA programe_saxa_cont">
        <h3><?php echo $this->lang->line('saxa_program'); ?></h3>
        <div style="width:755px !important;">
            <?php if (!empty($eventSaxa)): ?>
            <?php foreach($eventSaxa as $key): ?>
            <div class="block_news">
                <div class="image_news"><img src="<?php echo base_url('admin/common/multidata/news'.'/'.$key['avatar']); ?>"></div>
                <div class="news" style="width: 426px">
                    <label><?php echo $key['title']; ?></label>
                    <p><?php echo htmlspecialchars_decode($key['description']); ?></p>
                </div>
                <div class="clearfix"></div>
                <p class="see_more"><a class="detailWeAreDo" attr-id="<?php echo $key['id'] ?>" href="javascript:;"><?php echo $this->lang->line('view_more');?></a></p>
                <div class="clearfix"></div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="partner_list">
        <label><?php echo $this->lang->line('WE_ARE_DONE'); ?></label>
        <div>
            <?php if (!empty($partnerSaxa)): ?>
            <a class="bullet_partner_l" href="javascript:;"><img src="<?php echo base_url('common/images/arrow_blue_l.png'); ?>"></a>
            <ul class="partner">
                <?php foreach($partnerSaxa as $key): ?>
                <li><img src="<?php echo base_url('admin/common/multidata/partners').'/'.$key['logo']; ?>"></li>
                <?php endforeach; ?>
            </ul>
            <a class="bullet_partner_r" href="javascript:;"><img src="<?php echo base_url('common/images/arrow_blue_r.png'); ?>"></a>
            
            <div class="clearfix"></div>
            <?php if (!empty($numberPagination)) : ?>
            <div class="pagination">
                <ul>
                    <li class="active">&lt;</li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&gt;</a></li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="border-dashed marT60"></div>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">    
<?php require_once( APPPATH.'views/templates/_parts/master_popup_detaiwearedone.php'); ?>
<script src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script src="<?php echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('common/js/wearedone.js'); ?>"></script>