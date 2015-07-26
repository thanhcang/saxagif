<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('CAT_TITLE_EDIT') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category_news/edit/' . $detailCatNews['id']) ?>">
                    <?php if(!empty($cat_news_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($cat_news_errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label for=""><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                        <div class="controls">
                            <select name="language_type" class="form-control">
                                <option value="">&nbsp;</option>
                                <?php if(!empty($language_type)): ?>
                                <?php foreach ($language_type as $k=>$v): ?>
                                <option value="<?php echo $k ?>" <?php if(!empty($detailCatNews['language_type']) && $detailCatNews['language_type'] == $k && empty($params['language_type'])) echo 'selected' ;elseif(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"><?php echo $this->lang->line('CAT_NEWS_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php if(!empty($detailCatNews['name']) && empty($params['name'])) echo htmlspecialchars($detailCatNews['name']) ;elseif(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="slug"><?php echo $this->lang->line('SLUG') ?><span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="slug" class="form-control" class="" value="<?php  if(!empty($detailCatNews['slug']) && empty($params['slug'])) echo htmlspecialchars($detailCatNews['slug']) ;elseif(!empty($params['slug'])) echo htmlspecialchars($params['slug']) ?>" maxlength="255" placeholder="slug( URL Seo )" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_NEWS_POSITION') ?></label>
                        <select name="position" class="form-control">
                            <option value="">&nbsp;</option>
                            <?php if(!empty($position)): ?>
                            <?php foreach ($position as $key=>$value): ?>
                            <option value="<?php echo $key ?>" <?php if(empty($params['position']) && $detailCatNews['position'] == $key) echo 'selected';elseif(!empty ($params['position']) && $params['position'] == $key) echo 'selected' ?>><?php echo $value ?></option>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keyword_seo"><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                        <input type="text" name="keyword_seo" id="keyword_seo" class="form-control" value="<?php if(!empty($detailCatNews['keyword_seo']) && empty($params['keyword_seo'])) echo htmlspecialchars($detailCatNews['keyword_seo']) ;elseif(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="des_seo"><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                        <input type="text" name="des_seo" id="des_seo" class="form-control" value="<?php if(!empty($detailCatNews['des_seo']) && empty($params['des_seo'])) echo htmlspecialchars($detailCatNews['keyword_seo']) ;elseif(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?>" maxlength="255" />
                    </div>
                    <input type="hidden" value="<?php echo $detailCatNews['id'] ?>" name="category_news_id" />
                    <button type="submit" class="button martopten pull-right"><?php echo $this->lang->line('EDIT') ?></button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

