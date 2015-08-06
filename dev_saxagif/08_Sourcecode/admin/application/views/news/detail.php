<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/news.css') ?>" />
<!-- content starts -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i><?php echo $this->lang->line('VIEW') ?></h2>
            </div>
            <div class="box-content">
                <h3 class="title-news"><?php echo htmlspecialchars($detailNews['title']) ?></h3>
                <div class="line"></div>
                <div class="cont_news">
                    <?php if(!empty($detailNews['avatar']) && file_exists(IMAGE_NEWS_PATH . $detailNews['avatar'])): ?>
<!--                    <div class="avatar-news">
                        <img src="<?php //echo base_url('common/multidata/news/' . $detailNews['avatar']) ?>" />
                    </div>-->
                    <?php endif ?>
                    <p>
                        <?php if(!empty($detailNews['content'])) echo $detailNews['content'] ?>
                    </p>
                </div>
                <div class="clearfix"></div>
                <a href="<?php echo base_url('news/edit/' . $detailNews['id']) ?>" class="button pull-right"><?php echo $this->lang->line('EDIT') ?></a>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div><!--/row-->
<!-- content ends -->