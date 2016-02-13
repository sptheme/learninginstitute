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

// Get single blog layout blocks
$video = wpsp_get_post_video_html(); 

// Get single blog layout blocks
$post_format = get_post_format(); ?>

<div id="post-media">
<?php if ( $video && 'video' == $post_format ) : ?>	
	<?php printf( '<div class="blog-post-video">%s</div>',
				wpsp_get_post_video_html()
			); ?>
	<?php else: ?>
	<?php printf( '<div class="post-thumbnail"><a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a></div>', 
				wpsp_get_permalink(), 
				wpsp_get_esc_title(), 
				wpsp_post_thumbnail('blog-post')  
			); ?>
<?php endif;?>
</div> <!-- #post-media --> 	
