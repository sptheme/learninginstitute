<?php
/**
 * Template part for displaying staff single media.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
<?php if (has_post_thumbnail()) : ?>
	<div id="staff-single-media" class="staff-single-media">
		<?php echo get_the_post_thumbnail( $post->ID, 'staff-post', array( the_title_attribute( array( 'echo' => 0 ) ) ) ); ?>
	</div> <!-- .staff-single-media -->
<?php endif; ?>