<div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well">
            <h2><i class="glyphicon glyphicon-list-alt"></i> Cập nhật</h2>
        </div>
        <div class="box-content">
            <form name="frmCategoryNews" id="frmCategoryNews" method="POST" action="" enctype="multipart/form-data">
                <?php if (!empty($cat_news_errors)): ?>
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
                        <?php if (!empty($language_type)): ?>
                            <?php foreach ($language_type as $k => $v): ?>
                                <option value="<?php echo $k ?>" <?php if (!empty($params['language_type']) && $params['language_type'] == $k) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('CAT_NEWS_NAME') ?><span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control noEnter" id="name" value="<?php if (!empty($params['name'])) echo html_escape($params['name']) ?>" maxlength="255" />
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('SLUG') ?></label>
                    <input type="text" name="slug" class="form-control noEnter" id="slug" value="<?php if (!empty($params['slug'])) echo html_escape($params['slug']) ?>" maxlength="255" />
                </div>
                <div class="form-group">
                    <img src="<?php echo base_url('common/multidata/cat_news'.'/'.$avatar)  ;?>">
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <input  type="file" name="avatar"  class="" accept="image/*"/>
                </div>

                <div class="form-group">
                    <label>Hiển thị trang chủ</label>
                    <input style="margin-left: 20px" type="checkbox" name="is_home" value="1" <?php echo !empty($params['is_home']) ? 'checked="checked"' : '' ?> />
                </div>

                <div class="form-group position">
                    <label><?php echo $this->lang->line('CAT_NEWS_POSITION') ?></label>
                    <select name="position" class="form-control">
                        <option value="">&nbsp;</option>
                        <?php if (!empty($position)): ?>
                            <?php foreach ($position as $key => $value): ?>
                                <option value="<?php echo $key ?>" <?php if (!empty($params['position']) && $params['position'] == $key) echo 'selected' ?>><?php echo $value ?></option>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-group desSlide">
                    <label>Mô tả ngắn</label><span class="text-danger">*</span>
                    <textarea id="des" name="title" class="form-control noEnter" placeholder="Nhập nội dung mô tả ngắn"><?php echo!empty($params['title']) ? $params['title'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('KEYWORD_SEO') ?></label>
                    <input type="text" name="keyword_seo" class="form-control" id="keyword_seo" value="<?php if (!empty($params['keyword_seo'])) echo html_escape($params['keyword_seo']) ?>" maxlength="255" />
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('DESCRIPTION_SEO') ?></label>
                    <textarea id="des_seo" name="des_seo" class="form-control noEnter" placeholder="Nhập nội dung mô tả ngắn"><?php echo!empty($params['des_seo']) ? $params['des_seo'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="button button-blue">Cập nhật</button>
                    <input type="hidden" name="id" value="<?php echo $params['id']; ?>  " >
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // onload
        if ($('input[name=is_home]').is(':checked')) {
            $('.position').show();
        } else {
            $('.position').hide();
        }

        // on click
        $('input[name=is_home]').on('click', function () {
            if ($(this).is(':checked')) {
                $('.position').show();
            } else {
                $('.position').hide();
            }
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url('common/js/ckfinder/ckfinder.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('title', {customConfig: '../ckeditor/config_seo.js'});
    CKEDITOR.replace('des_seo', {customConfig: '../ckeditor/config_seo.js'});
</script>