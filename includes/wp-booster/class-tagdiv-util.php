<?php

/**
 * @package wp-booster
 * .org update
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
	 * @param        $type            - type of cut
	 * @param string $show_shortcodes - if shortcodes
	 *
	 * @return string
	 */
	static function excerpt( $post_content, $limit, $type = '', $show_shortcodes = '' ) {
		//REMOVE shortscodes and tags
		if ( $show_shortcodes == '' ) {
			//delete all shortcode tags from the content.
			$post_content = strip_shortcodes( $post_content );
		}

		$post_content = stripslashes( wp_filter_nohtml_kses( $post_content ) );

		//excerpt for letters
		if ( $type == 'letters' ) {
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
		}

		return $ret_excerpt;
	}


	/**
	 * Shows a soft error. The site will run as usual if possible. If the user is logged in and has 'switch_themes'
	 * privileges this will also output the caller file path
	 *
	 * @param $file
	 * @param $message
	 * @param string $more_data
	 */
	static function error( $file, $message, $more_data = '' ) {
		echo '<br><br>wp booster error:<br>';
		echo $message;
		if ( is_user_logged_in() && current_user_can( 'switch_themes' ) ) {
			echo '<br>' . $file;
			if ( ! empty( $more_data ) ) {
				echo '<br><br><pre>';
				echo 'more data:' . PHP_EOL;
				print_r( $more_data );
				echo '</pre>';
			}
		};
	}

	static function tagdiv_get_theme_options( $optionName ) {
		if ( is_null( self::$tagdiv_theme_options ) ) {
			self::$tagdiv_theme_options = get_theme_mod(TAGDIV_THEME_OPTIONS_NAME);
		}

		if ( !empty( self::$tagdiv_theme_options[$optionName] ) ) {
			return self::$tagdiv_theme_options[$optionName];
		}
		return '';
	}


}//end class Tagdiv_Util

/*  ----------------------------------------------------------------------------
    mbstring support - if missing from host
 */

if ( ! function_exists( 'mb_strlen' ) ) {
	function mb_strlen( $string, $encoding = '' ) {
		return strlen( $string );
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
if ( ! function_exists( 'mb_substr' ) ) {
	function mb_substr( $string, $start, $length, $encoding = '' ) {
		return substr( $string, $start, $length );
	}
}
