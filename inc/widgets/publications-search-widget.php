<?php
/**
 * Publication Search Form Widget
 *
 * Short contact information
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
class WPSP_Publication_Search_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {
		$branding = wpsp_get_theme_branding(false);
		$branding = $branding ? $branding . ' - ' : '';
		parent::__construct(
			'wpsp-publication-search-widget',
			$branding . esc_html__( 'Publication Search Form', 'wpsp_admin' ),
			$widget_ops = array(
                'classname'         => 'wpsp-publication-search-widget',
                'description'   => __( 'A widget to display publication search form.', 'wpsp_admin' )
            )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 * @since 3.2.0
	 *
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Set vars for widget usage
		$title        = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$filter_page = empty( $instance['filter_page'] ) ? '' : (int) $instance['filter_page'];

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<form role="search" method="get" class="search-form" action="<?php echo get_page_link($filter_page); ?>">
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'wpsp_admin' ); ?>" value="<?php if(!empty($_GET['p'])) echo $_GET['p']; ?>" name="p" title="<?php echo esc_attr_x( 'Search for:', 'label', 'wpsp_admin' ); ?>" />
			<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'wpsp_admin' ); ?></span></button>
		</form>

		<?php
		// After widget WP hook
		echo $args['after_widget']; ?>
		
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 * @since 3.2.0
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['filter_page'] = ( ! empty( $new_instance['filter_page'] ) ) ? (int) $new_instance['filter_page'] : '';
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 * @since 3.2.0
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		extract( wp_parse_args( ( array ) $instance, array(
			'title'        => esc_html__( '', 'wpsp_admin' ),
			'filter_page' => '',
		) ) ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wpsp_admin' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'filter_page' ) ); ?>"><?php esc_html_e( 'Select filter page: ', 'wpsp_admin' ); ?></label>
			<?php wp_dropdown_pages( array(
					'class'	=> 'widefat', // string
    				'name'	=> esc_attr( $this->get_field_name( 'filter_page' ) ), // string
    				'selected' => $instance['filter_page'],
    				'show_option_none' => 'Please select a page',
				) ); ?>
		</p>
		
	<?php
	}
}

// Register the widget
function wpsp_register_publication_page_widget() {
	register_widget( 'WPSP_Publication_Search_Widget' );
}
add_action( 'widgets_init', 'wpsp_register_publication_page_widget' );