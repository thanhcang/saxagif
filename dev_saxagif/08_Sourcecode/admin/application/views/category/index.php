<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/evol.colorpicker.min.css') ?>" />
<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-5">
        <h2><?php echo $this->lang->line('CAT_TITLE_CREATE') ?></h2>
        <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category') ?>" enctype="multipart/form-data">
            <?php if(!empty($cat_errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($cat_errors as $err): ?>
                    <li><?php echo $err; ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php endif ?>
            <div class="clearfix"></div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control input-sm" id="name" value="<?php if(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></label>
                <input type="text" name="bg_color" class="form-control input-sm" id="bg_color" value="<?php if(!empty($params['bg_color'])) echo html_escape($params['bg_color']) ?>" maxlength="7" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CAT_LOGO') ?></label>
                <input type="file" name="logo" class="form-control input-sm" id="logo" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                <select name="language_type" class="form-control input-sm">
                    <option value="">&nbsp;</option>
                    <?php if(!empty($language_type)): ?>
                    <?php foreach ($language_type as $k=>$v): ?>
                    <option value="<?php echo $k ?>" <?php if(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></label>
                <input type="text" name="keyword_seo" class="form-control input-sm" id="keyword_seo" value="<?php if(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CAT_DES_SEO') ?></label>
                <input type="text" name="des_seo" class="form-control input-sm" id="des_seo" value="<?php if(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?>" maxlength="255" />
            </div>
            
            <div class="form-group">
                <input type="hidden" name="category_id" value="" />
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('SAVE') ?></button>
                <button type="reset" class="btn btn-default" ><?php echo $this->lang->line('RESET') ?></button>
            </div>
        </form>
    </div>
    <div class="col-lg-7">
        <h2><?php echo $this->lang->line('LIST_CATEGORY') ?></h2>
    <table class="table table-bordered tbl-cat table-striped" style="border-collapse: collapse;">
        <thead>
            <tr class="">
                <th><?php echo $this->lang->line('STT') ?></th>
                <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                <th><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($list_data)): ?>
            <?php $num = 1 ?>
            <?php foreach ($list_data as $row): ?>
            <tr class="cat_<?php echo $row['id'] ?>">
                <td><?php echo $num ?></td>
                <td><a href="<?php echo base_url('category/detail/' . $row['id']) ?>"><?php echo htmlspecialchars($row['name']) ?></a></td>
                <td width="160">
                    <input type="color" value="<?php if(!empty($row['bg_color'])) echo '#'.$row['bg_color'] ?>" disabled="disabled" />.
                </td>
                <td>
                    <a href="<?php echo base_url('category/detail/' . $row['id']) ?>" title="Chi tiết"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="javascript:void(0)" class="editCat" cat_attr="<?php echo base64_encode($row['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="javascript:void(0)" title="Xóa" class="delCat" cat_name="<?php echo htmlspecialchars($row['name']) ?>" cat_attr="<?php echo base64_encode($row['id']) ?>" ><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <?php $num++ ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    <?php if (!empty($pagination)): ?>
    <div class="pagination-center" >
        <?php echo $pagination; ?>
    </div>
    <?php endif; ?>
</div>
<div id="dialog_content" class="dialog_content" style="display:none">
    <div class="dialogModal_header"><?php echo $this->lang->line('CONFIRM') ?></div>
    <div class="dialogModal_content"></div>
    <div class="dialogModal_footer">
        <button type="button" class="btn btn-primary btnConfirmDel" data-dialogmodal-but="ok"><?php echo $this->lang->line('OK') ?></button>
        <button type="button" class="btn btn-default" data-dialogmodal-but="cancel"><?php echo $this->lang->line('CANCEL') ?></button>
    </div>
</div>
<script>
    var MSG_DEL_CAT = '<?php echo $this->lang->line('CAT_MESS_DELETE') ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('common/js/evol.colorpicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

