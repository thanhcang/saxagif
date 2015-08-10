<div class="w_content">

    <h3 class="topic"><?php echo $this->lang->line('page_join_saxa'); ?></h3>

    <div class="content_join">
        <div class="people_join">
            <ul>
                <li>
                    <img src="<?php echo url_img('common/images/', 'img_join.png') ?>">
                    <div class="bg_joiner"></div>
                    <div class="name_joiner">
                        <span class="pull-left">LOUIS</span>
                        <span class="pull-right">
                            <a href="#"><img src="<?php echo base_url('common/images/icon_skype_join.png') ?>"/></a>
                            <a href="#"><img src="<?php echo base_url('common/images/icon_fb_join.png') ?>"/></a>
                        </span>
                        <span class="clearfix"></span>
                    </div>
                </li>
                <li>
                    <img src="<?php echo url_img('common/images/', 'img_join.png') ?>">
                    <div class="bg_joiner"></div>
                    <div class="name_joiner">
                        <span class="pull-left">LOUIS</span>
                        <span class="pull-right">
                            <a href="#"><img src="<?php echo base_url('common/images/icon_skype_join.png') ?>"></a>
                            <a href="#"><img src="<?php echo base_url('common/images/icon_fb_join.png') ?>"></a>
                        </span>
                        <span class="clearfix"></span>
                    </div>
                </li>
            </ul>
        </div>
        <div style="height:800px !important; width:875px !important; margin-top:0" class="pull-left">
            <div class="recruitment">
                <div class="join_us">
                    <div class="cont_join">
                        <header>
                            <div class="pull-left"><?php echo $listData['name'] ?></div>
                            <div class="clearfix"></div>
                        </header>
                        <div class="join">
                            <img src="<?php echo base_url('admin/common/multidata/joinsaxa/'.$listData['logo']); ?>">
                            <div class="control_group">
                                <label><?php echo $this->lang->line('NUMBER_JOINXASA')?> </label>
                                <?php echo htmlspecialchars_decode($listData['number']); ?>
                            </div>
                            <div class="control_group">
                                <label><?php echo $this->lang->line('WORK_JOINXASA'); ?> </label>
                                <?php echo htmlspecialchars_decode($listData['work']); ?>
                            </div>
                            <div class="control_group">
                                <label><?php echo $this->lang->line('COCNTENT_JOINXASA'); ?> </label>
                                <?php echo htmlspecialchars_decode($listData['content']); ?>
                            </div>
                            <div class="control_group">
                                <label><?php echo $this->lang->line('ISSUE_JOINXASA') ?></label>
                                <?php echo htmlspecialchars_decode($listData['issue']); ?>
                            </div>
                            <div class="control_group">
                                <label><?php echo $this->lang->line('RIGHT_JOINXASA'); ?></label>
                                <?php echo htmlspecialchars_decode($listData['right']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-right">
                <a href="#"><img src="<?php echo url_img('common/images/', 'icon_skype_join.png') ?>"/></a>
                <a href="#"><img src="<?php echo url_img('common/images/', 'icon_fb_join.png') ?>"/></a>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<script src="<?php   echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script>
     $('.recruitment').slimScroll({
        color: '#7eb235',
        size: '10px',
        height: '800px',
        alwaysVisible: true
    });
    
</script>