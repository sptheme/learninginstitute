<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/staff/staff-single-title' ); ?>
	<?php get_template_part( 'template-parts/staff/staff-single-media' ); ?>
	<?php get_template_part( 'template-parts/staff/staff-single-content' ); ?>
</article><!-- #post-## -->
<?php get_template_part( 'template-parts/staff/staff-single-related' ); ?>
