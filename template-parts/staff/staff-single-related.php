<?php
/**
 * Template part for displaying staff single related posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  

// Get post id
$post_id = get_the_ID();

// Posts count
$posts_count = 3;

// Return if count is empty or 0 - easy for child theme
if ( ! $posts_count || '0' == $posts_count ) {
	return;
}

// Related query arguments
$args = array(
	'post_type'      => 'staff',
	'posts_per_page' => $posts_count,
	'orderby'        => 'rand',
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
);

// Query by terms
$cats     = wp_get_post_terms( $post_id, 'staff_category' ); 
$cats_ids = array();  
foreach( $cats as $wpsp_related_cat ) {
	$cats_ids[] = $wpsp_related_cat->term_id; 
}
if ( ! empty( $cats_ids ) ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'staff_category',
			'field'    => 'id',
			'terms'    => $cats_ids,
			'operator' => 'IN',
		),
	);
} 

// Apply filters to query args
$args = apply_filters( 'wpex_related_staff_args', $args );

// Run Query - must be set to $wpex_related_query var!!
$related_query = new wp_query( $args );

// If posts were found display related items
if ( $related_query->have_posts() ) : ?>

<section id="staff-single-related">
	<?php
		$heading = 'Related Staff';
		$heading = $heading ? $heading : esc_html__( 'Related Staff', 'learninginstitute' );
		// If Heading text isn't empty
	if ( $heading ) : ?>
	<h2><?php echo $heading; ?></h2>
	<?php endif; ?>
	<div class="wpsp-row clearfix">
		<?php 
		// Define post count
		$post_count = 0;
		// Loop through posts
		foreach( $related_query->posts as $post ) : setup_postdata( $post );

			// Add to counter
			$post_count++;

			// Include template (use include to pass variables)
			if ( $template = locate_template( 'template-parts/staff/staff-entry.php' ) ) {
				include( $template );
			}
			if ( $post_count == 3 ) {
				$post_count = 0;	
			}

		endforeach;	?>
	</div> <!-- .wpsp-row .clearfix -->	
</section>
<?php endif; ?>