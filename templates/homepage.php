<?php
/**
 * Template Name: Homepage
 *
 * This is the template that displays landing homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

get_header(); 

	$home_meta = get_post_meta( $post->ID );
?>
	
	<section class="our-work">
		<header class="section-title">
		<?php if ( !empty($home_meta['wpsp_program_headline'][0]) ) : ?>
            <h2><?php echo $home_meta['wpsp_program_headline'][0]; ?></h2>
        <?php endif; ?>    
        <?php if ( !empty($home_meta['wpsp_program_desc'][0]) ) : ?>
            <p class="description"><?php echo $home_meta['wpsp_program_desc'][0]; ?></p>
        <?php endif; ?>    
        </header>
        <?php if ( !empty($home_meta['wpsp_main_program_page'][0]) ) : ?>
        <div class="featured-page wpsp-row clearfix">
    	<?php
    		$page_count = 0;
    		$args = array (
				'child_of' => $home_meta['wpsp_main_program_page'][0],
				'sort_column' => 'menu_order',
			); 
			$featured_pages = get_pages( $args );
			if ( !empty($featured_pages) ) {
				foreach ( $featured_pages as $page ) { 
					$page_count++;
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
	            	if ( $page_count == 1 ) {
	            		$image_url = aq_resize( $thumb_url[0], '415', '560', true);
	            	} else {
	            		$image_url = aq_resize( $thumb_url[0], '415', '270', true);
	            	}
	            	if ( $page_count <= 3 ) { 
	            		$entry_classes = array( 'page-entry-overlay' );
						$entry_classes[] = 'col';
						$entry_classes[] = wpsp_grid_class(2); 
						$entry_classes[] = 'col-' . $page_count; ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
							<div class="entry-page post-thumbnail-wrap overlay-1">
								<img src="<?php echo $image_url;?>">
								<div class="caption-wrap">
									<div class="caption-inner">
									<a href="<?php wpsp_permalink($page->ID);?>" rel="bookmark"><span class="title"><?php echo $page->post_title; ?></span></a>
									</div>
								</div>
							</div>
						</article> <!-- .page-entry-overlay -->

	            <?php }
				} 
			}?>
        </div> <!-- .featured-page .clearfix -->
    	<?php endif; ?>
	</section>

<?php get_footer(); ?>