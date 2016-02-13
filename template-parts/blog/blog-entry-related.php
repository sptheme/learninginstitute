<?php
/**
 * Template part for blog entry related posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 


if ( ! isset( $related_query ) ) {
	global $post_count;
}

// Add Standard Classes
$classes   = array();
$classes[] = 'related-post';
$classes[] = 'col';
$classes[] = wpsp_grid_class(3);
$classes[] = 'col-'. $post_count; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="blog-entry-inner">
	<?php printf( '<a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a>', 
				wpsp_get_permalink(), 
				wpsp_get_esc_title(), 
				wpsp_post_thumbnail('blog-entry')  
			); ?>
	<?php get_template_part( 'template-parts/blog/blog-entry-title' ); ?>
	<?php get_template_part( 'template-parts/blog/blog-entry-meta' ); ?>
	</div> <!-- .inner-blog-entry -->
</article><!-- #post-## -->