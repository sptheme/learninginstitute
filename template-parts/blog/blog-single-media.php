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
$photos = rwmb_meta( 'wpsp_format_gallery_album', array('type' => 'image_advanced', 'size' => 'thumb-landscape') );

// Get single blog layout blocks
$post_format = get_post_format(); ?>


<?php if ( $video && 'video' == $post_format ) : ?>	
	<div id="blog-single-video">
	<?php printf( '<div class="blog-single-video">%s</div>',
				wpsp_get_post_video_html()
			); ?>
	</div> <!-- #blog-single-video --> 		
<?php elseif ( $photos && 'gallery' == $post_format ) : ?>	
	<div class="gallery wpsp-row clearfix">
	<?php foreach ($photos as $photo ) : ?>
		<div class="col span_1_of_4">
			<div class="post-thumbnail-wrap overlay-2">
				<img src="<?php echo $photo['url'];?>">
				<div class="caption-wrap">
					<div class="caption-inner">
					<a href="<?php echo $photo['full_url'];?>" rel="bookmark" title="<?php echo $photo['title'];?>"><span class="title"><?php echo esc_html__('View Photo', 'learninginstitute'); ?></span></a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>	
	</div>
<?php endif;?>

