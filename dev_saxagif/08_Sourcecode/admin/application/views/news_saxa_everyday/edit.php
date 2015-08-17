<div class="row">
<div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well">
            <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('NEW_ADD') ?></h2>
        </div>
        <div class="box-content">
            <form name="frmNews" id="frmNews" method="POST" action="<?php echo base_url('news_saxa_everyday/edit/' . $detailnews_saxa_everyday['id']) ?>" enctype="multipart/form-data">
                <?php if(!empty($news_errors)): ?>
                <div class="error">
                    <ul>
                        <?php foreach ($news_errors as $err): ?>
                        <li><?php echo $err; ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                    <select name="language_type" class="form-control">
                        <?php if(!empty($language_type)): ?>
                        <?php foreach ($language_type as $k=>$v): ?>
                        <option value="<?php echo $k ?>" <?php if($detailnews_saxa_everyday['language_type'] == $k && empty($params['language_type'])) echo 'selected'; elseif(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtTitle"><?php echo $this->lang->line('TITLE') ?></label>
                    <input type="text" name="txtTitle" class="form-control" id="txtTitle" value="<?php if(empty($params['txtTitle'])) echo htmlspecialchars ($detailnews_saxa_everyday['title']); elseif(!empty($params['txtTitle'])) echo htmlspecialchars($params['txtTitle']) ?>" placeholder="<?php echo $this->lang->line('TITLE') ?>">
                </div>
                <div class="form-group">
                    <label for="txtSlug"><?php echo $this->lang->line('SLUG') ?></label>
                    <input type="text" name="txtSlug" class="form-control" id="txtSlug" value="<?php if(!empty($detailnews_saxa_everyday['slug']) && empty($params['txtSlug'])) echo htmlspecialchars($detailnews_saxa_everyday['slug']) ;elseif(!empty($params['txtSlug'])) echo htmlspecialchars($params['txtSlug']) ?>" placeholder="<?php echo $this->lang->line('SLUG') ?>">
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('AVATAR') ?></label>
                    <input type="file" name="avatar"  accept="image/*" class="" id="logo" />
                </div>
                <?php if (!empty($detailnews_saxa_everyday['avatar'])) : ?>
                <div class="form-group">
                    <img src="<?php echo base_url('common/multidata/news'.'/'.$detailnews_saxa_everyday['avatar']); ?>" />
                </div>
                <?php endif ?>
                
                <div class="form-group">
                    <label for="catNews"><?php echo $this->lang->line('NEWS_CAT') ?></label>
                    <div class="controls">
                        <select name="catNews" class="form-control">
                            <option value="">&nbsp;</option>
                            <?php if(!empty($listcategory)): ?>
                            <?php foreach($listcategory as $cat): ?>
                            <option value="<?php echo $cat['id'] ?>" <?php echo (!empty($params['catNews']) && $cat['id'] == $params['catNews']) || ($detailnews_saxa_everyday['id_news_cat'] == $cat['id'] ) ? 'selected = selected' : '';  ?> > <?php echo htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtKeySeo"><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                    <input type="text" name="txtKeySeo" value="<?php if(empty($params['txtKeySeo']) && !empty($detailnews_saxa_everyday['keyword_seo'])) echo htmlspecialchars($detailnews_saxa_everyday['keyword_seo']) ;elseif(!empty($params['txtKeySeo'])) echo htmlspecialchars($params['txtKeySeo']) ?>" class="form-control" id="txtKeySeo" placeholder="">
                </div>
                <div class="form-group">
                    <label for="txtDesSeo"><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                    <input type="text" name="txtDesSeo" value="<?php if(empty($params['txtDesSeo']) && !empty($detailnews_saxa_everyday['des_seo'])) echo htmlspecialchars($detailnews_saxa_everyday['des_seo']) ;elseif(!empty($params['txtDesSeo'])) echo htmlspecialchars($params['txtDesSeo']) ?>" class="form-control" id="txtDesSeo" placeholder="">
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('NEWS_DESCRIPTION') ?></label>
                    <textarea name="description" id="ckeditor_description" class="form-control description" cols="40" rows="4"><?php if(empty($params['description']) && !empty($detailnews_saxa_everyday['description'])) echo $detailnews_saxa_everyday['description'];elseif(!empty($params['description'])) echo htmlspecialchars($params['description']) ?></textarea>
                </div>
                <div class="clearfix"></div>
                <div class="form-group" id="content-wrap">
                    <label><?php echo $this->lang->line('NEWS_CONTENT') ?></label>
                     <div class="controls">
                         <textarea name="content" id="ckeditor_content"  class="form-control content-news"><?php if(empty($params['content']) && !empty($detailnews_saxa_everyday['content'])) echo htmlspecialchars($detailnews_saxa_everyday['content']) ;elseif(!empty($params['content'])) echo htmlspecialchars($params['content']) ?></textarea>
                     </div>
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="button"><?php echo $this->lang->line('EDIT') ?></button>
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