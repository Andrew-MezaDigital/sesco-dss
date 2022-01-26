document.addEventListener( 'DOMContentLoaded', function() {
	document.querySelector( 'body' ).classList.remove( 'preload' );
	if ( document.querySelector( '.glightbox' ) ) {
		const lightbox = GLightbox( {} );
	}
	if ( document.querySelector( '.splide' ) ) {
		const splide = new Splide( '.splide', {
			type: 'fade',
			autoplay: true,
			arrows: false,
			interval: 5000,
			rewind: true,
			pauseOnHover: false,
			pauseOnFocus: false,
		} );
		splide.mount();
	}
	if ( document.querySelector( '.logos' ) ) {
		const splide = new Splide( '.logos', {
			type: 'loop',
			autoplay: true,
			arrows: false,
			pagination: false,
			interval: 1500,
			perPage: 6,
			perMove: 1,
			pauseOnHover: false,
			pauseOnFocus: false,
			breakpoints: {
				576: {
					perPage: 2,
				},
				768: {
					perPage: 3,
				},
				1200: {
					perPage: 4,
				},
				1440: {
					perPage: 5,
				},
			},
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
