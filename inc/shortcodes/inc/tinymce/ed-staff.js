/**
 * staff Short code button
 */

(function($) {
     tinymce.create( 'tinymce.plugins.staff', {
        init : function( ed, url ) {
             ed.addButton( 'staff', {
                title : 'Insert Staff Posts',
                image : url + '/ed-icons/biography.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Staff options', 'admin-ajax.php?action=wpsp_staff_shortcode_ajax&width=' + W + '&height=' + H );					                 }
             });
         },
         getInfo : function() {
				return {
						longname : 'SP Theme',
						author : 'Sopheak Peas',
						authorurl : 'http://www.linkedin.com/in/sopheakpeas',
						infourl : 'http://www.linkedin.com/in/sopheakpeas',
						version : '1.0.1'
				};
		}
     });
	tinymce.PluginManager.add( 'staff', tinymce.plugins.staff );

	// handles the click event of the submit button
	$('body').on('click', '#sc-staff-form #option-submit', function() {
		form = $('#sc-staff-form');
		// defines the options and their default values
		// again, this is not the most elegant way to do this
		// but well, this gets the job done nonetheless
		var options = { 
			'term_id' : null,
			'post_count' : null,
			'post_style' : null,
			'cols' : null
			};
		var shortcode = '[sc_staff';
		
		for( var index in options) {
			var value = form.find('#'+index).val();
			
			// attaches the attribute to the shortcode only if it's different from the default value
			if ( value !== options[index] )
				shortcode += ' ' + index + '="' + value + '"';
		}
		
		shortcode += ']';
			
		// inserts the shortcode into the active editor
		tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
		// closes Thickbox
		tb_remove();
		
		
	});
	
})(jQuery);