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
				'name'  => __( 'Sub headline', 'wpsp_meta_options' ), 
				'id'    => $prefix . "masthead_title",
				'type'  => 'text',
			),
			array(
				'name'  => __( 'Description of Headline', 'wpsp_meta_options' ), 
				'id'    => $prefix . "masthead_desc",
				'type'  => 'textarea',
				'row'	=> 3
			),
			array(
				'name'  => __( 'Upload background image', 'wpsp_meta_options' ), 
				'id'    => $prefix . "masthead_image",
				'desc'	=> __( 'Option: Recommended image size: 1600px by 640px.', 'wpsp_meta_options' ), 
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
    );

    // Homepage
    $meta_boxes[] = array(
    	'id'			=> 'homepage-options',
		'title'			=> __( 'Homepage Options', 'wpsp_meta_options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Slideshow Photos', 'wpsp_meta_options' ), 
				'id'    => "slideshow_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Upload Photos', 'wpsp_meta_options' ), 
					'id'    => $prefix . "slideshow",
					'desc'	=> __( 'Upload images for slideshow. Option: Recommended image size: 1600px by 640px.', 'wpsp_meta_options' ), 
					'type'  => 'image_advanced'
				),
			array(
				'name'  => __( 'Main programs', 'wpsp_meta_options' ), 
				'id'    => "main_programs_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Highlight the title', 'wpsp_meta_options' ), 
					'id'    => $prefix . "program_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp_meta_options' ), 
					'id'    => $prefix . "program_desc",
					'type'  => 'textarea',
					'row'	=> 3
				),
				array(
					'name'  => __( 'Display Main Programs Page', 'wpsp_meta_options' ), 
					'id'    => $prefix . "main_program_page",
					'desc'	=> __( 'Please select parent page that containe all of main programs. eg: Areas of Interest', 'wpsp_meta_options' ), 
					'type'  => 'post',
					'post_type' => 'page',
					'field_type'  => 'select_advanced',
					'placeholder' => __( 'Select an Item', 'wpsp_meta_options' ),
				),
			array(
				'name'  => __( 'Latest Post', 'wpsp_meta_options' ), 
				'id'    => "latest_post_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Headline', 'wpsp_meta_options' ), 
					'id'    => $prefix . "latest_post_headline",
					'type'  => 'text',
					'std' => __( 'Latest Post', 'wpsp_meta_options' ), 
				),	
				array(
					'name'  => __( 'Post number', 'wpsp_meta_options' ), 
					'id'    => $prefix . "latest_post_number",
					'desc'	=> __( 'Enter number of post to show', 'wpsp_meta_options' ),
					'type' 	=> 'number',
					'min'  	=> 0,
					'max'  	=> 5,
					'step' 	=> 1,
					'std'  	=> 3,
				),
			array(
				'name'  => __( 'Publications', 'wpsp_meta_options' ), 
				'id'    => "publication_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Headline', 'wpsp_meta_options' ), 
					'id'    => $prefix . "publication_headline",
					'type'  => 'text',
					'std' => __( 'Download Publications', 'wpsp_meta_options' ), 
				),	
				array(
					'name'  => __( 'Post number', 'wpsp_meta_options' ), 
					'id'    => $prefix . "pub_post_number",
					'desc'	=> __( 'Enter number of post to show', 'wpsp_meta_options' ),
					'type' 	=> 'number',
					'min'  	=> 0,
					'max'  	=> 10,
					'step' 	=> 1,
					'std'  	=> 3,
				),		
		)
    );

	// About
    $meta_boxes[] = array(
    	'id'			=> 'about-options',
		'title'			=> __( 'About Options', 'wpsp_meta_options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Welcome', 'wpsp_meta_options' ), 
				'id'    => "welcome_msg_fake_id",
				'desc'	=> __( 'Write welcome message of CEO/Managing Direcotr with photo', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Title', 'wpsp_meta_options' ), 
					'id'    => $prefix . "welcome_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Body message', 'wpsp_meta_options' ), 
					'id'    => $prefix . "welcome_message",
					'type'  => 'wysiwyg',
					'raw'   => false,
					'options' => array(
						'textarea_rows' => 4,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'  => __( 'Profile photo', 'wpsp_meta_options' ), 
					'id'    => $prefix . "profile_photo",
					'desc'  => __( 'Upload photo of CEO/Managing Director', 'wpsp_meta_options'),
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
			array(
				'name'  => __( 'Our Mission', 'wpsp_meta_options' ), 
				'id'    => "our_mission_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Title', 'wpsp_meta_options' ), 
					'id'    => $prefix . "mission_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp_meta_options' ), 
					'id'    => $prefix . "mission_desc",
					'type'  => 'textarea',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Background image', 'wpsp_meta_options' ), 
					'id'    => $prefix . "mission_photo",
					'desc'  => __( 'Upload background image for our mission, should be the same size as our value image', 'wpsp_meta_options'),
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
			array(
				'name'  => __( 'Our Value', 'wpsp_meta_options' ), 
				'id'    => "our_value_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Title', 'wpsp_meta_options' ), 
					'id'    => $prefix . "value_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp_meta_options' ), 
					'id'    => $prefix . "value_desc",
					'type'  => 'textarea',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Background image', 'wpsp_meta_options' ), 
					'id'    => $prefix . "value_photo",
					'desc'  => __( 'Upload background image for our value, should be the same size as our mission image', 'wpsp_meta_options'),
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),			
			array(
				'name'  => __( 'Main programs', 'wpsp_meta_options' ), 
				'id'    => "main_programs_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Highlight the title', 'wpsp_meta_options' ), 
					'id'    => $prefix . "program_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp_meta_options' ), 
					'id'    => $prefix . "program_desc",
					'type'  => 'textarea',
					'row'	=> 3
				),
				array(
					'name'  => __( 'Display Main Programs Page', 'wpsp_meta_options' ), 
					'id'    => $prefix . "main_program_page",
					'desc'	=> __( 'Please select parent page that containe all of main programs. eg: Areas of Interest', 'wpsp_meta_options' ), 
					'type'  => 'post',
					'post_type' => 'page',
					'field_type'  => 'select_advanced',
					'placeholder' => __( 'Select an Item', 'wpsp_meta_options' ),
				),	
		)
    );	

	// Contact
    $meta_boxes[] = array(
    	'id'			=> 'contact-options',
		'title'			=> __( 'Contact Options', 'wpsp_meta_options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.
		
		'fields'		=> array(	
			array(
					'name'  => __( 'Short Description', 'wpsp_meta_options' ), 
					'id'    => $prefix . "contact_desc",
					'type'  => 'textarea',
					'row'	=> 4
				),
			array(
				'name'  => __( 'Map', 'wpsp_meta_options' ), 
				'id'    => "map_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Location', 'wpsp_meta_options' ), 
					'id'    => $prefix . "marker",
					'type'  => 'map',
					'std'   => '11.546921,104.917905',
				),
			array(
				'name'  => __( 'Background Image', 'wpsp_meta_options' ), 
				'id'    => "background_fake_id",
				'desc'	=> __( '', 'wpsp_meta_options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Upload image', 'wpsp_meta_options' ), 
					'id'    => $prefix . "contact_bg_image",
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

    // Publications post type
    $meta_boxes[] = array(
    	'id'			=> 'publication-options',
		'title'			=> __( 'Publication Options', 'wpsp_meta_options' ),
		'post_types'	=> array( 'publications' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'File Upload (En)', 'wpsp_meta_options' ), 
				'id'    => $prefix . "pub_file_en",
				'desc'  => __( 'Upload English version. Keep blank if do not have', 'wpsp_meta_options'),
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'application,pdf,doc,docx'
			),
			array(
				'name'  => __( 'File Upload (Kh)', 'wpsp_meta_options' ), 
				'id'    => $prefix . "pub_file_kh",
				'desc'  => __( 'Upload Khmer version. Keep blank if do not have', 'wpsp_meta_options'),
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => ''
			),
		)
    );

    // Post format video
    $meta_boxes[] = array(
    	'id'			=> 'format-video',
		'title'			=> __( 'Format video', 'wpsp_meta_options' ),
		'post_types'	=> array( 'post' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Video URL', 'wpsp_meta_options' ), 
				'id'    => $prefix . "post_video_embed",
				'desc'  => __( 'Enter Video Embed URL from youtube, vimeo or dailymotion', 'wpsp_meta_options'),
				'type'  => 'text',
			),
		)
    );

    // Post format gallery
    $meta_boxes[] = array(
    	'id'			=> 'format-gallery',
		'title'			=> __( 'Format gallery', 'wpsp_meta_options' ),
		'post_types'	=> array( 'post' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Upload photos', 'wpsp_meta_options' ), 
				'id'    => $prefix . "format_gallery_album",
				'desc'  => __( 'Upload photo into album', 'wpsp_meta_options'),
				'type'  => 'image_advanced',
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