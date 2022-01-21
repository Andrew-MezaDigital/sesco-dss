document.addEventListener( 'DOMContentLoaded', function() {
	if ( document.querySelector( '.glightbox' ) ) {
		const lightbox = GLightbox( {} );
	}
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

	if ( document.querySelector( '.filterable' ) ) {
		const selectFilter = document.querySelector( '.filter' );
		const mixer = mixitup( '.filterable' );
		if ( selectFilter ) {
			selectFilter.addEventListener( 'change', function() {
				var selector = selectFilter.value;
				mixer.filter( selector );
			} );
		}
	}
} );
