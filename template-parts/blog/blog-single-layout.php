<?php
/**
 * Template part for displaying single blog post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clearfix', 'single-blog-article') ); ?>>
	<?php get_template_part( 'template-parts/blog/blog-single-title' ); ?>	
	<?php get_template_part( 'template-parts/blog/blog-single-meta' ); ?>
	<?php get_template_part( 'template-parts/blog/blog-single-media' ); ?>
	<?php get_template_part( 'template-parts/blog/blog-single-content' ); ?>
</article><!-- #post-## -->
<?php wpsp_the_post_navigation(); ?>
<?php get_template_part( 'template-parts/blog/blog-single-related' ); ?>
