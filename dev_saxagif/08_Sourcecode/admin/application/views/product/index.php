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
                    <input type="textbox" name="s_product_code" placeholder="tìm mã phẩm ..." />
                    <input type="textbox" name="s_name" placeholder="tìm tên sản phẩm ..." />
                    <select>
                        <option>Loại danh mục</option>
                    </select>
                    <select>
                        <option>danh mục</option>
                    </select>
                    <input type="checkbox" name="promotion" /> Quà tặng
                    <button type="button">Filter</button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered table-striped responsive martopten datatable">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="5%">
                        <col width="30%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo 'Mã' ?></th>
                            <th><?php echo 'Tên' ?></th>
                            <th><?php echo 'Danh mục' ?></th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($listProduct)): ?>
                        <?php $i = 1; foreach ($listProduct as $pro): ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo htmlspecialchars($pro['product_code']) ?></td>
                            <td><?php echo htmlspecialchars($pro['name']) ?></td>
                            <td><?php echo htmlspecialchars($pro['slug']) ?></td>
                            <td> <?php echo !empty($pro['promotion']) ?  '<button><i class="glyphicon glyphicon-list glyphicon-gift blue"></i></button>' : '&nbsp;' ; ?></td>
                            <td>
                                <a href="javascript:;" class="viewProduct btn btn-success" attr_id="<?php  echo $pro['id']?>"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
                                <a href="<?php echo base_url('product/edit/' . $pro['id']) ?>" class="editPro btn btn-info" pro_attr="<?php echo base64_encode($pro['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
                                <a href="javascript:;" title="Xóa" class="delPro btn btn-danger" pro_name="<?php echo $pro['name'];?>"  pro_attr="<?php echo $pro['id'] ?>" ><i class="glyphicon glyphicon-trash icon-white"></i><?php echo $this->lang->line('DELETE') ?></a>
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

<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_popViewProduct.php') ;?>
<script src="<?php echo base_url('common/js/product.js'); ?>" /> </script>


