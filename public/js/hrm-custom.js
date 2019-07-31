jQuery(document).ready(function(){
	// menu responsive
	jQuery("document").ready(function() {
	    jQuery('.menu-open i').click( function () {
	        jQuery('.menu-responsive').animate({left: '0px'}, 200);
	    });
	    jQuery('.menu-close').click( function () {
	        jQuery('.menu-responsive').animate({left: '-250px'}, 200);
	    });
	});
});

/*---------------------------------------------------
/*  Vertical menus toggles
/* -------------------------------------------------*/
jQuery(document).ready(function($) {

    $('#menu-main-menu').addClass('toggle-menu');
    $('.toggle-menu ul.sub-menu, .toggle-menu ul.children').addClass('toggle-submenu');
    $('.toggle-menu ul.sub-menu').parent().addClass('toggle-menu-item-parent');

    $('.toggle-menu .toggle-menu-item-parent').append('<span class="toggle-caret"><i class="fa fa-plus"></i></span>');

    $('.toggle-caret').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('active').children('.toggle-submenu').slideToggle('fast');
    });
});

// back to top
jQuery( document ).ready( function() {
    jQuery( window ).scroll( function () {
        if ( jQuery( this ).scrollTop() > 100 ) {
            jQuery( '#topcontrol').css( { bottom: "45px" } );
        } else {
            jQuery( '#topcontrol' ).css( { bottom: "-100px" } );
        }
    } );

    jQuery( '#topcontrol' ).click( function() {
        jQuery( 'html, body' ).animate( { scrollTop: '0px' }, 800 );
        return false;
    } );
} );

