 
jQuery(document).ready(function() {
	
	jQuery(".main_partners_div").owlCarousel({
		items:6,
		pagination:false,
		navigation:true,
		navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
	});
	jQuery('#date_pick').Zebra_DatePicker();
});


  
  function sticky_relocate() {
    var window_top = jQuery(window).scrollTop();
    var div_top = jQuery('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        jQuery('#navigation-area').addClass('stick');
    } else {
        jQuery('#navigation-area').removeClass('stick');
    }
}

jQuery(function () {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});