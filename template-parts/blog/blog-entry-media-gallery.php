<?php
/**
 * Template part for displaying entry media gallery.
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
$post_format = get_post_format(); 
if ( $post_format != 'gallery' ) ) {
	exit;
} 

$photos = rwmb_meta( 'wpsp_format_gallery_album', array('type' => 'image_advanced', 'size' => 'thumb-landscape') );
$photo_count = 0;
?>

<div class="blog-entry-media-gallery">
	<?php foreach ($photos as $photo ) : $photo_count ++; ?>
		<?php if ( $photo_count == 1 ) : ?>
		<div class="col span_1_of_4">
			<div class="post-thumbnail-wrap overlay-2">
				<div class="post-thumbnail"><img src="<?php echo $photo['url'];?>"></div>
				<div class="caption-wrap">
					<div class="caption-inner">
					<a href="<?php wpsp_permalink();?>" title="<?php echo wpsp_esc_title(); ?>" rel="bookmark"><span class="title"><?php the_title(); ?></span></a>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div> <!-- .blog-entry-media -->
