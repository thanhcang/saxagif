<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/news.css') ?>" />
<!-- content starts -->
<div class="row">
    
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> <?php echo $this->lang->line('') ?>News</h2>
            </div>
            <div class="box-content">
                <div class="pull-left">
                    <form class="frmFilter" name="frmFilter" method="GET" action="<?php echo base_url('news') ?>">
                        <select name="language_type">
                            <option value=""><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></option>
                            <?php if(!empty($language_type)): ?>
                            <?php foreach ($language_type as $k=>$v): ?>
                            <option value="<?php echo $k ?>" <?php if(!empty($filter['language_type']) && $filter['language_type'] == $k ) echo 'selected'; ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select name="position" id="position">
                            <option value="">Vị trí hiển thị</option>
                            <?php if(!empty($position)): ?>
                            <?php foreach ($position as $key=>$value): ?>
                            <option value="<?php echo $key ?>" <?php if(!empty($filter['position']) && $filter['position'] == $key ) echo 'selected' ?>><?php echo $value ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <select name="cat_news" class="">
                            <option value="">Thuộc danh mục</option>
                            <?php if(!empty($listAllCatNews)): ?>
                            <?php foreach($listAllCatNews as $cat): ?>
                            <option value="<?php echo $cat['id'] ?>" <?php if(!empty($filter['cat_news']) && $filter['cat_news'] == $cat['id']) echo 'selected' ?>><?php echo htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                    <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url('news/add') ?>" class="button"><?php echo $this->lang->line('CREATE') ?></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="3%"/>
                        <col width="22%"/>
                        <col width="10%">
                        <col width="15%"/>
                        <col width="20%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('NAME') ?></th>
                            <th><?php echo $this->lang->line('POSITION') ?></th>
                            <th><?php echo $this->lang->line('NEWS_CAT_NAME') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_news)): foreach ($list_news as $key => $news): ?>
                        <tr class="news_<?php echo $news['id'] ?>">
                            <td class="text-center"><?php echo $key+1+$offset ?></td>
                            <td class=""><?php echo $news['title'] ?></td>
                            <td class="">
                                <?php if(!empty($news['position']) && !empty($position[$news['position']]))
                                    echo $position[$news['position']];
                                ?>
                            </td>
                            <td class=""><?php if(!empty($news['cat_news_name'])) echo htmlspecialchars($news['cat_news_name']) ?></td>
                            <td class="text-center">
                                <a class="btn btn-success" href="<?php echo base_url('news/detail/' . $news['id'] ) ?>">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    <?php echo $this->lang->line('VIEW') ?>
                                </a>
                                <a class="btn btn-info" href="<?php echo base_url('news/edit/' . $news['id'] ) ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?php echo $this->lang->line('EDIT') ?>
                                </a>
                                <a class="btn btn-danger delNews" href="javascript:;" news_attr="<?php echo $news['id'] ?>" news_name="<?php echo htmlspecialchars($news['title']) ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    <?php echo $this->lang->line('DELETE') ?>
                                </a>
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
<!-- content ends -->
<?php require_once(VIEW_PATH.'templates/popup/_confirmDelete.php') ;?>
<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/news.js') ?>"></script>