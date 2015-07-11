<!-- content starts -->
<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-pencil"></i> Cập nhật thông tin</h2>
            </div>
            <div class="box-content">
                <form name="frmPartners" id="frmPartners" action="<?php echo base_url('partners/edit/' . $detailPar['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?php if(!empty($par_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($par_errors as $err): ?>
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
                        <label for="inputName"><?php echo $this->lang->line('NAME') ?></label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php if(empty($params['name'])) echo htmlspecialchars($detailPar['name']); elseif(!empty ($params['name'])) echo htmlspecialchars($params['name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputFile"><?php echo $this->lang->line('LOGO') ?></label>
                        <div>
                            <?php if(!empty($detailPar['logo']) && file_exists( IMAGE_PARTNERS_PATH . $detailPar['logo'])): ?>
                                <span class="eidt_img_ca"><img src="<?php echo base_url('common/img/partners'.'/' . $detailPar['logo'] ) ?>" /></span>
                            <?php else: ?>
                                <span class="eidt_img_ca"><img src="<?php echo base_url('common/img/partners'.'/' . 'no-img.png' ) ?>" /></span>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="logo"  accept="image/*"  id="logo" />
                    </div>
                    <div class="form-group">
                        <label for="inputEmail"><?php echo $this->lang->line('EMAIL') ?></label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="" value="<?php if(!empty($detailPar['email']) && empty($params['email']) ) echo $detailPar['email']; elseif(!empty ($params['email'])) echo $params['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyPhone"><?php echo $this->lang->line('PHONE') ?></label>
                        <input type="text" name="phone" class="form-control" id="keyPhone" placeholder="" value="<?php if($detailPar['phone'] && empty($params['phone']) ) echo $detailPar['phone']; elseif(!empty ($params['phone'])) echo $params['phone'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputURL"><?php echo $this->lang->line('URL') ?></label>
                        <input type="text" name="url" class="form-control" id="inputURL" placeholder="" value="<?php if(!empty($detailPar['url']) && empty($params['url'])) echo $detailPar['url']; elseif(!empty ($params['url'])) echo htmlspecialchars($params['url']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyAddress"><?php echo $this->lang->line('ADDRESS') ?></label>
                        <input type="text" name="address" class="form-control" id="keyAddress" placeholder="" value="<?php if(!empty($detailPar['address']) && empty($params['address'])) echo $detailPar['address']; elseif(!empty ($params['address'])) echo htmlspecialchars($params['address']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyNote"><?php echo $this->lang->line('NOTE') ?></label>
                        <textarea name="note" class="re_opinion form-control"><?php if(!empty($detailPar['note']) && empty($params['note'])) echo htmlspecialchars($detailPar['note']); elseif(!empty($params['note'])) echo htmlspecialchars($params['note']) ?></textarea>
                    </div>
                    <input type="hidden" name="partners_id" value="<?php echo $detailPar['id'] ?>" />
                    <button type="submit" class="button"><?php echo $this->lang->line('SAVE') ?></button>
                </form>
            </div>
        </div>
    </div>

</div><!--/row-->