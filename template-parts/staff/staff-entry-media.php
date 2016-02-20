<?php
/**
 * Template part for displaying staff entry media.
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

<div id="staff-entry-media" class="staff-entry-media overlay-wrap">
	<a href="<?php wpsp_permalink();?>" title="<?php echo wpsp_esc_title(); ?>" rel="bookmark">
<?php if (has_post_thumbnail()) : ?>	
		<?php echo get_the_post_thumbnail( $post->ID, 'blog-post-square', array( the_title_attribute( array( 'echo' => 0 ) ) ) ); ?>
<?php else: ?>		
		<img src="<?php echo esc_url( $redux_wpsp['square-placeholder']['url']); ?>">
<?php endif; ?>
		<div class="overlay-inner white overlay-hide">
			<span class="title"><?php the_title(); ?></span>
		</div>
	</a>
</div> <!-- .staff-entry-media -->