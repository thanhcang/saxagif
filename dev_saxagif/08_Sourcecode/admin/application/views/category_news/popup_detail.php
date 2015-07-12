<div class="modal fade" id="detailCatNewsModal" tabindex="-1" role="dialog" aria-labelledby="profileModallLabel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Thông tin danh mục</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-content">
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('CAT_NEWS_NAME') ?>:</label>
                                    <span class="catNewsName"></span>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('SLUG') ?>:</label>
                                    <span class="catNewsSlug"></span>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('CAT_NEWS_POSITION') ?>:</label>
                                    <span class="catNewsPosition"></span>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('KEYWORD_SEO') ?>:</label>
                                    <span class="catNewsKeyWord"></span>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('DESCRIPTION_SEO') ?>:</label>
                                    <span class="catNewsDes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/row-->
            </div>
            <div class="modal-footer">
                <a href="javascript:;" data-dismiss="modal"><button type="button" class="button">Close</button></a>
                <a href="javascript:;" id="catLink"><button type="button" class="button">Edit</button></a>
            </div>
        </div>
    </div>
</div>

