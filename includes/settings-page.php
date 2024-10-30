<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="wrap" id="feslider-settings">

	<?php
		// Saved notification
		if ( isset( $_REQUEST[ 'updated' ] ) && $_REQUEST[ 'updated' ] == 1 ) {
		    echo "<div id='message' class='updated'><p><strong>Settings saved</strong></p></div>";
		}
	?>

	<form method="post" action="<?php echo admin_url( 'admin.php' ); ?>">

		<!-- key for admin_action -->
		<input type="hidden" name="action" value="custom-login-screen" />

		<!-- nonce -->
		<?php wp_nonce_field( 'custom-login-screen' ); ?>

		<div class="postbox ">
			<div class="hndle ui-sortable-handle">
				<span>Custom Login Screen</span>
				<span class="sub"></span>
				<a class="about-us-button" href="#">About Us</a>
			</div>
			<div class="inside">
				<div class="field-group">
					<label>Login Title</label>
					<input type="text" name="cls[login_title]" value="<?php echo esc_attr( $options[ 'login_title' ] ) ?>">
				</div>

				<div class="field-group">
					<label>Login Title On Mobile</label>
					<input type="text" name="cls[login_title_mobile]" value="<?php echo esc_attr( $options[ 'login_title_mobile' ] ) ?>">
					<span>A short version of login title</span>
				</div>

				<div class="field-group">
					<label>Login Logo</label>
					<?php
						new HRS_FileUploader( array(
							'input_name' => 'cls[login_logo]',
							'input_thumbnail_name' => 'cls[login_logo_thumbnail]',
							'selected_url' => $options[ 'login_logo' ],
							'thumbnail' => $options[ 'login_logo_thumbnail' ],
						) );
					?>
				</div>

				<div class="field-group">
					<label>Login Message</label>
					<textarea name="cls[login_message]" rows="3"><?php echo esc_textarea( $options[ 'login_message' ] ) ?></textarea>
				</div>

				<div class="field-group">
					<label>Style Preset</label>
					<?php $form_field->print_select( $login_styles, 'cls[style_preset]', $options[ 'style_preset' ] ); ?>
					<span>Select your preferred login style</span>
				</div>

				<div class="text-align-right">
					<input type="submit" class="button button-primary" value="Save Settings">
				</div>
			</div>
		</div>

	</form>
</div>

<a href="https://wordpress.org/support/plugin/custom-login-screen/reviews/#new-post" class="support-5-stars" target="_blank">
	Enjoy the plugin?, support us by share your 5 stars rating :)
	<span class="stars">
		<span class="dashicons dashicons-star-filled"></span>
		<span class="dashicons dashicons-star-filled"></span>
		<span class="dashicons dashicons-star-filled"></span>
		<span class="dashicons dashicons-star-filled"></span>
		<span class="dashicons dashicons-star-filled"></span>
	</span>
</a>