<?php
/**
 * Entry publcation meta
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $file_en = get_post_meta( get_the_ID(), 'wpsp_pub_file_en', true ); 
	$file_kh = get_post_meta( get_the_ID(), 'wpsp_pub_file_kh', true ); 
	$file_size_en = size_format( filesize( get_attached_file( $file_en ) ) );
	$file_size_kh = size_format( filesize( get_attached_file( $file_kh ) ) ); ?>
 
    <div class="publication-entry-meta">
    	<ul class="file-info">
    <?php // get term publication tags
    	$terms = get_the_terms( get_the_ID(), 'publications_tag' );                        
		if ( $terms && ! is_wp_error( $terms ) ) : 
		 
		    $publications_tags = array();
		    foreach ( $terms as $term ) {
		        $publications_tags[] = $term->name;
		    }                
	    	$publications_tags = join( ", ", $publications_tags ); ?>
	    	
	    	<li><?php printf( esc_html__( 'Published: %s', 'learninginstitute' ), esc_html( $publications_tags ) ); ?></li>
	    	
    <?php endif; ?>
    	<li>- <?php printf( esc_html__( 'Size: %s', 'learninginstitute' ), esc_html( $file_size_en ) ); ?></li>
    	</ul> <!-- .file-info -->

    	<ul class="file-download">
    		<li><?php esc_html_e( 'Download: ', 'learninginstitute' ); ?></li>
    		<?php if ( !empty($file_en) ) : ?>
    		<li><a href="<?php echo get_attached_file( $file_en ); ?>" target="_blank"><?php esc_html_e( 'English', 'learninginstitute' ); ?></a></li>
    		<?php endif; ?>	
    		<?php if ( !empty($file_kh) ) : ?>
    		<li>- <a href="<?php echo get_attached_file( $file_kh ); ?>" target="_blank"><?php esc_html_e( 'Khmer', 'learninginstitute' ); ?></a></li>
    		<?php endif; ?>	
    	</ul>
    </div>
