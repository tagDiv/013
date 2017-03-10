/* global jQuery:{} */
/* global screenReaderText */

/**
 * Mobile menu handler
 * Menu handler for screen readers
 */
( function() {
    'use strict';

    //handles open/close mobile menu
    jQuery( '#tagdiv-top-mobile-toggle a, .tagdiv-mobile-close a' ).click( function() {

        var body = jQuery( 'body' );

        if ( body.hasClass( 'tagdiv-menu-mob-open-menu' ) ) {
            body.removeClass( 'tagdiv-menu-mob-open-menu' );
        } else {
            body.addClass( 'tagdiv-menu-mob-open-menu' );
        }
    });

    //move through all the menu and find the item with sub-menues to atach a custom class to them
    jQuery( document ).find( '#tagdiv-mobile-nav .menu-item-has-children' ).each( function( i ) {

        var class_name = 'tagdiv_mobile_elem_with_submenu_' + i;
        jQuery( this ).addClass( class_name );

        //click on link elements with #
        jQuery( this ).children( 'a' ).addClass( 'tagdiv-link-element-after' );

        jQuery( this ).children( 'a' ).append( jQuery( '<span />', {
            'class': 'screen-reader-text',
            text: screenReaderText.expand
        } ) );

        jQuery( this ).click( function( event ) {

            /**
             * currentTarget - the li element
             * target - the element clicked inside of the currentTarget
             */

            var jQueryTarget = jQuery( event.target );

            // html i element
            if ( jQueryTarget.length &&
                ( ( jQueryTarget.hasClass( 'tagdiv-element-after') || jQueryTarget.hasClass( 'tagdiv-link-element-after') ) &&
                ( '#' === jQueryTarget.attr( 'href' ) || undefined === jQueryTarget.attr( 'href' ) ) ) ) {

                event.preventDefault();
                event.stopPropagation();

                jQuery( this ).toggleClass( 'tagdiv-sub-menu-open' );

                if ( jQuery( this ).hasClass( 'tagdiv-sub-menu-open' ) ) {
                    jQuery( this ).children( 'a' ).find( '.screen-reader-text' ).remove();
                    jQuery( this ).children( 'a' ).append( jQuery( '<span />', {
                        'class': 'screen-reader-text',
                        text: screenReaderText.collapse
                    } ) );
                } else {
                    jQuery( this ).children( 'a' ).find( '.screen-reader-text' ).remove();
                    jQuery( this ).children( 'a' ).append( jQuery( '<span />', {
                        'class': 'screen-reader-text',
                        text: screenReaderText.expand
                    } ) );
                }
            }
        });
    });

} )();


