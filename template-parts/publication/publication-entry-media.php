<?php
/**
 * Template part for displaying publication entry media.
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

<div id="publication-entry-media" class="publication-entry-media">
	<div class="post-thumbnail"><?php wpsp_get_post_thumbnail('thumb-portrait'); ?></div>	
</div> <!-- .publication-entry-media -->