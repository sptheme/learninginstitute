<?php
/**
 * Template part for displaying single blog media.
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

// Get single blog layout blocks
$video = wpsp_get_post_video_html(); 

// Get single blog layout blocks
$post_format = get_post_format(); ?>

<?php if ( $video && 'video' == $post_format ) : ?>	
	<?php printf( '<div class="blog-entry-video">%s</div>',
				wpsp_get_post_video_html()
			); ?>
	<?php else: ?>
		<div id="blog-entry-media" class="blog-entry-media">
			<div class="post-thumbnail">	
	<?php 
		if (has_post_thumbnail()) {
			printf( '<a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a>', 
					wpsp_get_permalink(), 
					wpsp_get_esc_title(), 
					wpsp_post_thumbnail('blog-entry')  
				); 
		} else {
			printf( '<a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a>', 
					wpsp_get_permalink(), 
					wpsp_get_esc_title(), 
					'<img src="' . esc_url( $redux_wpsp['landscape-placeholder']['url']) . '">'
				);
		}?>
			</div> <!-- .post-thumbnail -->
		</div> <!-- .blog-entry-media -->
<?php endif;?> 	
