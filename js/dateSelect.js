/*!
 * Date select plugin
 *
 * Copyright (c) 2010 José Carlos Chávez Sandoval
 *
 * Built on top of the jQuery library
 *   http://jquery.com
 *
 */


jQuery.fn.dateSelect = function(o){
    o = jQuery.extend({}, jQuery.fn.dateSelect.defaults, o);
    var monthDays = [31,28,31,30,31,30,31,31,30,31,30,31];
    var selectOne = o.selectOne.split(',');
    
    function capitalize(s){
        return s.replace( /(^|\s)([a-z])/g , function(m,p,q){
            return p+q.toUpperCase();
        } );
    }
    function isLeap(y){
        return ((y % 4 == 0) && ((y % 100 != 0) || (y % 400 == 0))) ? true : false;
    }

    function complete(n){
        return (n<10) ? '0'+n : n;
    }

    this.each(function(){
        id = jQuery(this).attr('id');
        if(jQuery('#dateSelect-'+id).length == 0){
        val = jQuery(this).val().split('-');
        y = val[0];
        m = val[1];
        d = val[2];
        jQuery(this).before('<div id="dateSelect-'+id+'"></div>').appendTo('#dateSelect-'+id).hide();

        jQuery.each(o.order.split(','),function(i,v){
            jQuery('div#dateSelect-'+id).append('<select id="'+id+'-'+v+'" class="dateSelect'+capitalize(v)+'"><option value="">'+selectOne[i]+'</option></select>');
        });

        if(o.maxYear == 'current'){
            var time = new Date();
            o.maxYear = time.getYear();
            if (o.maxYear < 2000)
                o.maxYear = o.maxYear + 1900;
        }

        for(i=o.maxYear;i>=o.minYear;i--){
            jQuery('select#'+id+'-year').append('<option '+((i==y) ? 'selected="selected"' : '')+' value="'+i+'">'+i+'</option>');
        }

        jQuery.each(o.months.split(','),function(i,v){
            jQuery('select#'+id+'-month').append('<option '+((i+1==m) ? 'selected="selected"' : '')+' value="'+(i+1)+'">'+v+'</option>');
        });

        for(i=1;i<=31;i++){
            jQuery('select#'+id+'-day').append('<option '+((i==d) ? 'selected="selected"' : '')+' class="dateSelectNumeric" value="'+i+'">'+complete(i)+'</option>');
        }
        }
    });

    jQuery('select.dateSelectYear, select.dateSelectMonth, select.dateSelectDay').live('change',function(){
        csd = jQuery(this).parent('div');
        m = csd.children('select.dateSelectMonth').val();
        y = csd.children('select.dateSelectYear').val();
        d = csd.children('select.dateSelectDay').val();
        if(!jQuery(this).hasClass('dateSelectDay')){
            mm = Math.max(1,m);
            max = ((mm == 2) && (isLeap(y))) ? monthDays[mm-1] + 1 : monthDays[mm-1];
            csd.find('select.dateSelectDay option.dateSelectNumeric').remove();
            d = Math.min(d,max);
            for(i=1;i<=max;i++){
                csd.find('select.dateSelectDay').append('<option class="dateSelectNumeric" '+((d == i) ? 'selected="selected"' : '' )+' value="'+i+'">'+complete(i)+'</option>');
            }
        }
        if((y!='') && (m!='') && (d!='')){
            csd.children('input').val(complete(y)+'-'+complete(m)+'-'+complete(d));
        }
    });
}

jQuery.fn.dateSelect.defaults = {
    selectOne:'Day,Month,Year',
    order:'day,month,year',
    maxYear:'current',
    minYear:1900,
    months:'January,February,March,April,May,June,July,August,September,October,November,December'
};