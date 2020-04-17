/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );





	/***** TOPBAR *****/

	// Topbar shadow
	wp.customize( 'skywp_topbar_shadow', function( value ){
		value.bind( function( newval ){
			if ( true == newval ) {
				$( '#top-bar-wrap' ).addClass( 'topbar-shadow' );
			} else {
				$( '#top-bar-wrap' ).removeClass( 'topbar-shadow' );
			}
			
		});
	});

	// Topbar background
	wp.customize( 'skywp_bg_topbar', function( value ){
		value.bind( function( newval ){
			$( '#top-bar-wrap' ).css({ 'background': newval });
		});
	});

	// Topbar social buttons color
	wp.customize( 'skywp_topbar_social_buttons_color', function( value ){
		value.bind( function( newval ){
			$( '.social-navigation .social-links-menu li a' ).css({ 'color': newval });
		});
	});

	// Width
	wp.customize( 'topbar_width', function( value ){
		value.bind( function( newval ){
			$( '#top-bar-wrap .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Padding
	wp.customize( 'skywp_topbar_padding', function( value ){
		value.bind( function( newval ){
			$( '#top-bar-wrap #top-bar' ).css({ 'padding': newval });
		});
	});

	// Visibility
	wp.customize( 'skywp_topbar_visibility', function( value ){
		value.bind( function( newval ){
			if ( 'all-devices' == newval ) {
				$( '#top-bar-wrap' ).addClass( 'all-devices' );
			} else {
				$( '#top-bar-wrap' ).removeClass( 'all-devices' );
			}
			if ( 'hide-tablet' == newval ) {
				$( '#top-bar-wrap' ).addClass( 'hide-tablet' );
			} else {
				$( '#top-bar-wrap' ).removeClass( 'hide-tablet' );
			}
			if ( 'hide-mobile' == newval ) {
				$( '#top-bar-wrap' ).addClass( 'hide-mobile' );
			} else {
				$( '#top-bar-wrap' ).removeClass( 'hide-mobile' );
			}
			if ( 'hide-tablet-mobile' == newval ) {
				$( '#top-bar-wrap' ).addClass( 'hide-tablet-mobile' );
			} else {
				$( '#top-bar-wrap' ).removeClass( 'hide-tablet-mobile' );
			}
			
		});
	});

	// Alignment
	wp.customize( 'skywp_topbar_alignment', function( value ){
		value.bind( function( newval ){
			if ( 'space-between' == newval ) {
				$( '#top-bar #top-bar-inner' ).addClass( 'space-between' );
			} else {
				$( '#top-bar #top-bar-inner' ).removeClass( 'space-between' );
			}
			if ( 'space-around' == newval ) {
				$( '#top-bar #top-bar-inner' ).addClass( 'space-around' );
			} else {
				$( '#top-bar #top-bar-inner' ).removeClass( 'space-around' );
			}
			if ( 'center' == newval ) {
				$( '#top-bar #top-bar-inner' ).addClass( 'center' );
			} else {
				$( '#top-bar #top-bar-inner' ).removeClass( 'center' );
			}
			if ( 'flex-start' == newval ) {
				$( '#top-bar #top-bar-inner' ).addClass( 'flex-start' );
			} else {
				$( '#top-bar #top-bar-inner' ).removeClass( 'flex-start' );
			}
			if ( 'flex-end' == newval ) {
				$( '#top-bar #top-bar-inner' ).addClass( 'flex-end' );
			} else {
				$( '#top-bar #top-bar-inner' ).removeClass( 'flex-end' );
			}
			
		});
	});

	// Position
	wp.customize( 'skywp_topbar_position', function( value ){
		value.bind( function( newval ){
			$( '#top-bar-wrap' ).css({ 'position': newval });
		});
	});

	// Text color
	wp.customize( 'skywp_topbar_text_color', function( value ){
		value.bind( function( newval ){
			$( '#top-bar-inner .site_widget' ).css({ 'color': newval });
		});
	});

	// Font size
	wp.customize( 'skywp_topbar_text_font_size', function( value ){
		value.bind( function( newval ){
			$( '#top-bar-inner .site_widget' ).css({ 'font-size': newval + 'px' });
		});
	});





	/***** HEADER *****/

	// Background header
	wp.customize( 'skywp_bg_header', function( value ){
		value.bind( function( newval ){
			$( '#site-header' ).css({ 'background': newval });
		});
	});

	// Background sticky header  
	wp.customize( 'skywp_bg_sticky_header', function( value ){
		value.bind( function( newval ){
			$( '#site-header.fixed' ).css({ 'background': newval });
		});
	});





	/***** BLOG *****/

	// Background
	wp.customize( 'sky_post_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#content-wrap #primary #main-style article .blog-wrap' ).css({'background': newval} );
		});
	});

	// Title
	wp.customize( 'sky_post_title_color', function( value ) {
		value.bind( function( newval ) {
			$( '#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-title a' ).css({'color': newval} );
		});
	});

	// Meta
	wp.customize( 'sky_post_meta_color', function( value ) {
		value.bind( function( newval ) {
			$( '#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-meta ul li, #content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-meta ul li a' ).css({'color': newval} );
		});
	});





	/***** SUBHEADER *****/

	// Background
	wp.customize( 'sky_subheader_bg_color', function( value ) {
		value.bind( function( newval ) {
			$( '#site-subheader' ).css({'background': newval} );
		});
	});

	// Padding
	wp.customize( 'sky_subheader_padding', function( value ) {
		value.bind( function( newval ) {
			$( '#site-subheader' ).css({'padding': newval} );
		});
	});

	// Color
	wp.customize( 'sky_subheader_color', function( value ) {
		value.bind( function( newval ) {
			$( '#site-subheader .content ul li, #site-subheader .content ul li a, #site-subheader .content ul li i.arrows-right' ).css({'color': newval} );
		});
	});

	// Font Weight
	wp.customize( 'sky_subheader_font_weight', function( value ) {
		value.bind( function( newval ) {
			$( '#site-subheader .content ul li' ).css({'font-weight': newval} );
		});
	});

	// Text Transform
	wp.customize( 'sky_subheader_text_transform', function( value ) {
		value.bind( function( newval ) {
			$( '#site-subheader .content ul li' ).css({'text-transform': newval} );
		});
	});

	// Letter Spacing
	wp.customize( 'sky_subheader_letter_spacing', function( value ) {
		value.bind( function( newval ) {
			$( '#site-subheader .content ul li' ).css({'letter-spacing': newval +'px'} );
		});
	});





	/***** BASE *****/

	// Width
	wp.customize( 'general_width', function( value ) {
		value.bind( function( newval ) {
			$( '.wrapper' ).css({'max-width': newval +'px'} );
		});
	});

	// Font size
	wp.customize( 'font_size_body', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css({'font-size': newval +'px'} );
		});
	});

	// Outer Background
	wp.customize( 'skywp_outer_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#wrap.outer-wrapper' ).css({'background': newval} );
		});
	});

	// Inner Background
	wp.customize( 'skywp_inner_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#content #content-wrap' ).css({'background': newval} );
		});
	});

	// Default color
	wp.customize( 'sky_default_color', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css({'color': newval} );
		});
	});

	// Links color
	wp.customize( 'skywp_links_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site_widget ul li a, .widget_calendar .calendar_wrap a, #content-wrap  .navigation.post-navigation .nav-links a, #comments .comment-list .comment .comment-body .comment-meta .comment-author .fn, #comments .comment-list .comment .comment-body .comment-meta .comment-author .fn a, #comments .comment-list .comment .comment-body .comment-meta .comment-metadata a, #comments .comment-list .comment .comment-body .reply a, #respond .logged-in-as a, .page-attachment .image-navigation .nav-links a, .page-attachment .entry-footer a' ).css({'color': newval} );
		});
	});





	/***** FOOTER *****/

	// Width
	wp.customize( 'footer_width', function( value ){
		value.bind( function( newval ){
			$( '#footer-wrapper .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Padding
	wp.customize( 'skywp_footer_padding', function( value ){
		value.bind( function( newval ){
			$( '#footer-wrapper' ).css({ 'padding': newval });
		});
	});

	// Background
	wp.customize( 'skywp_footer_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-wrapper' ).css({'background': newval} );
		});
	});

	// Title color
	wp.customize( 'sky_footer_title_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget h2' ).css({'color': newval} );
		});
	});

	// Border color
	wp.customize( 'sky_footer_border_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget h2' ).css({'border-color': newval} );
		});
	});

	// Text color
	wp.customize( 'sky_footer_text_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget, #footer-area .site_widget a, #footer-area .author-theme a' ).css({'color': newval} );
		});
	});

	// Tag cloud border color
	wp.customize( 'skywp_footer_tag_cloud_border_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget .tagcloud a' ).css({'border-color': newval} );
		});
	});





	/***** COPYRIGHT *****/

	// Alignment
	wp.customize( 'skywp_copyright_alignment', function( value ){
		value.bind( function( newval ){
			$( '#copyright .container' ).css({ '-webkit-box-pack': newval, '-ms-flex-pack': newval, 'justify-content': newval });
		});
	});

	// Width
	wp.customize( 'footer_copyright_width', function( value ){
		value.bind( function( newval ){
			$( '#copyright .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Padding
	wp.customize( 'skywp_footer_padding_copyright', function( value ){
		value.bind( function( newval ){
			$( '#copyright .container' ).css({ 'padding': newval });
		});
	});

	// Background
	wp.customize( 'skywp_copyright_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#copyright' ).css({'background': newval} );
		});
	});


	





} )( jQuery );
