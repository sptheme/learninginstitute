<?php
/**
 * Template part for displaying entry publication post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clearfix', 'entry-publication-article') ); ?>>
	<?php get_template_part( 'template-parts/publication/publication-entry-media' ); ?>
	<?php get_template_part( 'template-parts/publication/publication-entry-title' ); ?>	
	<?php get_template_part( 'template-parts/publication/publication-entry-meta' ); ?>
</article><!-- #post-## -->
