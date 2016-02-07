<?php
/**
 * Learning Institute functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Learning_Institute
 */

if ( ! function_exists( 'learninginstitute_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function learninginstitute_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Learning Institute, use a find and replace
	 * to change 'learninginstitute' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'learninginstitute', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'wpsp-post', 760, 506, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'learninginstitute' ),
		'mobile' => esc_html__( 'Mobile Menu', 'learninginstitute' ),
		'footer' => esc_html__( 'Footer Menu', 'learninginstitute' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
}
endif;
add_action( 'after_setup_theme', 'learninginstitute_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function learninginstitute_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'learninginstitute_content_width', 640 );
}
add_action( 'after_setup_theme', 'learninginstitute_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function learninginstitute_scripts() {
	wp_enqueue_style( 'learninginstitute-style', get_stylesheet_uri() );

	//Add Google Fonts (English): Merriweather and Open Sans
	//wp_enqueue_style( 'google-font-english', 'https://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic|Open+Sans:400,400italic,700,700italic' );

	//Add Google Font (Khmer): Hanuman
	//wp_enqueue_style( 'google-font-khmer', 'https://fonts.googleapis.com/css?family=Hanuman:400,700' );

	//Enabling Local Web Fonts
	wp_enqueue_style( 'local-fonts-english', get_template_directory_uri() . '/fonts/custom-fonts.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'mobile-menu', get_template_directory_uri() . '/css/mobile-menu.css' );

	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151214', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'learninginstitute_scripts' );

/*
 * Add Redux Framework
 */
require get_template_directory() . '/inc/admin/admin-init.php';

/**
 * Custom widgets and sidebar layout.
 */
require get_template_directory() . '/inc/widgets/widgets.php';
/**
 * Custom widgets and sidebar layout.
 */
require get_template_directory() . '/inc/shortcodes/shortcodes.php';

/*
 * Add Meta Box
 * https://metabox.io/
 */
require get_template_directory() . '/inc/meta-box/meta-box.php';
// Meta Sample Config
require get_template_directory() . '/inc/meta-box/demo.php';
// Meta hfhc Config
require get_template_directory() . '/inc/meta-box/meta-config.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/*
 * Add Custom Posts
 */
// Portfolio custom post
require get_template_directory() . '/inc/custom-posts/cp-portfolio.php';
require get_template_directory() . '/inc/custom-posts/cp-staff.php';
require get_template_directory() . '/inc/custom-posts/cp-testimonials.php';
require get_template_directory() . '/inc/custom-posts/cp-photo-gallery.php';
