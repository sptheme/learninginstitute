<?php
/**
 * Template part for displaying staff single media.
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
?>
<div id="staff-single-media" class="staff-single-media">
	<?php wpsp_get_post_thumbnail('thumb-portrait'); ?>
</div> <!-- .staff-single-media -->