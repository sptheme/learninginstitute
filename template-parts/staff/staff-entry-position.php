<?php
/**
 * Template part for displaying staff entry position.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
<?php if ( $position = get_post_meta( get_the_ID(), 'wpsp_staff_position', true ) ) : ?>
	<div id="staff-entry-position" class="staff-entry-position"><?php echo $position; ?></div>
<?php endif; ?>
