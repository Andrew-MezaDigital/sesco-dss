/* eslint-disable no-mixed-spaces-and-tabs */
document.addEventListener( 'DOMContentLoaded', function() {
	// Setup splide carousel
	if ( document.querySelector( '.splide' ) ) {
		const splide = new Splide( '.splide', {
			type: 'fade',
			autoplay: true,
            interval: 3000
		} );
	    splide.mount();
	}
} );
