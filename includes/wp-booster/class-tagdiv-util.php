<?php

/**
 * theme utility class/methods
 *
 * @package WordPress
 * @subpackage MeisterMag
 * @since MeisterMag 1.0
 */
class Tagdiv_Util {

	/**
	 * @var null
	 * keep a local copy of all theme settings
	 */
	static $tagdiv_theme_options = NULL ;

	/**
	 * returns a string containing the numbers of words or chars for the content
	 *
	 * @param        $post_content    - the content that needs to be cut
	 * @param        $limit           - limit to cut
	 * @param string $type            - type of cut
	 * @param string $show_shortcodes - if shortcodes
	 *
	 * @return string
	 */
	static function tagdiv_excerpt( $post_content, $limit, $type = '', $post_id,  $show_shortcodes = '' ) {
		//remove shortcodes and tags
		if ( '' == $show_shortcodes ) {
			//delete all shortcode tags from the content.
			$post_content = strip_shortcodes( $post_content );
		}

		$post_content = stripslashes( wp_filter_nohtml_kses( $post_content ) );

		//excerpt for letters
		if ( 'letters' == $type ) {
			$ret_excerpt = mb_substr( $post_content, 0, $limit );
			if ( mb_strlen( $post_content ) >= $limit ) {
				$ret_excerpt = $ret_excerpt . '...';
			}

		//excerpt for words
		} else {
			$excerpt = explode( ' ', $post_content, $limit );

			if ( count( $excerpt ) >= $limit ) {
				array_pop( $excerpt );
				$excerpt = implode( " ", $excerpt ) . '...';
			} else {
				$excerpt = implode( " ", $excerpt );
			}

			$excerpt = esc_attr( strip_tags( $excerpt ) );

			if ( trim( $excerpt ) == '...' ) {
				return '';
			}

			$ret_excerpt = $excerpt;
			$ret_excerpt .= sprintf( '<a href="%1$s" class="tagdiv-more-link">%2$s</a>',
				esc_url( get_permalink( $post_id ) ),
				/* translators: %s: Name of current post */
				sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'meistermag' ), get_the_title( $post_id ) )
			);
		}

		return $ret_excerpt;
	}

	/**
	 * Shows a soft error. The site will run as usual if possible. If the user is logged in and has 'switch_themes'
	 * privileges this will also output the caller file path
	 * @param $file
	 * @param $message
	 * @param string $more_data
	 */
	static function tagdiv_wp_booster_error( $file, $message, $more_data = '' ) {

		$error = '';
		$error .= '<div class="tagdiv-booster-error">';
		$error .= __( 'theme wp booster error: ', 'meistermag' );
		$error .= $message;

		if ( is_user_logged_in() && current_user_can( 'switch_themes' ) ) {
			$error .= '<br>' . $file . '<br><br>';

			if ( ! empty( $more_data ) ) {
				$error .= '<br><br><pre>';
				$error .= __( 'more data: ', 'meistermag' ) . PHP_EOL;
				$error .= print_r( $more_data );
				$error .= '</pre>';
			}
		}

		$error .= '</div>';
		echo $error;
	}

	/**
	 * get one of tagdiv_theme_options
	 * @param $option_key - the key/name of the option to return
	 * @return string - the option value
	 */
	static function tagdiv_get_theme_options( $option_key ) {
		if ( is_null( self::$tagdiv_theme_options ) ) {
			self::$tagdiv_theme_options = wp_parse_args( get_theme_mod( TAGDIV_THEME_OPTIONS_NAME ), self::tagdiv_get_theme_options_defaults() );
		}

		if ( !empty( self::$tagdiv_theme_options[$option_key] ) ) {
			return self::$tagdiv_theme_options[$option_key];
		}
		return '';
	}

	/**
	 * theme's default settings
	 * @return mixed|void
	 */
	static function tagdiv_get_theme_options_defaults() {
		$defaults = array(
			'tagdiv_footer_logo' 				=> '',
			'tagdiv_footer_text'				=> __( 'MeisterMag is your news, entertainment, music fashion website.', 'meistermag' ),
			'tagdiv_subfooter_copyright_symbol' => '1',
			'tagdiv_block_section_title' 		=> __( 'Block Title', 'meistermag' ),
			'tagdiv_latest_section_title' 		=> __( 'Latest Articles', 'meistermag' ),
			'tagdiv_footer_email' 				=> __( 'contact@yoursite.com', 'meistermag' ),
			'tagdiv_subfooter_copyright' 		=> __( 'Your Copyright Text', 'meistermag' )
		);

		return apply_filters( 'tagdiv_get_theme_options_defaults', $defaults );
	}

} //end class Tagdiv_Util

/*  ----------------------------------------------------------------------------
    mbstring support - if missing from host
 */

if ( ! function_exists( 'mb_strlen' ) ) {
	function mb_strlen( $string, $encoding = '' ) {
		return strlen( $string );
	}
}
if ( ! function_exists( 'mb_substr' ) ) {
	function mb_substr( $string, $start, $length, $encoding = '' ) {
		return substr( $string, $start, $length );
	}
}
if ( ! function_exists( 'mb_strpos' ) ) {
	function mb_strpos( $haystack, $needle, $offset = 0 ) {
		return strpos( $haystack, $needle, $offset );
	}
}
if ( ! function_exists( 'mb_strrpos' ) ) {
	function mb_strrpos( $haystack, $needle, $offset = 0 ) {
		return strrpos( $haystack, $needle, $offset );
	}
}
if ( ! function_exists( 'mb_strtolower' ) ) {
	function mb_strtolower( $string ) {
		return strtolower( $string );
	}
}
if ( ! function_exists( 'mb_strtoupper' ) ) {
	function mb_strtoupper( $string ) {
		return strtoupper( $string );
	}
}
