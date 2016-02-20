<?php
/**
 * Template part for displaying publication entry media.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

	global $redux_wpsp;
?>

<div id="publication-entry-media" class="publication-entry-media">
	<div class="post-thumbnail">
	<?php if (has_post_thumbnail()) { 
			the_post_thumbnail( 'blog-post-portrait' ) ;
		} else {
			echo '<img src="' . esc_url( $redux_wpsp['portrait-placeholder']['url']) . '">';
		} ?>
	</div>	
</div> <!-- .publication-entry-media -->