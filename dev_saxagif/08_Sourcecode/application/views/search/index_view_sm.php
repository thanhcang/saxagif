<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
<form action="" method="GET">
    <div class="label"><?php echo $this->lang->line('search') ?></div>
    <h5 class="tit_search"><?php echo $this->lang->line('category_search') ?></h5>
    <label class="lbl_search"><?php echo $this->lang->line('input_keyword_search') ?></label>
    <input type="text" name="keyword" value="<?php if(!empty($keyword)) echo htmlspecialchars($keyword) ?>" class="input_search"/>
    <label class="lbl_search"><?php echo $this->lang->line('select_category_search') ?></label>
    <div class="option_search">
        <input type="radio" name="type" <?php if(!empty($type) && $type == TYPE_ARTICLE) echo 'checked' ?> value="<?php echo TYPE_ARTICLE ?>"/><?php echo $this->lang->line('search_article') ?>
        <input type="radio" name="type" <?php if(!empty($type) && $type == TYPE_PRODUCT) echo 'checked' ?> value="<?php echo TYPE_PRODUCT ?>"/><?php echo $this->lang->line('search_product') ?>
        <input type="submit" value="<?php echo $this->lang->line('send') ?>" class="btn_search"/>
        <div class="clearfix"></div>
    </div>
</form>
    <h5 class="tit_search"><?php echo $this->lang->line('search_result') ?></h5>
    <?php if(!empty($search_result) && $type_search == TYPE_ARTICLE ): ?>
    <?php foreach($search_result as $row): ?>
        <div class="cont_tab">
            <div class="img_tab"><a href="<?php echo base_url($row['slug']) ?>">
            <?php if(!empty($row['avatar'])):// && file_exists(base_url('admin/common/multidata/news/' . $row['avatar'])) ?>
                <img src="<?php echo base_url('admin/common/multidata/news/' . $row['avatar']) ?>"/>
            <?php else: ?>
                <img src="<?php echo base_url('common/images/no-img.png') ?>"/>
            <?php endif ?>
            </a></div>
            <div class="main_tab">
                <label><a href="<?php echo base_url($row['slug']) ?>" class="js__p_start"><?php echo html_escape($row['title']) ?></a></label>
                <div class="des_tab">
                    <?php echo htmlspecialchars_decode($row['description']) ?>
                </div>
    
            </div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach ?>
    <?php endif ?>
    
    <?php if(!empty($search_result) && $type_search == TYPE_PRODUCT ): ?>
    <?php foreach($search_result as $row): ?>
        <div class="cont_tab">
            <div class="img_tab">
                <a href="<?php echo base_url($row['slug']) ?>">
                <?php if(!empty($row['pro_img'])): ?>
                    <img src="<?php echo base_url('admin/common/multidata/product_img/' . $row['pro_img']) ?>"/>
                <?php else: ?>
                    <img src="<?php echo base_url('common/images/no-img.png') ?>"/>
                <?php endif ?>
                </a>
            </div>
            <div class="main_tab">
                <label><a href="chi-tiet-bai-viet.html" class="js__p_start"><?php echo html_escape($row['name']) ?></a></label>
                <div class="des_tab">
                    <?php if(!empty($row['description'])) echo _substr($row['description'],200) ?>
                </div>
    
            </div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach ?>
    <?php endif ?>
    <div class="clearfix"></div>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>