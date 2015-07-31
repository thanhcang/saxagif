<!-- content starts -->
<div class="row">
    
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> <?php echo $this->lang->line('') ?> Gia nhập cùng saxa</h2>
            </div>
            <div class="box-content">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url('joinSaxa/add') ?>" class="button"><?php echo $this->lang->line('CREATE') ?></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="3%"/>
                        <col width="10%"/>
                        <col width="3%"/>
                        <col width="67%">
                        <col width="27%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo $this->lang->line('STT') ?></th>
                            <th>vị trí</th>
                            <th>số lượng</th>
                            <th>nội dung</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_data)): foreach ($list_data as $key => $news): ?>
                        <tr class="news_<?php echo $news['id'] ?>">
                            <td class="text-center"><?php echo $key+1+$offset ?></td>
                            <td class="text-center"><?php echo !empty($news['name']) ? $news['name'] : ''  ?></td>
                            <td class="text-center"><?php echo !empty($news['number']) ? $news['number'] : ''  ?></td>
                            <td class=""><?php echo !empty($news['content']) ? _substr($news['content'],200) : '' ?></td>
                            <td class="text-center">
                                <a class="btn btn-success" href="<?php echo base_url('news/detail/' . $news['id'] ) ?>">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    <?php echo $this->lang->line('VIEW') ?>
                                </a>
                                <a class="btn btn-info" href="<?php echo base_url('news/edit/' . $news['id'] ) ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?php echo $this->lang->line('EDIT') ?>
                                </a>
                                <a class="btn btn-danger delNews" href="javascript:;" cat_attr="<?php echo $news['id'] ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    <?php echo $this->lang->line('DELETE') ?>
                                </a>
                                <?php if ($news['status'] == 1) : ?>
                                <a class="btn btn-success onNews" href="javascript:;" cat_attr="<?php echo $news['id'] ?>">
                                    <i class="glyphicon glyphicon-eye-open icon-white"> ON</i>
                                </a>
                                <?php else : ?>
                                <a class="btn btn-danger offNews" href="javascript:;" cat_attr="<?php echo $news['id'] ?>">
                                    <i class="glyphicon glyphicon-eye-close icon-white"> OFF</i>
                                </a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php endforeach; ;endif; ?>
                    </tbody>
                </table>
                <?php if (!empty($pagination)): ?>
                    <div class="pagination" >
                        <?php echo $pagination; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div><!--/row-->
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/join_saxa.js') ?>"></script>