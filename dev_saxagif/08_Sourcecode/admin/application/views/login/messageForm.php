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
                <div class="well col-md-5 center login-box">
                    <div class="alert alert-info">
                        <?php echo $message ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
