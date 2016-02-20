<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Learning_Institute
 */


if ( ! function_exists( 'wpsp_get_theme_branding' ) ) :
function wpsp_get_theme_branding( $branding = true ) {
	$fullname = WPSP_THEME_BRANDING;		
	$prefix = WPSP_THEME_BRANDING_PREFIX;
	if ( $branding ) {
		return $fullname;
	} else {
		return $prefix;
	}
}
endif;

if ( ! function_exists( 'wpsp_entry_posted_on' ) ) :
function wpsp_entry_posted_on() {
	$time_string = '<span class="fa fa-clock-o"></span><time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<span class="fa fa-clock-o"></span><time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'learninginstitute' ),
		$time_string
	);
	//$out = '<ul class="meta clearfix">';
	$out = '<div class="posted-on">' . $posted_on . '</div>';
	//$out .= '</ul>';
	echo $out;
}
endif;
if ( ! function_exists( 'wpsp_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wpsp_posted_on() {
	$time_string = '<span class="fa fa-clock-o"></span><time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<span class="fa fa-clock-o"></span><time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'learninginstitute' ),
		$time_string
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'learninginstitute' ),
		'<span class="fa fa-user"></span><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$categories_list = sprintf('%s</span>',
		'<span class="fa fa-folder-o"></span>' . get_the_category_list( esc_html__( ', ', 'learninginstitute' ) )
	);

	$out = '<ul class="meta clearfix">';
	$out .= '<li class="posted-on">' . $posted_on . '</li>';
	$out .= '<li class="byline"> ' . $byline . '</li>';
	$out .= '<li class="cat-links">' . $categories_list . '</li>';
	$out .= '</ul>';
	echo $out;
}
endif;

