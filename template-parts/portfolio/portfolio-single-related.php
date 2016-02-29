<?php
/**
 * Template part for displaying portfolio single related posts.
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

// Return if disabled
if ( ! $redux_wpsp['is-portfolio-post-related'] ) {
	return;
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
	'post_type'      => 'portfolio',
	'posts_per_page' => $posts_count,
	'orderby'        => 'rand',
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
);

// Query by terms
$cats     = wp_get_post_terms( $post_id, 'portfolio_category' ); 
$provinces     = wp_get_post_terms( $post_id, 'portfolio_province' ); 
$cats_ids = array();  
$provinces_ids = array();  
foreach( $cats as $wpsp_related_cat ) {
	$cats_ids[] = $wpsp_related_cat->term_id; 
}
foreach( $provinces as $wpsp_related_province ) {
	$provinces_ids[] = $wpsp_related_province->term_id; 
}
if ( ! empty( $cats_ids ) ) {
	$args['tax_query'] = array (
		'relation' => 'OR',
		array (
			'taxonomy' => 'portfolio_category',
			'field'    => 'id',
			'terms'    => $cats_ids,
			'operator' => 'IN',
		),
	);
} 
if ( ! empty( $provinces_ids ) ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'portfolio_province',
			'field'    => 'id',
			'terms'    => $provinces_ids,
			'operator' => 'IN',
		),
	);
} 

// Apply filters to query args
$args = apply_filters( 'wpsp_related_portfolio_args', $args );

// Run Query - must be set to $wpex_related_query var!!
$related_query = new wp_query( $args );

// If posts were found display related items
if ( $related_query->have_posts() ) : ?>

<section id="portfolio-single-related">
	<?php
		$heading = $redux_wpsp['portfolio-post-related-title'];
		$heading = $heading ? $heading : esc_html__( 'Related projects', 'learninginstitute' );
		// If Heading text isn't empty
	if ( $heading ) : ?>
	<h3><?php echo $heading; ?></h3>
	<?php endif; ?>
	<div class="wpsp-row clearfix">
		<?php 
		// Define post count
		$post_count = 0;
		$cols = 3;
		$entry_classes = array( 'portfolio-single-related' ); 
		$entry_classes[] = 'related-post';
		$entry_classes[] = 'col';
		$entry_classes[] = wpsp_grid_class($cols);
		// Loop through posts
		foreach( $related_query->posts as $post ) : setup_postdata( $post );

			// Add to counter
			$post_count++;

			// Include template (use include to pass variables)
			//include ( locate_template( 'template-parts/portfolio/portfolio-entry.php' ) ) ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
				<?php get_template_part( 'template-parts/portfolio/portfolio-entry-media' ); ?>
				<div class="portfolio-entry-content">
					<?php get_template_part( 'template-parts/portfolio/portfolio-entry-title' ); ?>
					<?php get_template_part( 'template-parts/portfolio/portfolio-entry-meta' ); ?>
				</div> <!-- .entry-portfolio-content -->
			</article>
		<?php
			if ( $post_count == 3 ) {
				$post_count = 0;	
			}

		endforeach;	?>
	</div> <!-- .wpsp-row .clearfix -->	
</section>
<?php endif; ?>