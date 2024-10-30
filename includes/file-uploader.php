<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * File Uploader
 * @author harisrozak
 */

if( ! class_exists( 'HRS_FileUploader' ) ) :

Class HRS_FileUploader {
	public function __construct( $args = array() ) {
		$default_args = array(
			'name' => 'wp-media',
			'input_name' => 'wp-media',
			'input_thumbnail_name' => 'wp-media',
			'button_id' => 'wp-media-add-image',
			'container' => '#wp-media',
			'type' => 'image',
			'frame' => 'select',
			'empty_notice' => 'No image selected yet.',
			'selected_url' => false,
			'thumbnail' => false,
		);

		$this->args = array_replace( $default_args, $args );
		$this->thumbnail_style = 'margin-bottom:10px;';
		$this->thumbnail_img_style = 'max-width:150px;max-height:150px;padding:3px;background-color:#fff;border:1px solid #dee2e6;border-radius:.25rem;';
		$this->thumbnail_btn_style = 'width: 158px;text-align: center;';

		// print
		$this->html();
		$this->javascript();
	}

	private function html() {
		// display selected url
		if ( $this->args[ 'selected_url' ] ) {
			printf(	"<div style='%s' id='thumbnail-container'><img src='%s' style='%s'></div>", 
				esc_attr( $this->thumbnail_style ),
				esc_url( $this->args[ 'thumbnail' ] ),
				esc_attr( $this->thumbnail_img_style )
			);
		}
		else {			
			printf( "<div style='%s' id='thumbnail-container'>%s<br><br></div>", 
				esc_attr( $this->thumbnail_style ), 
				esc_html( $this->empty_notice ) 
			);
		}

		// select image button
		printf( "<a href='javascript:;' class='button' style='%s' id='%s'>%s</a>",
			esc_attr( $this->thumbnail_btn_style ), 
			esc_attr( $this->args[ 'button_id' ] ), 
			__( 'Select an Image' )
		);

		// hidden input
		printf(
			"<input type='hidden' name='%s' id='%s' value='%s'>",
			esc_attr( $this->args[ 'input_name' ] ), 
			esc_attr( $this->args[ 'input_name' ] ), 
			esc_url( $this->args[ 'selected_url' ] )
		);

		// hidden input thumbnail
		printf(
			"<input type='hidden' name='%s' id='%s' value='%s'>",
			esc_attr( $this->args[ 'input_thumbnail_name' ] ), 
			esc_attr( $this->args[ 'input_thumbnail_name' ] ), 
			esc_url( $this->args[ 'thumbnail' ] )
		);
	}

	private function javascript() {
		// load jquery
		wp_enqueue_script( 'jquery' );
		wp_enqueue_media();

		// prevent the same name of media modal to double identified
		$varname = $this->args[ 'name' ];
		$varname = str_replace( '-', '_', $varname );
		$varname = str_replace( ' ', '_', $varname );

		?>
		
		<script type='text/javascript'>
		
		if ( typeof( fegallery_media_<?php echo $varname ?> ) === 'undefined' ) { 
			var fegallery_media_<?php echo $varname ?> = false;
		}

		if ( ! fegallery_media_<?php echo $varname ?> ) { 

			fegallery_media_<?php echo $varname ?> = true;

			jQuery( document ).ready( function( $ ) {
				$( '#<?php echo $this->args[ 'button_id' ] ?>' ).on( 'click', function( e ) {
			        var custom_uploader
			        var media_button = $( this );

			        e.preventDefault();

			        // If the uploader object has already been created, reopen the dialog
			        if ( custom_uploader ) {
			            custom_uploader.open();
			            return;
			        }

			        // Extend the wp.media object
			        custom_uploader = wp.media.frames.file_frame = wp.media( {
			            frame: '<?php echo $this->args[ 'frame' ] ?>',
			            title: 'Choose <?php echo $this->args[ 'type' ] ?>',
			            library : { type : '<?php echo $this->args[ 'type' ] ?>'},
			            button: {
			                text: 'Choose <?php echo $this->args[ 'type' ] ?>'
			            },
			            multiple: 'false'
			        } );
			 
			        // When a file is selected, grab the URL and set it as the text field's value
			        custom_uploader.on( 'select', function() {
			        	var container = $( '<?php echo $this->args[ 'container' ] ?>' );
			            var attachments = custom_uploader.state().get( 'selection' ).toJSON();

			            if(attachments.length > 0 && container.children( 'span' ).length > 0) {
			            	container.children( 'span' ).remove();
			            }

						$.each( attachments, function( index, value ) {
							var attachment_id = value.id;
							var thumbnail_url = value.sizes.thumbnail.url;
							var original_url = value.url;

							// set url to input_name and input_thumbnail_name
							$( 'input[name="<?php echo $this->args[ 'input_name' ] ?>"]' ).val( original_url );
							$( 'input[name="<?php echo $this->args[ 'input_thumbnail_name' ] ?>"]' ).val( thumbnail_url );

							// set display thumbnail
							$( '#thumbnail-container' ).html( "<img src='" + thumbnail_url + "' style='<?php echo $this->thumbnail_img_style ?>'>" );
							
						} );
			        } );
			 
			        // Open the uploader dialog
			        custom_uploader.open();	 
			    } );
			} );		

		}

		</script>

		<?php
	}
}	

endif;
