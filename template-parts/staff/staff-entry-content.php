<?php
/**
 * Template part for displaying staff entry content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="staff-entry-content">
	<?php get_template_part( 'template-parts/staff/staff-entry-title' ); ?>
	<?php get_template_part( 'template-parts/staff/staff-entry-position' ); ?>
	<?php //get_template_part( 'template-parts/staff/staff-entry-excerpt' ); ?>
</div><!-- .entry-content -->