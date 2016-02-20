<?php
/**
 * Template part for displaying page header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

$custom_page_header_bg_img = wp_get_attachment_url( rwmb_meta( 'wpsp_masthead_image') );
$default_bg_img = array(
				get_template_directory_uri() . '/images/place-holder-1600-650-1.jpg',
				get_template_directory_uri() . '/images/place-holder-1600-650-2.jpg',
				get_template_directory_uri() . '/images/place-holder-1600-650-3.jpg',
				get_template_directory_uri() . '/images/place-holder-1600-650-4.jpg',
				get_template_directory_uri() . '/images/place-holder-1600-650-5.jpg',
			);
$page_header_title = get_post_meta( get_the_ID(), 'wpsp_masthead_title', true );
$page_subheadline = get_post_meta( get_the_ID(), 'wpsp_masthead_desc', true );

( $custom_page_header_bg_img ) ? $page_header_bg_img = $custom_page_header_bg_img : $page_header_bg_img = $default_bg_img[(rand(1, count($default_bg_img))-1)];
?>

<div id="page-header" class="page-header page-header-background-image" style="background-image:url(<?php echo $page_header_bg_img; ?>);">
	<div class="page-header-inner">
		<div class="container clearfix">
			<h1 class="page-header-title"><?php the_title(); ?></h1>
			<p class="page-subheadline"><?php echo esc_html__( $page_subheadline ); ?></p>
		</div>
	</div> <!-- .page-header-inner -->
	<span class="page-header-overlay"></span>
</div> <!-- #page-header -->
