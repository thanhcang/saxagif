<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/product.css') ?>" />
<script src="<?php echo base_url('common/js/product_new.js'); ?>" /> </script>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $this->lang->line('PRO_ADD_TITLE') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmProduct" id="frmProduct" action="<?php echo base_url('product/add') ?>" method="POST" enctype="multipart/form-data">
                    <?php if(!empty($pro_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($pro_errors as $err): ?>
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
                        <label><?php echo $this->lang->line('PRO_CODE') ?><span class="text-danger">(*)</span></label>
                        <input type="text" name="product_code" class="form-control noEnter" value="<?php if(!empty($params['product_code'])) echo htmlspecialchars($params['product_code']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_NAME') ?><span class="text-danger">(*)</span></label>
                        <input type="text" name="name" class="form-control noEnter" value="<?php if(!empty($params['name'])) echo htmlspecialchars($params['name']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('SLUG') ?></label>
                        <input type="text" name="slug" id="slug" class="form-control noEnter" value="<?php if(!empty($params['slug'])) echo htmlspecialchars($params['slug']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_PRICE') ?></label>
                        <input type="text" name="price" id="price" class="form-control noEnter" value="<?php if(!empty($params['price'])) echo htmlspecialchars($params['price']) ?>" maxlength="20" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_IMAGE') ?></label>
                        <input id="imageProduct" type="file" name="image[]" multiple="multiple" accept="image/*"  value="" maxlength="" />
                    </div>
                    <div class="form-group hide" id="imagePreview">
                    </div>
                    <div class="form-group">
                        <label><?php echo 'Loại danh mục' ?> <span class="text-danger">(*)</span></label>
                        <select name="type" id="cat_id" class="form-control input-sm">
                            <option value="">&nbsp;</option>
                            <?php foreach ($typeCategory as $key => $value) : ?> 
                            <option value="<?php echo $key?>"><?php echo $value ?></option>
                            <?php endforeach ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_BOOK_LIMIT') ?></label>
                        <input name="book_limit" class="form-control noEnter" value="<?php if(!empty($params['book_limit'])) echo htmlspecialchars($params['book_limit']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_DELIVERY_DAYS') ?></label>
                        <input name="delivery_days" class="form-control noEnter" value="<?php if(!empty($params['delivery_days'])) echo htmlspecialchars($params['delivery_days']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group cont-giftset">
                        <label>
                            <?php echo $this->lang->line('PRO_DISTRIBUTION') ?>
                            <button type="button" id="add-giftset">+</button>
                        </label>
                        <input name="pro_distribution" id="giftset" class="form-control noEnter giftset" value="<?php if(!empty($params['pro_distribution'])) echo htmlspecialchars($params['pro_distribution']) ?>" maxlength="300" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_DESCRIPTION') ?></label>
                        <textarea id="textdescription" name="description" class="form-control re_opinion noEnter" cols="40" rows="4"><?php if(!empty($params['description'])) echo htmlspecialchars($params['description']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_CONTENT') ?></label>
                        <textarea name="content" id="textcontent" class="form-control re_opinion noEnter"><?php if(!empty($params['content'])) echo htmlspecialchars($params['content']) ?></textarea>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="promotion" value="1">
                            <?php echo $this->lang->line('PRO_CHOOSE_PROMOTION') ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_KEYWORD_SEO') ?></label>
                        <input name="keyword_seo" class="form-control noEnter" value="<?php if(!empty($params['keyword_seo'])) echo htmlspecialchars($params['keyword_seo']) ?>" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_DES_SEO') ?></label>
                        <textarea class="noEnter form-control des_seo"><?php if(!empty($params['des_seo'])) echo htmlspecialchars($params['des_seo']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="product_id" value="<?php if (!empty($params['product_id'])) echo $params['product_id'] ?>" />
                        <button type="submit" class="button"><?php echo $this->lang->line('SAVE') ?></button>
                        <button type="reset" class="button" ><?php echo $this->lang->line('RESET') ?></button>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

<div class="tChildCategory hide">
    <div class="form-group childCategory">
    </div>
</div>

<div id="main_loader" class="hide"></div>

<?php require_once(VIEW_PATH.'templates/popup/_messageDialog.php') ;?>
<script type="text/javascript" src="<?php echo base_url('common/js/ckfinder/ckfinder.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('textcontent', {customConfig: '../ckeditor/config_long.js'});
</script>




