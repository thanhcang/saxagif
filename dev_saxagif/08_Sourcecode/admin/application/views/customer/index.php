<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?php echo $this->lang->line('') ?>Danh sách khách hàng</h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="25%"/>
                        <col width="35%"/>
                        <col width="35%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th>Tên</th>
                            <th>S.DT</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listCustomer)):?>
                        <?php foreach ($listCustomer as $key => $cus):?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td class=""><?php echo htmlspecialchars(ucwords($cus['name'])) ?></td>
                            <td class=""><?php if(!empty($cus['phone_number'])) echo $cus['phone_number'] ?></td>
                            <td class="">
                                <?php if(!empty($cus['email_address'])): ?>
                                <a href="mailto:<?php echo $cus['email_address'] ?>"><?php echo $cus['email_address'] ?></a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php
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