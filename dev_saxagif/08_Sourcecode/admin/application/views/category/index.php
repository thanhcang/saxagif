<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/evol.colorpicker.min.css') ?>" />
<div class="clearfix"></div>
<div class="row">
    
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-plus"></i><?php echo $this->lang->line('NEW_ADD') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category/childrenCategory'.'/'.$parent['id']) ?>" enctype="multipart/form-data">
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
                        <select name="language_type" class="form-control noEnter">
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control input-sm noEnter" id="name" value="<?php if(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('SLUG') ?><span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control input-sm noEnter" id="slug" value="<?php if(!empty($params['slug'])) echo html_escape($params['slug']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group bg_color">
                        <label><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></label>
                        <input type="text" name="bg_color" readonly="readonly" class="form-control input-sm noEnter" id="bg_color" value="<?php if(!empty($params['bg_color'])) echo html_escape($params['bg_color']) ?>" maxlength="7" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_LOGO') ?></label>
                        <input type="file" name="logo"  accept="image/*" class="noEnter" id="logo" />
                    </div>
                    <div class="form-group">
                        <label for="logo">Hiển thị trang chủ</label>
                        <input type="checkbox" name="is_home" value="1" <?php echo !empty($params['is_home']) ? "checked" : '' ?>/>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></label>
                        <input type="text" name="keyword_seo" class="form-control noEnter" id="keyword_seo" value="<?php if(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_DES_SEO') ?></label>
                        <textarea name="des_seo" class="form-control noEnter"><?php if(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?></textarea>
                    </div>
                    <?php if(!empty($gift)): ?>
                    <input type="hidden" name="is_gift" value="1" />
                    <?php endif ?>
                    <div class="form-group">
                        <button type="submit" class="button button-blue"><?php echo $this->lang->line('CREATE') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-th-list"> </i> Danh sách</h2>
            </div>
            <div class="box-content">
                <div class="pull-left">
                    <form class="frmFilter" name="frmFilter" method="GET" action="">
                        <select name="language_type">
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($items['language_type']) && $items['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="15%"/>
                        <col width="5%"/>
                        <col width="35%"/>
                        <col width="15%"/>
                        <col width="30%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">danh mục cha</th>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th>tên danh mục</th>
                            <th class="text-center"><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($list_data)): $colspan = count($list_data); ?>
                        <?php foreach ($list_data as $key => $row): ?>
                        <tr class="cat_<?php echo $row['id'] ?>">
                             <?php if ( $key == 0): ?>
                            <td rowspan="<?php echo $colspan; ?>"  style=" text-align: center; vertical-align: middle"><a href="<?php echo base_url('category/detail/' . $row['id']) ?>"><?php echo htmlspecialchars($parent['name']) ?></a></td>
                            <?php endif ?>
                            <td><?php echo $key+1+$offset ?></td>
                            <td>
                                <a href="javascript:;"><?php echo htmlspecialchars($row['name']) ?></a>
                            </td>
                            <td width="160" class="text-center">
                                <?php if(!empty($row['bg_color'])): ?>
                                <input type="color" value="<?php if(!empty($row['bg_color'])) echo $row['bg_color'] ?>" disabled="disabled" />
                                <?php else: ?>
                                &nbsp;
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-success viewChildCategory" attr-category="<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
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
<?php require_once(VIEW_PATH.'templates/popup/_viewChildCategory.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

