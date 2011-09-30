jQuery(document).ready(function(){

    jQuery('select[name=menu_icon]').live('change',function(){
        menu_icon = jQuery(this);
        menu_icon.next('span').css('backgroundImage', 'url(' + menu_icon.attr('path') + '/' + menu_icon.val() + ')');
    });
    
    jQuery('input[rel=date]').dateSelect();    
});