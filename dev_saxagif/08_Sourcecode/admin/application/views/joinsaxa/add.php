<div class="row">
<div class="box col-md-8">
    <div class="box-inner">
        <div class="box-header well">
            <h2><i class="glyphicon glyphicon-plus"></i> Thêm mới</h2>
        </div>
        <div class="box-content">
            <form method="POST" action="<?php echo base_url('joinSaxa/add'); ?>" enctype="multipart/form-data">
                <?php if(!empty($error)): ?>
                <div class="form-group error">
                        <ul>
                            <?php foreach ($error as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
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
                    <label>Vị trí<span class="text-danger">*</span></label>
                    <input type="text" name="name" value="<?php if (!empty($params['name'])) echo html_escape($params['name']) ?>" class="noEnter form-control" />
                </div>
                
                <div class="form-group">
                    <label>Số lượng <span class="text-danger">( * )</span></label>
                    <input type="text" name="number" value="<?php if (!empty($params['number'])) echo html_escape($params['number']) ?>"  class="noEnter form-control" />
                </div>
                
                <div class="form-group">
                    <label>Mô tả ngắn <span class="text-danger">( * )</span></label>
                    <textarea placeholder="Mô tả ngắn" class="form-control" name="des"><?php if (!empty($params['des'])) echo html_escape($params['des']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Ảnh đại diện<span class="text-danger"> ( * )</span></label>
                    <input type="file" name="logo"  accept="image/*" class="noEnter" id="logo" />
                </div>
                
                <div class="form-group">
                    <label>Công việc<span class="text-danger"> ( * )</span></label>
                    <textarea placeholder="Công việc" class="form-control" name="work"><?php if (!empty($params['work'])) echo html_escape($params['work']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>nội dung<span class="text-danger"> ( * )</span></label>
                    <textarea placeholder="Nội dung" class="form-control" name="content"><?php if (!empty($params['content'])) echo html_escape($params['content']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Yêu cầu <span class="text-danger"> ( * )</span></label>
                    <textarea placeholder="Yêu cầu" class="form-control" name="issue"><?php if (!empty($params['issue'])) echo html_escape($params['issue']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Quyền lợi<span class="text-danger"> ( * )</span></label>
                    <textarea placeholder="Quyền lợi" class="form-control" name="right"><?php if (!empty($params['right'])) echo html_escape($params['right']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="button button-blue"><?php echo $this->lang->line('CREATE') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>