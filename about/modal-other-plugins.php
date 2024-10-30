<?php
	$wp_plugin_url = "https://wordpress.org/plugins/%s/";
	$wp_plugin_image_url = "https://ps.w.org/%s/assets/icon-256x256.png";
	$harisrozak_free_plugins = array(
		'feslider' => 'Featured Slider',
		'fegallery' => 'Featured Gallery',
		'custom-login-screen' => 'Custom Login Screen',
		'wp-project-essentials' => 'WP Project Essentials',
	);
?>

<div id="harisrozak-free-plugins-modal" title="Other Free Plugins" style="display:none;">
	<a href='javascript:;' class="about-back-button"><span>&larr;</span>Back</a>
	<div class="plugin-list">
		<?php foreach ( $harisrozak_free_plugins as $slug => $name ) : ?>

		<div class="plugin-item">
			<a href="<?php printf( $wp_plugin_url, $slug ) ?>" target="_blank">
				<image src="<?php printf( $wp_plugin_image_url, $slug ) ?>"/>
				<span><?php echo $name ?></span>
			</a>
		</div>

		<?php endforeach ?>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		$( '#harisrozak-free-plugins-modal' ).dialog( {
			width: 800,
			height: 550,
			modal: true,
			autoOpen: false,
			dialogClass: 'ui-dialog-harisrozak-free-plugins'
		} );

		$( '.about-back-button' ).click( function(){
			$( '#about-us-modal' ).dialog( 'open' );
			$( '#harisrozak-free-plugins-modal' ).dialog( 'close' );
		} );		
	} );
</script>