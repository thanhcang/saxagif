<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.html"><?php echo $this->lang->line('') ?>Home</a>
        </li>
        <li>
            <a href="index.html"><?php echo $this->lang->line('') ?>News</a>
        </li>
        <li>
            <a href="#"><?php echo $this->lang->line('') ?>Edit</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('') ?>Edit</h2>
            </div>
            <div class="box-content">
                <form name="frmNews" id="frmNews" method="POST" action="<?php echo base_url('news/edit/' . $news_id) ?>" enctype="multipart/form-data">
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
                        <select name="language_type" class="form-control input-sm">
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(empty($params['language_type']) && !empty($detailNews['language_type']) && $detailNews['language_type'] == $k ) echo 'selected'  ; elseif(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtTitle"><?php echo $this->lang->line('TITLE') ?></label>
                        <input type="text" name="txtTitle" class="form-control" id="txtTitle" value="<?php if(empty($params['txtTitle']) && !empty($detailNews['title'])) echo htmlspecialchars($detailNews['title']);elseif(!empty ($params['txtTitle'])) echo htmlspecialchars($params['txtTitle']) ?>" placeholder="<?php echo $this->lang->line('TITLE') ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtSlug"><?php echo $this->lang->line('SLUG') ?></label>
                        <input type="text" name="txtSlug" class="form-control" id="txtSlug" value="<?php if(empty($params['txtSlug']) && !empty($detailNews['slug'])) echo htmlspecialchars($detailNews['slug']);elseif(!empty ($params['txtSlug'])) echo htmlspecialchars($params['txtSlug']) ?>" placeholder="<?php echo $this->lang->line('SLUG') ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('AVATAR') ?></label>
                        <input type="file" name="avatar"  accept="image/*" class="form-control input-sm" id="logo" />
                    </div>
                    <div class="form-group">
                        <label for="position"><?php echo $this->lang->line('POSITION') ?></label>
                        <div class="controls">
                            <select name="position" id="position" data-rel="chosen">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catNews"><?php echo $this->lang->line('NEWS_CAT') ?></label>
                        <div class="controls">
                            <select name="catNews">
                                <option value=""></option>
                                <option value="1">Sự kiện</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtKeySeo"><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                        <input type="text" name="txtKeySeo" value="<?php if(empty($params['keyword_seo']) && !empty($detailNews['keyword_seo'])) echo htmlspecialchars($detailNews['slug']);elseif(!empty ($params['txtKeySeo'])) echo htmlspecialchars($params['txtKeySeo']) ?>" class="form-control" id="txtKeySeo" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="txtDesSeo"><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                        <input type="text" name="txtDesSeo" value="<?php if(empty($params['txtDesSeo']) && !empty($detailNews['des_seo'])) echo htmlspecialchars($detailNews['des_seo']);elseif(!empty ($params['txtDesSeo'])) echo htmlspecialchars($params['txtDesSeo']) ?>" class="form-control" id="txtDesSeo" placeholder="">
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('NEWS_DESCRIPTION') ?></label>
                        <textarea name="description" class="form-control re_opinion" cols="40" rows="4"><?php if(!empty($params['description'])) echo htmlspecialchars($params['description']) ?><?php if(empty($params['description']) && !empty($detailNews['description'])) echo htmlspecialchars($detailNews['description']);elseif(!empty ($params['description'])) echo htmlspecialchars($params['description']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('NEWS_CONTENT') ?></label>
                        <textarea name="content" id="content" class="form-control re_opinion"><?php if(empty($params['content']) && !empty($detailNews['content'])) echo htmlspecialchars($detailNews['content']);elseif(!empty ($params['content'])) echo htmlspecialchars($params['content']) ?></textarea>
                    </div>
                    <button type="submit" class="button"><?php echo $this->lang->line('EDIT') ?></button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div><!--/row-->
<!-- content ends -->