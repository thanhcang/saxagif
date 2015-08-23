<style>.main_tab label a { font-size: 1.3em }</style>
<?php
$string_test = 'Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis. In hac habitasse platea dictumst. Ut euismod tempus hendrerit. Morbi ut adipiscing nisi. Etiam rutrum sodales gravida! Aliquam tellus orci, iaculis vel.';
$selft = & get_instance(); 
$slug = $this->uri->segment(2); 
$aricle = $this->uri->segment(3); 

?>
<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('SHARE_FUNNY') ?></div>
    <div class="content_noboder">
        <?php if(!empty($parent)) : $t_parent_id = 0; ?>
            <?php foreach ($parent as  $key => $value): ?>
            <div class="label"><?php echo htmlspecialchars($key); ?></div>
            <div id="tabs">
                <ul  class="tab_menu">
                    <?php foreach ($value as $c_key): ?>
                        <li <?php echo (!empty($slug) && ($c_key['slug'] == $slug) ) ? 'class="ui-tabs-active"' : ''; ?>><a href="<?php echo base_url('truyen-cam-hung'.'/'.$c_key['slug']); ?>"><?php echo $c_key['name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <div id="tabs-1" class="tab">
                        <!--<div class="sort_view">
                            <div class="sort_year">
                                <label>Bài hay theo năm :</label>
                                <input type="text"/>
                            </div>
                            <div class="sort_month">
                                <label class="pull-left">Bài hay theo tháng :</label>
                                <ul>
                                    <li class="active"><</li>
                                    <li><a href="#">T1</a></li>
                                    <li><a href="#">T2</a></li>
                                    <li><a href="#">T3</a></li>
                                    <li><a href="#">></a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>-->
                        <?php 
                        if (!empty($slug)){
                            $listDetiail = $selft->detailEvent($slug); 
                            $detail = $selft->detail($aricle); 
                        } else {
                            $listDetiail = $selft->detailEvent($value[0]['slug']); 
                        } ?>
                        <?php if (!empty($listDetiail)): ?>
                        <?php foreach ($listDetiail as $d_key): ?>
                            <div class="cont_tab">
                                <div class="img_tab"><a href="chi-tiet-bai-viet.html"><img src="<?php echo base_url('admin/common/multidata/news').'/'.$d_key['avatar'] ;?>"/></a></div>
                                <div class="main_tab">
                                    <label><a href="<?php echo base_url('truyen-cam-hung'.'/'.$d_key['parent_slug'].'/'.$d_key['slug']); ?>" class="js__p_start"><?php echo $d_key['title']; ?></a></label>
                                    <div class="des_tab">
                                        <?php echo htmlspecialchars_decode($d_key['description']); ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endforeach ?>
                        <?php endif ?>  
                    </div> 
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif ?>
        
    </div> 
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>