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
} 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('portfolio-single-article') ); ?>>
	<?php get_template_part( 'template-parts/portfolio/portfolio-single-title' ); ?>	
	<?php get_template_part( 'template-parts/portfolio/portfolio-single-meta' ); ?>
	<?php get_template_part( 'template-parts/portfolio/portfolio-single-content' ); ?>
</article><!-- #post-## -->
<?php wpsp_the_post_navigation(); ?>
<?php //get_template_part( 'template-parts/portfolio/portfolio-single-related' ); ?>
