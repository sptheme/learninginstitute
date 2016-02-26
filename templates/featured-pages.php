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
				$page_count = 0;
				$cols = rwmb_meta('wpsp_page_col') ? rwmb_meta('wpsp_page_col') : 4;
				$post_style = 'post-highlight';
				$post_excerpt = 1;
				$excerpt_length = 25;
				$entry_classes = array( 'entry-blog-article' ); 
				$entry_classes[] = $post_style;
				$entry_classes[] = 'col';
				$entry_classes[] = wpsp_grid_class($cols);
				$entry_classes[] = 'col-' . $page_count;

				$args = array (
					'child_of' => rwmb_meta('wpsp_featured_parent_page'),
					'sort_column' => 'menu_order',
				); 
				$featured_pages = get_pages( $args );
				if ( !empty($featured_pages) ) {
					foreach ( $featured_pages as $page ) { ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
							<div class="post-thumbnail">
								<a href="<?php wpsp_permalink($page->ID);?>" title="<?php echo wpsp_esc_title($page->ID); ?>" rel="bookmark">
									<?php echo get_the_post_thumbnail( $page->ID, 'thumb-landscape' ); ?>
								</a>
							</div>
							<div class="entry-post-content-wrap">
								<div class="entry-blog-content">
									<h3 id="blog-entry-title" class="entry-title entry-blog-title">
										<a href="<?php wpsp_permalink($page->ID);?>" title="<?php echo wpsp_esc_title($page->ID); ?>" rel="bookmark"><span class="title"><?php echo $page->post_title; ?></span></a>	
									</h3>
								</div> <!-- .entry-blog-content -->
								<?php if ( $post_excerpt ) { ?>
								<div class="blog-entry-excerpt">
									<?php /*wpsp_excerpt( array(
										'length'   => $excerpt_length,
										'readmore' => true,
									) );*/ echo $page->post_excerpt; ?>
								</div>
								<?php } ?>
							</div> <!-- .entry-post-content-wrap -->
						</article>	
				<?php }; 
				} ?>
			</section> <!-- .li-goal -->
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();