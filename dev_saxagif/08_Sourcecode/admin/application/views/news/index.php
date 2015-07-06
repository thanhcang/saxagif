<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/popModal.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/news.css') ?>" />
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin') ?>"><?php echo $this->lang->line('HOME') ?></a>
        </li>
        <li>
            <a href="javascript:;"><?php echo $this->lang->line('NEWS') ?></a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('NEW_ADD') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmNews" id="frmNews" method="POST" action="<?php echo base_url('news') ?>" enctype="multipart/form-data">
                    <?php if(!empty($news_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($news_errors as $err): ?>
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
                        <label for="txtTitle"><?php echo $this->lang->line('TITLE') ?></label>
                        <input type="text" name="txtTitle" class="form-control" id="txtTitle" placeholder="<?php echo $this->lang->line('TITLE') ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtSlug"><?php echo $this->lang->line('SLUG') ?></label>
                        <input type="text" name="txtSlug" class="form-control" id="txtSlug" placeholder="<?php echo $this->lang->line('SLUG') ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('AVATAR') ?></label>
                        <input type="file" name="avatar"  accept="image/*" class="form-control input-sm" id="logo" />
                    </div>
                    <div class="form-group">
                        <label for="position"><?php echo $this->lang->line('POSITION') ?></label>
                        <div class="controls">
                            <select name="position" id="position" data-rel="chosen">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catNews"><?php echo $this->lang->line('NEWS_CAT') ?></label>
                        <div class="controls">
                            <select name="catNews">
                                <option value=""></option>
                                <option value="1">Sự kiện</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtKeySeo"><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                        <input type="text" name="txtKeySeo" class="form-control" id="txtKeySeo" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="txtDesSeo"><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                        <input type="text" name="txtDesSeo" class="form-control" id="txtDesSeo" placeholder="">
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('NEWS_DESCRIPTION') ?></label>
                        <textarea name="description" class="form-control re_opinion" cols="40" rows="4"><?php if(!empty($params['description'])) echo htmlspecialchars($params['description']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('NEWS_CONTENT') ?></label>
                        <textarea name="content" id="content" class="form-control re_opinion"><?php if(!empty($params['content'])) echo htmlspecialchars($params['content']) ?></textarea>
                    </div>
                    <button type="submit" class="button"><?php echo $this->lang->line('NEW_ADD') ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?php echo $this->lang->line('') ?>News</h2>
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
                        <col width="30%"/>
                        <col width="10%"/>
                        <col width="25%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('NAME') ?></th>
                            <th><?php echo $this->lang->line('POSITION') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_news)): $i = 1; foreach ($list_news as $news): ?>
                        <tr class="news_<?php echo $news['id'] ?>">
                            <td><?php echo $i ?></td>
                            <td class=""><?php echo $news['title'] ?></td>
                            <td class="">
                                trang chủ
                            </td>
                            <td class="">
                                <a class="btn btn-success" href="<?php echo base_url('news/detail/' . $news['id'] ) ?>">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    <?php echo $this->lang->line('VIEW') ?>
                                </a>
                                <a class="btn btn-info" href="<?php echo base_url('news/edit/' . $news['id'] ) ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?php echo $this->lang->line('EDIT') ?>
                                </a>
                                <a class="btn btn-danger delNews" href="javascript:;" news_attr="<?php echo base64_encode($news['id']) ?>" news_name="<?php echo htmlspecialchars($news['title']) ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    <?php echo $this->lang->line('DELETE') ?>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/row-->
<!-- content ends -->

<div id="dialog_content" class="dialog_content" style="display:none">
    <div class="dialogModal_header"><?php echo $this->lang->line('CONFIRM') ?></div>
    <div class="dialogModal_content"></div>
    <div class="dialogModal_footer">
        <button type="button" class="btn btn-primary btnConfirmDel" data-dialogmodal-but="ok"><?php echo $this->lang->line('OK') ?></button>
        <button type="button" class="btn btn-default" data-dialogmodal-but="cancel"><?php echo $this->lang->line('CANCEL') ?></button>
    </div>
</div>
<script type="text/javascript">
    var MSG_DEL_NEWS = '<?php echo $this->lang->line('NEWS_MESS_DEL') ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/tinymce/tinymce.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/news.js') ?>"></script>