if ( ! function_exists( 'wpsp_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wpsp_entry_footer() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'learninginstitute' ), esc_html__( '1 Comment', 'learninginstitute' ), esc_html__( '% Comments', 'learninginstitute' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'learninginstitute' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wpsp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wpsp_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wpsp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wpsp_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wpsp_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wpsp_categorized_blog.
 */
function wpsp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wpsp_categories' );
}
add_action( 'edit_category', 'wpsp_category_transient_flusher' );
add_action( 'save_post',     'wpsp_category_transient_flusher' );

if ( ! function_exists( 'wpsp_the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function wpsp_the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
	    <div class="post-nav-box clearfix">
	        <h4 class="screen-reader-text"><?php _e( 'Post navigation', 'learninginstitute' ); ?></h4>
	        <div class="nav-links">
	            <?php
	            previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . _x( 'Previous Post:', 'Previous post', 'learninginstitute' ) . '</div><h4>%link</h4></div>', '%title', true );
				next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . _x( 'Next Post:', 'Next post', 'learninginstitute' ) . '</div><h4>%link</h4></div>', '%title', true );
	            ?>
	        </div><!-- .nav-links -->
	    </div><!-- .post-nav-box -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Get Post thumbnail
 * 
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_get_post_thumbnail') ) : 
function wpsp_get_post_thumbnail($size = 'thumbnail') {
	echo wpsp_post_thumbnail( $size );
}
endif;

/**
 * Return Post thumbnail
 * 
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_post_thumbnail') ) : 
function wpsp_post_thumbnail($size = 'thumbnail') {
	global $post, $redux_wpsp;
	if (has_post_thumbnail()) {
	    return get_the_post_thumbnail( $post->ID, $size ) ;
	} else { 
		return '<img src="' . esc_url( $redux_wpsp['landscape-placeholder']['url']) . '">';
	} 
}
endif; 

/**
 * Echo post video
 *
 * @since 1.0.0
 */
function wpsp_post_video( $post_id ) {
	echo wpsp_get_post_video( $post_id );
}

/**
 * Returns post video
 *
 * @since 2.0.0
 */
if ( ! function_exists('wpsp_get_post_video') ) :
function wpsp_get_post_video( $post_id = '' ) {

	// Define video variable
	$video = '';

	// Get correct ID
	$post_id = $post_id ? $post_id : get_the_ID();

	// Embed
	if ( $meta = get_post_meta( $post_id, 'wpsp_post_video_embed', true ) ) {
		$video = $meta;
	}
	// Apply filters & return
	return apply_filters( 'wpsp_get_post_video', $video );
}
endif;

/**
 * Echo post video HTML
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_post_video_html') ) :
function wpsp_post_video_html( $video = '' ) {
	echo wpsp_get_post_video_html( $video );
}
endif;

/**
 * Returns post video HTML
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_get_post_video_html') ) :
function wpsp_get_post_video_html( $video = '' ) {

	// Get video
	$video = $video ? $video : wpsp_get_post_video();

	// Return if video is empty
	if ( empty( $video ) ) {
		return;
	}

	// Check post format for standard post type
	if ( 'post' == get_post_type() && 'video' != get_post_format() ) {
		return;
	}

	// Get oembed code and return
	if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
		return '<div class="responsive-video-wrap">'. $oembed .'</div>';
	}

}
endif;

/**
 * Returns correct social button class
 *
 * @since 3.0.0
 */
if ( ! function_exists('wpsp_get_social_button_class') ) :
function wpsp_get_social_button_class( $style ) {

	// Set theme default style
	$style = $style ? $style : 'flat-color';
	$style = apply_filters( 'wpsp_default_social_button_style', $style );

	// None
	if ( 'none' == $style ) {
		$style = 'wpsp-social-btn-no-style';
	}

	// Minimal
	elseif ( 'minimal' == $style ) {
		$style = 'wpsp-social-btn-minimal';
	}

	// Flat
	elseif ( 'flat' == $style ) {
		$style = 'wpsp-social-btn-flat wpsp-bg-gray';
	} 

	// Flat Color
	elseif ( 'flat-color' == $style ) {
		$style = 'wpsp-social-btn-flat wpsp-social-bg';
	} 

	// Apply filters & return style
	return apply_filters( 'wpsp_get_social_button_class', 'wpsp-social-btn '. $style );
}
endif;

/*-------------------------------------------------------------------------------*/
/* [ Dashicons ]
/*-------------------------------------------------------------------------------*/
/**
 * Returns array of WP dashicons
 *
 * @since 3.3.0
 */
function wpsp_get_dashicons_array() {
	return array(
		'admin-appearance' => 'f100',
		'admin-collapse' => 'f148',
		'admin-comments' => 'f117',
		'admin-generic' => 'f111',
		'admin-home' => 'f102',
		'admin-media' => 'f104',
		'admin-network' => 'f112',
		'admin-page' => 'f133',
		'admin-plugins' => 'f106',
		'admin-settings' => 'f108',
		'admin-site' => 'f319',
		'admin-tools' => 'f107',
		'admin-users' => 'f110',
		'align-center' => 'f134',
		'align-left' => 'f135',
		'align-none' => 'f138',
		'align-right' => 'f136',
		'analytics' => 'f183',
		'arrow-down' => 'f140',
		'arrow-down-alt' => 'f346',
		'arrow-down-alt2' => 'f347',
		'arrow-left' => 'f141',
		'arrow-left-alt' => 'f340',
		'arrow-left-alt2' => 'f341',
		'arrow-right' => 'f139',
		'arrow-right-alt' => 'f344',
		'arrow-right-alt2' => 'f345',
		'arrow-up' => 'f142',
		'arrow-up-alt' => 'f342',
		'arrow-up-alt2' => 'f343',
		'art' => 'f309',
		'awards' => 'f313',
		'backup' => 'f321',
		'book' => 'f330',
		'book-alt' => 'f331',
		'businessman' => 'f338',
		'calendar' => 'f145',
		'camera' => 'f306',
		'cart' => 'f174',
		'category' => 'f318',
		'chart-area' => 'f239',
		'chart-bar' => 'f185',
		'chart-line' => 'f238',
		'chart-pie' => 'f184',
		'clock' => 'f469',
		'cloud' => 'f176',
		'dashboard' => 'f226',
		'desktop' => 'f472',
		'dismiss' => 'f153',
		'download' => 'f316',
		'edit' => 'f464',
		'editor-aligncenter' => 'f207',
		'editor-alignleft' => 'f206',
		'editor-alignright' => 'f208',
		'editor-bold' => 'f200',
		'editor-customchar' => 'f220',
		'editor-distractionfree' => 'f211',
		'editor-help' => 'f223',
		'editor-indent' => 'f222',
		'editor-insertmore' => 'f209',
		'editor-italic' => 'f201',
		'editor-justify' => 'f214',
		'editor-kitchensink' => 'f212',
		'editor-ol' => 'f204',
		'editor-outdent' => 'f221',
		'editor-paste-text' => 'f217',
		'editor-paste-word' => 'f216',
		'editor-quote' => 'f205',
		'editor-removeformatting' => 'f218',
		'editor-rtl' => 'f320',
		'editor-spellcheck' => 'f210',
		'editor-strikethrough' => 'f224',
		'editor-textcolor' => 'f215',
		'editor-ul' => 'f203',
		'editor-underline' => 'f213',
		'editor-unlink' => 'f225',
		'editor-video' => 'f219',
		'email' => 'f465',
		'email-alt' => 'f466',
		'exerpt-view' => 'f164',
		'facebook' => 'f304',
		'facebook-alt' => 'f305',
		'feedback' => 'f175',
		'flag' => 'f227',
		'format-aside' => 'f123',
		'format-audio' => 'f127',
		'format-chat' => 'f125',
		'format-gallery' => 'f161',
		'format-image' => 'f128',
		'format-links' => 'f103',
		'format-quote' => 'f122',
		'format-standard' => 'f109',
		'format-status' => 'f130',
		'format-video' => 'f126',
		'forms' => 'f314',
		'googleplus' => 'f462',
		'groups' => 'f307',
		'hammer' => 'f308',
		'id' => 'f336',
		'id-alt' => 'f337',
		'image-crop' => 'f165',
		'image-flip-horizontal' => 'f169',
		'image-flip-vertical' => 'f168',
		'image-rotate-left' => 'f166',
		'image-rotate-right' => 'f167',
		'images-alt' => 'f232',
		'images-alt2' => 'f233',
		'info' => 'f348',
		'leftright' => 'f229',
		'lightbulb' => 'f339',
		'list-view' => 'f163',
		'location' => 'f230',
		'location-alt' => 'f231',
		'lock' => 'f160',
		'marker' => 'f159',
		'menu' => 'f333',
		'migrate' => 'f310',
		'minus' => 'f460',
		'networking' => 'f325',
		'no' => 'f158',
		'no-alt' => 'f335',
		'performance' => 'f311',
		'plus' => 'f132',
		'portfolio' => 'f322',
		'post-status' => 'f173',
		'pressthis' => 'f157',
		'products' => 'f312',
		'redo' => 'f172',
		'rss' => 'f303',
		'screenoptions' => 'f180',
		'search' => 'f179',
		'share' => 'f237',
		'share-alt' => 'f240',
		'share-alt2' => 'f242',
		'shield' => 'f332',
		'shield-alt' => 'f334',
		'slides' => 'f181',
		'smartphone' => 'f470',
		'smiley' => 'f328',
		'sort' => 'f156',
		'sos' => 'f468',
		'star-empty' => 'f154',
		'star-filled' => 'f155',
		'star-half' => 'f459',
		'tablet' => 'f471',
		'tag' => 'f323',
		'testimonial' => 'f473',
		'translation' => 'f326',
		'trash' => 'f182',
		'twitter' => 'f301',
		'undo' => 'f171',
		'update' => 'f463',
		'upload' => 'f317',
		'vault' => 'f178',
		'video-alt' => 'f234',
		'video-alt2' => 'f235',
		'video-alt3' => 'f236',
		'visibility' => 'f177',
		'welcome-add-page' => 'f133',
		'welcome-comments' => 'f117',
		'welcome-edit-page' => 'f119',
		'welcome-learn-more' => 'f118',
		'welcome-view-site' => 'f115',
		'welcome-widgets-menus' => 'f116',
		'wordpress' => 'f120',
		'wordpress-alt' => 'f324',
		'yes' => 'f147',
	);
}

/*-------------------------------------------------------------------------------*/
/* [ Taxonomies ]
/*-------------------------------------------------------------------------------*/

/**
 * Checks if on a theme portfolio category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_portfolio_tax' ) ) {
	function wpsp_is_portfolio_tax() {
		if ( ! is_search() && ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if on a theme staff category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_staff_tax' ) ) {
	function wpsp_is_staff_tax() {
		if ( ! is_search() && ( is_tax( 'staff_category' ) || is_tax( 'staff_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Returns correct classes for the staff grid
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_staff_column_class' ) ) {
	function wpsp_staff_column_class( $query ) {
		if ( 'related' == $query ) {
			return wpsp_grid_class( 3 );
		} else {
			return wpsp_grid_class( 3 );
		}
	}
}


/**
 * Checks if on a theme testimonials category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_testimonials_tax' ) ) {
	function wpsp_is_testimonials_tax() {
		if ( ! is_search() && ( is_tax( 'testimonials_category' ) || is_tax( 'testimonials_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if on a theme photo_gallery category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_photo_gallery_tax' ) ) {
	function wpsp_is_photo_gallery_tax() {
		if ( ! is_search() && ( is_tax( 'photo_gallery_category' ) || is_tax( 'photo_gallery_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if on a theme partner category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_partner_tax' ) ) {
	function wpsp_is_partner_tax() {
		if ( ! is_search() && ( is_tax( 'partner_category' ) || is_tax( 'partner_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Checks if on a theme publications category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_publications_tax' ) ) {
	function wpsp_is_publications_tax() {
		if ( ! is_search() && ( is_tax( 'publications_category' ) || is_tax( 'publications_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Sanitize Data ]
/*-------------------------------------------------------------------------------*/

/**
 * Echo the post URL
 *
 * @since 1.0.0
 */
function wpsp_permalink( $post_id = '' ) {
	echo wpsp_get_permalink( $post_id );
}

/**
 * Return the post URL
 *
 * @since 1.0.0
 */
function wpsp_get_permalink( $post_id = '' ) {

	// If post ID isn't defined lets get it
	$post_id = $post_id ? $post_id : get_the_ID();

	// Check wpsp_post_link custom field for custom link
	$meta = get_post_meta( $post_id, 'wpsp_post_link', true );

	// If wpsp_post_link custom field is defined return that otherwise return the permalink
	$permalink  = $meta ? $meta : get_permalink( $post_id );

	// Apply filters
	$permalink = apply_filters( 'wpsp_permalink', $permalink );

	// Sanitize & return
	return esc_url( $permalink );

}

/**
 * Echo escaped post title
 *
 * @since 1.0.0
 */
function wpsp_esc_title() {
	echo wpsp_get_esc_title();
}

/**
 * Return escaped post title
 *
 * @since 1.0.0
 */
function wpsp_get_esc_title() {
	return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Returns the correct classname for any specific column grid
 *
 * @since 1.0.0
 */
function wpsp_grid_class( $col = '4' ) {
	return esc_attr( apply_filters( 'wpsp_grid_class', 'span_1_of_'. $col ) );
}


/*-------------------------------------------------------------------------------*/
/* [ Custom excerpt ]
/*-------------------------------------------------------------------------------*/

/**
 * Get or generate excerpts
 *
 * @since 1.0.0
 */
function wpsp_excerpt( $args ) {
	echo wpsp_get_excerpt( $args );
}

/**
 * Get or generate excerpts
 *
 * @since 1.0.0
 */
function wpsp_get_excerpt( $args = array() ) {

	// Fallback for old method
	if ( ! is_array( $args ) ) {
		$args = array(
			'length' => $args,
		);
	}

	// Setup default arguments
	$defaults = array(
		'output'        => '',
		'length'        => '30',
		'readmore'      => false,
		'readmore_link' => '',
		'more'          => '&hellip;',
	);

	// Parse arguments
	$args = wp_parse_args( $args, $defaults );

	// Filter args
	$args = apply_filters( 'wpsp_excerpt_args', $args );

	// Extract args
	extract( $args );

	// Sanitize data
	$excerpt = intval( $length );

	// If length is empty or zero return
	if ( empty( $length ) || '0' == $length || false == $length ) {
		return;
	}

	// Get global post
	$post = get_post();

	// Display password protected notice
	if ( $post->post_password ) :

		$output = esc_html__( 'This is a password protected post.', 'learninginstitute' );
		$output = apply_filters( 'wpsp_password_protected_excerpt', $output );
		$output = '<p>'. $output .'</p>';
		return $output;

	endif;

	// Get post data
	$post_id      = $post->ID;
	$post_content = $post->post_content;
	$post_excerpt = $post->post_excerpt;

	// Get post excerpt
	if ( $post_excerpt ) {
		$post_excerpt = apply_filters( 'the_content', $post_excerpt );
	}

	// If has custom excerpt
	if ( $post_excerpt ) :

		// Display custom excerpt
		$output = $post_excerpt;

	// Create Excerpt
	else :

		// Return the content including more tag
		if ( '9999' == $length ) {
			return apply_filters( 'the_content', get_the_content( '', '&hellip;' ) );
		}

		// Return the content excluding more tag
		if ( '-1' == $length ) {
			return apply_filters( 'the_content', $post_content );
		}

		// Check for text shortcode in post
		if ( strpos( $post_content, '[vc_column_text]' ) ) {
			$pattern = '{\[vc_column_text.*?\](.*?)\[/vc_column_text\]}is';
			preg_match( $pattern, $post_content, $match );
			if ( isset( $match[1] ) ) {
				$excerpt = strip_shortcodes( $match[1] );
				$excerpt = wp_trim_words( $excerpt, $length, $more );
			} else {
				$content = strip_shortcodes( $post_content );
				$excerpt = wp_trim_words( $content, $length, $more );
			}
		}

		// No text shortcode so lets strip out shortcodes and return the content
		else {
			$content = strip_shortcodes( $post_content );
			$excerpt = wp_trim_words( $content, $length, $more );
		}

		// Add excerpt to output
		if ( $excerpt ) {
			$output .= '<p>'. $excerpt .'</p>';
		}

	endif;

	// Add readmore link to output if enabled
	if ( $readmore ) :

		$read_more_text = isset( $args['read_more_text'] ) ? $args['read_more_text'] : esc_html__( 'Read more', 'learninginstitute' );
		$output .= '<a href="'. get_permalink( $post_id ) .'" title="'.$read_more_text .'" rel="bookmark" class="wpsp-readmore theme-button">'. $read_more_text .' <span class="wpsp-readmore-rarr">&rarr;</span></a>';

	endif;

	// Apply filters for easier customization
	$output = apply_filters( 'wpsp_excerpt_output', $output );
	
	// Echo output
	return $output;

}

/**
 * Custom excerpt length for posts
 *
 * @since 1.0.0
 */
function wpsp_excerpt_length() {

	// Theme panel length setting
	$length = wpsp_get_mod( 'blog_excerpt_length', '40' );

	// Taxonomy setting
	if ( is_category() ) {
		
		// Get taxonomy meta
		$term       = get_query_var( 'cat' );
		$term_data  = get_option( "category_$term" );
		if ( ! empty( $term_data['wpsp_term_excerpt_length'] ) ) {
			$length = $term_data['wpsp_term_excerpt_length'];
		}
	}

	// Return length and add filter for quicker child theme editign
	return apply_filters( 'wpsp_excerpt_length', $length );

}

/**
 * Change default read more style
 *
 * @since 1.0.0
 */
function wpsp_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wpsp_excerpt_more', 10 );

/**
 * Change default excerpt length
 *
 * @since 1.0.0
 */
function wpsp_custom_excerpt_length( $length ) {
	return '40';
}
add_filter( 'excerpt_length', 'wpsp_custom_excerpt_length', 999 );

/**
 * Prevent Page Scroll When Clicking the More Link
 * http://codex.wordpress.org/Customizing_the_Read_More
 *
 * @since 1.0.0
 */
function wpsp_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'wpsp_remove_more_link_scroll' );

