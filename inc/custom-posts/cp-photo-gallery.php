<?php 
/**
 * Photo Gallery custom post type
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPSP_Cp_Photo_Gallery' ) ) {
	class WPSP_Cp_Photo_Gallery {
		
		private $label;

		/**
		 * Get things started.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Update vars
			$this->label = get_option( 'photo_gallery_labels' );
			$this->label = $this->label ? $this->label : _x( 'Photo Gallery', 'Photo Gallery Post Type Label', 'wpsp_admin' );

			// Adds the photo gallery post type
			add_action( 'init', array( $this, 'register_post_type' ), 0 );

			// Adds the photo gallery taxonomies
			if ( 'off' != get_option( 'photo_gallery_tags', 'on' ) ) {
				add_action( 'init', array( $this, 'register_tags' ), 0 );
			}
			if ( 'off' != get_option( 'photo_gallery_categories', 'on' ) ) {	
				add_action( 'init', array( $this, 'register_categories' ), 0 );
			}	

			// Admin only actions
			if ( is_admin() ) {
				// Adds columns in the admin view for taxonomies
				add_filter( 'manage_edit-photo_gallery_columns', array( $this, 'edit_columns' ) );
				add_action( 'manage_photo_gallery_posts_custom_column', array( $this, 'column_display' ), 10, 2 );

				// Allows filtering of posts by taxonomy in the admin view
				add_action( 'restrict_manage_posts', array( $this, 'tax_filters' ) );

				// Create Editor for altering the post type arguments
				add_action( 'admin_menu', array( $this, 'add_page' ) );
				add_action( 'admin_init', array( $this,'register_page_options' ) );
				add_action( 'admin_notices', array( $this, 'notices' ) );
				add_action( 'admin_print_styles-photo_gallery_page_wpsp-photo-gallery-editor', array( $this,'css' ) );
			}	

			// Adds the photo gallery custom sidebar
			add_filter( 'widgets_init', array( $this, 'register_sidebar' ) );

			// Posts per page
			add_action( 'pre_get_posts', array( $this, 'posts_per_page' ) );

		}

		/**
		 * Register post type
		 *
		 * @since 1.0.0
		 */
		public function register_post_type() {

			// Get values and sanitize
			$name             = $this->label;
			$singular_name    = get_option( 'photo_gallery_singular_name' );
			$singular_name    = $singular_name ? $singular_name : esc_html__( 'Photo Gallery Item', 'wpsp_admin' );
			$slug  			  = get_option( 'photo_gallery_slug' );
			$slug             = $slug ? $slug : 'photo-gallery-item';
			$menu_icon        = get_option( 'photo_gallery_admin_icon' );
			$menu_icon        = $menu_icon ? $menu_icon : 'format-gallery';
			$photo_gallery_search = true;

			// Args
			$args = array(
				'labels' => array(
					'name' => $name,
					'singular_name' => $singular_name,
					'add_new' => esc_html__( 'Add New', 'wpsp_admin' ),
					'all_items' => esc_html__( 'All ' . $name, 'wpsp_admin' ),
					'add_new_item' => esc_html__( 'Add New Item', 'wpsp_admin' ),
					'edit_item' => esc_html__( 'Edit Item', 'wpsp_admin' ),
					'new_item' => esc_html__( 'Add New Item', 'wpsp_admin' ),
					'view_item' => esc_html__( 'View Item', 'wpsp_admin' ),
					'search_items' => esc_html__( 'Search Items', 'wpsp_admin' ),
					'not_found' => esc_html__( 'No Items Found', 'wpsp_admin' ),
					'not_found_in_trash' => esc_html__( 'No Items Found In Trash', 'wpsp_admin' )
				),
				'public' => true,
				'capability_type' => 'post',
				'has_archive' => false,
				'menu_icon' => 'dashicons-'. $menu_icon,
				'menu_position' => 20,
				'exclude_from_search' => $photo_gallery_search,
				'rewrite' => array(
					'slug' => $slug,
				),
				'supports' => array(
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'comments',
					'custom-fields',
					'revisions',
					'author',
					'page-attributes',
				),
			);

			// Register the post type
			register_post_type( 'photo_gallery', apply_filters( 'wpsp_photo_gallery_args', $args ) );

		}

		/**
		 * Register Photo Gallery tags.
		 *
		 * @since 1.0.0
		 */
		public static function register_tags() {

			// Define and sanitize options
			$name = esc_html( get_option( 'photo_gallery_tag_labels' ) );
			$name = $name ? $name : esc_html__( 'Photo Gallery Tags', 'wpsp' );
			$slug = get_option( 'photo_gallery_tag_slug' );
			$slug = $slug ? $slug : 'photo-gallery-tag';

			// Define photo gallery tag arguments
			$args = array(
				'labels' => array(
					'name' => $name,
					'singular_name' => $name,
					'menu_name' => $name,
					'search_items' => esc_html__( 'Search','wpsp' ),
					'popular_items' => esc_html__( 'Popular', 'wpsp' ),
					'all_items' => esc_html__( 'All', 'wpsp' ),
					'parent_item' => esc_html__( 'Parent', 'wpsp' ),
					'parent_item_colon' => esc_html__( 'Parent', 'wpsp' ),
					'edit_item' => esc_html__( 'Edit', 'wpsp' ),
					'update_item' => esc_html__( 'Update', 'wpsp' ),
					'add_new_item' => esc_html__( 'Add New', 'wpsp' ),
					'new_item_name' => esc_html__( 'New', 'wpsp' ),
					'separate_items_with_commas' => esc_html__( 'Separate with commas', 'wpsp' ),
					'add_or_remove_items' => esc_html__( 'Add or remove', 'wpsp' ),
					'choose_from_most_used' => esc_html__( 'Choose from the most used', 'wpsp' ),
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => false,
				'rewrite' => array(
					'slug'  => $slug,
				),
				'query_var' => true,
			);

			// Apply filters
			$args = apply_filters( 'wpsp_taxonomy_photo_gallery_tag_args', $args );

			// Register the photo gallery tag taxonomy
			register_taxonomy( 'photo_gallery_tag', array( 'photo_gallery' ), $args );

		}

		/**
		 * Register Photo Gallery category.
		 *
		 * @since 1.0.0
		 */
		public static function register_categories() {

			// Define and sanitize options
			$name = esc_html( get_option( 'photo_gallery_cat_labels' ) );
			$name = $name ? $name : esc_html__( 'Photo Gallery Categories', 'wpsp' );
			$slug = get_option( 'photo_gallery_tag_slug' );
			$slug = $slug ? $slug : 'photo-gallery-category';

			// Define photo gallery category arguments
			$args = array(
				'labels' => array(
					'name' => $name,
					'singular_name' => $name,
					'menu_name' => $name,
					'search_items' => esc_html__( 'Search','wpsp' ),
					'popular_items' => esc_html__( 'Popular', 'wpsp' ),
					'all_items' => esc_html__( 'All', 'wpsp' ),
					'parent_item' => esc_html__( 'Parent', 'wpsp' ),
					'parent_item_colon' => esc_html__( 'Parent', 'wpsp' ),
					'edit_item' => esc_html__( 'Edit', 'wpsp' ),
					'update_item' => esc_html__( 'Update', 'wpsp' ),
					'add_new_item' => esc_html__( 'Add New', 'wpsp' ),
					'new_item_name' => esc_html__( 'New', 'wpsp' ),
					'separate_items_with_commas' => esc_html__( 'Separate with commas', 'wpsp' ),
					'add_or_remove_items' => esc_html__( 'Add or remove', 'wpsp' ),
					'choose_from_most_used' => esc_html__( 'Choose from the most used', 'wpsp' ),
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => true,
				'rewrite' => array( 'slug' => $slug ),
				'query_var' => true
			);

			// Apply filters
			$args = apply_filters( 'wpsp_taxonomy_photo_gallery_category_args', $args );

			// Register the photo gallery category taxonomy
			register_taxonomy( 'photo_gallery_category', array( 'photo_gallery' ), $args );

		}

		/**
		 * Adds columns to the WP dashboard edit screen.
		 *
		 * @since 1.0.0
		 */
		public static function edit_columns( $columns ) {
			if ( taxonomy_exists( 'photo_gallery_category' ) ) {
				$columns['photo_gallery_category'] = esc_html__( 'Category', 'wpsp' );
			}
			if ( taxonomy_exists( 'photo_gallery_tag' ) ) {
				$columns['photo_gallery_tag']      = esc_html__( 'Tags', 'wpsp' );
			}
			return $columns;
		}
		

		/**
		 * Adds columns to the WP dashboard edit screen.
		 *
		 * @since 1.0.0
		 */
		public static function column_display( $column, $post_id ) {

			switch ( $column ) :

				// Display the photo gallery categories in the column view
				case 'photo_gallery_category':

					if ( $category_list = get_the_term_list( $post_id, 'photo_gallery_category', '', ', ', '' ) ) {
						echo $category_list;
					} else {
						echo '&mdash;';
					}

				break;

				// Display the photo gallery tags in the column view
				case 'photo_gallery_tag':

					if ( $tag_list = get_the_term_list( $post_id, 'photo_gallery_tag', '', ', ', '' ) ) {
						echo $tag_list;
					} else {
						echo '&mdash;';
					}

				break;

			endswitch;

		}

		/**
		 * Adds taxonomy filters to the photo gallery admin page.
		 *
		 * @since 1.0.0
		 */
		public static function tax_filters() {
			global $typenow;

			// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
			$taxonomies = array( 'photo_gallery_category', 'photo_gallery_tag' );

			// must set this to the post type you want the filter(s) displayed on
			if ( 'photo_gallery' == $typenow ) {

				foreach ( $taxonomies as $tax_slug ) {
					if ( ! taxonomy_exists( $tax_slug ) ) {
						continue;
					}
					$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
					$tax_obj = get_taxonomy( $tax_slug );
					$tax_name = $tax_obj->labels->name;
					$terms = get_terms($tax_slug);
					if ( count( $terms ) > 0) {
						echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
						echo "<option value=''>$tax_name</option>";
						foreach ( $terms as $term ) {
							echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
						}
						echo "</select>";
					}
				}
			}
		}

		/**
		 * Add sub menu page for the Photo Gallery Editor.
		 *
		 * @since 1.0.0
		 * @link    http://codex.wordpress.org/Function_Reference/add_theme_page
		 */
		public function add_page() {
			$wpsp_photo_gallery_editor = add_submenu_page(
				'edit.php?post_type=photo_gallery',
				esc_html__( 'Post Type Editor', 'wpsp' ),
				esc_html__( 'Post Type Editor', 'wpsp' ),
				'administrator',
				'wpsp-photo-gallery-editor',
				array( $this, 'create_admin_page' )
			);
			add_action( 'load-'. $wpsp_photo_gallery_editor, array( $this, 'flush_rewrite_rules' ) );
		}

		/**
		 * Flush re-write rules
		 *
		 * @since 1.1.0
		 */
		public static function flush_rewrite_rules() {
			$screen = get_current_screen();
			if ( $screen->id == 'photo_gallery_page_wpsp-photo-gallery-editor' ) {
				flush_rewrite_rules();
			}

		}

		/**
		 * Function that will register the photo gallery editor admin page.
		 *
		 * @since 1.0.0
		 * @link    http://codex.wordpress.org/Function_Reference/register_setting
		 */
		public function register_page_options() {
			register_setting( 'wpsp_photo_gallery_options', 'wpsp_photo_gallery_branding', array( $this, 'sanitize' ) );
		}

		/**
		 * Displays saved message after settings are successfully saved
		 *
		 * @since 1.0.0
		 * @link    http://codex.wordpress.org/Function_Reference/settings_errors
		 */
		public static function notices() {
			settings_errors( 'wpsp_photo_gallery_editor_page_notices' );
		}

		/**
		 * Sanitizes input and saves theme_mods.
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// Save values to theme mod
			if ( ! empty ( $options ) ) {
				// Checkboxes
				$checkboxes = array(
					'photo_gallery_categories',
					'photo_gallery_tags',
				);
				foreach ( $checkboxes as $checkbox ) {
					if ( ! empty( $options[$checkbox] ) ) {
						delete_option( $checkbox );
						unset( $options[$checkbox] );
					} else {
						update_option( $checkbox, 'off' );
					}
				}

				// Not checkboxes
				foreach( $options as $key => $value ) {
					if ( $value ) {
						update_option( $key, $value );
					} else {
						delete_option( $key );
					}
				}
			}

			// Add notice
			add_settings_error(
				'wpsp_photo_gallery_editor_page_notices',
				esc_attr( 'settings_updated' ),
				esc_html__( 'Settings saved and rewrite rules flushed.', 'wpsp' ),
				'updated'
			);

			// Lets delete the options as we are saving them into theme mods
			$options = '';
			return;
		}

		/**
		 * Output for the actual Photo Gallery Editor admin page.
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>
			<div class="wrap">
				<h2><?php esc_html_e( 'Post Type Editor', 'wpsp' ); ?></h2>
				<form method="post" action="options.php">
				<?php settings_fields( 'wpsp_photo_gallery_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Admin Icon', 'wpsp' ); ?></th>
						<td>
							<?php
							// Mod
							$mod = get_option( 'photo_gallery_admin_icon', null );
							$mod = 'photo_gallery' == $mod ? '' : $mod;
							// Dashicons list
							$dashicons = wpsp_get_dashicons_array(); ?>
							<div id="wpsp-dashicon-select" class="wpsp-clr">
								<?php foreach ( $dashicons as $key => $val ) :
									$value = 'photo_gallery' == $key ? '' : $key;
									$class = $mod == $value ? 'button-primary' : 'button-secondary'; ?>
									<a href="#" data-value="<?php echo esc_attr( $value ); ?>" class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $key ); ?>"><span class="dashicons dashicons-<?php echo $key; ?>"></span></a>
								<?php endforeach; ?>
							</div>
							<input type="hidden" name="wpsp_photo_gallery_branding[photo_gallery_admin_icon]" id="wpsp-dashicon-select-input" value="<?php echo esc_attr( $mod ); ?>"></td>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Name', 'wpsp' ); ?></th>
						<td><input type="text" name="wpsp_photo_gallery_branding[photo_gallery_labels]" value="<?php echo get_option( 'photo_gallery_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Singular Name', 'wpsp' ); ?></th>
						<td><input type="text" name="wpsp_photo_gallery_branding[photo_gallery_singular_name]" value="<?php echo get_option( 'photo_gallery_singular_name' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpsp-tags-enable">
						<th scope="row"><?php esc_html_e( 'Enable Tags', 'wpsp' ); ?></th>
						<?php
						// Get checkbox value
						$mod = get_option( 'photo_gallery_tags', 'on' );
						$mod = 'off' != $mod ? 'on' : 'off'; // sanitize ?>
						<td><input type="checkbox" name="wpsp_photo_gallery_branding[photo_gallery_tags]" value="<?php echo esc_attr( $mod ); ?>" <?php checked( $mod, 'on' ); ?> /></td>
					</tr>
					<tr valign="top" id="wpsp-tags-label">
						<th scope="row"><?php esc_html_e( 'Tags: Label', 'wpsp' ); ?></th>
						<td><input type="text" name="wpsp_photo_gallery_branding[photo_gallery_tag_labels]" value="<?php echo get_option( 'photo_gallery_tag_labels' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpsp-tags-slug">
						<th scope="row"><?php esc_html_e( 'Tags: Slug', 'wpsp' ); ?></th>
						<td><input type="text" name="wpsp_photo_gallery_branding[photo_gallery_tag_slug]" value="<?php echo get_option( 'photo_gallery_tag_slug' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpsp-categories-enable">
						<th scope="row"><?php esc_html_e( 'Enable Categories', 'wpsp' ); ?></th>
						<?php
						// Get checkbox value
						$mod = get_option( 'photo_gallery_categories', 'on' );
						$mod = 'off' != $mod ? 'on' : 'off'; // sanitize ?>
						<td><input type="checkbox" name="wpsp_photo_gallery_branding[photo_gallery_categories]" value="<?php echo esc_attr( $mod ); ?>" <?php checked( $mod, 'on' ); ?> /></td>
					</tr>
					<tr valign="top" id="wpsp-categories-label">
						<th scope="row"><?php esc_html_e( 'Categories: Label', 'wpsp' ); ?></th>
						<td><input type="text" name="wpsp_photo_gallery_branding[photo_gallery_cat_labels]" value="<?php echo get_option( 'photo_gallery_cat_labels' ); ?>" /></td>
					</tr>
					<tr valign="top" id="wpsp-categories-slug">
						<th scope="row"><?php esc_html_e( 'Categories: Slug', 'wpsp' ); ?></th>
						<td><input type="text" name="wpsp_photo_gallery_branding[photo_gallery_cat_slug]" value="<?php echo get_option( 'photo_gallery_cat_slug' ); ?>" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
				</form>	
				<script>
					( function( $ ) {
						"use strict";
						$( document ).ready( function() {
							// Dashicons
							var $buttons = $( '#wpsp-dashicon-select a' ),
								$input   = $( '#wpsp-dashicon-select-input' );
							$buttons.click( function() {
								var $activeButton = $( '#wpsp-dashicon-select a.button-primary' );
								$activeButton.removeClass( 'button-primary' ).addClass( 'button-secondary' );
								$( this ).addClass( 'button-primary' );
								$input.val( $( this ).data( 'value' ) );
								return false;
							} );
							// Categories enable/disable
							var $catsEnable   = $( '#wpsp-categories-enable input' ),
								$catsTrToHide = $( '#wpsp-categories-label, #wpsp-categories-slug' );
							if ( 'off' == $catsEnable.val() ) {
								$catsTrToHide.hide();
							}
							$( $catsEnable ).change(function () {
								if ( $( this ).is( ":checked" ) ) {
									$catsTrToHide.show();
								} else {
									$catsTrToHide.hide();
								}
							} );
							// Tags enable/disable
							var $tagsEnable   = $( '#wpsp-tags-enable input' ),
								$tagsTrToHide = $( '#wpsp-tags-label, #wpsp-tags-slug' );
							if ( 'off' == $tagsEnable.val() ) {
								$tagsTrToHide.hide();
							}
							$( $tagsEnable ).change(function () {
								if ( $( this ).is( ":checked" ) ) {
									$tagsTrToHide.show();
								} else {
									$tagsTrToHide.hide();
								}
							} );
						} );
					} ) ( jQuery );
				</script>
			</div>
		<?php }

		/**
		 * Post Type Editor CSS
		 *
		 * @since 1.1.0
		 */
		public static function css() { ?>
		
			<style type="text/css">
				#wpsp-dashicon-select { max-width: 800px; }
				#wpsp-dashicon-select a { display: inline-block; margin: 2px; padding: 0; width: 32px; height: 32px; line-height: 32px; text-align: center; }
				#wpsp-dashicon-select a .dashicons,
				#wpsp-dashicon-select a .dashicons-before:before { line-height: inherit; }
			</style>

		<?php }

		/**
		 * Registers a new custom photo gallery sidebar.
		 *
		 * @since 1.0.0
		 */
		public static function register_sidebar() {

			// Get post type object to name sidebar correctly
			$obj            = get_post_type_object( 'photo_gallery' );
			$post_type_name = $obj->labels->name;

			// Register custom sidebar
			register_sidebar( array(
				'name'          => $post_type_name .' '. esc_html__( 'Sidebar', 'wpsp' ),
				'id'            => 'photo_gallery_sidebar',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}

		/**
		 * Alters posts per page for the photo gallery taxonomies.
		 *
		 * @since 2.0.0
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
		 */
		public static function posts_per_page( $query ) {
			if ( wpsp_is_photo_gallery_tax() && $query->is_main_query() ) {
				$query->set( 'posts_per_page', 12 );
				return;
			}
		}

	}	
}
$wpsp_cp_photo_gallery = new WPSP_Cp_Photo_Gallery;