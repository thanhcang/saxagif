<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.html">Home</a>
        </li>
        <li>
            <a href="index.html">Category</a>
        </li>
        <li>
            <a href="index.html">Quà tặng công nghệ</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Add new</h2>
            </div>
            <div class="box-content">
                <form>
                    <div class="form-group">
                        <label for="inputName"><?php echo $this->lang->line('CAT_NAME') ?>: </label>
                        <?php echo htmlspecialchars($catDetail['name']) ?>
                    </div>
                    <div class="form-group">
                        <label for="inputColor"><?php echo $this->lang->line('CAT_BACKGROUND_COLOR') ?>: </label>
                        <input type="color" value="<?php if(!empty($catDetail['bg_color'])) echo '#'. $catDetail['bg_color'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="keyGoogle"><?php echo $this->lang->line('CAT_KEYWORD_SEO') ?>: </label>
                        <?php if(!empty($catDetail['keyword_seo'])) echo htmlspecialchars($catDetail['keyword_seo']) ?>
                    </div>
                    <div class="form-group">
                        <label for="desGoogle"><?php echo $this->lang->line('CAT_DES_SEO') ?>: </label>
                        <?php if(!empty($catDetail['des_seo'])) echo htmlspecialchars($catDetail['des_seo']) ?>
                    </div>
                    <!--<?php if(!empty($catDetail['logo'])): ?>
                    <img src="<?php echo base_url(IMAGE_CATEGORY_PATH . $catDetail['logo']) ?>" width="200" height="150" />
                    <?php else: ?>
                    <img src="<?php echo base_url(IMAGE_PATH . 'noimg.png') ?>" width="150" height="100" />
                    <?php endif; ?>-->
                    <button type="submit" class="button"><?php echo $this->lang->line('CREATE') ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-asterisk"></i> Quà tặng công nghệ</h2>
            </div>
            <div class="box-content">
                <DIV CLass="pull-left">
                    <select>
                        <option>all dates</option>
                    </select>
                    <select>
                        <option>all category</option>
                    </select>
                    <button type="button">Filter</button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped table-bordered responsive martopten datatable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="45%"/>
                        <col width="30%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('STT') ?></th>
                            <th><?php echo $this->lang->line('CAT_NAME') ?></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($catDetail['cat_parent']):
                            $i = 1;
                            foreach ($catDetail['cat_parent'] as $detail): ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo htmlspecialchars($detail['name']) ?></td>
                            <td>
                                <a href="javascript:;" class="editCat btn btn-success" cat_attr="<?php echo base64_encode($detail['id']) ?>" title="Sửa"><i class="glyphicon glyphicon-zoom-in icon-white"></i>View</a>
                                <a href="javascript:;" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
                                <a href="javascript:;" title="Xóa" class="delCat btn btn-danger" cat_name="<?php echo htmlspecialchars($detail['name']) ?>" cat_attr="<?php echo base64_encode($detail['id']) ?>" ><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
                            </td>
                        </tr>
                        <?php
                            $i++;
                            endforeach;
                        endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!--/row-->

