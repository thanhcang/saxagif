<style>
    .line{ border-top: 3px solid #35a6e7; padding:10px 0 10px 0px; }
</style>
<!-- content starts -->
<div class="row">
    <form name="frmReview" id="frmReview" method="POST" action="<?php echo base_url('news/add') ?>">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="glyphicon glyphicon-list-alt"></i><?php echo $this->lang->line('VIEW') ?></h2>
                </div>
                <div class="box-content">
                    <p><label>Ngôn ngữ:</label> <?php if(!empty($params['language_type']) && !empty($language_type[$params['language_type']])) echo $language_type[$params['language_type']]  ?></p>
                    <p><label>Slug:</label> <?php if(!empty($params['txtSlug'])) echo htmlspecialchars($params['txtSlug']) ?></p>
                    <p><label>Vị trí hiển thị:</label> <?php if(!empty($params['position']) && !empty($position[$params['position']])) echo $position[$params['position']] ?></p>
                    <p><label>Danh mục tin:</label> <?php if(!empty($catNewsDetail['name'])) echo htmlspecialchars($catNewsDetail['name']) ?></p>
                    <p><label>Keyword seo:</label> <?php if(!empty($params['txtKeySeo'])) echo htmlspecialchars($params['txtKeySeo']) ?></p>
                    <p><label>Description seo:</label> <?php if(!empty($params['txtDesSeo'])) echo htmlspecialchars($params['txtDesSeo']) ?></p>

                    <div class="line"></div>
                    <div class="cont_news">
                        <label><?php echo htmlspecialchars($params['txtTitle']) ?></label>
                        <?php if(!empty($params['description'])) echo $params['description'] ?>
                        <p>
                            <?php if(!empty($params['content'])) echo $params['content'] ?>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <input type="hidden" name="language_type" value="<?php echo $params['language_type'] ?>" />
                    <input type="hidden" name="txtTitle" value="<?php if(!empty($params['txtTitle'])) echo htmlspecialchars($params['txtTitle']) ?>" />
                    <input type="hidden" name="txtSlug" value="<?php if(!empty($params['txtSlug'])) echo htmlspecialchars($params['txtSlug']) ?>" />
                    <input type="hidden" name="avatar" value="<?php if(!empty($params['avatar'])) echo $params['avatar'] ?>" />
                    <input type="hidden" name="position" value="<?php if(!empty($params['position'])) echo (int)$params['position'] ?>" />
                    <input type="hidden" name="catNews" value="<?php if(!empty($params['catNews'])) echo (int)$params['catNews'] ?>" />
                    <input type="hidden" name="txtKeySeo" value="<?php if(!empty($params['txtKeySeo'])) echo htmlspecialchars ($params['txtKeySeo']) ?>" />
                    <input type="hidden" name="txtDesSeo" value="<?php if(!empty($params['txtDesSeo'])) echo htmlspecialchars($params['txtDesSeo']) ?>" />
                    <input type="hidden" name="description" value="<?php if(!empty($params['description'])) echo htmlspecialchars($params['description']) ?>" />
                    <input type="hidden" name="content" value="<?php if(!empty($params['content'])) echo htmlspecialchars($params['content']) ?>" />
                    <div class="line"></div>
                    <button type="button"  class="button reviewNews">Hủy</button>
                    <button type="submit" class="button"><?php echo $this->lang->line('SAVE') ?></button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </form>
</div><!--/row-->
<!-- content ends -->