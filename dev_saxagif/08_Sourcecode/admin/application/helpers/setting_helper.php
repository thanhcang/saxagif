<?php

if ((!function_exists("defaultInfoCompany"))) {

    /**
     * 
     * @return array
     */
    function defaultInfoCompany() {
        return array(
            'sitename' => 'saxagif',
            'shortcut' => base_url('/common/img/logo20.png'),
            'logo' => base_url('/common/img/logo.png'),
            'key_google',
            'des_google',
            'phone',
            'fax',
            'email',
            'address',
            'slogan' => "SỨ MỆNH CỦA MỘT CÔNG TY LÀ GÌ,\nNẾU KHÔNG PHẢI LÀ ĐEM LẠI HẠNH PHÚC CHO KHÁCH HÀNG CỦA MÌNH?",
        );
    }

}
