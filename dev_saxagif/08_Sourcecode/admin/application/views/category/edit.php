<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/category.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/evol.colorpicker.min.css') ?>" />
<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-pencil"></i> <?php echo $this->lang->line('CAT_TITLE_EDIT') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmCategory" id="frmCategory" method="POST" action="<?php echo base_url('category/edit/' . $params['id']) ?>" enctype="multipart/form-data">
                    <?php if(!empty($cat_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($cat_errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                    <div class="control-group">
                        <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                        <div class="controls">
                            <select name="language_type" class="form-control" disabled="disabled">
                                <option value="">&nbsp;</option>
                                <?php if(!empty($language_type)): ?>
                                    <?php foreach ($language_type as $k=>$v): ?>
                                        <option value="<?php echo $k ?>" <?php echo (!empty($params['language_type']) &&  $params['language_type'] == $k ) ?  'selected' :''; ?>> <?php echo $v; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="name"><?php echo $this->lang->line('CAT_NAME') ?><span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control noEnter" value="<?php if( !empty($params['name'])) echo htmlspecialchars($params['name']) ; else echo ''; ?>" maxlength="255" />
                    </div>
                    <div class="control-group">
                        <label for="slug"><?php echo $this->lang->line('SLUG') ?></label>
                        <input type="text" name="slug" id="slug" class="form-control" class="" value="<?php  if(!empty($params['slug'])) echo htmlspecialchars($params['slug']) ; else echo ''; ?>" maxlength="255" placeholder="slug( URL Seo )" />
                    </div>
                    <div class="form-group">
                        <label>Mô tả ngắn</label>
                        <textarea placeholder="Nhập nội dung mô tả ngắn" class="form-control" name="note"><?php  if(!empty($params['note'])) echo htmlspecialchars($params['note']) ; else echo ''; ?></textarea>
                    </div>
                    <div class="control-group bg_color">
                        <label for="bg_color"><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?></label>
                        <input type="text" name="bg_color" id="bg_color" readonly="readonly" class="form-control noEnter" value="<?php  echo !empty($params['bg_color']) ? htmlspecialchars($params['bg_color']) :''   ?>" maxlength="7" />
                    </div>
                    <div class="control-group">
                        <label for="logo"><?php echo $this->lang->line('CAT_LOGO') ?></label>
                        <input type="file" name="logo"  accept="image/*"  id="logo" />
                    </div>
                    
                    <?php if(!empty($logo)) :?>
                    <div class="control-group">
                        <div style=" margin: 5px 0">
                            <img src="<?php echo base_url('common/multidata/cat_logo'.'/'.$logo); ?>" />
                        </div>
                    </div>
                    <?php endif ?>
                                      
<!--                    <div class="form-group">
                        <label><?php echo $this->lang->line('CAT_PARENT') ?></label>
                        <div class="controls">
                            <select name="parent" class="form-control">
                                <option value="">&nbsp;</option>
                                <?php foreach($parent as $key): ?>
                                <option value="<?php echo $key['id']; ?>" <?php echo (!empty($params['parent']) && $params['parent'] == $key['id']) ? 'selected' : '' ; ?>> <?php echo $key['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>-->
                    <div class="control-group">
                        <label for="keyword_seo"><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?></label>
                        <input type="text" name="keyword_seo" id="keyword_seo" class="form-control noEnter" value="<?php echo (!empty($params['keyword_seo'])) ?  htmlspecialchars($params['keyword_seo']) : ''; ?>" maxlength="255" />
                    </div>
                    <div class="control-group">
                        <label for="des_seo"><?php echo $this->lang->line('CAT_DES_SEO') ?></label>
                        <textarea name="des_seo" class="form-control noEnter"><?php echo (!empty($params['des_seo'])) ? htmlspecialchars($params['des_seo']) : ''  ?></textarea>
                    </div>
                    <input type="hidden" value="<?php echo $params['id'] ?>" name="id" />
                    <button type="submit" class="button martopten pull-right"><?php echo $this->lang->line('EDIT') ?></button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('common/js/evol.colorpicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>

