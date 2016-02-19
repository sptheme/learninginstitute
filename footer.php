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
		</div><!-- .container -->	
	</div><!-- #content -->

	<?php wpsp_hook_content_bottom(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer-top">
			<div class="join-us">
				<div class="container clearfix">
					<?php if ( is_active_sidebar( 'social-footer-sidebar' ) ) dynamic_sidebar( 'social-footer-sidebar' ); ?>
				</div> <!-- .container -->
			</div> <!-- .join-us -->
			
			<?php if ( is_active_sidebar( 'signup-sidebar' ) ) dynamic_sidebar( 'signup-sidebar' ); ?>
		</div> <!-- #footer-top -->

		<div id="footer-bottom" class="footer-sidebar">
			<div class="container wpsp-row clearfix">
				<div id="footer-sidebar-1" class="col span_1_of_3">
				<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar' ); ?>
				<?php else : ?>
					<p>Go to <strong>Widget</strong> in Appearance menu to add widget into <strong>Footer Sidebar 1</strong>.</p>
				<?php endif; ?>
				</div>
				<div id="footer-sidebar-2" class="col span_1_of_3">
				<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
				<?php else : ?>
					<p>Go to <strong>Widget</strong> in Appearance menu to add widget into <strong>Footer Sidebar 1</strong>.</p>
				<?php endif; ?>
				</div>
				<div id="footer-sidebar-3" class="col span_1_of_3 last">
				<?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
				<?php else : ?>
					<p>Go to <strong>Widget</strong> in Appearance menu to add widget into <strong>Footer Sidebar 1</strong>.</p>
				<?php endif; ?>
				</div>
			</div> <!-- .container .clearfix -->	
		</div> <!-- .footer-sidebar -->

		<div class="site-info clearfix">
			<div class="copyright"><?php esc_html_e( 'All content copyright © 2010, The Learning Institute. All Rights Reserved.', 'learninginstitute' ); ?></div>
			<nav id="footer-navigation" class="footer-navigation" role="navigation">			
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'nav-menu-footer', 'container' => false ) ); ?>
			</nav><!-- #site-navigation -->
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
