<!-- content starts -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i><?php echo $this->lang->line('VIEW') ?></h2>
            </div>
            <div class="box-content">
                
                <div class="pic_news">
                    <?php if(!empty($detailNews['avatar']) && file_exists(IMAGE_NEWS_PATH . $detailNews['avatar'])): ?>
                        <img src="<?php echo base_url('common/multidata/news/' . $detailNews['avatar']) ?>" width="200" height="150" /> 
                    <?php endif ?>
                </div>
                <div class="cont_news">
                    <label><?php echo htmlspecialchars($detailNews['title']) ?></label>
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