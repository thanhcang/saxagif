<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() ?>"><?php echo $this->lang->line('HOME') ?></a>
        </li>
        <li>
            <a href="<?php echo base_url('partners') ?>"><?php echo $this->lang->line('PAR_PARTNERS') ?></a>
        </li>
    </ul>
</div>
<?php if($this->session->flashdata('msg-success')): ?>
<div class="row msg-success">
    <?php echo $this->session->flashdata('msg-success') ?>
</div>
<?php endif ?>
<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('NEW_ADD') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmPartners" id="frmProduct" action="<?php echo base_url('partners') ?>" method="POST" enctype="multipart/form-data">
                    <?php if(!empty($par_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($par_errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
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
                        <label for="inputName"><?php echo $this->lang->line('PAR_NAME') ?></label>
                        <input type="text" name="name" class="form-control" id="inputName" value="<?php if(!empty($params['name'])) echo htmlspecialchars($params['name']) ?>" placeholder="<?php echo $this->lang->line('PAR_NAME') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail"><?php echo $this->lang->line('EMAIL') ?></label>
                        <input type="email" name="email" class="form-control" id="inputEmail" value="<?php if(!empty($params['email'])) echo htmlspecialchars($params['email']) ?>" placeholder="<?php echo $this->lang->line('EMAIL') ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyPhone"><?php echo $this->lang->line('PHONE') ?></label>
                        <input type="text" name="phone" class="form-control" id="keyPhone" value="<?php if(!empty($params['phone'])) echo htmlspecialchars($params['phone']) ?>" placeholder="<?php echo $this->lang->line('PHONE') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputURL"><?php echo $this->lang->line('URL') ?></label>
                        <input type="url" name="url" class="form-control" id="inputURL" value="<?php if(!empty($params['url'])) echo htmlspecialchars($params['url']) ?>" placeholder="<?php echo $this->lang->line('URL') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputFile"><?php echo $this->lang->line('LOGO') ?></label>
                        <input type="file" name="logo"  accept="image/*" class="form-control" id="inputFile" />
                    </div>
                    <div class="form-group">
                        <label for="keyAddress"><?php echo $this->lang->line('ADDRESS') ?></label>
                        <input type="text" name="address" class="form-control" id="keyAddress" value="<?php if(!empty($params['address'])) echo htmlspecialchars($params['address']) ?>" placeholder="<?php echo $this->lang->line('ADDRESS') ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyNote"><?php echo $this->lang->line('NOTE') ?></label>
                        <textarea name="note" class="re_opinion form-control"><?php if(!empty($params['note'])) echo htmlspecialchars($params['note']) ?></textarea>
                    </div>
                    <button type="submit" class="button"><?php echo $this->lang->line('NEW_ADD') ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?php echo $this->lang->line('PAR_LIST_PARTNERS') ?></h2>
            </div>
            <div class="box-content">
                <DIV CLass="pull-left">
                    <select>
                        <option>all dates</option>
                    </select>
                    <select>
                        <option>all category</option>
                    </select>
                    <button type="button">Filter</button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="25%"/>
                        <col width="10%"/>
                        <col width="30%"/>
                        <col width="30%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('NAME') ?></th>
                            <th><?php echo $this->lang->line('PHONE') ?></th>
                            <th><?php echo $this->lang->line('NOTE') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($list_partners)):
                        $num = 1;
                        foreach($list_partners as $partners):
                    ?>
                        <tr>
                            <td><?php echo $num ?></td>
                            <td><?php echo htmlspecialchars($partners['name']) ?></td>
                            <td><?php if(!empty($partners['phone'])) echo htmlspecialchars($partners['phone']) ?></td>
                            <td><?php if (!empty($partners['note'])) echo htmlspecialchars($partners['note']) ?></td>
                            <td>
                                <a class="btn btn-success" href="<?php echo base_url('partners/detail/' . $partners['id']) ?>">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    <?php echo $this->lang->line('VIEW') ?>
                                </a>
                                <a class="btn btn-info" href="<?php echo base_url('partners/edit/' . $partners['id']) ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?php echo $this->lang->line('EDIT') ?>
                                </a>
                                <a class="btn btn-danger delPar" href="javascript:;" attr_par="<?php echo base64_encode($partners['id']) ?>" par_name="<?php echo htmlspecialchars($partners['name']) ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    <?php echo $this->lang->line('DELETE') ?>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $num++;
                        endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/row-->
<div id="dialog_content" class="dialog_content" style="display:none">
    <div class="dialogModal_header"><?php echo $this->lang->line('CONFIRM') ?></div>
    <div class="dialogModal_content"></div>
    <div class="dialogModal_footer">
        <button type="button" class="btn btn-primary btnConfirmDel" data-dialogmodal-but="ok"><?php echo $this->lang->line('OK') ?></button>
        <button type="button" class="btn btn-default" data-dialogmodal-but="cancel"><?php echo $this->lang->line('CANCEL') ?></button>
    </div>
</div>
<script>
    var MSG_DEL_PAR = '<?php echo $this->lang->line('PAR_CONFIRM_DEL') ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/partners.js') ?>"></script>