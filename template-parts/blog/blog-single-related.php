<?php
/**
 * Template part for displaying blog single related posts.
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
if ( ! $redux_wpsp['is-post-related'] ) {
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

// Query by terms
$cats     = wp_get_post_terms( get_the_ID(), 'category' );
$cats_ids = array();  
foreach( $cats as $wpsp_related_cat ) {
	$cats_ids[] = $wpsp_related_cat->term_id; 
}

// Query args
$args = array(
	'posts_per_page' => 3,
	'orderby'        => 'rand',
	'category__in'   => $cats_ids,
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
	'tax_query'      => array (
		'relation'  => 'AND',
		array (
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio', 'post-format-image', 'post-format-aside', 'post-format-chat', 'post-format-status' ),
			'operator' => 'NOT IN',
		),
	),
);
$args = apply_filters( 'wpsp_related_blog_post_args', $args );

// Run Query - must be set to $wpex_related_query var!!
$related_query = new wp_query( $args );

// If posts were found display related items
if ( $related_query->have_posts() ) : ?>

<section id="blog-single-related">
	<?php
		$heading = $redux_wpsp['post-related-title'];
		$heading = $heading ? $heading : esc_html__( 'You may also see...', 'learninginstitute' );
		// If Heading text isn't empty
	if ( $heading ) : ?>
	<h3><?php echo $heading; ?></h3>
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
			include( locate_template( 'template-parts/blog/blog-entry-related.php' ) );

			if ( $post_count == 3 ) $post_count = 0;
		endforeach;	?>
	</div> <!-- .wpsp-row .clearfix -->	
</section>
<?php endif; ?>