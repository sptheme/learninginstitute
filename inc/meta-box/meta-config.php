<?php
 /**
 * Registering meta boxes
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 *
 * @package Learning_Institute
 */

 add_filter( 'rwmb_meta_boxes', 'wpsp_register_meta_boxes' );

/**
 * Register meta boxes
 *
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
	function wpsp_register_meta_boxes( $meta_boxes ) {
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'wpsp_';

	/* get the registered sidebars */
    global $wp_registered_sidebars;

    $sidebars = array();
    foreach( $wp_registered_sidebars as $id=>$sidebar ) {
      $sidebars[ $id ] = $sidebar[ 'name' ];
    }
    $sidebars_tmp = array_unshift( $sidebars, "-- Choose Sidebar --" );    

	// Masthead apply header of the page
    $meta_boxes[] = array(
    	'id'			=> 'masthead',
		'title'			=> __( 'Masthead Options', 'wpsp_meta_options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Headline', 'wpsp_meta_options' ), 
				'id'    => $prefix . "masthead_title",
				'type'  => 'text',
			),
			array(
				'name'  => __( 'Sub Headline', 'wpsp_meta_options' ), 
				'id'    => $prefix . "masthead_desc",
				'type'  => 'textarea',
				'row'	=> 3
			),
			array(
				'name'  => __( 'Upload background image', 'wpsp_meta_options' ), 
				'id'    => $prefix . "masthead_image",
				'desc'	=> __( 'Option: Recommended image size: 1600px by 650px.', 'wpsp_meta_options' ), 
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
    );

	// Staff post type
    $meta_boxes[] = array(
    	'id'			=> 'staff-options',
		'title'			=> __( 'Personal information', 'wpsp_meta_options' ),
		'post_types'	=> array( 'staff', 'portfolio' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Position', 'wpsp_meta_options' ), 
				'id'    => $prefix . "staff_position",
				'type'  => 'text',
			),
		)
    );

	// Page layout options
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'page-options',
		'title'      => __( 'Page options', 'wpsp_meta_options' ),
		'post_types' => array( 'post', 'page', 'portfolio', 'staff' ),
		'context'    => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'   => 'high', // Order of meta box: high (default), low. Optional.
		'autosave'   => true, // Auto save: true, false (default). Optional.

		// List of meta fields
		'fields'     => array(
			array(
				'name'  => __( 'Primary Sidebar', 'wpsp_meta_options' ), 
				'id'    => $prefix . "sidebar_primary",
				'desc'  => __( 'Overrides default', 'wpsp_meta_options' ),// Field description (optional)
				'type'  => 'select',
				// Array of 'value' => 'Image Source' pairs
				'options'  => $sidebars,
			),
			array(
				'name'  => __( 'Layout', 'wpsp_meta_options' ), 
				'id'    => $prefix . "layout",
				'desc'  => __( 'Overrides the default layout option', 'wpsp_meta_options' ),// Field description (optional)
				'type'  => 'image_select',
				'std'   => __( 'inherit', 'wpsp_meta_options' ),// Default value (optional)
				// Array of 'value' => 'Image Source' pairs
				'options'  => array(
					'inherit'  => get_template_directory_uri() . '/images/admin/layout-off.png',
					'col-1c'   => get_template_directory_uri() . '/images/admin/col-1c.png',
					'col-2cl'  => get_template_directory_uri() . '/images/admin/col-2cl.png',
					'col-2cr'  => get_template_directory_uri() . '/images/admin/col-2cr.png',
				),
			),
		)
	);	

	return $meta_boxes;
}