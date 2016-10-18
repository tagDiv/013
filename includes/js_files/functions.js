/*
 * Supersubs v0.3b - jQuery plugin
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 *
 * This plugin automatically adjusts submenu widths of suckerfish-style menus to that of
 * their longest list item children. If you use this, please expect bugs and report them
 * to the jQuery Google Group with the word 'Superfish' in the subject line.
 *
 */

(function($){ // $ will refer to jQuery within this closure

    "use strict";

    $.fn.supersubs = function(options){
        var opts = $.extend({}, $.fn.supersubs.defaults, options);
        // return original object to support chaining
        return this.each(function() {
            // cache selections
            var $$ = $(this);
            // support metadata
            var o = $.meta ? $.extend({}, opts, $$.data()) : opts;
            // cache all ul elements and show them in preparation for measurements
            var $ULs = $$.find('ul').show();
            // get the font size of menu.
            // .css('fontSize') returns various results cross-browser, so measure an em dash instead
            var fontsize = $('<li id="menu-fontsize">&#8212;</li>').css({
                'padding' : 0,
                'position' : 'absolute',
                'top' : '-999em',
                'width' : 'auto'
            }).appendTo($$)[0].clientWidth; //clientWidth is faster than .width()
            // remove em dash
            $('#menu-fontsize').remove();
            // loop through each ul in menu
            $ULs.each(function(i) {
                // cache this ul
                var $ul = $(this);
                // get all (li) children of this ul
                var $LIs = $ul.children();
                // get all anchor grand-children
                var $As = $LIs.children('a');
                // force content to one line and save current float property
                var liFloat = $LIs.css('white-space','nowrap').css('float');
                // remove width restrictions and floats so elements remain vertically stacked
                $ul.add($LIs).add($As).css({
                    'float' : 'none',
                    'width'	: 'auto'
                });
                // this ul will now be shrink-wrapped to longest li due to position:absolute
                // so save its width as ems.
                var emWidth = $ul[0].clientWidth / fontsize;
                // add more width to ensure lines don't turn over at certain sizes in various browsers
                emWidth += o.extraWidth;
                // restrict to at least minWidth and at most maxWidth
                if (emWidth > o.maxWidth)		{ emWidth = o.maxWidth; }
                else if (emWidth < o.minWidth)	{ emWidth = o.minWidth; }
                emWidth += 'em';
                // set ul to width in ems
                $ul.css('width',emWidth);
                // restore li floats to avoid IE bugs
                // set li width to full width of this ul
                // revert white-space to normal
                $LIs.css({
                    'float' : liFloat,
                    'width' : '100%',
                    'white-space' : 'normal'
                })
                    // update offset position of descendant ul to reflect new width of parent.
                    // set it to 100% in case it isn't already set to this in the CSS
                    .each(function(){
                        var $childUl = $(this).children('ul');
                        var offsetDirection = $childUl.css('left') !== undefined ? 'left' : 'right';
                        $childUl.css(offsetDirection,'100%');
                    });
            }).hide();

        });
    };
    // expose defaults
    $.fn.supersubs.defaults = {
        minWidth		: 9,		// requires em unit.
        maxWidth		: 25,		// requires em unit.
        extraWidth		: 0			// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
    };

})(jQuery); // plugin code ends


/*  ----------------------------------------------------------------------------
    Mobile menu
 */

( function() {
    'use strict';

    //handles open/close mobile menu
    jQuery( '#td-top-mobile-toggle a, .td-mobile-close a' ).click(function(){
        if ( jQuery( 'body' ).hasClass( 'td-menu-mob-open-menu' ) ) {
            jQuery( 'body' ).removeClass( 'td-menu-mob-open-menu' );
        } else {
            jQuery( 'body' ).addClass( 'td-menu-mob-open-menu' );
        }
    });

    //move thru all the menu and find the item with sub-menues to atach a custom class to them
    jQuery( document ).find( '#td-mobile-nav .menu-item-has-children' ).each(function( i ) {

        var class_name = 'td_mobile_elem_with_submenu_' + i;
        jQuery(this).addClass( class_name );

        //click on link elements with #
        jQuery(this).children('a').addClass( 'td-link-element-after' );

        jQuery(this).click(function( event ) {

            /**
             * currentTarget - the li element
             * target - the element clicked inside of the currentTarget
             */

            var jQueryTarget = jQuery( event.target );

            // html i element
            if ( jQueryTarget.length &&
                ( ( jQueryTarget.hasClass( 'td-element-after') || jQueryTarget.hasClass( 'td-link-element-after') ) &&
                ( '#' === jQueryTarget.attr( 'href' ) || undefined === jQueryTarget.attr( 'href' ) ) ) ) {

                event.preventDefault();
                event.stopPropagation();

                jQuery( this ).toggleClass( 'td-sub-menu-open' );
            }
        });
    });

} )();

