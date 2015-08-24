<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<div class="clearfix"></div>
<div class="row">
    
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i><?php echo $this->lang->line('NEW_ADD') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmCategoryNews" id="frmCategoryNews" method="POST" action="<?php echo base_url('category_news') ?>" enctype="multipart/form-data">
                    <?php if(!empty($cat_news_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($cat_news_errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                        <select name="language_type" class="form-control">
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($params['language_type']) && $params['language_type'] == $k ) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_NEWS_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php if(!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('SLUG') ?><span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control" id="slug" value="<?php if(!empty($params['slug'])) echo html_escape($params['slug']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_NEWS_POSITION') ?></label>
                        <select name="position" class="form-control">
                            <option value="">&nbsp;</option>
                            <?php if(!empty($position)): ?>
                            <?php foreach ($position as $key=>$value): ?>
                            <option value="<?php echo $key ?>" <?php if(!empty($params['position']) && $params['position'] == $key ) echo 'selected' ?>><?php echo $value ?></option>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group desSlide">
                        <label>Mô tả ngắn</label>
                        <textarea name="title" class="form-control noEnter" placeholder="Nhập nội dung mô tả ngắn"><?php echo !empty($params['title']) ? $params['title'] : '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề page</label>
                        <input type="text" name="page_title" class="form-control"  value="<?php if(!empty($params['page_title'])) echo html_escape($params['page_title']) ?>"/>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                        <textarea id="keyword_seo" name="keyword_seo"><?php if(!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?></textarea> 
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                        <textarea id="des_seo" name="des_seo"><?php if(!empty($params['des_seo'])) echo html_escape($params['des_seo']) ?></textarea> 
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
                <h2><i class="glyphicon glyphicon-list"> </i><?php echo $this->lang->line('CAT_NEWS_LIST') ?></h2>
            </div>
            
            <div class="box-content">
                <div class="pull-left">
                    <form class="frmFilter" name="frmFilter" method="GET" action="<?php echo base_url('category_news') ?>">
                        <select name="language_type">
                            <option value=""><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></option>
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($items['language_type']) && $items['language_type'] == $k ) echo 'selected'; ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select name="cat_news_id">
                            <option value="">All category news</option>
                            <?php if(!empty($listAll)): ?>
                            <?php foreach ($listAll as $row): ?>
                            <option value="<?php echo $row['id'] ?>" <?php if(!empty($items['cat_news_id']) && $items['cat_news_id'] == $row['id'] ) echo 'selected' ?>><?php echo htmlspecialchars($row['name']) ?></option>
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
                        <col width="35%"/>
                        <col width="20%"/>
                        <col width="40%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('CAT_NEWS_NAME') ?></th>
                            <th><?php echo $this->lang->line('CAT_NEWS_POSITION') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($list_data)): ?>
                        <?php foreach ($list_data as $key => $row): ?>
                        <tr class="cat_<?php echo $row['id'] ?>">
                            <td><?php echo $key+1+$offset ?></td>
                            <td><a href="javascript:;" class="btnShowDetail" attrCatNews="<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['name']) ?></a></td>
                            <td><?php if(!empty($row['position']) && !empty($position[$row['position']])) echo $position[$row['position']] ?></td>
                            <td>
                                <a href="javascript:;" class="btn btn-success btnShowDetail" attrCatNews="<?php echo $row['id'] ?>"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
                                <a href="<?php echo base_url('category_news/edit/' . $row['id']) ?>" class="editCat1 btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
                                <a href="javascript:;" class="delCatNews btn btn-danger" cat_name="<?php echo htmlspecialchars($row['name']) ?>" cat_attr="<?php echo $row['id'] ?>" ><i class="glyphicon glyphicon-trash icon-white"></i><?php echo $this->lang->line('DELETE') ?></a>
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
<?php require_once(VIEW_PATH.'category_news/popup_detail.php') ;?>
<script>
    var IS_CAT = '<?php $class = $this->router->class;if(!empty($class)) echo '1' ?>';
</script>
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/category_news.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('keyword_seo', {customConfig: '../ckeditor/config_short_seo.js'});
    CKEDITOR.replace('des_seo', {customConfig: '../ckeditor/config_short_seo.js'});
</script>

