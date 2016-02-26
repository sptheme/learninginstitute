<?php
/**
 * Template part for displaying portfolio entry meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<div class="portfolio-entry-meta">
	<?php printf( '<span class="portfolio-province">%s</span>', get_the_term_list( get_the_ID(), 'portfolio_province', '', ', ', '' ) ); ?>
	<?php if ( rwmb_meta('wpsp_portfolio_status') ) printf( '<span class="portfolio-status">%s</span>', wpsp_portfolio_status(rwmb_meta('wpsp_portfolio_status')) ); ?>
	<?php if ( rwmb_meta('wpsp_portfolio_progress') ) printf( '<span class="portfolio-progress">%s</span>', rwmb_meta('wpsp_portfolio_progress') . '%' ); ?>
</div> <!-- .portfolio-entry-meta -->
