<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Tạo mới</h2>
            </div>
            <div class="box-content">
                <form action="" method="post" id="frmAddNewUser">
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="inputSlug">Mật khẩu</label>
                        <input type="password" class="form-control" id="inputSlug" placeholder="Nhập Mật khẩu">
                    </div>
                    <div class="form-group">
                        <label>Họ</label>
                        <input type="text" class="form-control" id="inputColor" placeholder="Nhập Họ ">
                    </div>
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" id="keyGoogle" placeholder="Nhập tên">
                    </div>
                    <div class="form-group">
                        <label>image</label>
                        <input type="file" accept="image/*" />
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <select class="form-control" >
                        </select>
                    </div>
                    <button type="button" class="button" id="buttonAddNewUser">Add new</button>
                </form>
            </div>
        </div>
    </div>
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Category</h2>
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
