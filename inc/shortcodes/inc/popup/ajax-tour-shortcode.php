<?php

add_action('wp_ajax_wpsp_tour_shortcode_ajax', 'wpsp_tour_shortcode_ajax' );

function wpsp_tour_shortcode_ajax(){
	$defaults = array(
		'tour' => null
	);
	$args = array_merge( $defaults, $_GET );
	?>

	<div id="sc-tour-form">
			<table id="sc-tour-table" class="form-table">
				<tr>
					<?php $field = 'term_id'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Type: ', 'wpsp_shortcode' ); ?></label></th>
					<td>
						<select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
							<option class="level-0" value="-1"><?php _e( 'All tour', 'wpsp_shortcode' ); ?></option>
							<optgroup label="<?php _e( 'By term', 'wpsp_shortcode' ); ?>">
								<?php $args = array(
										'hide_empty'	=> 0
									);
								$taxonomies = get_terms( 'tour_style', $args );
								foreach ( $taxonomies as $tax ) {
									echo '<option class="level-0" value="' . $tax->term_id . '">' . $tax->name . '</option>';
								} ?>
							</optgroup>
						</select>
					</td>
				</tr>
				<tr>
					<?php $field = 'post_num'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Number tour: ', 'wpsp_shortcode' ); ?></label></th>
					<td>
						<input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="4" /> <smal>(-1 for show all)</small>
					</td>
				</tr>
				<tr>
					<?php $field = 'cols'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Columns: ', 'wpsp_shortcode' ); ?></label></th>
					<td>
						<select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
							<option class="level-0" value="2">2</option>
							<option class="level-0" selected="selected" value="3">3</option>
							<option class="level-0" value="4">4</option>
						</select>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="button" id="option-submit" class="button-primary" value="<?php _e( 'Add tour', 'wpsp_shortcode' ); ?>" name="submit" />
			</p>
	</div>			

	<?php
	exit();	
}
?>