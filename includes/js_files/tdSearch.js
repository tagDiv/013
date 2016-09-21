
/* global jQuery:{} */

var tdSearch = {};

jQuery().ready(function() {

    'use strict';

    tdSearch.init();

});

(function() {

    'use strict';

    tdSearch = {

        // private vars
        _first_down_up: true,
        _is_search_open: false,


        /**
         * init the class
         */
        init: function init() {

            // hide the drop down if we click outside of it
            jQuery(document).click(function(e) {
                if (
                    'td-icon-search' !== e.target.className &&
                    'td-header-search' !== e.target.id &&
                    'td-header-search-top' !== e.target.id &&
                    true === tdSearch._is_search_open
                ) {
                    tdSearch.hide_search_box();
                }
            });


            // show and hide the drop down on the search icon
            jQuery( '#td-header-search-button' ).click(function(event){
                event.preventDefault();
                if (tdSearch._is_search_open === true) {
                    tdSearch.hide_search_box();

                } else {
                    tdSearch.show_search_box();
                }
            });
        },


        show_search_box: function() {
            jQuery( '.td-drop-down-search' ).addClass( 'td-drop-down-search-open' );
            tdSearch._is_search_open = true;
        },


        hide_search_box: function hide_search_box() {
            jQuery(".td-drop-down-search").removeClass('td-drop-down-search-open');
            tdSearch._is_search_open = false;
        }

    };

})();
