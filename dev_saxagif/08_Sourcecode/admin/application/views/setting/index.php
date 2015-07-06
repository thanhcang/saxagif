<div class="row">
    <div class="box col-md-12">
        <div class="marb5pi">
            <form action="" method="post">
                <select name="language" class="form-control selectbox-language inline-block">
                    <?php foreach ($this->config->item('language_type') as $key => $value): ?>
                        <option value="<?php echo $key ?>" <?php echo !empty($list['language_type']) && $list['language_type'] == $key ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="searchLanguage" value="1">
                <button type="submit" class="button">Apply</button>
            </form>
        </div>
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Cài đặt chung</h2>
            </div>
            <div class="box-content">
                <?php if (!empty($error)):?>
                <div class="error">
                    <?php foreach($error as $key=>$value): ?>
                        <?php echo $value.'<br />'; ?>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputName">Site Name</label>
                        <input type="text" name="sitename" value="<?php echo !empty($list['sitename']) ? html_escape($list['sitename']) :'' ?>" class="form-control" id="inputName" placeholder="Nhập sitename">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Shorcut</label>
                        <input type="file" name="shortcut" value="" accept="image/*" />
                        <?php if (!empty($list['shortcut'])): ?>
                        <img src="data:image/png;base64,<?php echo base64_encode($list['shortcut']);?>" alt="" title="biểu tượng đại diện cho website" /></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="keyLogo">logo</label>
                        <input  type="file"  name="logo" value="" accept="image/*" />
                        <?php if (!empty($list['logo'])): ?>
                            <img src="data:image/png;base64,<?php echo base64_encode($list['logo']) ?>" alt="logo của công ty" title="shorcut" />
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="inputURL">Key Google</label>
                        <textarea name="key_google" placeholder="nhập keyword seo google" class="re_opinion form-control"><?php echo !empty($list['key_google']) ? $list['key_google'] : '';  ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputFile">Des Goolge</label>
                        <textarea name="des_google" placeholder="nhập mô tả cho website để thông báo cho google" class="re_opinion form-control"><?php echo !empty($list['des_google']) ? $list['des_google'] : '';  ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keyAddress">Điện Thoại</label>
                        <input  type="text" name="phone" value="<?php echo !empty($list['phone']) ? html_escape($list['phone']) :'' ?>" class="form-control" id="keyAddress" placeholder="nhập số điện thoại công ty">
                    </div>
                    <div class="form-group">
                        <label for="inputName">Fax</label>
                        <input  type="text" name="fax" value="<?php echo !empty($list['fax']) ? html_escape($list['fax']) :'' ?>" class="form-control" id="inputName" placeholder="Nhập số fax công ty">
                    </div>
                    <div class="form-group">
                        <label for="inputName">Email</label>
                        <input type="text" name="email" value="<?php echo !empty($list['email']) ? html_escape($list['email']) :'' ?>" class="form-control" id="inputName" placeholder="Nhập email công ty">
                    </div>
                    <div class="form-group">
                        <label for="inputName">Địa chỉ</label>
                        <input type="text" name="address" value="<?php echo !empty($list['address']) ? html_escape($list['address']) :'' ?>" class="form-control" id="inputName" placeholder="Nhập địa chỉ công ty">
                    </div>
                    <div class="form-group">
                        <label for="inputName">Câu trích dẫn</label>
                        <textarea name="slogan" placeholder="nhập câu trích dẫn cho công ty" class="re_opinion form-control"><?php echo !empty($list['slogan']) ? $list['slogan'] : $deault_setting['slogan'];  ?></textarea>
                    </div>
                    <button type="submit" class="button">Save</button>
                    <input name="language_type" type="hidden" value="<?php echo $list['language_type']; ?>" />
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/common/js/setting.js'); ?>"></script>