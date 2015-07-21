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
                <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category') ?>" enctype="multipart/form-data">
                    <?php if(!empty($error)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($error as $err): ?>
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
                                    <option value="<?php echo $k ?>" <?php if(!empty($param['language_type']) && $param['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control input-sm" id="name" value="<?php if(!empty($param['name'])) echo html_escape($param['name']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label>Loại danh mục</label>
                        <select name="type" class="form-control">
                            <?php if(!empty($typeCategory)) : ?>
                                <?php foreach($typeCategory as $key=>$value): ?>
                                    <option value="<?php echo $key?>" <?php echo (!empty($param['type']) && $key == $param['type']) ? 'selected' :''; ?> ><?php echo $value?></option>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô tả ngắn</label>
                        <textarea name="note" class="form-control" placeholder="Nhập nội dung mô tả ngắn"><?php echo (!empty($param['note'])) ?  $param['note'] : ''  ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('SLUG') ?></label>
                        <input type="text" name="slug" class="form-control input-sm" id="slug" value="<?php if(!empty($param['slug'])) echo html_escape($param['slug']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></label>
                        <input type="text" name="keyword_seo" class="form-control input-sm" id="keyword_seo" value="<?php if(!empty($param['keyword_seo'])) echo html_escape($param['keyword_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_DES_SEO') ?></label>
                        <textarea name="des_seo" class="form-control noEnter"><?php if(!empty($param['des_seo'])) echo html_escape($param['des_seo']) ?></textarea>
                    </div>
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
                        <select name="sLanguageType">
                            <option value="">chọn ngôn ngữ</option>
                            <?php if(!empty($language_type)): ?>
                                <?php foreach ($language_type as $k=>$v): ?>
                                    <option value="<?php echo $k ?>" <?php if(!empty($sParam['sLanguageType']) && $sParam['sLanguageType'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select name="sType">
                            <option value="">chọn loại danh mục</option>
                        <?php if(!empty($typeCategory)) : ?>
                            <?php foreach($typeCategory as $key=>$value): ?>
                                <option value="<?php echo $key?>" <?php echo (!empty($sParam['sType']) && $key == $sParam['sType']) ? 'selected' :''; ?> ><?php echo $value?></option>
                            <?php endforeach;?>
                        <?php endif; ?>
                        </select>
                        <select name="sCatId"> 
                            <option value="">tên danh mục</option>
                            <?php if(!empty($list_data)): ?>
                            <?php foreach ($list_data as $key => $row): ?>
                                <option value="<?php echo $row['id'];?>" <?php echo (!empty($sParam['sCatId']) && $row['id'] == $sParam['sCatId']) ? 'selected' :''; ?> ><?php echo $row['name']?></option>
                            <?php endforeach;?>
                            <?php endif; ?>
                        </select>
                        <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="40%"/>
                        <col width="15%"/>
                        <col width="40%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-align-center-i"><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                            <th class="text-align-center-i">Loại</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($list_data)): ?>
                        <?php foreach ($list_data as $key => $row): ?>
                        <tr>
                            <td class="text-align-center-i"><?php echo $key+1+$offset ?></td>
                            <td><a href="javascript:;"><?php echo htmlspecialchars($row['name']) ?></a></td>
                            <td class="text-align-center-i">
                                <?php echo $typeCategory[$row['type']] ?>
                            </td>
                            <td>
                                <a class="btn btn-success viewCategory" href="<?php echo base_url('category/viewCategory/' . $row['id']) ?>"><i class="glyphicon glyphicon-zoom-in icon-white"></i>Xem</a>
                                <a href="<?php echo base_url('category/updateCategory/' . $row['id']) ?>" class="editCat1 btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
                                <a href="javascript:;" class="delCat btn btn-danger" cat_name="<?php echo htmlspecialchars($row['name']) ?>" cat_attr="<?php echo $row['id'] ?>" ><i class="glyphicon glyphicon-trash icon-white"></i><?php echo $this->lang->line('DELETE') ?></a>
                                <?php if (!empty($row['type']) && ( $row['type'] == 1)): ?>
                                <a href="<?php echo base_url('category/childrenCategory/' . $row['id']) ?>" class="btn btn-success" title="thêm danh mục con"><i class="glyphicon glyphicon-plus icon-white"></i>Thêm</a>
                                <?php endif; ?>
                                <?php if (!empty($row['type']) &&  $row['type'] == 3 && !empty($row['is_home']) ): ?>
                                <a href="javascript:;" class="btn btn-success" title="hiên thị trang chủ"><i class="glyphicon glyphicon-bookmark icon-white"></i>Trang chủ</a>
                                <?php endif; ?>
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
</div>
<div class="pageHomeTemp hide">
    <div class="form-group pageHome">
        <label>Hình slideshow</label>
        <input type="file" name="event_img" />
    </div>
    
    <div class="form-group pageHome">
        <label>Hiển thị trang chủ</label>
        <input type="checkbox" name="is_home" value="1" <?php echo (!empty($param['price'])) ? 'checked' : '' ?> >
    </div>
</div>

<div class="pricePresent hide">
    <div class="form-group pricePresent">
        <label>Giá</label>
        <input type="text" name="price" value="<?php echo (!empty($param['price'])) ? $param['price'] : ''  ?>" class="form-control" placeholder="Nhập giá" />
    </div>
    
    <div class="form-group pricePresent">
        <label>Hiển thị trang chủ</label>
        <input type="checkbox" name="is_home" value="1" <?php echo (!empty($param['price'])) ? 'checked' : ''  ?> />
    </div>
</div>

<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script src="<?php echo base_url('common/js/category.js'); ?>"></script>
