<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class CLS_ApplySettings extends CLS {
	function __construct() {
		add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ) );		
	}
	
	public function login_enqueue_scripts() {
		// apply main custom login style
		wp_enqueue_style( 'custom-login', CLS_URL . 'assets/style-login.css', array() );
		
		// get options
		$options = $this->get_options();

		// apply preset style
		if ( $options[ 'style_preset' ] !== 'default' ) {
			wp_enqueue_style( $options[ 'style_preset' ], sprintf( "%sassets/%s.css" , CLS_URL , $options[ 'style_preset' ] ) );	
		}

		// apply options
        $custom_css = sprintf( "
	            body:before {
					content: '%s';
				}
				#login {
					background-image: url('%s');
				}
				#login > form#loginform:before {
					content: '%s';
				}
				@media only screen and (max-width: 415px) {
					body:before {
						content: '%s';
					}
				}
			", 
			esc_attr( $options[ 'login_title' ] ),
			esc_url( $options[ 'login_logo' ] ),
			esc_attr( $options[ 'login_message' ] ),
			esc_attr( $options[ 'login_title_mobile' ] )
		);

		// apply custom css as inline style
        wp_add_inline_style( 'custom-login', $custom_css );
	}

}

new CLS_ApplySettings();