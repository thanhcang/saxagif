<div class="row">    
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-pencil"></i> Cập nhật thông tin</h2>
            </div>
            <div class="box-content">
                <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category/updateCategory'.'/'.$catId) ?>" enctype="multipart/form-data">
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
                        <select name="language_type" class="form-control" disabled="disabled">
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
                        <select name="type" class="form-control" disabled="disabled">
                            <?php if(!empty($typeCategory)) : ?>
                                <?php foreach($typeCategory as $key=>$value): ?>
                                    <option value="<?php echo $key?>" <?php echo (!empty($param['type']) && $key == $param['type']) ? 'selected' :''; ?> ><?php echo $value?></option>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <?php if (!empty($param['type']) && $param['type'] == 2 ): ?>
                    <div class="form-group">
                        <label>Hiển thị trang chủ</label>
                        <input value="1" name="is_home" type="checkbox" <?php echo !empty($param['is_home']) ? 'checked' : ''; ?> />
                    </div>
                    <?php endif ?>
                    <?php if (!empty($param['type']) && $param['type'] == 2  ) : ?>
                    <div class="form-group">
                        <label>Hình slideshow</label>
                        <input type="file" name="event_img" />
                    </div>
                    <?php endif ?>
                    <?php if (!empty($event_img) && !empty($param['type']) && $param['type'] == 2) : ?>
                    <div class="form-group">                        
                        <div>
                            <img src="<?php echo base_url('common/multidata/slide'.'/'.$event_img)?>" />
                        </div>
                    </div>
                    <?php endif ?>
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
                        <input type="hidden" value="<?php echo $param['id']?>" name="id" />
                        <a href="<?php echo base_url('category'); ?>"><button type="button" class="button button-blue">Trở về</button></a>
                        <button type="submit" class="button button-blue">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>



