<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/product.css') ?>" />
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.html">Home</a>
        </li>
        <li>
            <a href="index.html">Category</a>
        </li>
        <li>
            <a href="index.html">Quà tặng công nghệ</a>
        </li>
        <li>
            <a href="index.html">USB</a>
        </li>
        <li>
            <a href="index.html">USB1</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Edit</h2>
            </div>
            <div class="box-content">
                <form name="frmProduct" id="frmProduct" method="POST" action="<?php echo base_url('product/edit/' . $detailPro['id']) ?>">
                    <div class="form-group">
                        <label for="inputID"><?php echo $this->lang->line('PRO_CODE') ?></label>
                        <input type="text" name="product_code" id="code" class="form-control" id="inputID" value="<?php echo htmlspecialchars($detailPro['product_code']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="name"><?php echo $this->lang->line('PRO_NAME') ?></label>
                        <input type="text" name="name" id="name" class="form-control" id="inputName" value="<?php echo htmlspecialchars($detailPro['name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug"><?php echo $this->lang->line('SLUG') ?></label>
                        <input type="text" name="slug" id="slug" class="form-control" id="inputName" value="<?php if(!empty($detailPro['slug'])) echo htmlspecialchars($detailPro['slug']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPrice"><?php echo $this->lang->line('PRO_PRICE') ?></label>
                        <input type="text" name="price" id="price" class="form-control" id="inputPrice" value="<?php if(!empty($detailPro['price'])) echo trim($detailPro['price']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputFile"><?php echo $this->lang->line('PRO_IMAGE') ?></label>
                        <span class="eidt_img_ca">
                            <?php if(!empty($detailPro['product_image']) && file_exists(IMAGE_THUMB_PRODUCT_PATH . $detailPro['product_image'][0]['name']) ): ?>
                            <img src="<?php echo base_url(IMAGE_THUMB_PRODUCT_PATH . $detailPro['product_image'][0]['name']) ?>"/>
                            <?php endif ?>
                        </span>
                        <input type="file" name="image[]" multiple="multiple" accept="image/*" class="form-control input-sm" value="" maxlength="">
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_CAT') ?></label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">&nbsp;</option>
                        <?php if(!empty($listCat)): ?>
                        <?php foreach ($listCat as $row): ?>
                            <?php if($row['parent'] === "0"): ?>
                            <optgroup label="<?php echo ucwords($row['name']) ?>">
                                <?php foreach ($listCat as $row1): ?>
                                <?php if($row1['parent'] !== "0" && $row1['parent'] == $row['id']): ?>
                                <option value="<?php echo $row1['id'] ?>" <?php if(empty($params['cat_id']) && $detailPro['cat_id'] == $row1['id'] ) echo 'selected' ;elseif(!empty($params['cat_id']) && $params['cat_id'] == $row1['id'] ) echo 'selected' ?>><?php echo ucfirst($row1['name']) ?></option>
                                <?php endif; ?>
                                <?php endforeach ?>
                            </optgroup>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputTimeTransfer"><?php echo $this->lang->line('PRO_DELIVERY_DAYS') ?></label>
                        <input type="text" name="elivery_days" class="form-control" id="inputTimeTransfer" value="<?php if (!empty($detailPro['delivery_days'])) echo htmlspecialchars($detailPro['delivery_days']) ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_DESCRIPTION') ?></label>
                        <textarea class="re_opinion" name="description" id="description"><?php if (!empty($detailPro['description'])) echo htmlentities($detailPro['description']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_CONTENT') ?></label>
                        <textarea class="re_opinion" name="content" id="content"><?php if (!empty($detailPro['content'])) echo htmlentities($detailPro['content']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('PRO_DISTRIBUTION') ?></label>
                        <div class="attach_product">
                            <ul>
                               <?php if (!empty($detailPro['giftset'])): ?>
                                <?php foreach($detailPro['giftset'] as $giftset): ?>
                                <li>
                                    <?php if(!empty($giftset['product_img']) && file_exists( IMAGE_THUMB_PRODUCT_PATH . $giftset['product_img'])): ?>
                                        <img src="<?php echo base_url( IMAGE_THUMB_PRODUCT_PATH . $giftset['product_img'] ) ?>" />
                                    <?php else: ?>
                                        <img src="<?php echo base_url( IMAGE_PATH . 'no-img.png' ) ?>" />
                                    <?php endif ?>
                                        <div class="icon_del" attr_giftset="<?php echo base64_encode($detailPro['id'] . '_' . $giftset['id']) ?>"><img src="<?php echo base_url('common/images/icon_del.png') ?>"/></div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif ?>
                                
                            </ul>
                            <button type="button" class="button"><?php echo $this->lang->line('PRO_ADD_GIFTSET') ?></button>
                            <div class="form-group search_attach">
                                <input type="text" class="form-control search_attach" id="search_attach">
                                <span class="glyphicon glyphicon-search icon_search"></span>
                                <div class="glyphicon glyphicon-plus icon_plus"></div>
                            </div>
                            <div class="form-group search_attach">
                                <input type="text" class="form-control search_attach" id="search_attach">
                                <span class="glyphicon glyphicon-search icon_search"></span>
                                <span class="glyphicon glyphicon-plus icon_plus"></span>
                            </div>
                            <div class="form-group search_attach">
                                <input type="text" class="form-control search_attach" id="search_attach">
                                <span class="glyphicon glyphicon-search icon_search"></span>
                                <span class="glyphicon glyphicon-plus icon_plus"></span>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="promotion" value="1" <?php if(!empty($detailPro['promotion'])) echo 'checked' ?>>
                            <?php echo $this->lang->line('PRO_CHOOSE_PROMOTION') ?>
                        </label>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $detailPro['id'] ?>" />
                    <button type="submit" class="button btn-save"><?php echo $this->lang->line('SAVE') ?></button>
                </form>
            </div>
        </div>
    </div>
</div><!--/row-->
<script type="text/javascript" src="<?php echo base_url('common/js/tinymce/tinymce.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/product.js') ?>"></script>