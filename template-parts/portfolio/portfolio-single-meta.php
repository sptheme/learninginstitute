<?php
/**
 * Template part for displaying portfolio single meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<div class="portfolio-single-meta meta">
	<?php printf( '<span class="portfolio-province"><i class="fa fa-map-marker"></i> %s</span>', get_the_term_list( get_the_ID(), 'portfolio_province', '', ', ', '' ) ); ?>
	<!-- Project meta was disabled by LI Team. To be enable, pls update inc/meta-box-meta-config -->
	<?php //if ( rwmb_meta('wpsp_portfolio_status') ) printf( '<span class="portfolio-status"><i class="fa fa-tachometer"></i> %s</span>', wpsp_portfolio_status(rwmb_meta('wpsp_portfolio_status')) ); ?>
	<?php //if ( rwmb_meta('wpsp_portfolio_progress') ) printf( '<span class="portfolio-progress">%s</span>', rwmb_meta('wpsp_portfolio_progress') . '%' ); ?>
</div><!-- .entry -->
