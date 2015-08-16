<div class="row">
<div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well">
            <h2><i class="glyphicon glyphicon-plus"></i> Thêm mới</h2>
        </div>
        <div class="box-content">
            <form method="POST" action="<?php echo base_url('ideaCustomer/add'); ?>" enctype="multipart/form-data">
                <?php if (!empty($error)): ?>
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
                    <select name="language_type" class="form-control noEnter">
                        <?php if (!empty($language_type)): ?>
                            <?php foreach ($language_type as $k => $v): ?>
                                <option value="<?php echo $k ?>" <?php if (!empty($params['language_type']) && $params['language_type'] == $k) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên khách hàng<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control input-sm noEnter" value="<?php if (!empty($params['name'])) echo html_escape($params['name']) ?>" />
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện<span class="text-danger">*</span></label>
                    <input type="file" name="logo"  accept="image/*" class="noEnter" id="logo" />
                </div>
                
                <div class="form-group">
                    <label>Ý kiến Khách hàng  <span class="text-danger">*</span></label>
                    <textarea id="comment" placeholder="Nhập câu hỏi" class="form-control" name="idea"><?php if (!empty($params['idea'])) echo htmlspecialchars_decode($params['idea']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="button button-blue"><?php echo $this->lang->line('CREATE') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('common/js/ckfinder/ckfinder.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('comment', {customConfig: '../ckeditor/config_seo.js'});
</script>