<?php
/**
 * Template part for displaying staff entry excerpt.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Get excerpt length
$excerpt_length = 20;

// Return if excerpt length is set to 0
if ( '0' == $excerpt_length ) {
	return;
} ?>

<div class="entry-excerpt">
	<?php wpsp_excerpt( array(
		'length'   => $excerpt_length,
		'readmore' => false,
	) ); ?>
</div><!-- .entry-excerpt -->