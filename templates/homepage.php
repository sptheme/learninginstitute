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
        <div class="featured-page clearfix">
    	<?php echo 'Featured page start'; 
    		$args = array (
				'child_of' => $home_meta['wpsp_main_program_page'][0],
				'number' => 3,
				'sort_column' => 'menu_order'
			); 
			$featured_pages = get_pages( $args );
			$page_count = 0;
			if ( !empty($featured_pages) ) {
				echo 'Featured page'; 
				foreach ( $featured_pages as $page ) { 
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
	            	if ( $page_count == 1 ) {
	            		$image_url = aq_resize( $thumb_url[0], '415', '270', true);
	            	} else {
	            		$image_url = aq_resize( $thumb_url[0], '300', '180', true);	
	            	}
	            	echo '<img src="' . $image_url . '">';
	            	echo '<a href="'.get_page_link( $page->ID ).'">' . $page->post_title . '</a>';
	            	$page_count++;
				} 
			}?>
        </div> <!-- .featured-page .clearfix -->
    	<?php endif; ?>
	</section>

<?php get_footer(); ?>