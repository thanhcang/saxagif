<div class="row">
    <h2><?php echo $this->lang->line('PRO_TITLE_DETAIL') ?></h2>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_CODE') ?>:</label>
        <?php echo htmlspecialchars($detailPro['product_code']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_NAME') ?>:</label>
        <?php echo htmlspecialchars($detailPro['name']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('SLUG') ?>:</label>
        <?php echo htmlspecialchars($detailPro['slug']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_PRICE') ?>:</label>
        <?php if(!empty($detailPro['price'])) echo number_format($detailPro['price']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_KEYWORD_SEO') ?>:</label>
        <?php if(!empty($detailPro['keyword_seo'])) echo htmlspecialchars($detailPro['keyword_seo']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_DES_SEO') ?>:</label>
        <?php if(!empty($detailPro['des_seo'])) echo htmlspecialchars($detailPro['des_seo']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_DESCRIPTION') ?>:</label>
        <?php if(!empty($detailPro['description'])) echo htmlspecialchars($detailPro['description']) ?>
    </div>
    <div class="control-label">
        <label><?php echo $this->lang->line('PRO_CONTENT') ?>:</label>
        <?php echo $detailPro['content'] ?>
    </div>
</div>
<div class="row">
    <?php if(!empty($detailPro['product_image'])): ?>
    <?php foreach ($detailPro['product_image'] as $row): ?>
    <div class="col-lg-3">
        <div class="image">
        <img src="<?php echo base_url(IMAGE_THUMB_PRODUCT_PATH . $row['name']) ?>" height="200" />
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
<style>
    .image { border:2px solid #CCC; padding:2px;margin:5px; }
</style>


