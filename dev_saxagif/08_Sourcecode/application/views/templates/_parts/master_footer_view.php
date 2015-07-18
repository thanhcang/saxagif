<div class="category_product_foot">
    <div class="tit_category_foot"><?php echo $this->lang->line('product_category') ?></div>
    <ul class="list_category">
        <?php if(!empty($cat_menu)): ?>
        <?php foreach($cat_menu as $cat): ?>
        <?php if($cat['parent'] == '0'): ?>
        <li>
            <div class="header"><?php echo htmlspecialchars($cat['name']) ?></div>
            <ul class="sub_category">
            <?php foreach ($cat_menu as $cat_child): ?>
                <?php if($cat_child['parent'] == $cat['id']): ?>
                <li><?php echo htmlspecialchars($cat_child['name']) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        </li>
        <?php endif ?>
        <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>
<div class="footer">
                        <div class="logo_foot"><img src="<?php echo base_url('common/images/logo_footer.png') ?>"/></div>
                        <div class="slogan_foot">
                            SỨ MỆNH CỦA MỘT CÔNG TY LÀ GÌ,<br/>
                            NẾU KHÔNG PHẢI LÀ ĐEM LẠI HẠNH PHÚC CHO KHÁCH HÀNG CỦA MÌNH?
                        </div>
                        <div class="address_foot">
                            <span>TELL:</span> (08) 38 120 440<br/>
                            <span>FAX: </span>(08) 38 120 441<br/>
                            <span>EMAIL: </span> info@saxagifts.com<br/>
                            <span>ADD:</span> SAXA Group Building,<br/> 
                            56 Nguyễn Văn Săng, Q.Tân Phú, TP.HCM<br/>
                            <span class="copyright">© Copyright 2010 - 2015 SAXA Group. All right reserved</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <script src="<?php echo base_url('common/js/jquery-1.8.1.min.js') ?>"></script>
            <script src="<?php echo base_url('common/js/vertical.news.slider.js') ?>"></script>
            <script src="<?php echo base_url('common/js/home.js') ?>"></script>
            
            <!--=============Popup=============-->
            <script type="text/javascript" src="<?php echo base_url('common/js/jquery.popup.js') ?>"></script>
            <!--Layout Popup-->
            <div class="p_body js__p_body js__fadeout"></div>
            <div class="popup js__popup js__slide_top"> <a href="#" class="p_close js__p_close" title="Close"></a>
                <div class="p_content">
                    <p class="note_mail">
                        Cảm ơn bạn đã chia sẻ với SAXA<br/>
                        những chia sẻ của bạn rất có giá trị với chúng tôi
                    </p>
                </div>
            </div>

            <script>
                                        function showMask(id) {
                                            document.getElementById(id).style.display = 'block';
                                        }
                                        function hideMask(id) {
                                            document.getElementById(id).style.display = 'none';
                                        }
            </script>
    </body>
</html>
