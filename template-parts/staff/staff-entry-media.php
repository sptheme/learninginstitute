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
} ?>
<?php if (has_post_thumbnail()) : ?>
	<div id="staff-entry-media" class="staff-entry-media overlay-wrap">
		<a href="<?php wpsp_permalink();?>" title="<?php echo wpsp_esc_title(); ?>" rel="bookmark">
		<?php echo get_the_post_thumbnail( $post->ID, 'staff-entry', array( the_title_attribute( array( 'echo' => 0 ) ) ) ); ?>
		<div class="overlay-inner white overlay-hide">
			<span class="title"><?php the_title(); ?></span>
		</div>
		</a>
	</div> <!-- .staff-entry-media -->
<?php endif; ?>