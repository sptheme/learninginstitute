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
} 

global $redux_wpsp;

$cols = (is_page()) ? 3 : $redux_wpsp['column-archive-portfolio'];
$entry_classes = array( 'portfolio-entry-article' ); 
$entry_classes[] = 'post-highlight';
$entry_classes[] = 'col';
$entry_classes[] = wpsp_grid_class($cols); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
	<?php get_template_part( 'template-parts/portfolio/portfolio-entry-media' ); ?>
	<div class="portfolio-entry-content">
		<?php get_template_part( 'template-parts/portfolio/portfolio-entry-title' ); ?>
		<div class="portfolio-entry-meta">
			<?php get_template_part( 'template-parts/portfolio/portfolio-entry-meta' ); ?>
		</div> <!-- .portfolio-entry-meta -->
	</div> <!-- .entry-portfolio-content -->
</article>
</article><!-- #post-## -->
