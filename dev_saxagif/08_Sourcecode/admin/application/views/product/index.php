<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/product.css') ?>" />
<?php if($this->session->flashdata('msg-success')): ?>
<div class="row msg-success">
    <?php echo $this->session->flashdata('msg-success') ?>
</div>
<?php endif ?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> <?php echo $this->lang->line('PRO_TITLE') ?></h2>
            </div>
            <div class="box-content">
                <div cLass="pull-left">
                    <a href="<?php echo base_url('product/add'); ?>"><button type="button">Thêm mới</button></a>
                    <select>
                        <option>all dates</option>
                    </select>
                    <select>
                        <option>all category</option>
                    </select>
                    <button type="button">Filter</button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered table-striped responsive martopten datatable">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo 'Mã' ?></th>
                            <th><?php echo 'Tên' ?></th>
                            <th><?php echo 'Danh mục' ?></th>
                            <th><?php echo 'Quà tặng' ?></th>
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
                            <td class=" sorting_1"><input type="checkbox" name="is-promotion" id="is-promotion" <?php if(!empty($pro['promotion'])) echo 'checked' ?> /></td>
                            <!--<td><?php echo htmlspecialchars($pro['category_name']) ?></td>
                            <td><?php if(!empty($pro['description'])) echo htmlspecialchars($pro['description']) ?></td>-->
                            <td>
                                <a href="<?php echo base_url('product/detail/' . $pro['id']) ?>" class="btn btn-success"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
                                <a href="<?php echo base_url('product/edit/' . $pro['id']) ?>" class="editPro btn btn-info" pro_attr="<?php echo base64_encode($pro['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
                                <a href="javascript:;" title="Xóa" class="delPro btn btn-danger" pro_name="<?php echo htmlspecialchars($pro['name']) ?>" pro_attr="<?php echo base64_encode($pro['id']) ?>" ><i class="glyphicon glyphicon-trash icon-white"></i><?php echo $this->lang->line('DELETE') ?></a>
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
<script src="<?php echo base_url('common/js/product.js'); ?>" /> </script>


