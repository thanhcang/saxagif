<h3 class="topic"><?php echo $this->lang->line('SHARE_FUNNY'); ?></h3>
<?php $selft = & get_instance(); 
$slug = $this->uri->segment(2); 
$aricle = $this->uri->segment(3); 
?>
<?php if(!empty($parent)) : $t_parent_id = 0; ?>
<?php foreach ($parent as  $key => $value): ?>
<div id="tabs_video" class="tabs_inspiration">
    <h4><?php echo htmlspecialchars($key); ?></h4>
    <ul>
        <?php foreach ($value as $c_key): ?>
        <li <?php echo (!empty($slug) && ($c_key['slug'] == $slug) ) ? 'class="ui-tabs-active"' : ''; ?>><a href="<?php echo base_url('truyen-cam-hung'.'/'.$c_key['slug']); ?>"><?php echo $c_key['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content">
        <div id="tabs1" class="tab">
            <div class="video_left">
                <div style="width:345px !important">
                    <div  class="scrollbar_left_item">
                    <div class="width_340">
                        <?php 
                        if (!empty($slug)){
                            $listDetiail = $selft->detailEvent($slug); 
                            $detail = $selft->detail($aricle); 
                        } else {
                            $listDetiail = $selft->detailEvent($value[0]['slug']); 
                        }
                        
                        if (!empty($listDetiail)): ?>
                        <?php foreach ($listDetiail as $d_key): ?>
                        <div class="block_video">
                            <a href="<?php echo base_url('truyen-cam-hung'.'/'.$d_key['parent_slug'].'/'.$d_key['slug']); ?>"><img src="<?php echo base_url('admin/common/multidata/news').'/'.$d_key['avatar'] ;?>" width="317" height="138"/></a>
                            <div class="title_video"><?php echo $d_key['title']; ?></div>
                            <div class="des_video">
                                <?php echo htmlspecialchars_decode($d_key['description']); ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    </div>
                </div>
            </div>
            <div class="video_right" style="width: 740px">
                <?php if (!empty($listDetiail)&& empty($detail)): ?>
                <div class="sroll_right">
                <div style="width: 735px">
                <?php echo htmlspecialchars_decode($listDetiail[0]['content']); ?>
                <a href="#"><img src="<?php echo url_img('common/images/', 'btn_likeFb.png') ?>"/></a>
                <a href="#"><img src="<?php echo url_img('common/images/', 'btn_shareFb.png') ?>"/></a>
                </div>
                </div>
                <?php elseif (!empty($listDetiail)&& !empty($detail)) : ?>
                <div class="sroll_right">
                <div style="width: 735px">
                <?php echo htmlspecialchars_decode($detail['content']); ?>
                <a href="#"><img src="<?php echo url_img('common/images/', 'btn_likeFb.png') ?>"/></a>
                <a href="#"><img src="<?php echo url_img('common/images/', 'btn_shareFb.png') ?>"/></a>
                </div>
                </div>
<!--                <div class="clearfix"></div>
                <div class="block_comment">
                    <h6 class="tit_comment">Bình luận</h6>
                    <div class="box_comment">
                        <div class="avatar"><img src="images/avatar.png"/></div>
                        <div class="frm_comment">
                            <textarea></textarea>
                            <div class="btn_comment"><button type="submit">Bình luận</button></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="scrollbar-external_wrapper" style="width:765px!important; height: 242px !important">
                        <div class="scrollbar-external width_722 height_242">
                            <div class="cont_comment">
                            </div> 
                        </div>
                    </div>
                </div>-->
                <?php endif ?>
            </div>
            <div class="clearfix"></div>
            <?php if (!empty($listDetiail)): ?>
            <div class="sort_view">
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
            </div>
            <?php endif ?>
            
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif ?>
<div class="border-dashed marT60"></div>
<script type="text/javascript" src="<?php echo base_url('common/js/jquery.slimscroll.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('common/js/inspirational.js') ?>"></script>