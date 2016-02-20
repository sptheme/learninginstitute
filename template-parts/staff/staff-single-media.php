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
} 
	global $redux_wpsp;
?>
<div id="staff-single-media" class="staff-single-media">
<?php if (has_post_thumbnail()) : ?>
	<?php echo get_the_post_thumbnail( $post->ID, 'blog-post-square', array( the_title_attribute( array( 'echo' => 0 ) ) ) ); ?>
<?php else: ?>	
<img src="<?php echo esc_url( $redux_wpsp['square-placeholder']['url']); ?>">
<?php endif; ?>
</div> <!-- .staff-single-media -->