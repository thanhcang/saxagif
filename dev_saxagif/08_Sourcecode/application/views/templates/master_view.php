<?php
$this->load->view('templates/_parts/master_header_view');
?>
<?php
$this->load->view('templates/_parts/master_banner_home_view');
?>
    <?php echo $the_view_content;?>
<?php
$this->load->view('templates/_parts/master_footer_view');
?>