<h3 class="topic"><?php echo $this->lang->line('TITLE_QUESTION'); ?></h3>
<div class="content">
    <div class="content_left_QA">
        <div class="box_l">
            <div class="box_head_QA"><?php echo $this->lang->line('CUSTOMER_QUESTION'); ?></div>
            <div class="box_main_QA">
                <div class="scrollbar-external_wrapper" style="height:643px !important; width:333px !important;">
                    <div class="questionCustomer">
                        <?php if (!empty($question)): ?>
                        <?php foreach ($question as $key): ?>
                        <div class="idea">
                            <div class="img_customer"><img src="<?php echo url_img('admin/common/multidata/comment/', $key['logo']) ?>"/></div>
                            <div class="idea_customer">
                                <label><?php echo !empty($key['customer_name']) ? $key['customer_name'] : '' ?></label>
                                <p>
                                    <?php echo !empty($key['question']) ? $key['question'] : '' ?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php endforeach;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="box_foot_QA"></div>
        </div>
    </div>
    <div class="content_QA">
        <div class="bg_tit_Q"><?php echo $this->lang->line('YOU_QUESTION'); ?></div>
        <div class="bg_tit_A"><?php echo $this->lang->line('SAXA_ANWERS'); ?>i</div>

        <div class="scrollbar-external_wrapper" style="height:643px !important; width:803px !important">
            <div class="scrollbar-external scrollbar-external-QA height_643 width_785">
                <div id="accordion">
                    <?php if (!empty($answer)): ?>
                        <?php foreach ($answer as $key): ?>
                        <div class="question">
                                <?php echo $key['question']; ?>
                                <div class="pull-right"><img src="<?php echo url_img('common/images/', 'icon_arrow_down.png') ?>"/></div>
                        </div>
                        <div class="answer">
                            <?php echo $key['answer']; ?>
                        </div>
                        <?php endforeach;?>
                    <?php endif ?>
                </div>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>

    <form id="sendQa" method="post" action="<?php echo base_url('thac-mac-va-huong-dan/sendQuestion'); ?>">
        <div class="send_QA">
            <label><?php echo $this->lang->line('SEND_QUESTION_SAXA'); ?></label>
            <p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, </p>
            <div class="frm_cont_QA">
                <div class="control_group">
                    <input type="text" name="customer_name" class="inbox_contact" value="" placeholder="Tên khách hàng"/>
                </div>
                <div class="control_group">
                    <input type="text" name="customer_email" class="inbox_contact" value="" placeholder="Email khách hàng"/>
                </div>
                <div class="control_group">
                    <textarea name="question" class="textarea_contact" placeholder="<?php echo $this->lang->line('CUSTOMER_QUESTION_'); ?>"></textarea>
                </div>
                <input type="hidden" name="formname" value="1" />
                <button type="button" class="send_frm_QA"><?php echo $this->lang->line('send'); ?></button>
            </div>
        </div>
    </form>
</div>

<div class="border-dashed marT60"></div>
<div id="main_loader" class="c_hide"></div>
<script>
    $(function() {
        $("#accordion").accordion({
                    heightStyle: "content"
                });
    });
</script>
<link rel="stylesheet" href="<?php echo base_url('common/css/popModal.css') ?>" type="text/css">
<?php require_once( APPPATH.'views/templates/_parts/master_popup_sendmail.php'); ?>
<script src="<?php echo base_url('common/js/popModal.js') ?>"></script>
<script src="<?php   echo base_url('common/js/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php   echo base_url('common/js/question.js'); ?>"></script>