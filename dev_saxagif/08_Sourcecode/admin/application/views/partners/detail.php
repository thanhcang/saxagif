<!-- content starts -->
<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> View</h2>
            </div>
            <div class="box-content">
                <form>
                    <div class="form-group">
                        <label for="inputName"><?php echo $this->lang->line('NAME') ?></label>
                        <input type="text" class="form-control" id="inputName" placeholder="Name" value="<?php echo htmlspecialchars($detailPar['name']) ?>" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="inputFile"><?php echo $this->lang->line('LOGO') ?></label>
                        <?php if(!empty($detailPar['logo']) && file_exists( IMAGE_PARTNERS_PATH . $detailPar['logo'])): ?>
                            <span class="eidt_img_ca"><img src="<?php echo base_url('common/img/partners'.'/'.$detailPar['logo'] ) ?>" /></span>
                        <?php else: ?>
                            <span class="eidt_img_ca"><img src="<?php echo base_url('common/img/partners'.'/' . 'no-img.png' ) ?>" /></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail"><?php echo $this->lang->line('EMAIL') ?></label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="" value="<?php if(!empty($detailPar['email'])) echo $detailPar['email'] ?>" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="keyPhone"><?php echo $this->lang->line('PHONE') ?></label>
                        <input type="text" class="form-control" id="keyPhone" placeholder="" value="<?php if($detailPar['phone']) echo $detailPar['phone'] ?>" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="inputURL"><?php echo $this->lang->line('URL') ?></label>
                        <input type="text" class="form-control" id="inputURL" placeholder="" value="<?php if(!empty($detailPar['url'])) echo $detailPar['url'] ?>" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="keyAddress"><?php echo $this->lang->line('ADDRESS') ?></label>
                        <input type="text" class="form-control" id="keyAddress" placeholder="" value="<?php if(!empty($detailPar['address'])) echo $detailPar['address'] ?>" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="keyNote"><?php echo $this->lang->line('NOTE') ?></label>
                        <textarea class="re_opinion form-control"  disabled="disabled"><?php if(!empty($detailPar['note'])) echo htmlspecialchars($detailPar['note']) ?></textarea>
                    </div>
                    <a href="<?php echo base_url('partners/edit/' . $detailPar['id']) ?>" class="button"><?php echo $this->lang->line('EDIT') ?></a>
                    <a href="<?php echo base_url('partners');?>"><button type="button" class="button btnBack"><?php echo $this->lang->line('BACK') ?></button></a>
                </form>
            </div>
        </div>
    </div>

</div><!--/row-->