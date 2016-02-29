<?php
/**
 * Template part for displaying portfolio entry excerpt.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

$excerpt_length = 25;
?>


<div class="portfolio-entry-excerpt">
	<?php wpsp_excerpt( array(
		'length'   => $excerpt_length,
		'readmore' => true,
	) ); ?>
</div><!-- .entry-excerpt -->
