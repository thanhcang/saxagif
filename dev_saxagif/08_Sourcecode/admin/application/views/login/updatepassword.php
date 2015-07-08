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
</head>
<body>
    <div class="ch-container">
        <div class="row">

            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2>Chào : <?php echo $list['first_name'].' '.$list['last_name'] ?></h2>
                </div>
                <!--/span-->
            </div><!--/row-->

            <div class="row">
                <div class="well col-md-5 center login-box">
                    <div class="alert alert-info">
                        <?php if(!empty($error)): ?>
                            <?php foreach($error as $key): ?>
                                <?php echo $key.'<br />' ?>
                            <?php endforeach;?>
                        <?php else : ?>
                            Cập Nhật Password
                        <?php endif ;?>
                    </div>
                    <form id="frmLogin" class="form-horizontal" action="<?php echo base_url('login/formResetPassword/'.$token)?>" method="post">
                        <fieldset>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="clearfix"></div><br/>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <input type="password" name="rePassword" class="form-control" placeholder="Password">
                            </div>
                            <div class="clearfix"></div>
                            <p class="center col-md-5">
                                <button id="submitButton" type="submit" class="btn btn-primary bnt-o-i">Cập nhât</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
                <!--/span-->
            </div><!--/row-->
        </div><!--/fluid-row-->
    </div><!--/.fluid-container-->
</body>
