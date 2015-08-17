<div class="banner_t"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('common/images/logo_p.png') ?>"/></a></div>
<div class="content_boder">
    <div class="label"><?php echo $this->lang->line('question') ?></div>
    <div class="content_QA">
        <div class="bg_tit_Q"><?php echo $this->lang->line('you_ask') ?></div>
        <!--<?php if (!empty($question)): ?>
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
        <?php endif; ?>-->
    </div>
        <div class="bg_tit_A"><?php echo $this->lang->line('saxa_reply') ?></div>
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
    <form id="sendQa" method="post" action="<?php echo base_url('thac-mac-va-huong-dan/sendQuestion'); ?>">
        <div class="send_QA">
            <label> <?php echo $this->lang->line('SEND_QUESTION_SAXA') ?></label>
            <p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, </p>
            <div class="frm_cont_QA">
                <div class="control_group">
                    <input type="text" name="customer_name" class="inbox_contact" value="" placeholder="<?php echo $this->lang->line('customer_name') ?>"/>
                </div>
                <div class="control_group">
                    <input type="text" name="customer_email" class="inbox_contact" value="" placeholder="<?php echo $this->lang->line('email_customer') ?>" />
                </div>
                <div class="control_group">
                    <textarea class="textarea_contact" name="question" placeholder="<?php echo $this->lang->line('CUSTOMER_QUESTION_') ?>"></textarea>
                </div>
                <input type="hidden" name="formname" value="1" />
                <button type="button" class="send_frm_QA"><?php echo $this->lang->line('send') ?></button>
                <div class="clearfix"></div>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('templates/_parts/category_footer_view_sm'); ?>
<script src="<?php echo base_url('common/js/question_sm.js'); ?>"></script>
<script src="<?php echo base_url('common/js/jquery.js') ?>"></script>
<script src="<?php echo base_url('common/js/jquery-ui.js') ?>"></script>
<script>
    $( "#accordion" ).accordion();
</script>