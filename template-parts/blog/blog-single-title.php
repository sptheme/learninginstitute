<?php
/**
 * Template part for displaying single post title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<header id="blog-single-header" class="single-header">
	<h1 id="blog-single-title" class="single-post-title"><?php the_title(); ?></h1>
</header><!-- .entry-header -->
