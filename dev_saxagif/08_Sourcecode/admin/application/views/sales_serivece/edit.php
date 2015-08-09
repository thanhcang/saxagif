<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-plus"></i> Cập nhật</h2>
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
                        <label>Tên<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control input-sm noEnter" value="<?php if (!empty($params['name'])) echo html_escape($params['name']) ?>" />
                    </div>
                    <div class="form-group">
                        <label>phone<span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control input-sm noEnter" value="<?php if (!empty($params['phone'])) echo html_escape($params['phone']) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện<span class="text-danger">*</span></label>
                        <input type="file" name="avatar"  accept="image/*" class="noEnter" id="logo" />
                    </div>
                    
                    <div class="form-group">
                        <img src="<?php echo base_url('common/multidata/salse'.'/'.$params['avatar']); ?>" />
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
