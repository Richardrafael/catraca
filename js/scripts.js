//////////////////
//IR PARA O TOPO//
//////////////////

jQuery(document).ready(function(){

    jQuery("#subirTopo").hide();
    
    jQuery('a#subirTopo').click(function () {
             jQuery('body,html').animate({
               scrollTop: 0
             }, 800);
            return false;
    });
    
    jQuery(window).scroll(function () {
             if (jQuery(this).scrollTop() > 10) {
                jQuery('#subirTopo').fadeIn();
             } else {
                jQuery('#subirTopo').fadeOut();
             }
    });
});

///////////////////
//IR PARA O TOPO2//
///////////////////
jQuery(document).ready(function(){

    jQuery("#subirTopoEdit").hide();
    
    jQuery('#subirTopoEdit').click(function () {
             jQuery('body,html').animate({
               scrollTop: 0
             }, 800);
            return false;
    });
    
    jQuery(window).scroll(function () {
             if (jQuery(this).scrollTop() > 10) {
                jQuery('#subirTopoEdit').fadeIn();
             } else {
                jQuery('#subirTopoEdit').fadeOut();
             }
    });
});

///////////////////////
//HABILITANTO POPOVER//
///////////////////////

$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        placement : 'top'
    });
});