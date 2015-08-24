<h3 class="topic"><?php echo $this->lang->line('WE_ARE_DO') ?></h3>
<p class="desciption">
    <?php echo !empty($detailMaster['title']) ? $detailMaster['title'] :''  ?>
</p>

<div class="cont_topic" style="width:1245px; margin-bottom: 10px">
    <div class="scrollWeAreDo" style="width:1245px">
    <?php if (!empty($listData)) : ?>
    <?php foreach ($listData as $key) : ?>
        <div class="articles_ " style="width: 1172px">
        <h4><a class="detailWeAreDo" attr-id="<?php echo $key['id'] ?>" href="javascript:;"><?php echo $key['title']; ?></a></h4>
        <div class="articles_l">
            <?php echo htmlspecialchars_decode($key['description']) ?>
        </div>
        <span class="img_article_r">
            <img src="<?php echo base_url('admin/common/multidata/news'.'/'.$key['avatar']); ?>">
        </span>
        <div class="clearfix"></div>
        <div class="marT80">
            <a href="#"><img src="<?php echo base_url('common/images/btn_shareFb.png') ?>"></a>
            <a href="#"><img src="<?php echo base_url('common/images/btn_likeFb.png') ?>"></a>
        </div>
        </div>
    <?php endforeach; ?>
    <?php endif ?>
    </div>
</div>
<div class="clearfix"></div>
<a href="<?php echo base_url('hop-tac'); ?>"><img src="<?php echo base_url('common/images/link-to-contact.png'); ?>"></a>
<div class="border-dashed marT60"></div>
<div id="main_loader" class="c_hide"></div>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">    
<?php require_once( APPPATH.'views/templates/_parts/master_popup_detaiwearedo.php'); ?>
<script src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script src="<?php   echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('common/js/wearedo.js'); ?>"></script>
