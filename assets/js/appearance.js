/**
 * Liquid Glass — appearance toggle + header polish.
 * Progressive enhancement only: the theme is fully usable without this file.
 *
 * Cycle: auto (follow OS) → light → dark → auto …
 * Preference persists in localStorage under `lg-appearance`.
 */
( function () {
	'use strict';

	var STORAGE_KEY = 'lg-appearance';
	var root = document.documentElement;

	function applyPreference( pref ) {
		root.classList.remove( 'lg-dark', 'lg-force-light' );

		if ( 'dark' === pref ) {
			root.classList.add( 'lg-dark' );
		} else if ( 'light' === pref ) {
			root.classList.add( 'lg-force-light' );
		}

		var buttons = document.querySelectorAll( '.lg-appearance-toggle' );
		for ( var i = 0; i < buttons.length; i++ ) {
			buttons[ i ].setAttribute( 'data-state', pref );
			buttons[ i ].setAttribute(
				'title',
				/* translators: %s: appearance mode */
				( window.lgData && window.lgData.strings && window.lgData.strings.appearanceTitle ) ||
				'Appearance: ' + pref
			);
		}
	}

	function currentPreference() {
		try {
			return window.localStorage.getItem( STORAGE_KEY ) || 'auto';
		} catch ( e ) {
			return 'auto';
		}
	}

	function nextPreference( pref ) {
		if ( 'auto' === pref ) { return 'light'; }
		if ( 'light' === pref ) { return 'dark'; }
		return 'auto';
	}

	function init() {
		var pref = currentPreference();
		applyPreference( pref );

		var buttons = document.querySelectorAll( '.lg-appearance-toggle' );
		for ( var i = 0; i < buttons.length; i++ ) {
			buttons[ i ].addEventListener( 'click', function () {
				pref = nextPreference( currentPreference() );
				try {
					window.localStorage.setItem( STORAGE_KEY, pref );
				} catch ( e ) { /* Private browsing: keep session-only. */ }
				applyPreference( pref );
			} );
		}

		// Sticky-header scroll state (purely visual).
		var header = document.querySelector( '.site-header' );
		if ( header && 'IntersectionObserver' in window ) {
			var sentinel = document.createElement( 'div' );
			sentinel.setAttribute( 'aria-hidden', 'true' );
			sentinel.style.height = '1px';
			document.body.insertBefore( sentinel, document.body.firstChild );

			new IntersectionObserver( function ( entries ) {
				header.classList.toggle( 'is-scrolled', ! entries[ 0 ].isIntersecting );
			} ).observe( sentinel );
		}
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
