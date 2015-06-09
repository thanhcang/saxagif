<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/evol.colorpicker.min.css') ?>" />

<h2><?php echo $this->lang->line('CAT_TITLE_EDIT') ?></h2>
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
    <table class="table table-condensed table-bordered">
    <tr>
        <th><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></th>
        <td><input type="text" name="name" id="name" value="<?php if(!empty($detail_cat['name']) && empty($params['name'])) echo htmlspecialchars($detail_cat['name']) ;elseif(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" /></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></th>
        <td><input type="text" name="bg_color" id="bg_color" value="<?php if(!empty($detail_cat['bg_color']) && empty($params['bg_color'])) echo '#'.htmlspecialchars($detail_cat['bg_color']) ;elseif(!empty($params['bg_color'])) echo html_escape($params['bg_color']) ?>" maxlength="7" /></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('CAT_LOGO') ?></th>
        <td><input type="file" name="logo" id="logo" /></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></th>
        <td>
            <select name="language_type">
                <option value="">&nbsp;</option>
                <?php if(!empty($language_type)): ?>
                <?php foreach ($language_type as $k=>$v): ?>
                <option value="<?php echo $k ?>" <?php if(!empty($detail_cat['language_type']) && $detail_cat['language_type'] == $k && empty($params['language_type'])) echo 'selected' ;elseif(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('CAT_PARENT') ?></th>
        <td>
            <select name="parent">
                <option value="">&nbsp;</option>
                <?php if(!empty($parent)): ?>
                <?php foreach ($parent as $p): ?>
                <option value="<?php echo $p['id'] ?>" <?php if(!empty($detail_cat['parent']) && $detail_cat['parent'] == $p['id'] && empty($params['parent'])) echo 'selected' ;elseif(!empty($params['parent']) && $params['parent'] == $p['id'] ) echo 'selected' ?>><?php echo $p['name'] ?></option>
                <?php endforeach ?>
                <?php endif; ?>
            </select>
        </td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></th>
        <td>
            <input type="text" name="keyword_seo" id="keyword_seo" value="<?php if(!empty($detail_cat['keyword_seo']) && empty($params['keyword_seo'])) echo htmlspecialchars($detail_cat['keyword_seo']) ;elseif(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
        </td>
    </tr>
    <tr>
        <th>
            <?php echo $this->lang->line('CAT_DES_SEO') ?>
        </th>
        <td>
            <input type="text" name="des_seo" id="des_seo" value="<?php if(!empty($detail_cat['des_seo']) && empty($params['des_seo'])) echo htmlspecialchars($detail_cat['keyword_seo']) ;elseif(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?>" maxlength="255" />
        </td>
    </tr>
    <tr>
        <th>
            &nbsp;
        </th>
        <td>
            <input type="hidden" name="category_id" value="<?php echo $detail_cat['id'] ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('EDIT') ?></button>
            <button type="reset" class="btn btn-default" ><?php echo $this->lang->line('RESET') ?></button>
        </td>
    </tr>
</table>
</form>
<script type="text/javascript" src="<?php echo base_url('common/js/evol.colorpicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

