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
$logo_img = wp_get_attachment_image( rwmb_meta( 'wpsp_partner_logo'), 'large' );
$logo_url = (rwmb_meta('wpsp_partner_url')) ? rwmb_meta('wpsp_partner_url') : '#';
printf( '<a itemprop="url" href="%1$s" rel="bookmark" title="%2$s" target="_blank">%3$s</a>', 
	$logo_url, 
	wpsp_get_esc_title(), 
	$logo_img  
); ?>
