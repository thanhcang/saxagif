<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<div class="row">
    <div class="col-sm-5" id="frmSearch">
        <form name="searchCategory" id="searchCategory" method="" action="<?php echo base_url('category') ?>"> 
            <table class="table table-bordered" width="300">
                <tr>
                    <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                    <td>
                        <input name="name" id="name" value="<?php if(!empty($params['name'])) echo $params['name'] ?>" maxlength="255" />
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <button type="submit" class="btn btn-primary btn-sm"><?php echo $this->lang->line('SEARCH') ?></button>
                    </td>
                </tr>
            </table> 
        </form>
    </div>
</div>
<div class="row">
    <a href="<?php echo base_url('category/create') ?>" class="btn btn-primary btn-sm"><?php echo $this->lang->line('CREATE') ?></a>
</div>
<div class="clearfix"></div>
<div class="row">
    <table class="table table-bordered table-condensed tbl-cat table-striped" style="border-collapse: collapse;">
        <thead>
            <tr class="">
                <th><?php echo $this->lang->line('STT') ?></th>
                <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                <th><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></th>
                <th><?php echo $this->lang->line('CAT_LOGO') ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($list_data)): ?>
            <?php $num = 1 ?>
            <?php foreach ($list_data as $row): ?>
            <tr class="cat_<?php echo $row['id'] ?>">
                <td><?php echo $num ?></td>
                <td><?php echo htmlspecialchars($row['name']) ?></td>
                <td width="160" style="background: #<?php if(!empty($row['bg_color'])) echo $row['bg_color'] ?>;">
                </td>
                <td width="160" style="background:#<?php if(!empty($row['bg_color'])) echo $row['bg_color'] ?>">
                    <?php if(!empty($row['logo'])): ?>
                    <img src="<?php echo base_url(IMAGE_CATEGORY_PATH . $row['logo']); ?>" width="150" height="100" />
                    <?php else: ?>
                    <img src="<?php echo base_url(IMAGE_PATH . 'no-img.png'); ?>" width="150" height="100" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo base_url('category/edit/' . $row['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="javascript:void(0)" title="Xóa" class="delCat" cat_name="<?php echo htmlspecialchars($row['name']) ?>" cat_attr="<?php echo base64_encode($row['id']) ?>" ><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
                <?php if(!empty($row['sub_cat'])): ?>
                <?php foreach ($row['sub_cat'] as $sub_cat): ?>
                    <?php //foreach ($sub_cats as $sub_cat): ?>
            <tr class="cat_<?php echo $sub_cat['id'] ?>">
                    <td>&nbsp;</td>
                    <td>
                        ＞ <?php echo htmlspecialchars($sub_cat['name']) ?>
                    </td>
                    <td width="160" style="background: #<?php if(!empty($sub_cat['bg_color'])) echo $sub_cat['bg_color'] ?>;">
                    <td width="160">
                        <?php if(!empty($sub_cat['logo'])): ?>
                        <img src="<?php echo base_url(IMAGE_CATEGORY_PATH . $sub_cat['logo']); ?>" width="150" height="100" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('category/edit/' . $sub_cat['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="javascript:void(0)" title="Xóa" class="delCat" cat_name="<?php echo htmlspecialchars($sub_cat['name']) ?>" cat_attr="<?php echo base64_encode($sub_cat['id']) ?>" ><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
                <?php //endforeach; ?>
                <?php endforeach; ?>
                <?php endif ?>
            <?php $num++ ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
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
<script type="text/javascript" src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

