<?php
/**
 * Template part for displaying entry blog post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clearfix', 'entry-blog-article') ); ?>>
	<?php get_template_part( 'template-parts/blog/blog-entry-title' ); ?>	
	<?php get_template_part( 'template-parts/blog/blog-entry-meta' ); ?>
	<?php get_template_part( 'template-parts/blog/blog-entry-media' ); ?>
	<?php get_template_part( 'template-parts/blog/blog-entry-excerpt' ); ?>
</article><!-- #post-## -->
