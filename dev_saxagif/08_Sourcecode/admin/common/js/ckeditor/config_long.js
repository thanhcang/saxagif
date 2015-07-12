/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 * author : 
 * custom : file config 
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        {name: 'links'},
        {name: 'insert'},
        //{name: 'forms'},
        {name: 'tools'},
        //{name: 'document', groups: ['mode', 'document', 'doctools']},
       // {name: 'others'},
       // '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
        {name: 'styles'},
        {name: 'colors'},
        {name: 'about'}
    ];
    config.filebrowserBrowseUrl = BASE_URL + 'common/js/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = BASE_URL + 'common/js/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = BASE_URL + 'common/js/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = BASE_URL + 'common/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = BASE_URL + 'common/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = BASE_URL + 'common/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    //config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
    config.height = 350;        // 500 pixels high.
    //Add extension youtube
    config.extraPlugins = 'youtube';
    //config.toolbar = [{ name: 'insert', items: ['Image', 'Youtube']}];
};
