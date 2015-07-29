<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Thắc mắc và hướng dẫn</h2>
            </div>
            <div class="box-content">
                <div cLass="pull-left">
                    <form action="">
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="pull-left">
                    <a href="<?php echo base_url('commentCustomer/add') ?>" class="button"><?php echo $this->lang->line('CREATE') ?></a>
                </div>
                <div class="clearfix"></div>
                
                <table class="table table-bordered table-striped responsive martopten datatable">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="30%">
                        <col width="30%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo 'Tên khách hàng' ?></th>
                            <th><?php echo 'Câu hỏi' ?></th>
                            <th><?php echo 'Câu trả lời' ?></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($list_data)): ?>
                        <?php foreach ($list_data as $key => $value): ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo htmlspecialchars($value['customer_name']) ?></td>
                            <td><?php echo htmlspecialchars($value['question']) ?></td>
                            <td><?php echo htmlspecialchars($value['answer']) ?></td>
                            <td>
                                <a href="javascript:;" class="viewProduct btn btn-success" attr_id="<?php  echo $value['id']?>"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
                                <a href="<?php echo base_url('commentCustomer/edit/' . $value['id']) ?>" class="btn btn-info" title="Sửa"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
                                <a href="javascript:;" title="xóa" class="delPro btn btn-danger" pro_name="<?php echo $value['id'];?>"  pro_attr="<?php echo $value['id'] ?>" ><i class="glyphicon glyphicon-trash icon-white"></i><?php echo $this->lang->line('DELETE') ?></a>
                            </td>
                        </tr>
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
        </div>
    </div>
</div>
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>