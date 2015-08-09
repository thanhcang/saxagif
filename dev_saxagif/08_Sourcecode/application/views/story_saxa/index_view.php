<h3 class="topic"><?php echo $this->lang->line('story_saxa') ?></h3>

<div class="cont_topic">
    <?php if($listData): ?>
    <h4><?php echo $listData['title'] ?></h4>
    <div class="scrollbar">
        <div class="articles" style="width:760px !important ">
            <p>
                <?php echo htmlspecialchars_decode($listData['content']); ?>
            </p>
        </div>
    </div>
    <?php endif ?>
</div>

<div class="mn_topic">
    <h4><?php echo $this->lang->line('ARE_YOU_CHOOSE_ME') ?></h4>
    <img src="<?php echo base_url('common/images/phone.png') ?>">
</div>

<div class="clearfix"></div>

<div class="share_solution">
    <a href="javascript:;"><img src="<?php echo base_url('common/images/btn_likeFb.png') ?>"></a>
    <a href="javascript:;"><img src="<?php echo base_url('common/images/btn_shareFb.png') ?>"></a>
</div>
<div class="feel_customer">
    <h3><?php echo $this->lang->line('LISTEN_YOUR_SAY') ?></h3>
    <ul class="staff_talk">
        <?php if (!empty($yourSayPer)): ?>
        <?php foreach ($yourSayPer as $key=>$value):?>
        <li class="listenDetail" attr-id="<?php echo $value['id'] ?>">
            <img src="<?php echo base_url('admin/common/multidata/listen_to_them_say'.'/'.$value['logo']); ?>">
            <div class="name"><?php echo $value['name'] ?></div>
        </li>
        <?php endforeach?>
        <?php endif; ?>
        
        <?php if (!empty($yourSayGroup)): ?>
        <?php foreach ($yourSayGroup as $key=>$value):?>
        <li class="team listenDetail" attr-id="<?php echo $value['id'] ?>">
            <img src="<?php echo base_url('admin/common/multidata/listen_to_them_say'.'/'.$value['logo']); ?>">
            <div class="name"><?php echo $value['name'] ?></div>
        </li>
        <?php endforeach?>
        <?php endif; ?>
    </ul>
</div>
<div id="main_loader" class="c_hide"></div>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">    
<?php require_once( APPPATH.'views/templates/_parts/master_listen_saxa.php'); ?>
<script src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script src="<?php   echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php   echo base_url('common/js/story_saxa.js'); ?>"></script>