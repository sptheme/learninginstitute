<?php
/**
 * Template part for displaying staff entry title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<h2 id="staff-entry-title" class="staff-entry-title entry-title">
	<a href="<?php wpsp_permalink();?>" title="<?php echo wpsp_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>	
</h2>

