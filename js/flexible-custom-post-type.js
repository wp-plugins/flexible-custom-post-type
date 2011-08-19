jQuery(document).ready(function(){

    jQuery('select[name=menu_icon]').live('change',function(){
        menu_icon = jQuery(this);
        jQuery(this).next('img').attr('src', menu_icon.next('img').attr('path') + '/' + menu_icon.val());
    });
    
    jQuery('input[rel=date]').dateSelect();    
});