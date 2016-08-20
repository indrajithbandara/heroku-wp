/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	/*
	 * HEADER SECTION -------------------------------------------------------------
	*/
	
	wp.customize( 'eryn_logo_header', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a .title' ).text( to );
		} );
	} );
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a .title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a .tagline' ).text( to );
		} );
	} );
	wp.customize( 'eryn_background_header_repeat', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'background-repeat', to );
		} );
	} );
		
	/*
	 * FOOTER SECTION -------------------------------------------------------------
	*/
	
	wp.customize( 'footer_copyright_strapline', function( value ) {
		value.bind( function( to ) {
			$( '.site-copyright p' ).html( to );
		} );
	} );

	
	
	
	/*
	 * HOMEPAGE SECTION -------------------------------------------------------------
	*/	
	
	wp.customize( 'eryn_grid_title', function( value ) {
		value.bind( function( to ) {
			$( '.grid-header h2' ).text( to );
		} );
	} );
	wp.customize( 'eryn_grid_sub_title', function( value ) {
		value.bind( function( to ) {
			$( '.grid-header h3' ).text( to );
		} );
	} );	
	
	
	/*
	 * COLORS -------------------------------------------------------------
	*/
	  
	// ------------ Header Colors
	wp.customize( 'header_bg', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'header_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a .title' ).css( 'color', to );
		} );
	} );
	wp.customize( 'header_tagline_color', function( value ) {
		value.bind( function( to ) {
			$( '.tagline' ).css( 'color', to );
		} );
	} );

    // ------------ Panels Colors  
	wp.customize( 'panels_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-navigation, .site-secondary, .search-panel' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'panels_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-description, .search-help,.panel-widget h4' ).css( 'color', to );
		} );
	} );
	wp.customize( 'panels_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-navigation a, .site-navigation a:visited, .slide-panels a, .slide-panels a:visited' ).css( 'color', to );
		} );
	} );


    // ------------ Main Colors        
	wp.customize( 'main_txt_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, button, input, select, textarea' ).css( 'color', to );
		} );
	} );
	wp.customize( 'main_link_color', function( value ) {
		value.bind( function( to ) {
			$( '.meta-data a, .meta-data a:visited, .entry-content a, .entry-content a:visited, .entry-footer a, .entry-footer a:visited, .comments-area a, .comments-area a:visited' ).css( 'color', to );
		} );
	} );
	
	// ------------ Footer Colors
	
	wp.customize( 'foot_bg', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets .content-wrap, .site-copyright .content-wrap' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'foot_txt', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets .content-wrap, .site-copyright .content-wrap, .footer-widgets .content-wrap td,.footer-widgets .content-wrap td, .footer-widgets .content-wrap th, .footer-widgets h4, .footer-widgets li:before' ).css( 'color', to );
		} );
	} );
	wp.customize( 'foot_txt_highlight', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widgets .content-wrap a, .footer-widgets .content-wrap a:visited,.site-copyright .content-wrap a, .site-copyright .content-wrap a:visited' ).css( 'color', to );
		} );
	} );
	
} )( jQuery );
