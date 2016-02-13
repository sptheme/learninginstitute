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


<?php if ( $video && 'video' == $post_format ) : ?>	
	<div id="post-media">
	<?php printf( '<div class="blog-post-video">%s</div>',
				wpsp_get_post_video_html()
			); ?>
	</div> <!-- #post-media --> 		
<?php endif;?>

