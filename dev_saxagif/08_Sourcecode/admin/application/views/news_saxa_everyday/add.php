<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/news.css') ?>" />
<div class="row">
<div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well">
            <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('NEW_ADD') ?></h2>
        </div>
        <div class="box-content">
            <form name="frmNews" id="frmNews" method="POST" action="<?php echo base_url('news_saxa_everyday/add') ?>" enctype="multipart/form-data">
                <div class="error error-news">
                    <?php if(!empty($news_errors)): ?>
                    <ul>
                        <?php foreach ($news_errors as $err): ?>
                        <li><?php echo $err; ?></li>
                        <?php endforeach ?>
                    </ul>
                     <?php endif ?>
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?> <span class="text-danger">*</span></label>
                    <select name="language_type" class="form-control">
                        <?php if(!empty($language_type)): ?>
                        <?php foreach ($language_type as $k=>$v): ?>
                        <option value="<?php echo $k ?>" <?php if(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtTitle"><?php echo $this->lang->line('TITLE') ?> <span class="text-danger">*</span></label>
                    <input type="text" name="txtTitle" class="form-control" id="txtTitle" value="<?php if(!empty($params['txtTitle'])) echo htmlspecialchars($params['txtTitle']) ?>" placeholder="<?php echo $this->lang->line('TITLE') ?>">
                </div>
                <div class="form-group">
                    <label for="txtSlug"><?php echo $this->lang->line('SLUG') ?></label>
                    <input type="text" name="txtSlug" class="form-control" id="txtSlug" value="<?php if(!empty($params['txtSlug'])) echo htmlspecialchars($params['txtSlug']) ?>" placeholder="<?php echo $this->lang->line('SLUG') ?>">
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('AVATAR') ?></label>
                    <input type="file" name="avatar"  accept="image/*" class="" id="logo" />
                </div>
                
                <div class="form-group">
                    <label for="catNews"><?php echo $this->lang->line('NEWS_CAT') ?> <span class="text-danger">*</span></label>
                    <div class="controls">
                        
                        <select name="catNews" id="catNews" class="form-control">
                            <option value="">&nbsp;</option>
                            <?php if(!empty($listcategory)): ?>
                            <?php foreach($listcategory as $cat): ?>
                            <option value="<?php echo $cat['id'] ?>" <?php if(!empty($params['catNews']) && $params['catNews'] == $cat['id']) echo 'selected' ?>><?php echo htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtKeySeo"><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                    <input type="text" name="txtKeySeo" value="<?php if(!empty($params['txtKeySeo'])) echo htmlspecialchars($params['txtKeySeo']) ?>" class="form-control" id="txtKeySeo" placeholder="">
                </div>
                <div class="form-group">
                    <label for="txtDesSeo"><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                    <input type="text" name="txtDesSeo" value="<?php if(!empty($params['txtDesSeo'])) echo htmlspecialchars($params['txtDesSeo']) ?>" class="form-control" id="txtDesSeo" placeholder="">
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('NEWS_DESCRIPTION') ?></label>
                    <textarea name="description" id="ckeditor_description"  class="form-control description" cols="40" rows="4"><?php if(!empty($params['description'])) echo htmlspecialchars($params['description']) ?></textarea>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" id="content-wrap">
                    <label><?php echo $this->lang->line('NEWS_CONTENT') ?> <span class="text-danger">*</span></label>
                     <div class="controls">
                        <textarea name="content" id="ckeditor_content"  class="form-control content-news"><?php if(!empty($params['content'])) echo htmlspecialchars($params['content']) ?></textarea>
                     </div>
                </div>
                <div class="clearfix"></div>
                <button type="button" onclick="return validateNews()" class="button reviewNews">Xem trước</button>
                <button type="submit" class="button"><?php echo $this->lang->line('NEW_ADD') ?></button>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('common/js/ckfinder/ckfinder.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/news.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor_content', {customConfig: '../ckeditor/config_long.js'});
    CKEDITOR.replace('ckeditor_description', {customConfig: '../ckeditor/config_short.js'});
</script>