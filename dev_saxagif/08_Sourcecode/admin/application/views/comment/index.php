<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> <?php echo $this->lang->line('PRO_TITLE') ?></h2>
            </div>
            <div class="box-content">
                <div cLass="pull-left">
                    <form action="" method="get" >
                    <a href="<?php echo base_url('product/add'); ?>"><button type="button">Thêm mới</button></a>
                    <input type="textbox" name="s_product_code" placeholder="tìm mã phẩm ..." value="<?php echo !empty($params['s_product_code']) ? $params['s_product_code'] : ''?>" />
                    <input type="textbox" name="s_name" placeholder="tìm tên sản phẩm ..."  value="<?php echo !empty($params['s_name']) ? $params['s_name'] : ''?>"/>
                    <select name="sType">
                        <option value="0">Loại danh mục</option>
                        <?php foreach($type_category as $keyType => $valueType): ?>
                            <option <?php echo (!empty($params['sType']) && $params['sType'] == $keyType) ? 'selected' : ''  ?> value="<?php echo $keyType; ?>"><?php echo $valueType ?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="checkbox" name="sPromotion" value="1" <?php echo !empty($params['sPromotion']) ? 'checked' : ''?> /> Quà tặng
                    <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered table-striped responsive martopten datatable">
                    <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="35%">
                        <col width="35%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo 'Tên khách hàng' ?></th>
                            <th><?php echo 'Câu hỏi' ?></th>
                            <th><?php echo 'Câu trả lời' ?></th>
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
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>


