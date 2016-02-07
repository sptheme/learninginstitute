<?php
/**
 * Template part for displaying staff single title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<header id="staff-single-header" class="single-header">
	<h1 id="staff-single-title" class="entry-title single-post-title"><?php the_title(); ?></h1>
	<?php get_template_part( 'template-parts/staff/staff-single-position' ); ?>
</header><!-- .entry-header -->
