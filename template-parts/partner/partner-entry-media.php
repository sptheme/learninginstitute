<?php
/**
 * Template part for displaying partner logo with link.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<?php 
$logos = rwmb_meta( 'wpsp_partner_logo', array('type' => 'image_advanced', 'size' => 'large') );
$logo_url = (rwmb_meta('wpsp_partner_url')) ? rwmb_meta('wpsp_partner_url') : '#'; ?>

<a href="<?php echo $logo_url; ?>" rel="bookmark" title="<?php echo wpsp_get_esc_title(); ?>" target="_blank">
	<?php foreach ( $logos as $logo ) : ?>
		<img src="<?php echo $logo['full_url']; ?>">
	<?php endforeach; ?>
</a>