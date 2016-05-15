jQuery(document).ready(function() {
    jQuery('img[usemap]').rwdImageMaps();
    jQuery('img[usemap]').maphilight();
    jQuery(window).resize(function() {
        jQuery('img[usemap]').maphilight();
    });
});