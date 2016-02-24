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
		<?php wpsp_get_post_thumbnail('thumb-portrait'); ?>
		<div class="overlay-inner white overlay-hide">
			<span class="title"><?php the_title(); ?></span>
		</div>
	</a>
</div> <!-- .staff-entry-media -->