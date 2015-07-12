<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category_news.css') ?>" />
<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('CAT_NEWS_DETAIL') ?></h2>
            </div>
            <div class="box-content">
                <form>
                    <div class="form-group">
                        <label for="inputName"><?php echo $this->lang->line('CAT_NEWS_NAME') ?>: </label>
                        <?php echo htmlspecialchars($detailCatNews['name']) ?>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('SLUG') ?>: </label>
                        <?php if(!empty($detailCatNews['slug'])) echo htmlspecialchars($detailCatNews['slug']) ?>
                    </div>
                    <div class="form-group">
                        <label for="keyGoogle"><?php echo $this->lang->line('KEYWORD_SEO') ?>: </label>
                        <?php if(!empty($detailCatNews['keyword_seo'])) echo htmlspecialchars($detailCatNews['keyword_seo']) ?>
                    </div>
                    <div class="form-group">
                        <label for="desGoogle"><?php echo $this->lang->line('DESCRIPTION_SEO') ?>: </label>
                        <?php if(!empty($detailCatNews['des_seo'])) echo htmlspecialchars($detailCatNews['des_seo']) ?>
                    </div>
                    <!--<button type="submit" class="button"><?php echo $this->lang->line('CREATE') ?></button>-->
                </form>
            </div>
        </div>
    </div>
</div><!--/row-->
<script type="text/javascript" src="<?php echo base_url('common/js/category_news.js') ?>"></script>
