jssor_slider1_starter = function(containerId) {
    var options = {
        $DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
        $ArrowNavigatorOptions: {//[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 0, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
        }
    };

    var jssor_slider1 = new $JssorSlider$(containerId, options);
};

$(function(){
    setLanguage();
});

function setLanguage() {
    $('.lang_type').on('click', function(){
        var _languageType = '';
        _languageType = $(this).attr('attr_val');
        if (_languageType != '') {
            $.ajax({
                url: URL_SET_LANGUAGE,
                type: 'POST',
                data: {
                    'language': _languageType,
                },
                //async: false,
            })
            .done(function(e){
                if(e) {
                    _urlCurrent = document.location.href;
                    window.location = _urlCurrent;
                }
            });
        }
    });  
}