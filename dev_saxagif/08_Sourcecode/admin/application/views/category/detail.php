<div class="row">
<h2><?php echo $this->lang->line('CAT_DETAIL') ?></h2>
<div class="col-lg-6">
    <div class="control-label">
        <label><?php echo $this->lang->line('CAT_NAME') ?>:</label>
        <?php echo htmlspecialchars($catDetail['name']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?>:</label>
        <input type="color" value="<?php if(!empty($catDetail['bg_color'])) echo '#'. $catDetail['bg_color'] ?>" />
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?>:</label>
        <?php if(!empty($catDetail['keyword_seo'])) echo htmlspecialchars($catDetail['keyword_seo']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('CAT_DES_SEO') ?>:</label>
        <?php if(!empty($catDetail['des_seo'])) echo htmlspecialchars($catDetail['des_seo']) ?>
    </div>
</div>
<div class="col-lg-6">
    <?php if(!empty($catDetail['logo'])): ?>
    <img src="<?php echo base_url(IMAGE_CATEGORY_PATH . $catDetail['logo']) ?>" width="200" height="150" />
    <?php else: ?>
    <img src="<?php echo base_url(IMAGE_PATH . 'noimg.png') ?>" width="150" height="100" />
    <?php endif; ?>
</div>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('STT') ?></th>
                <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                <th><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <?php if($catDetail['cat_parent']):
            $i = 1;
            foreach ($catDetail['cat_parent'] as $detail): ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo htmlspecialchars($detail['name']) ?></td>
            <td><?php if (!empty($detail['bg_color'])) echo '#'.$detail['bg_color'] ?></td>
            <td>
                <a href="javascript:void(0)" class="editCat" cat_attr="<?php echo base64_encode($detail['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="javascript:void(0)" title="Xóa" class="delCat" cat_name="<?php echo htmlspecialchars($detail['name']) ?>" cat_attr="<?php echo base64_encode($detail['id']) ?>" ><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php
            $i++;
            endforeach;
        endif ?>
    </table>
</div>


