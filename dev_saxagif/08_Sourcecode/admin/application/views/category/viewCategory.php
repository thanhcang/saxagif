<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Cập nhật</h2>
            </div>
            <div class="box-content">
                <table class="table responsive martopten datatable">
                    <colgroup>
                        <col width="20%"/>
                        <col width="85%"/>
                    </colgroup>         
                    <tr>
                        <td><b>Ngôn ngữ</b></td>
                        <td><?php echo $language_type[$catDetail['language_type']]; ?></td>
                    </tr>
                    <tr>
                        <td><b>Tên danh mục</b></td>
                        <td><?php echo htmlspecialchars($catDetail['name']) ?></td>
                    </tr>
                    <tr>
                        <td><b>Loại danh mục</b></td>
                        <td><?php echo $typeCategory[$catDetail['type']] ?></td>
                    </tr>
                    <?php if ($catDetail['type'] == 2) : ?>
                    <tr>
                        <td><b>Hiên thị trang chủ</b></td>
                        <td><?php echo  !empty($catDetail['is_home']) ? 'hiển thị' : 'không hiển thị'; ?></td>
                    </tr>
                    <?php endif;?>
                    <?php if (!empty($catDetail['event_img'])) : ?>
                    <tr>
                        <td><b>Hình slideshow</b></td>
                        <td><img src="<?php echo base_url('common/multidata/slide'.'/'.$catDetail['event_img'])?>" /></td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td><b>Slug(URL Seo)</b></td>
                        <td><?php echo $catDetail['slug'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Keyword seo</b></td>
                        <td><?php echo $catDetail['keyword_seo'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Description seo</b></td>
                        <td><?php echo $catDetail['des_seo'] ?></td>
                    </tr>
                </table>
                <div class="form-group">
                    <a href="<?php echo base_url('category');?>"><button type="buton" class="button button-blue">Trở về</button></a>
                    <a href="<?php echo base_url('category/updateCategory'.'/'.$catDetail['id']);?>"><button type="buton" class="button button-blue">Cập nhật</button></a>
                </div>
            </div>
        </div>
    </div>
</div><!--/row-->

