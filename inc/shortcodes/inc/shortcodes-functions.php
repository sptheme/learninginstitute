<?php
/**
 * Shortcodes functions
 *
 * @package Learning_Institute
 */

/**
 * Print script and style of shortcodes
 */
add_action( 'wp_enqueue_scripts', 'add_script_style_sc' );

function add_script_style_sc() {
	global $post;
	if( !is_admin() ){
		wp_enqueue_script( 'shortcode-js', SC_JS_URL . 'shortcodes.js', array(), SC_VER, true );
		wp_enqueue_style( 'shortcode', SC_CSS_URL . 'shortcodes.css', false, SC_VER );
	}
	
}

/**
 * Register and initialize short codes
 */
function wpsp_add_shortcodes() {
	add_shortcode( 'col', 'col' );
	//add_shortcode( 'button', 'wpsp_button_shortcode' );
	
	
}
add_action( 'init', 'wpsp_add_shortcodes' );

/**
 * Fix Shortcodes 
 */
if( !function_exists('wpsp_fix_shortcodes') ) {
	function wpsp_fix_shortcodes($content){
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
}
add_filter('the_content', 'wpsp_fix_shortcodes');

/**
 * Helper function for removing automatic p and br tags from nested short codes
 */
function return_clean( $content, $p_tag = false, $br_tag = false )
{
	$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

	if ( $br_tag )
		$content = preg_replace( '#<br \/>#', '', $content );

	if ( $p_tag )
		$content = preg_replace( '#<p>|</p>#', '', $content );

	return do_shortcode( shortcode_unautop( trim( $content ) ) );
}

if ( ! function_exists( 'col' ) ) :
/**
 * Column
 */
function col( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'full'
	), $atts ) );
	$out = '<div class="' . $type . '">' . return_clean($content) . '</div>';
	if ( strpos( $type, 'last' ) )
		$out .= '<div class="clear"></div>';
	return $out;
}
endif;

if ( ! function_exists( 'wpsp_button_shortcode' ) ) :
/**
 * Button
 */
function wpsp_button_shortcode($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'url' => 'null',
	), $atts));
	
	return '<a class="button" href="' . $url .'">' . $content . '</a>';
	
}
endif;

if ( ! function_exists( 'wpsp_accordion_shortcode' ) ) :
/**
 * Accordion
 * Main accordion container
 */
function wpsp_accordion_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => 'one',
		'size' => 'small',		
		'open_index' => 0
	), $atts));

	return '<div class="accordion ' . $size . ' ' . $style . ' clearfix" data-opened="' . $open_index . '">' . return_clean($content) . '</div>';
}
endif;

if ( ! function_exists( 'wpsp_accordion_section_shortcode' ) ) :
/**
 * Accordion section
 */
function wpsp_accordion_section_shortcode($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' => 'Title Goes Here',		
	), $atts));

	return '<section><h4>' . $title . '</h4><div><p>' . return_clean($content) . '</p></div></section>';
	
}
endif;
