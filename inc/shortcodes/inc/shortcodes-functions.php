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
	add_shortcode( 'callout_box', 'wpsp_callout_box_shortcode' );
	add_shortcode( 'sc_staff', 'wpsp_staff_shortcode' );
	
	
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

/**
 * Callout box shortcode
 *
 * Options: Show callout message
 *
 */
if ( ! function_exists( 'wpsp_callout_box_shortcode' ) ) :
function wpsp_callout_box_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'button_name' => null,
		'button_url' => null
	), $atts ) );

	$out = '<div class="callout-box">';
	$out .= '<div class="callout-message">' . return_clean($content) . '</div>';
	$out .= '<div class="callout-button"><a class="button green" href="'. $button_url .'">'. $button_name .'</a></div>';
	$out .= '</div><!-- #callout-box -->';

	return $out;
}
endif;

if ( ! function_exists( 'wpsp_staff_shortcode' ) ) :
/**
 * staff shortcode
 *
 * Options: Show all staff / by Category
 *
 */
function wpsp_staff_shortcode( $atts, $content = null ){
	ob_start();
	extract( shortcode_atts( array(
		'term_id' => null,
		'post_count' => null,
		'cols' => null
	), $atts ) );

	$args = array(
			'post_type' => 'staff',
			'tax_query' => array(
					array(
						'taxonomy' => 'staff_category',
						'field'    => 'id',
						'terms'    => array($term_id)
					)
				),
				'posts_per_page' => $post_count
		);
	$staff_query = new WP_Query($args);

	if ( $staff_query->have_posts() ) { ?>
		<div class="wpsp-row clearfix">

	<?php while ( $staff_query->have_posts() ) : $staff_query->the_post(); ?>
	<?php
		$entry_classes = array( 'staff-entry' );
		$entry_classes[] = 'col';
		$entry_classes[] = 'span_1_of_'. $cols; 
	?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
				<div class="staff-entry-inner">
				<?php get_template_part( 'template-parts/staff/staff-entry-media' ); ?>
				<?php get_template_part( 'template-parts/staff/staff-entry-content' ); ?>
				</div> <!-- .inner-staff-entry -->
			</article><!-- #post-## -->
	<?php endwhile; wp_reset_postdata(); ?>

		</div> <!-- .wpsp-row .clearfix -->
	<?php	
	} else {
		echo esc_html__( 'Sorry, new content will coming soon.', 'learninginstitute' );
	}

	return ob_get_clean();
}
endif;