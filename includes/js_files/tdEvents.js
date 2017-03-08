/* global jQuery:{} */

/**
 * tdEvents.js - handles the events that require throttling
 */


var tdEvents = {};

(function(){
    'use strict';

    tdEvents = {

        //the events - we have timers that look at the variables and fire the event if the flag is true
        scroll_event_slow_run: false,
        scroll_event_medium_run: false,

        resize_event_slow_run: false, //when true, fire up the resize event
        resize_event_medium_run: false,


        scroll_window_scrollTop: 0, //used to store the scrollTop

        window_pageYOffset: window.pageYOffset,
        window_innerHeight: window.innerHeight, // used to store the window height
        window_innerWidth: window.innerWidth, // used to store the window width

        init: function() {

            jQuery( window ).scroll(function() {
                tdEvents.scroll_event_slow_run = true;
                tdEvents.scroll_event_medium_run = true;

                //read the scroll top
                tdEvents.scroll_window_scrollTop = jQuery( window ).scrollTop();
                tdEvents.window_pageYOffset = window.pageYOffset;
            });


            jQuery( window ).resize(function() {
                tdEvents.resize_event_slow_run = true;
                tdEvents.resize_event_medium_run = true;

                tdEvents.window_innerHeight = window.innerHeight;
                tdEvents.window_innerWidth = window.innerWidth;
            });
        }
    };

    tdEvents.init();
})();

/*  ----------------------------------------------------------------------------
    Set the mobile menu min-height property

    This is used to force vertical scroll bar appearance from the beginning.
    Without it, on some mobile devices (ex Android), at scroll bar appearance appear some
    visual issues.
 */

( function () {

    'use strict';

    if ( 'undefined' === typeof tdEvents.previousWindowInnerWidth ) {

        // Save the previous width
        tdEvents.previousWindowInnerWidth = tdEvents.window_innerWidth;

    } else if ( tdEvents.previousWindowInnerWidth === tdEvents.window_innerWidth ) {

        // Stop if the width has not been modified
        return;
    }

    tdEvents.previousWindowInnerWidth = tdEvents.window_innerWidth;

    var $tdMobileMenu = jQuery( '#tagdiv-mobile-nav' ),
        cssHeight = tdEvents.window_innerHeight + 1;

    if ( $tdMobileMenu.length ) {
        $tdMobileMenu.css( 'min-height' , cssHeight + 'px' );
    }

    var $tdMobileBg = jQuery( '.tagdiv-menu-background' ),
        $tdMobileBgSearch = jQuery( '.tagdiv-search-background' );

    if ( $tdMobileBg.length ) {
        $tdMobileBg.css( 'height' , ( cssHeight + 70 ) + 'px' );
    }

    if ( $tdMobileBgSearch.length ) {
        $tdMobileBgSearch.css( 'height' , ( cssHeight + 70 ) + 'px' );
    }

} )();
