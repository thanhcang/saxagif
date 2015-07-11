<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/evol.colorpicker.min.css') ?>" />

<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.html">Home</a>
        </li>
        <li>
            <a href="index.html">Category</a>
        </li>
        <li>
            <a href="#">Edit</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('CAT_TITLE_EDIT') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category/edit/' . $detail_cat['id']) ?>" enctype="multipart/form-data">
                    <?php if(!empty($cat_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($cat_errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                    <div class="control-group">
                        <label for="name"><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php if(!empty($detail_cat['name']) && empty($params['name'])) echo htmlspecialchars($detail_cat['name']) ;elseif(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
                    </div>
                    <div class="control-group">
                        <label for="slug"><?php echo $this->lang->line('SLUG') ?><span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="slug" class="form-control" class="" value="<?php  if(!empty($detail_cat['slug']) && empty($params['slug'])) echo htmlspecialchars($detail_cat['slug']) ;elseif(!empty($params['slug'])) echo htmlspecialchars($params['slug']) ?>" maxlength="255" placeholder="slug( URL Seo )" />
                    </div>
                    <div class="control-group">
                        <label for="bg_color"><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></label>
                        <input type="text" name="bg_color" id="bg_color" class="form-control" value="<?php if(!empty($detail_cat['bg_color']) && empty($params['bg_color'])) echo '#'.htmlspecialchars($detail_cat['bg_color']) ;elseif(!empty($params['bg_color'])) echo html_escape($params['bg_color']) ?>" maxlength="7" />
                    </div>
                    <div class="control-group">
                        <label for="logo"><?php echo $this->lang->line('CAT_LOGO') ?></label>
                        <input type="file" name="logo"  accept="image/*" class="form-control input-sm" id="logo" />
                    </div>
                    <div class="control-group">
                        <label for=""><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                        <div class="controls">
                            <select name="language_type" class="form-control">
                                <option value="">&nbsp;</option>
                                <?php if(!empty($language_type)): ?>
                                <?php foreach ($language_type as $k=>$v): ?>
                                <option value="<?php echo $k ?>" <?php if(!empty($detail_cat['language_type']) && $detail_cat['language_type'] == $k && empty($params['language_type'])) echo 'selected' ;elseif(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <?php if(!empty($detail_cat['parent'])): ?>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_PARENT') ?></label>
                        <div class="controls">
                            <select name="parent" class="form-control">
                                <option value="">&nbsp;</option>
                                <?php if(!empty($parent)): ?>
                                <?php foreach ($parent as $p): ?>
                                <option value="<?php echo $p['id'] ?>" <?php if(empty($params['parent']) && $detail_cat['parent'] == $p['id'] ) echo 'selected'  ;elseif(!empty($params['parent']) && $params['parent'] == $p['id'] ) echo 'selected' ?>><?php echo $p['name'] ?></option>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <?php endif ?>
                    <div class="control-group">
                        <label for="keyword_seo"><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></label>
                        <input type="text" name="keyword_seo" id="keyword_seo" class="form-control" value="<?php if(!empty($detail_cat['keyword_seo']) && empty($params['keyword_seo'])) echo htmlspecialchars($detail_cat['keyword_seo']) ;elseif(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="control-group">
                        <label for="des_seo"><?php echo $this->lang->line('CAT_DES_SEO') ?></label>
                        <input type="text" name="des_seo" id="des_seo" class="form-control" value="<?php if(!empty($detail_cat['des_seo']) && empty($params['des_seo'])) echo htmlspecialchars($detail_cat['keyword_seo']) ;elseif(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="form-control">
                        <label><?php echo $this->lang->line('CAT_CHOOSE_HOME') ?></label>
                        <input type="checkbox" name="is_home" value="1" <?php if(!empty($detail_cat['position'])) echo 'checked' ?> />
                    </div>
                    <input type="hidden" value="<?php echo $detail_cat['id'] ?>" name="category_id" />
                    <button type="reset" class="button martopten pull-right" ><?php echo $this->lang->line('RESET') ?></button>
                    <button type="submit" class="button martopten pull-right"><?php echo $this->lang->line('EDIT') ?></button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url('common/js/evol.colorpicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

