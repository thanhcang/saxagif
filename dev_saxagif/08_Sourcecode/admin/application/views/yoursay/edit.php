<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-plus"></i> Thêm mới</h2>
            </div>
            <div class="box-content">
                <form method="POST" action="" enctype="multipart/form-data">
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
                        <label>Loại</label>
                        <select name="type" class="form-control" >
                            <?php foreach ($type_listen as $key => $value) : ?>
                                <option value="<?php echo $key ?>" <?php if (!empty($params['type']) && $params['type'] == $k) echo 'selected' ?>><?php echo $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control input-sm noEnter" value="<?php if (!empty($params['name'])) echo html_escape($params['name']) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện<span class="text-danger">*</span></label>
                        <input type="file" name="logo"  accept="image/*" class="noEnter" id="logo" />
                    </div>
                    
                    <div class="form-group">
                        <img src="<?php echo base_url('common/multidata/listen_to_them_say/thumb'.'/'.$params['logo']); ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label>Họ nói <span class="text-danger">*</span></label>
                        <textarea id="comment" placeholder="Nhập những gì họ nói" class="form-control" name="comment"><?php if (!empty($params['comment'])) echo $params['comment'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button button-blue"><?php echo 'Cập nhật' ?></button>
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
