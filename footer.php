<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Learning_Institute
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'learninginstitute' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'learninginstitute' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'learninginstitute' ), 'learninginstitute', '<a href="https://www.linkedin.com/in/sopheakpeas" rel="designer">Sopheak Peas</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<nav id="sitemenu-container" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
	<div id="inner-mobile-menu">
	    <div class="mobile-branding">
	    	<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">
			
			<?php $description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif; ?>
	    </div>
	    
	    <?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'menu-mobile', 'theme_location' => 'mobile', 'menu_class' => 'mobile-nav' ) ); ?>
    </div> <!-- #inner-mobile-menu -->
</nav>

<?php wp_footer(); ?>

</body>
</html>
