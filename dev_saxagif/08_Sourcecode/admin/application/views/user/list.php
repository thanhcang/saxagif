<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-plus"></i> Tạo mới</h2>
            </div>
            <div class="box-content">
                <form action="" method="post" id="frmAddNewUser" enctype="multipart/form-data">
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
                        <input type="password" name="password" class="form-control"  placeholder="Nhập Mật khẩu" >
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
                    <button type="button" class="button" id="buttonAddNewUser">Tạo mới</button>
                </form>
            </div>
        </div>
    </div>
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Danh sách</h2>
            </div>
            <div class="box-content">
                <DIV CLass="pull-left">
                    <select name="fLevel" <?php echo !empty($param['level']) && $param['level'] == $key ? 'selected' : '';   ?>>
                        <option>chọn quyền</option>
                        <?php foreach($per as $key=>$value): ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php endforeach; ?>
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
                        <col width="20%"/>
                        <col width="10%"/>
                        <col width="25%"/>
                        <col width="30%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên nhân viên</th>
                            <th>Quyền</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list)) : ?>
                        <?php foreach($list as $key=>$value) : ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td class=""><?php echo  $value['first_name'].' '.$value['last_name']; ?></td>
                            <td class=""></td>
                            <td class=""><?php echo  $value['email']; ?></td>
                            <td class="">
                                <a class="btn btn-success currentLogin" href="javascript:;" attUser='<?php echo $value['id']; ?>'>
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>
                                <a class="btn btn-info" href="category_edit.html">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger" href="#">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('common/js/user.js'); ?>"></script>