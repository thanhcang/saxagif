
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.html"><?php echo $this->lang->line('HOME') ?></a>
        </li>
        <li>
            <a href="index.html"><?php echo $this->lang->line('CUS_MANAGEMENT') ?></a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('EDIT') ?></h2>
            </div>
            <div class="box-content">
                <form name="frmCustomer" id="frmCustomer" method="POST" action="<?php echo base_url('customer/edit/' . $detailCus['id']) ?>">
                    <?php if(!empty($cus_errors)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($cus_errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                    <div class="control-group">
                        <label for="name"><?php echo $this->lang->line('CUS_NAME') ?></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php if(empty($params['name'])) echo htmlspecialchars($detailCus['name']); elseif(!empty ($params['name'])) echo htmlspecialchars($params['name']) ?>">
                    </div>
                    <div class="control-group">
                        <label for="birthday"><?php echo $this->lang->line('BIRTHDAY') ?></label>
                        <input type="text" name="birthday" class="form-control" id="inputSlug" value="<?php if(!empty($detailCus['birthday']) && empty($params['birthday'])) echo date('d/m/Y', strtotime($detailCus['birthday'])); elseif(!empty ($params['birthday'])) echo $params['birthday'] ?>" placeholder="<?php echo $this->lang->line('BIRTHDAY') ?>">
                    </div>
                    <div class="control-group">
                        <label for="sex"><?php echo $this->lang->line('SEX') ?></label>
                        <input type="text" name="sex" class="form-control" id="sex" value="<?php if(!empty($detailCus['sex']) && empty($params['sex'])) echo $detailCus['sex'];elseif (!empty ($params['sex'])) echo $params['sex'] ?>" placeholder="<?php echo $this->lang->line('SEX') ?>">
                    </div>
                    <div class="control-group">
                        <label for="company_name"><?php echo $this->lang->line('CUS_COMPANY_NAME') ?></label>
                        <input type="text" name="company_name" class="form-control" id="company_name" value="<?php if(!empty($detailCus['company_name']) && empty($params['company_name'])) echo $detailCus['company_name'];elseif (!empty ($params['company_name'])) echo $params['company_name'] ?>" placeholder="<?php echo $this->lang->line('CUS_COMPANY_NAME') ?>">
                    </div>
                    <div class="control-group">
                        <label for="address"><?php echo $this->lang->line('ADDRESS') ?></label>
                        <input type="text" class="form-control" id="address" value="<?php if(!empty($detailCus['address']) && empty($params['address'])) echo $detailCus['address'];elseif (!empty ($params['address'])) echo $params['address'] ?>" placeholder="<?php echo $this->lang->line('ADDRESS') ?>">
                    </div>
                    <div class="control-group">
                        <label for="email_address"><?php echo $this->lang->line('EMAIL') ?></label>
                        <input type="text" name="email_address" class="form-control" id="email_address" value="<?php if(!empty($detailCus['email_address']) && empty($params['email_address'])) echo $detailCus['email_address'];elseif (!empty ($params['email_address'])) echo $params['email_address'] ?>" placeholder="<?php echo $this->lang->line('EMAIL') ?>">
                    </div>
                    <div class="control-group">
                        <label for="phone_number"><?php echo $this->lang->line('PHONE') ?></label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" value="<?php if(!empty($detailCus['phone_number']) && empty($params['phone_number'])) echo $detailCus['phone_number'];elseif (!empty ($params['phone_number'])) echo $params['phone_number'] ?>" placeholder="<?php echo $this->lang->line('PHONE') ?>">
                    </div>
                    <input type="hidden" name="customer_id" value="<?php echo $detailCus['id'] ?>" />
                    <button type="submit" class="button martopten pull-right"><?php echo $this->lang->line('SAVE') ?></button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div><!--/row-->
<!-- content ends -->