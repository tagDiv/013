/* global jQuery:{} */

/**
 * tdSearch.js - handles the search events
 */

var tdSearch = {};

jQuery().ready( function() {

    'use strict';

    tdSearch.init();

} );

( function() {
    'use strict';

    tdSearch = {

        // private vars
        _is_search_open: false,

        /**
         * init the class
         */
        init: function init() {

            // hide the drop down if we click outside of it
            jQuery( document ).click( function( e ) {
                if (
                    'tagdiv-icon-search' !== e.target.className &&
                    'tagdiv-search-box-wrap' !== e.target.className &&
                    'tagdiv-header-search' !== e.target.id &&
                    'tagdiv-header-search-top' !== e.target.id &&
                    true === tdSearch._is_search_open
                ) {
                    tdSearch.hide_search_box();
                }
            } );

            // show and hide the drop down on the search icon
            jQuery( '#tagdiv-header-search-button' ).click( function( event ) {
                event.preventDefault();
                if ( true === tdSearch._is_search_open ) {
                    tdSearch.hide_search_box();
                } else {
                    tdSearch.show_search_box();
                }
            } );

            // show and hide the drop down on the search icon for mobile
            jQuery( '#tagdiv-header-search-button-mob' ).click( function( event ) {
                jQuery( 'body' ).addClass( 'td-search-opened' );
            } );

            //close the search
            jQuery( '.tagdiv-search-close a' ).click( function() {
                jQuery( 'body' ).removeClass( 'td-search-opened' );
            } );
        },


        show_search_box: function() {
            jQuery( '.tagdiv-drop-down-search' ).addClass( 'tagdiv-drop-down-search-open' );
            tdSearch._is_search_open = true;
        },


        hide_search_box: function hide_search_box() {
            jQuery( ".tagdiv-drop-down-search" ).removeClass( 'tagdiv-drop-down-search-open' );
            tdSearch._is_search_open = false;
        }

    };

} )();
