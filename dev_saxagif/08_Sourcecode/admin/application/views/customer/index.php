<link rel="stylesheet" type="text/css" href="<?php echo base_url('common/css/customer.css') ?>" />
<!-- content starts -->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() ?>"><?php echo $this->lang->line('HOME') ?></a>
        </li>
        <li>
            <a href="<?php echo base_url('customer') ?>"><?php echo $this->lang->line('CUS_MANAGEMENT') ?></a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?php echo $this->lang->line('') ?>Danh sách khách hàng</h2>
            </div>
            <div class="box-content">
                <DIV CLass="pull-left">
                    <select>
                        <option>all dates</option>
                    </select>
                    <select>
                        <option>all category</option>
                    </select>
                    <button type="button">Filter</button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="25%"/>
                        <col width="20%"/>
                        <col width="10%"/>
                        <col width="20%"/>
                        <col width="20%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('CUS_NAME') ?></th>
                            <th><?php echo $this->lang->line('PHONE') ?></th>
                            <th><?php echo $this->lang->line('EMAIL') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listCustomer)):
                            $num = 1;
                            foreach ($listCustomer as $cus):
                        ?>
                            
                        <tr>
                            <td><?php echo $num ?></td>
                            <td class=""><?php echo htmlspecialchars(ucwords($cus['name'])) ?></td>
                            <td class=""><?php if(!empty($cus['phone_number'])) echo $cus['phone_number'] ?></td>
                            <td class="">
                                <?php if(!empty($cus['email_address'])): ?>
                                <a href="mailto:<?php echo $cus['email_address'] ?>"><?php echo $cus['email_address'] ?></a>
                                <?php endif ?>
                            </td>
                            <td class="">
                                <a class="btn btn-success btn-setting" href="<?php echo base_url('customer/detail/' . $cus['id']) ?>">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    <?php echo $this->lang->line('VIEW') ?>
                                </a>
                                <a class="btn btn-info" href="<?php echo base_url('customer/edit/' . $cus['id']) ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    <?php echo $this->lang->line('EDIT') ?>
                                </a>
                                <a class="btn btn-danger" href="javascript:;" attr_cus="<?php echo base64_encode($cus['id']) ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    <?php echo $this->lang->line('DELETE') ?>
                                </a>
                            </td>
                        </tr>
                        <?php
                            $num++;
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/row-->
<!-- content ends -->
<script type="text/javascript" src="<?php echo base_url('common/js/category.js') ?>"></script>