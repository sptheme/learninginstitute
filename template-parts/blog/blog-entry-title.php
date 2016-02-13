<?php
/**
 * Template part for displaying blog entry title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<h3 id="blog-entry-title" class="entry-title blog-entry-title">
	<a href="<?php wpsp_permalink();?>" title="<?php echo wpsp_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>	
</h3>

