<div class="category_foot">
    <label><?php echo $this->lang->line('product_category') ?></label>
    <?php if(!empty($cat_menu)): ?>
    <?php foreach($cat_menu as $cat): ?>
    <?php if($cat['parent'] == '0'): ?>
    <div class="category">  
        <ul>
            <li class="header_cate"><?php echo htmlspecialchars($cat['name']) ?></li>
        <?php foreach ($cat_menu as $cat_child): ?>
            <?php if($cat_child['parent'] == $cat['id']): ?>
            <li><a href="<?php echo base_url($cat['slug'].'/'.$cat_child['slug']) ?>"><?php echo htmlspecialchars($cat_child['name']) ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif ?>
    <?php endforeach ?>
    <?php endif ?>
</div>