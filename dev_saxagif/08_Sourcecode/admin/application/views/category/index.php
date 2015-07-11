<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/evol.colorpicker.min.css') ?>" />
<div class="clearfix"></div>
<div class="row">
    
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i><?php echo $this->lang->line('NEW_ADD') ?></h2>
            </div>
            <div class="box-content">
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
                        <label><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control input-sm" id="name" value="<?php if(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('SLUG') ?><span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control input-sm" id="slug" value="<?php if(!empty($params['slug'])) echo html_escape($params['slug']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group bg_color">
                        <label><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></label>
                        <input type="text" name="bg_color" class="form-control input-sm" id="bg_color" value="<?php if(!empty($params['bg_color'])) echo html_escape($params['bg_color']) ?>" maxlength="7" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_LOGO') ?></label>
                        <input type="file" name="logo"  accept="image/*" class="" id="logo" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_PARENT') ?></label>
                        <div class="controls">
                            <select name="parent" class="form-control">
                                <option value="">&nbsp;</option>
                                <?php if(!empty($parent)): ?>
                                <?php foreach ($parent as $p): ?>
                                <option value="<?php echo $p['id'] ?>" <?php if(!empty($params['parent']) && $params['parent'] == $p['id'] ) echo 'selected' ?>><?php echo $p['name'] ?></option>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></label>
                        <input type="text" name="keyword_seo" class="form-control input-sm" id="keyword_seo" value="<?php if(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_DES_SEO') ?></label>
                        <input type="text" name="des_seo" class="form-control input-sm" id="des_seo" value="<?php if(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?>" maxlength="255" />
                    </div>
                    <?php if(!empty($gift)): ?>
                    <input type="hidden" name="is_gift" value="1" />
                    <?php endif ?>
                    <div class="form-group">
                        <!--<input type="hidden" name="category_id" value="<?php if(!empty($params['category_id'])) echo $params['category_id'] ?>" />-->
                        <button type="submit" class="button button-blue"><?php echo $this->lang->line('CREATE') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"> </i><?php echo $this->lang->line('LIST_CATEGORY') ?></h2>
            </div>
            
            <div class="box-content">
                <div class="pull-left">
                    <form class="frmFilter" name="frmFilter" method="GET" action="">
                        <select name="language_type">
                            <option value=""><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></option>
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($items['language_type']) && $items['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select name="cat_id">
                            <option value="">All category</option>
                            <?php if(!empty($parent)): ?>
                            <?php foreach ($parent as $row): ?>
                            <option value="<?php echo $row['id'] ?>" <?php if(!empty($items['cat_id']) && $items['cat_id'] == $row['id'] ) echo 'selected' ?>><?php echo htmlspecialchars($row['name']) ?></option>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                    <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="50%"/>
                        <col width="15%"/>
                        <col width="30%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                            <th class="text-center"><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></th>
                            <!--<th><?php echo $this->lang->line('DISPLAY_POSITION') ?></th>-->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($list_data)): ?>
                        <?php foreach ($list_data as $key => $row): ?>
                        <tr class="cat_<?php echo $row['id'] ?>">
                            <td><?php echo $key+1+$offset ?></td>
                            <td><a href="<?php echo base_url('category/detail/' . $row['id']) ?>"><?php echo htmlspecialchars($row['name']) ?></a></td>
                            <td width="160" class="text-center">
                                <input type="color" value="<?php if(!empty($row['bg_color'])) echo '#'.$row['bg_color'] ?>" disabled="disabled" />
                            </td>
                            <td>
                                <a href="<?php echo base_url('category/detail/' . $row['id']) ?>" class="btn btn-success"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
                                <a href="<?php echo base_url('category/edit/' . $row['id']) ?>" class="editCat1 btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
                                <a href="javascript:;" class="delCat btn btn-danger" cat_name="<?php echo htmlspecialchars($row['name']) ?>" cat_attr="<?php echo $row['id'] ?>" ><i class="glyphicon glyphicon-trash icon-white"></i><?php echo $this->lang->line('DELETE') ?></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
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
<script>
    var MSG_DEL_CAT = '<?php echo $this->lang->line('CAT_MESS_DELETE') ?>';
    var IS_CAT = '<?php $class = $this->router->class;if(!empty($class)) echo '1' ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('common/js/evol.colorpicker.min.js') ?>"></script>
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

