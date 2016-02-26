<?php
/**
 * Template part for displaying portfolio entry title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<h3 class="entry-title portfolio-entry-title">
	<a href="<?php wpsp_permalink();?>" title="<?php echo wpsp_esc_title(); ?>" rel="bookmark"><?php echo wpsp_limit_title_lenght(55); ?></a>	
</h3> <!-- .portfolio-entry-title -->
