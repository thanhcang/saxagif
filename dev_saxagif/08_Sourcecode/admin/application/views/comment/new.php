<div class="row">
<div class="box col-md-8">
    <div class="box-inner">
        <div class="box-header well">
            <h2><i class="glyphicon glyphicon-plus"></i> Thêm mới</h2>
        </div>
        <div class="box-content">
            <form method="POST" action="<?php echo base_url('commentCustomer/add'); ?>" enctype="multipart/form-data">
                <?php if (!empty($error)): ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($error as $err): ?>
                                <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('CHOOSE_LANGUAGE') ?></label>
                    <select name="language_type" class="form-control noEnter">
                        <?php if (!empty($language_type)): ?>
                            <?php foreach ($language_type as $k => $v): ?>
                                <option value="<?php echo $k ?>" <?php if (!empty($params['language_type']) && $params['language_type'] == $k) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên khách hàng<span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control input-sm noEnter" value="<?php if (!empty($params['customer_name'])) echo html_escape($params['customer_name']) ?>" />
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <input type="file" name="logo"  accept="image/*" class="noEnter" id="logo" />
                </div>
                
                <div class="form-group">
                    <label>Khách hàng hỏi <span class="text-danger">*</span></label>
                    <textarea placeholder="Nhập câu hỏi" class="form-control" name="question"><?php if (!empty($params['question'])) echo html_escape($params['question']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Saxa trả lời</label>
                    <textarea placeholder="Saxa trả lời" class="form-control" name="answer"><?php if (!empty($params['answer'])) echo html_escape($params['answer']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="button button-blue"><?php echo $this->lang->line('CREATE') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>