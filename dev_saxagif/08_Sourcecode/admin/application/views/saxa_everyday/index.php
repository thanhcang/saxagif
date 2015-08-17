<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<div class="clearfix"></div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2> <i class="glyphicon glyphicon-list"></i> Danh sách</h2>
            </div>
            
            <div class="box-content">
                <div class="pull-left">
                    <form class="frmFilter" name="frmFilter" method="GET" action="<?php echo base_url('saxa_everyday') ?>">
                        <a href="<?php echo base_url('saxa_everyday/add') ?>" > <i class="glyphicon glyphicon-plus-sign"></i>  Thêm mới</a>
                        <select name="language_type">
                            <option value=""><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></option>
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($items['language_type']) && $items['language_type'] == $k ) echo 'selected'; ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select name="cat_news_id">
                            <option value="">Filter theo danh mục</option>
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
                            <td>
                                <a style="<?php echo !empty($row['parent']) ? 'margin-left : 20px' : '' ; ?>" href="javascript:;" class="btnShowDetail" attrCatNews="<?php echo $row['id'] ?>">
                                    <?php echo !empty($row['parent']) ? ' > ' : '' ; ?>
                                    <?php echo htmlspecialchars($row['name']) ?>
                                </a>
                            </td>
                            <td><?php if(!empty($row['position']) && !empty($position[$row['position']]) && $row['level'] > 1) echo $position[$row['position']] ?></td>
                            <td>
                                <?php if ($row['level'] == 1) : ?>
                                <a href="<?php echo base_url('saxa_everyday/add'.'/'.$row['id']) ?>" title="Thêm danh mục con" class="btn btn-success" attrCatNews="<?php echo $row['id'] ?>"><i class="glyphicon glyphicon-plus-sign icon-white"></i>Thêm</a>
                                <?php endif ?>
                                <?php if ($row['level'] >  1 && !empty($row['is_home']) ) : ?>
                                <a href="javascript:;" title="hiển thi trang chủ" class="btn btn-success btnShowDetail"><i class="glyphicon glyphicon-home icon-white"></i></a>
                                <?php endif ?>
                                <a href="javascript:;" class="btn btn-success btnShowDetail" attrCatNews="<?php echo $row['id'] ?>"><i class="glyphicon glyphicon-zoom-in icon-white"></i><?php echo $this->lang->line('VIEW') ?></a>
                                <a href="<?php echo base_url('saxa_everyday/edit/' . $row['id']) ?>" class="editCat1 btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i><?php echo $this->lang->line('EDIT') ?></a>
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
<?php require_once(VIEW_PATH.'saxa_everyday/popup_detail.php') ;?>
<script>
    var IS_CAT = '<?php $class = $this->router->class;if(!empty($class)) echo '1' ?>';
</script>
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/saxa_everyday.js') ?>"></script>

