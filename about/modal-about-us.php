<div id="about-us-modal" style="display:none;">
	<div class="about-promo-container">
		<div class="jumbo-header">
			<div class="container py-md-3">
				<h1 class="display-4">More Than Just<br>A Software House</h1>
				<h3 class="my-4 subtitle subtitle-home">We are Creating Solutions for Personal and Business</h3>
				<div class="about-cta-container">
					<a href="https://astahub.github.io" target="blank" class="about-cta-btn btn-blue">About Astahub</a>
					<a href="https://harisrozak.github.io" target="blank" class="about-cta-btn btn-red">Haris Profile</a>
					<a href="javascript:;" class="about-cta-btn btn-white harisrozak-free-plugins">Other Free Plugins</a>
				</div>
			</div>
		</div>

		<div class="image-about-us"></div>	
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		$( '#about-us-modal' ).dialog( {
			width: 800,
			height: 550,
			modal: true,
			autoOpen: false,
			dialogClass: 'ui-dialog-about-us'
		} );
		
		$( '.about-us-button' ).click( function(){
			$( '#about-us-modal' ).dialog( 'open' );
			$( '#harisrozak-free-plugins-modal' ).dialog( 'close' );
		} );	
		
		$( '.harisrozak-free-plugins' ).click( function(){
			$( '#harisrozak-free-plugins-modal' ).dialog( 'open' );
			$( '#about-us-modal' ).dialog( 'close' );
		} );
	} );
</script>