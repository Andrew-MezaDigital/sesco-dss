/* eslint-disable no-mixed-spaces-and-tabs */
document.addEventListener( 'DOMContentLoaded', function() {
	// Setup splide carousel
	if ( document.querySelector( '.splide' ) ) {
		const splide = new Splide( '.splide', {
			type: 'fade',
			autoplay: true,
			interval: 5000,
			rewind: true,
			pauseOnHover: false,
			pauseOnFocus: false,
		} );
	    splide.mount();
	}
	if ( document.querySelector( '.list-work' ) ) {
		var mixWork = mixitup('.list-work' );
	}
} );
