<?php
/**
 * Quick Contact Widget
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

if ( ! class_exists( 'WPSP_Quick_Contact_Widget' ) ) :
class WPSP_Quick_Contact_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $id = 'wpsp-quick-contact-widget';
        $name = 'HFH - '. __( 'Quick contact', 'wpsp_admin' );
        $widget_ops = array(
                'classname'         => 'widget-quick-contact',
                'description'   => __( 'A widget to display short contact information.', 'wpsp_admin' )
            );
        $control_ops = array();
        parent::__construct( $id, $name, $widget_ops, $control_ops );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     * @since 1.0.0
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget( $args, $instance ) {
        // Extract args
        extract( $args, EXTR_SKIP );

        $address          = $instance['address'];
        $telephone        = $instance['telephone'];
        $fax              = $instance['fax'];
        $email            = $instance['email'];
        $social_label     = $instance['social_label'];
        $facebook         = $instance['facebook'];
        $twitter          = $instance['twitter'];
        $youtube           = $instance['youtube'];
        $linkedin         = $instance['linkedin'];

        $title = apply_filters('widget_title', empty($instance['title'] ) ? __('Office address:', 'wpsp') : $instance['title'], $instance, $this->id_base);

        echo $before_widget;

        echo $before_title.$title.$after_title;

        // We're good to go, let's build the menu
        $out = '<ul class="quick-contact">';
        $out .= '<li class="address"><span>' . $address . '</span></li>';
        $out .= '<li class="telephone">' . $telephone . '</li>';
        $out .= '<li class="fax">' . $fax . '</li>';
        $out .= '<li class="email"><a href="mailto:' . antispambot( $email ) . '">' . antispambot( $email ) . '</a></li>';
        $out .= '</ul>';
        $out .= '<ul class="social-links">';
        $out .= '<li>' . $social_label . '</li>';
        $out .= '<li><a target="_blank" href="' . $facebook . '"><span class="screen-reader-text">Facebook</span></a></li>';
        $out .= '<li><a target="_blank" href="' . $twitter . '"><span class="screen-reader-text">Twitter</span></a></li>';
        $out .= '<li><a target="_blank" href="' . $youtube . '"><span class="screen-reader-text">Youtube</span></a></li>';
        $out .= '<li><a target="_blank" href="' . $linkedin . '"><span class="screen-reader-text">Linkedin</span></a></li>';
        $out .= '</ul>';

        echo $out;

        echo $after_widget;
        
        return $instance;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @since 1.0.0
     *
     * @see WP_Widget::form()
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
 
        $instance['title'] = sanitize_text_field($new_instance['title']);  
        $instance['address'] = strip_tags( $new_instance['address']);
        $instance['telephone'] = strip_tags( $new_instance['telephone'] );
        $instance['fax'] = strip_tags( $new_instance['fax'] );
        $instance['email'] = strip_tags( $new_instance['email'] );
        $instance['social_label'] = strip_tags( $new_instance['social_label'] );
        $instance['facebook'] = strip_tags( $new_instance['facebook'] );
        $instance['twitter'] = strip_tags( $new_instance['twitter'] );
        $instance['youtube'] = strip_tags( $new_instance['youtube'] );
        $instance['linkedin'] = strip_tags( $new_instance['linkedin'] );

        return $instance;
    }	

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     * @since 1.0.0
     *
     * @param array $instance Previously saved values from database.
     */
    function form( $instance ) {
        //Set up some default widget settings.
        $defaults = array( 
            'title' => esc_html__('Office address: ', 'wpsp_admin'), 
            'address' => '#170, street 450, Toul Tompoung II, Chamcar Morn, Phnom Penh',
            'telephone' => '+855 (0)23 997 840', 
            'fax' => '+855 (0)23 997 840',
            'email' => 'info@mydomain.com',
            'social_label' => esc_html__('Keep Connect', 'wpsp_admin'),
            'facebook' => '',
            'twitter' => '',
            'youtube' => '',
            'linkedin' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'wpsp_admin'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" row="3"><?php echo esc_attr($instance['address']) ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('telephone'); ?>"><?php _e('Telephone:', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" type="text" value="<?php echo esc_attr($instance['telephone']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($instance['fax']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($instance['email']) ?>" />
        </p>
        <hr />
        <p>
            <label for="<?php echo $this->get_field_id('social_label'); ?>"><?php _e('Social label', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('social_label'); ?>" name="<?php echo $this->get_field_name('social_label'); ?>" type="text" value="<?php echo esc_attr($instance['social_label']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($instance['facebook']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($instance['twitter']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($instance['youtube']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin', 'wpsp_admin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($instance['linkedin']) ?>" />
        </p>
<?php    
    }    
}
endif;

// Register widget with widgets init hook
if ( ! function_exists( 'register_wpsp_quick_contact_widget' ) ) :
function register_wpsp_quick_contact_widget() {
    register_widget( 'WPSP_Quick_Contact_Widget' );
}
endif;
add_action( 'widgets_init', 'register_wpsp_quick_contact_widget' );