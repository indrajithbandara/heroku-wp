jQuery(document).ready(function($) {

    $("site-secondary").scrollTop = $("site-secondary").scrollHeight;


    $('.nav-btn').on('click', function(e){
        e.preventDefault();
        $('body').removeClass('search-expanded').toggleClass('nav-expanded');
    });

    $('.nav-search-btn').on('click', function(e){
        e.preventDefault();
        var body = $('body');
        body.removeClass('nav-expanded').toggleClass('search-expanded');
    });

    /**
     * ======================================================
     * Featured Image
     * ======================================================
     */

    /**
		 * ======================================================
		 * Function Declaration
		 * ======================================================
		 */

		// Body height
		var calculateBodyHeight = function() {
			$( 'body' ).css( 'height', $( window ).height() - $( 'body' ).offset().top );
		}

		var calculateSidebarTogglePosition = function() {
			var margin_right = $( '.main' ).outerWidth() - $( '.main-inner' ).outerWidth();
			$( '.sticky-sidebar-toggle', '.main' ).css( 'marginRight', margin_right );
		}

		var resizePageBackground = function() {

			$( '.page-background-image > img' ).each(function( i, el ) {
				var $el       = $( el ),
				    $section  = $el.parent(),
				    img_w     = el.naturalWidth,
				    img_h     = el.naturalHeight,
				    section_w = $section.outerWidth(),
				    section_h = $section.outerHeight(),
				    scale_w   = section_w / img_w,
				    scale_h   = section_h / img_h,
				    scale     = scale_w > scale_h ? scale_w : scale_h,
				    new_img_w, new_img_h, offet_top, offet_left;

				new_img_w = scale * img_w;
				new_img_h = scale * img_h;
				offet_left = ( new_img_w - section_w ) / 2 * -1;
				offet_top  = ( new_img_h - section_h ) / 2 * -1;

				$el.css( 'width', new_img_w );
				$el.css( 'height', new_img_h );
				$el.css( 'marginTop', offet_top );
				$el.css( 'marginLeft', offet_left );
			});

		};

		/**
		 * ======================================================
		 * Run Scripts
		 * ======================================================
		 */

		// Body height
		$( window ).on( 'resize', function() {
			calculateBodyHeight();
		});
		calculateBodyHeight();

		// Sidebar Toggle Floating Position
		$( window ).on( 'resize', function() {
			calculateSidebarTogglePosition();
		});
		calculateSidebarTogglePosition();

		// Sidebar toggle
		$( 'body' ).on( 'click', '.sidebar-toggle', function( e ) {
			e.preventDefault();
			$( 'body' ).toggleClass( 'sidebar-active' );
		});


		// Preloader
		if ( $( '#preloader' ) ) {
			$( 'body' ).imagesLoaded( function() {
				$( 'body' ).addClass( 'preloader-done' );
			});
		}

		// Convert all side background sources to side background image
		if ( $( '#page-background' ) ) {

			$( '.page-background-source' ).each(function( i, el ) {
				var $img = $( this ),
				    $list = $( '#page-background' ),
				    $insert = $( '<div><img /></div>' ),
				    src = $img.attr( 'src' ),
				    insert_id = 'page-background-image-' + ( i + 1 );

				$insert.attr( 'id', insert_id );
				$insert.addClass( 'page-background-image' );
				$insert.children( 'img' ).attr( 'src', src );
				$insert.children( 'img' ).attr( 'alt', '' );
				$insert.appendTo( $list );

				if ( $img.parents( '.post-content' ) ) {

					var $anchor = $( '<div></div>' );

					$anchor.addClass( 'page-background-source-anchor' );
					$anchor.data( 'target', '#' + insert_id );
					$anchor.insertBefore( $img );
				}
			});

			$( '.page-background-image' ).imagesLoaded( function( instance ) {
				$( instance.elements ).addClass( 'loaded' );

				// Cover mode
				resizePageBackground();
				$( window ).on( 'resize', function() {
					resizePageBackground();
				});
			});

			// Set first side background image to active
			$( '.page-background-image' ).first().addClass( 'active' );



		}

    /**
     * ======================================================
     * Smooth Scroll to anchor CSS Tricks
     * ======================================================
     */
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
		    $('html,body').animate({
		      scrollTop: target.offset().top
		    }, 1000);
		    return false;
		  }
		}
	});
	$(document).scroll(function () {
	    var y = $(this).scrollTop();
	    if (y > 800) {
	        $('.nav-to-top-btn').fadeIn('slow');
	    } else {
	        $('.nav-to-top-btn').fadeOut('slow');
	    }
	});

    /**
     * ======================================================
     * Search & Social Toggle
     * ======================================================
     */
	$('.search-toggle').on('click', function(e){
		$('body').removeClass('is-social-toggled-on');
		$('body').toggleClass('is-search-toggled-on');
		if($('body').hasClass('is-search-toggled-on')){
			$('.top-bar .search-field').focus();
		}
	});
	$('.social-toggle').on('click', function(){
		$('body').removeClass('is-search-toggled-on');
		$('body').toggleClass('is-social-toggled-on');
	});
	$('.menu-toggle').on('click', function(){
		$('body').toggleClass('is-expanded-menu');
	});

    /**
     * ======================================================
     * slider nav width fixed;
     * ======================================================
     */
    $(window).load(function(){
        //Gallery post
        $('.flexslider').flexslider({
            animation: "fade",
            slideshow: false,
            itemMargin: 0,
            smoothHeight: true,
            rtl: true
        });

        $(".flex-control-nav").each(function(){

          var li_count = $(this).find("li").length;
          var _width = ((li_count * $(this).find("li").outerWidth() ) * 2.5);

          $(this).outerWidth(_width);
          $(this).css("margin-left", -1 * (_width/2));

        });
    });


  	// tooltip-ize all links with title attributes, except Site title.
	$('.hastip-share').tooltipsy({
		offset: [0, 10]
	});

	$('.hastip-author').tooltipsy({
		offset: [0, 10]
	});


	// Fitvids
	// Target your .container, .wrapper, .post, etc.
	$(".post-image.video").fitVids();

});
