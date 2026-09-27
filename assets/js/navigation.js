/**
 * Liquid Glass — navigation behaviour.
 * Progressive enhancement over a standard wp_nav_menu() + CSS drawer:
 *  - Without JavaScript the mobile drawer is rendered open (see .no-js rules
 *    in components.css) so every menu item stays reachable.
 *  - With JavaScript the drawer collapses behind an accessible toggle button,
 *    parent items get keyboard-operable accordion buttons, Escape closes the
 *    drawer and focus returns to the toggle.
 */
( function () {
	'use strict';

	var MQ = '(max-width: 781px)';

	function $( sel, ctx ) {
		return ( ctx || document ).querySelector( sel );
	}

	function $$( sel, ctx ) {
		return Array.prototype.slice.call( ( ctx || document ).querySelectorAll( sel ) );
	}

	function initNav() {
		var nav = $( '#site-navigation' );
		var toggle = $( '.menu-toggle' );
		var overlay = $( '.mobile-nav-overlay' );

		if ( ! nav ) {
			return;
		}

		/* ------------------------------------------------------------------
		 * Mobile drawer
		 * ----------------------------------------------------------------*/
		function setDrawer( open ) {
			document.body.classList.toggle( 'has-mobile-nav', open );
			if ( toggle ) {
				toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			}
			if ( open ) {
				var firstLink = $( 'a, button', nav );
				if ( firstLink ) {
					firstLink.focus();
				}
			}
		}

		function closeDrawer() {
			setDrawer( false );
			if ( toggle ) {
				toggle.focus();
			}
		}

		if ( toggle ) {
			toggle.addEventListener( 'click', function () {
				var open = 'true' === toggle.getAttribute( 'aria-expanded' );
				setDrawer( ! open );
			} );
		}

		if ( overlay ) {
			overlay.addEventListener( 'click', function () {
				setDrawer( false );
			} );
		}

		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key && document.body.classList.contains( 'has-mobile-nav' ) ) {
				closeDrawer();
			}
		} );

		// Reset state when crossing the breakpoint.
		var mql = window.matchMedia( MQ );
		function onBreakpoint( mqEvent ) {
			if ( ! mqEvent.matches ) {
				setDrawer( false );
			}
		}
		if ( mql.addEventListener ) {
			mql.addEventListener( 'change', onBreakpoint );
		} else if ( mql.addListener ) {
			mql.addListener( onBreakpoint );
		}

		/* ------------------------------------------------------------------
		 * Submenu toggles (accordion on mobile, keyboard-friendly on all
		 * sizes). Buttons are injected next to every parent link.
		 * ----------------------------------------------------------------*/
		$$( '.menu-item-has-children, .page_item_has_children', nav ).forEach( function ( item ) {
			var link = $( ':scope > a', item );
			var sub = $( ':scope > ul', item );

			if ( ! link || ! sub ) {
				return;
			}

			var id = 'lg-submenu-' + Math.random().toString( 36 ).slice( 2, 9 );
			sub.id = id;

			var button = document.createElement( 'button' );
			button.className = 'lg-submenu-toggle';
			button.type = 'button';
			button.setAttribute( 'aria-expanded', 'false' );
			button.setAttribute( 'aria-controls', id );

			var label = '';
			if ( window.lgNav && window.lgNav.strings && window.lgNav.strings.submenu ) {
				label = window.lgNav.strings.submenu;
			}
			button.setAttribute(
				'aria-label',
				link.textContent.trim() + ' ' + ( label || 'submenu' )
			);

			item.appendChild( button );

			function setOpen( open ) {
				item.classList.toggle( 'lg-open', open );
				button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			}

			button.addEventListener( 'click', function () {
				setOpen( ! item.classList.contains( 'lg-open' ) );
			} );

			// Keyboard parity on desktop where CSS uses :focus-within.
			link.addEventListener( 'keydown', function ( event ) {
				if ( 'ArrowDown' === event.key ) {
					event.preventDefault();
					setOpen( true );
					var first = $( 'a', sub );
					if ( first ) {
						first.focus();
					}
				}
			} );

			// Close sibling popovers when another opens (desktop tidiness).
			button.addEventListener( 'click', function () {
				if ( ! window.matchMedia( MQ ).matches ) {
					$$( '.lg-open', nav ).forEach( function ( other ) {
						if ( other !== item && ! other.contains( item ) && ! item.contains( other ) ) {
							other.classList.remove( 'lg-open' );
							var b = $( '.lg-submenu-toggle', other );
							if ( b ) {
								b.setAttribute( 'aria-expanded', 'false' );
							}
						}
					} );
				}
			} );
		} );

		// Click outside closes desktop popovers.
		document.addEventListener( 'click', function ( event ) {
			if ( ! nav.contains( event.target ) ) {
				$$( '.lg-open', nav ).forEach( function ( item ) {
					item.classList.remove( 'lg-open' );
					var b = $( '.lg-submenu-toggle', item );
					if ( b ) {
						b.setAttribute( 'aria-expanded', 'false' );
					}
				} );
			}
		} );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', initNav );
	} else {
		initNav();
	}
}() );
