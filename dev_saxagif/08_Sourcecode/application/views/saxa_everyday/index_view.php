<h3 class="topic"><?php echo !empty($listParent['name']) ? $listParent['name'] : '';  ?></h3>
<div id="tabs">
    <ul>
        <?php if (!empty($listCategory)): ?>
            <?php foreach ($listCategory as $key): ?>
            <li <?php echo $key['slug'] == $this->uri->segment(1) ? 'class="active"' : '' ?>><a href="<?php echo base_url($key['slug']); ?>"><?php echo $key['name']; ?></a></li>
            <?php endforeach ?>
        <?php endif ?>
    </ul>

    <div class="tab-content">
        <div id="tabs-1" class="tab">
            
            <?php if (!empty($listData)) : ?>
            <div class="post_saxa_everyday">
            <?php foreach ($listData as $key) : ?>
                <div class="cont_tab" style="width: 1124px">
                <div class="img_tab"><img src="<?php echo base_url('admin/common/multidata/news'.'/'.$key['avatar']); ?>"/></div>
                <div class="main_tab">
                    <label><a href="javascript:;" attr-id="<?php echo $key['id'] ?>"  class="detailWeAreDo"><?php echo $key['title'] ?></a></label>
                    <div class="des_tab">
                        <?php echo htmlspecialchars_decode($key['description']) ?>
                    </div>
                    <div class="more_tab"><a href="javascript:;" attr-id="<?php echo $key['id'] ?>"  class="detailWeAreDo"><?php echo $this->lang->line('view_more');  ?></a></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php endforeach ?>
            </div>
            <?php endif ?>
            
            <div class="sort_view">
                <div class="sort_year">
                    <label><?php echo $this->lang->line('MOST_POST') ?> :</label>
                    <input type="text"/>
                </div>
                <div class="sort_month">
                    <label class="pull-left"><?php echo $this->lang->line('MONTH_POST') ?> :</label>
                    <ul>
                        <li class="active"><</li>
                        <li><a href="#">T1</a></li>
                        <li><a href="#">T2</a></li>
                        <li><a href="#">T3</a></li>
                        <li><a href="#">></a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="border-dashed marT60"></div>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">    
<?php require_once( APPPATH.'views/templates/_parts/master_popup_detaiwearedone.php'); ?>
<script src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script src="<?php echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('common/js/saxa_everyday.js'); ?>"></script>