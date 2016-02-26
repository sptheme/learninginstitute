<?php
/**
 * Template part for displaying portfolio thumbnail.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<?php printf( '<div class="post-thumbnail"><a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a></div>', 
	wpsp_get_permalink(), 
	wpsp_get_esc_title(), 
	wpsp_post_thumbnail('thumb-landscape')  
); ?>
