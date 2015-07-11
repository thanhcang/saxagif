<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-pencil"></i> Cập nhật thông tin</h2>
            </div>
            <div class="box-content">
                <form action="<?php echo(base_url('user/edit'.'/'.$user_id)); ?>" method="post" id="frmAddNewUser" enctype="multipart/form-data">
                    <div class="form-group <?php echo !empty($error)?'' : 'hide'; ?> red" id="error">
                        <?php if(!empty($error)): ?>
                        <?php foreach($error as $key) : ?>
                            <?php echo $key.'<br/>'; ?>
                        <?php endforeach;?>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control"  placeholder="Nhập tên đăng nhập" maxlength="60" value="<?php echo !empty($param['username']) ? $param['username'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputSlug">Mật khẩu</label>
                        <input type="password" name="password" class="form-control"  placeholder="Nhập Mật khẩu" value="system123456Abc">
                    </div>
                    <div class="form-group">
                        <label>Họ</label>
                        <input type="text" name="first_name" class="form-control"  placeholder="Nhập Họ" maxlength="20" value="<?php echo !empty($param['first_name']) ? $param['first_name'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Nhập tên" maxlength="20" value="<?php echo !empty($param['last_name']) ? $param['last_name'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Nhập email" value="<?php echo !empty($param['email']) ? $param['email'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>image</label>
                        <div>
                        <?php if (!empty($param['image'])) : ?>
                        <img src="<?php echo base_url('common/img/logo_member'.'/'.$param['image']); ?>" />
                        <?php endif ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="logo" accept="image/*" />
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <?php $per = $this->config->item('permission'); ?>
                        <select name="level" class="form-control" <?php echo !empty($param['level']) && $param['level'] == $key ? 'selected' : '';   ?>>
                            <?php foreach($per as $key=>$value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $user_id?>" />
                    <button type="submit" class="button" id="buttonUpdateNewUser">Cập Nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('common/js/user.js'); ?>"></script>