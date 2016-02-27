<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="entry-header">
				<?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .entry-header -->

			<div class="posts-thumb clearfix">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clearfix', 'entry-blog-article') ); ?>>
					<?php get_template_part( 'template-parts/blog/blog-entry-media' ); ?>
					<?php get_template_part( 'template-parts/blog/blog-entry-title' ); ?>
					<?php get_template_part( 'template-parts/blog/blog-entry-meta' ); ?>
					<div class="blog-entry-excerpt">
						<?php wpsp_excerpt( array(
							'length'   => 20,
							'readmore' => false,
						) ); ?>
					</div>
				</article>

			<?php endwhile; ?>
			</div>
			<?php // Pagination
                if(function_exists('wp_pagenavi'))
                    wp_pagenavi();
                else 
                    wpsp_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
