<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/product.css') ?>" />
<div class="row">
    <div class="col-lg-4">
        <h2><?php echo $this->lang->line('PRO_ADD_TITLE') ?></h2>
        <form name="frmProduct" id="frmProduct" action="<?php echo base_url('product') ?>" method="POST" enctype="multipart/form-data">
            <?php if(!empty($pro_errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($pro_errors as $err): ?>
                    <li><?php echo $err; ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php endif ?>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_CODE') ?></label>
                <input type="text" name="product_code" class="form-control input-sm" value="<?php if(!empty($params['product_code'])) echo htmlspecialchars($params['product_code']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_NAME') ?></label>
                <input type="text" name="name" class="form-control input-sm" value="<?php if(!empty($params['name'])) echo htmlspecialchars($params['name']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('SLUG') ?></label>
                <input type="text" name="slug" id="slug" class="form-control input-sm" value="<?php if(!empty($params['slug'])) echo htmlspecialchars($params['slug']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_PRICE') ?></label>
                <input type="text" name="price" id="price" class="form-control input-sm" value="<?php if(!empty($params['price'])) echo htmlspecialchars($params['price']) ?>" maxlength="20" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_IMAGE') ?></label>
                <input type="file" name="image[]" multiple="multiple" accept="image/*" class="form-control input-sm" value="" maxlength="" />
                 <!-- multiple="multiple"  accept="image/*" -->
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_CAT') ?></label>
                <select name="cat_id" id="cat_id" class="form-control input-sm">
                    <option value="">&nbsp;</option>
                <?php if(!empty($listCat)): ?>
                <?php foreach ($listCat as $row): ?>
                    <?php if($row['parent'] === "0"): ?>
                    <optgroup label="<?php echo ucwords($row['name']) ?>">
                        <?php foreach ($listCat as $row1): ?>
                        <?php if($row1['parent'] !== "0" && $row1['parent'] == $row['id']): ?>
                        <option value="<?php echo $row1['id'] ?>" <?php if(!empty($params['cat_id']) && $params['cat_id'] == $row1['id'] ) ?>><?php echo ucfirst($row1['name']) ?></option>
                        <?php endif; ?>
                        <?php endforeach ?>
                    </optgroup>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif ?>
                </select>
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_BOOK_LIMIT') ?></label>
                <input name="book_limit" class="form-control input-sm" value="<?php if(!empty($params['book_limit'])) echo htmlspecialchars($params['book_limit']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_DELIVERY_DAYS') ?></label>
                <input name="delivery_days" class="form-control input-sm" value="<?php if(!empty($params['delivery_days'])) echo htmlspecialchars($params['delivery_days']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_KEYWORD_SEO') ?></label>
                <input name="keyword_seo" class="form-control input-sm" value="<?php if(!empty($params['keyword_seo'])) echo htmlspecialchars($params['keyword_seo']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_DES_SEO') ?></label>
                <input name="des_seo" class="form-control input-sm" value="<?php if(!empty($params['des_seo'])) echo htmlspecialchars($params['des_seo']) ?>" maxlength="255" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_DISTRIBUTION') ?></label>
                <input name="pro_distribution" class="form-control input-sm" value="<?php if(!empty($params['pro_distribution'])) echo htmlspecialchars($params['pro_distribution']) ?>" maxlength="300" />
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                <select name="language_type" class="form-control input-sm">
                    <?php if(!empty($language_type)): ?>
                    <?php foreach ($language_type as $k=>$v): ?>
                    <option value="<?php echo $k ?>" <?php if(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_DESCRIPTION') ?></label>
                <textarea name="description" class="form-control" cols="40" rows="4"><?php if(!empty($params['description'])) echo htmlspecialchars($params['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label><?php echo $this->lang->line('PRO_CONTENT') ?></label>
                <textarea name="content" id="content" class="form-control"><?php if(!empty($params['content'])) echo htmlspecialchars($params['content']) ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="product_id" value="<?php if (!empty($params['product_id'])) echo $params['product_id'] ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('SAVE') ?></button>
                <button type="reset" class="btn btn-default" ><?php echo $this->lang->line('RESET') ?></button>
            </div>
        </form>
    </div>
    <div class="col-lg-8">
        <h2><?php echo $this->lang->line('PRO_TITLE') ?></h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('STT') ?></th>
                    <th><?php echo $this->lang->line('PRO_CODE') ?></th>
                    <th><?php echo $this->lang->line('PRO_NAME') ?></th>
                    <th><?php echo $this->lang->line('SLUG') ?></th>
                    <th><?php echo $this->lang->line('PRO_CAT') ?></th>
                    <th><?php echo $this->lang->line('PRO_DESCRIPTION') ?></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($listProduct)): ?>
                <?php $i = 1; foreach ($listProduct as $pro): ?>
                <tr class="pro_<?php echo $pro['name'] ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo htmlspecialchars($pro['product_code']) ?></td>
                    <td><?php echo htmlspecialchars($pro['name']) ?></td>
                    <td><?php echo htmlspecialchars($pro['slug']) ?></td>
                    <td><?php echo htmlspecialchars($pro['category_name']) ?></td>
                    <td><?php if(!empty($pro['description'])) echo htmlspecialchars($pro['description']) ?></td>
                    <td>
                        <a href="<?php echo base_url('product/detail/' . $pro['id']) ?>" title="Chi tiết"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="javascript:;" class="editPro" pro_attr="<?php echo base64_encode($pro['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="javascript:;" title="Xóa" class="delPro" pro_name="<?php echo htmlspecialchars($pro['name']) ?>" pro_attr="<?php echo base64_encode($pro['id']) ?>" ><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($pagination)): ?>
        <div class="pagination-center" >
            <?php echo $pagination; ?>
        </div>
        <?php endif; ?>
    </div>
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
    var MSG_DEL_PRO = '<?php echo $this->lang->line('PRO_CONFIRM_DEL') ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/tinymce/tinymce.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/product.js') ?>"></script>


