<?php
/**
 * Template Name: Featured pages
 *
 * This is the template that display child papges as page thumbnail.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

get_header(); 

	$about_meta = get_post_meta( $post->ID );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if ( rwmb_meta( 'wpsp_masthead_title') ) : ?>
			<header class="entry-header">
				<h2 class="entry-title"><?php echo rwmb_meta( 'wpsp_masthead_title'); ?></h2>
			</header><!-- .entry-header -->
			<?php endif; ?>

			<section class="entry-content">
				<?php the_content(); ?>
			</section> <!-- .about-entry-content -->

			<section class="featured-pages wpsp-row clearfix">
			<?php // setup cols
				$cols = 4;
				$entry_classes = array(); 
				$entry_classes[] = 'span_1_of_'. $cols;
			?>
				<div class="col span_1_of_2">
					
				</div> <!-- .col span_1_of_2 -->
			</section> <!-- .li-goal -->
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();