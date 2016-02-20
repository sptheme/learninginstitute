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
} ?>

<div id="publication-entry-media" class="publication-entry-media">
	<?php printf( '<div class="post-thumbnail"><a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a></div>', 
			wpsp_get_permalink(), 
			wpsp_get_esc_title(), 
			wpsp_post_thumbnail('blog-post')  
		); ?>
</div> <!-- .publication-entry-media -->