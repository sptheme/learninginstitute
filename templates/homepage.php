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
		<div class="container">
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
    	</div> <!-- .container -->
	</section> <!-- .our-work -->

	<?php // get video post
		$args = array(
				'post_type' => 'post',
				'posts_per_page' => 1,
				'tax_query' => array( array(
		            'taxonomy' => 'post_format',
		            'field' => 'slug',
		            'terms' => array('post-format-video'),
		            'operator' => 'IN'
		           ) )
			);
		$video_post_query = new WP_Query($args);

		if ( $video_post_query->have_posts() ) : 
			while ( $video_post_query->have_posts() ) : $video_post_query->the_post(); ?>

	<section class="latest-video-wrap">
		<div class="container">
			<div class="latest-video wpsp-row clearfix">
			<div class="col span_1_of_2">
				<?php printf( '<div class="post-thumbnail"><a class="popup-youtube" itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a></div>', 
					wpsp_get_post_video(), 
					wpsp_get_esc_title(), 
					wpsp_post_thumbnail('blog-post')  
				); ?>
			</div>
			<div class="col span_1_of_2">
				<?php get_template_part( 'template-parts/blog/blog-entry-title' ); ?>
				<?php get_template_part( 'template-parts/blog/blog-entry-meta' ); ?>
				<?php get_template_part( 'template-parts/blog/blog-entry-excerpt' ); ?>
			</div>
			</div> <!-- .latest-video -->
		</div> <!-- .container -->
	</section>
	<?php endwhile; wp_reset_postdata(); 
	endif; ?>

	<section class="latest-post-wrap">
		<div class="container">
			<header class="section-title">
				<h2><?php echo $home_meta['wpsp_latest_post_headline'][0]; ?></h2>
			</header>
			<div class="latest-post wpsp-row posts-thumb clearfix">
				<div class="col span_2_of_3">
				<?php // get video post
					$post_number = $home_meta['wpsp_latest_post_number'][0];
					$args = array(
							'post_type' => 'post',
							'posts_per_page' => $post_number,
							'post__not_in' => get_option( 'sticky_posts' ),
							'tax_query' => array( array(
					            'taxonomy' => 'post_format',
					            'field' => 'slug',
					            'terms' => array('post-format-video'),
					            'operator' => 'NOT IN'
					           ) )
						);
					$video_post_query = new WP_Query($args);

					if ( $video_post_query->have_posts() ) : 
						$post_count = 0;
						while ( $video_post_query->have_posts() ) : $video_post_query->the_post(); 
							$post_count++;
							if ( $post_count <= $post_number ) : ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clearfix', 'entry-blog-article') ); ?>>
								<?php get_template_part( 'template-parts/blog/blog-entry-media' ); ?>
								<?php get_template_part( 'template-parts/blog/blog-entry-title' ); ?>
								<?php get_template_part( 'template-parts/blog/blog-entry-meta' ); ?>
								<div class="blog-entry-excerpt">
									<?php wpsp_excerpt( array(
										'length'   => 20,
										'readmore' => false,
									) ); ?>
								</div>
								</article>
							<?php endif; ?>
					<?php endwhile; wp_reset_postdata(); 
					endif; ?>
				</div>
				<div class="col span_1_of_3">
					facebook like box <?php echo $home_meta['wpsp_latest_post_number'][0]; ?>
				</div>
			</div>
		</div> <!-- .container -->
	</section> <!-- .latest-post-wrap -->


<?php get_footer(); ?>