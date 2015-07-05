<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex,nofollow" />
    <title><?php echo empty($page_title) ? DEFAULT_TITLE : $page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
        $css_path = $this->config->item('css_path');
        $js_path = $this->config->item('js_path');
        // css
        foreach ($css_path as $key) {
            echo link_tag($key);
        }
        // js
        foreach ($js_path as $key) {
            echo '<script src="'.base_url($key).'"></script>';
        }
    ?>
    <script src="<?php echo base_url('/common/js/forgetpassword.js') ?>"></script>
</head>
<body>
    <div class="ch-container">
        <div class="row">

            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2>Quên mật khẩu</h2>
                </div>
                <!--/span-->
            </div><!--/row-->

            <div class="row">
                <div class="well col-md-5 center login-box">
                    <div class="alert alert-info <?php echo !empty($error) ? '' : 'hide'; ?>">
                    <?php if(!empty($error)): ?>
                        <?php foreach($error as $key): ?>
                            <?php echo $key.'<br />' ?>
                        <?php endforeach;?>
                    <?php endif ;?>
                    </div>
                    <form id="frmForgetPassword" class="form-horizontal" action="<?php echo base_url('login/forgetpassword');?>" method="post">
                        <fieldset>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                                <input type="text" name="email" class="form-control" placeholder="Nhập Email" value="<?php echo !empty($param['email']) ? $param['email'] : ''; ?>">
                            </div>
                            <div class="clearfix"></div><br>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                                <input type="text" name="reEmail" class="form-control" placeholder="Nhập lại Email" value="<?php echo !empty($param['email']) ? $param['email'] : ''; ?>">
                            </div>
                            <div class="clearfix"></div>
                            <p class="center col-md-5">
                                <button id="submitButton" type="button" class="btn btn-primary">Gởi</button>
                                <input type="hidden" name="form_email_forget" value="<?php echo $param['form_email_forget']; ?>" />
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
