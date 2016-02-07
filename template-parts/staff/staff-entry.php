<?php
/**
 * Template part for staff entry posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 


if ( ! isset( $related_query ) ) {
	global $post_count;
	$query = 'archive';
} else {
	$query = 'related';
}

// Add Standard Classes
$classes   = array();
$classes[] = 'staff-entry';
$classes[] = 'col';
$classes[] = wpsp_staff_column_class( $query );
$classes[] = 'col-'. $post_count; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="staff-entry-inner">
	<?php get_template_part( 'template-parts/staff/staff-entry-media' ); ?>
	<?php get_template_part( 'template-parts/staff/staff-entry-content' ); ?>
	</div> <!-- .inner-staff-entry -->
</article><!-- #post-## -->