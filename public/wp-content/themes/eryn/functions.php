<?php
/**
 * eryn functions and definitions
 *
 * @package eryn
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 940; /* pixels */
}

if ( ! function_exists( 'eryn_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eryn_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eryn, use a find and replace
	 * to change 'eryn' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'eryn', get_template_directory() . '/languages' );

	// Feed Links
	add_theme_support( 'automatic-feed-links' );
	
	// Post formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery') );

	// Post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'full-thumb', 940, 0, true );
	add_image_size( 'slider-thumb', 650, 440, true );
	add_image_size( 'thumb', 440, 294, true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'eryn' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
    
	// Display Title in theme
	add_theme_support( 'title-tag' );
    
    // Custom Backgrounds Support
    $args = array(
	   'default-color' => 'FFFFFF',
    );
    add_theme_support( 'custom-background', $args );
    
    // link a custom stylesheet file to the TinyMCE visual editor
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Droid+Serif' );
	add_editor_style( array('style.css', 'css/editor-style.css', $font_url) );
    
    
}
endif; // eryn_setup
add_action( 'after_setup_theme', 'eryn_setup' );

/**
 * Author Social Links
 */
function eryn_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = 'Twitter Username';
	$contactmethods['facebook']  = 'Facebook Username';
	$contactmethods['google']    = 'Google Plus Username';
	$contactmethods['tumblr']    = 'Tumblr Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';

	return $contactmethods;
}
add_filter('user_contactmethods','eryn_contactmethods',10,1);


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function eryn_widgets_init() {
    register_sidebar( array(
		'name' => __( 'Footer 1', 'eryn' ),
		'id' => 'footer-1',
        'description'   => __( 'One of two widget areas that will apear at the bottom of the site.', 'eryn' ),
		'before_widget' => '<aside id="%1$s" class="widget first %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
    register_sidebar( array(
		'name' => __( 'Footer 2', 'eryn' ),
		'id' => 'footer-2',
        'description'   => __( 'One of two widget areas that will apear at the bottom of the site.', 'eryn' ),
		'before_widget' => '<aside id="%1$s" class="widget first %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',        
	) );
    register_sidebar( array(
		'name' => __( 'Navigation Panel', 'eryn' ),
		'id' => 'nav-bar-1',
        'description'   => __( 'Widget area within the navigation panel that will display below the site primary menu.', 'eryn' ),
		'before_widget' => '<aside id="%1$s" class="widget first %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
    register_sidebar( array(
		'name' => __( 'Search Panel', 'eryn' ),
		'id' => 'search-bar-1',
        'description'   => __( 'Widget area within the search panel that will display below the site search form.', 'eryn' ),
		'before_widget' => '<aside id="%1$s" class="widget first %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'eryn_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eryn_scripts() {
	
	// STYLESHEETS
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:600|Droid+Serif', '', '1.1');
	wp_enqueue_style('eryn-style', get_stylesheet_uri(), '', '1.1');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '', '1.1');
	wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', '', '1.1');

	// SCRIPTS
	wp_enqueue_script('eryn-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.1', true );
	wp_enqueue_script('eryn-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.1', true );
	wp_enqueue_script('jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.1', true);
	wp_enqueue_script('jquery-tooltipsy', get_template_directory_uri() . '/js/tooltipsy.min.js', array('jquery'), '1.1', true);
	wp_enqueue_script('jquery-flexslider', get_template_directory_uri() . '/js/flexslider.min.js', array('jquery'), '1.1', true);
	wp_enqueue_script('eryn_scripts', get_template_directory_uri() . '/js/eryn.js', array('jquery'), NULL, true);
    wp_enqueue_script('masonry');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eryn_scripts' );


/**
 * Include files
 */

//Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Theme Options
include('functions/customizer_controller.php');
include('functions/customizer_settings.php');
include('functions/customizer_styles.php');


/**
 * Exclude Featured Category
 */
function eryn_category($separator) {
	
	if(get_theme_mod( 'eryn_featured_cat_hide' ) == true) {
		
		$excluded_cat = get_theme_mod('eryn_featured_cat');
		
		$first_time = 1;
		foreach((get_the_category()) as $category) {
			if ($category->cat_ID != $excluded_cat) {
				if ($first_time == 1) {
					echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "eryn" ), $category->name ) . '" ' . '>'  . $category->name.'</a>';
					$first_time = 0;
				} else {
					echo $separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "eryn" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
				}
			}
		}
	
	} else {
		
		$first_time = 1;
		foreach((get_the_category()) as $category) {
			if ($first_time == 1) {
				echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "eryn" ), $category->name ) . '" ' . '>'  . $category->name.'</a>';
				$first_time = 0;
			} else {
				echo $separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "eryn" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
			}
		}
	
	}
}

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


/**
 * The Excerpt
 */
function eryn_custom_excerpt_length( $length ) {
	return 19;
}
add_filter( 'excerpt_length', 'eryn_custom_excerpt_length', 999 );

function eryn_new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'eryn_new_excerpt_more' );

/**
 * Title Tag Fallback
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) : 
function eryn_slug_render_title() { 
?> 
<title><?php wp_title( '|', true, 'right' ); ?></title> 
<?php 
} 
add_action( 'wp_head', 'eryn_slug_render_title' ); 
endif; 
/**
 * Include Google Fonts
 */
function eryn_google_fonts() {
	// Add Google Font stylesheets
	$array_font_sections = array(
		'font_site_title',
		'font_site_tagline',
		'font_body',
		'font_headers',
		'font_site_nav',
	);
	$fonts = '';
    $enqueueFonts = 0;
	foreach($array_font_sections as $id => $section)
	{
		if(get_theme_mod($array_font_sections[$id].'_display'))
		{
			$family = get_theme_mod($array_font_sections[$id]);
			$weight = get_theme_mod($array_font_sections[$id].'_weight');

			$fonts = $family;

			if($weight)
			{
				$fonts .= ':'.$weight;
			}
                    $fonts = ltrim($fonts, '|');
        $url = add_query_arg('family', urlencode($fonts), "//fonts.googleapis.com/css" );

        wp_enqueue_style('eryn-google-fonts-'.urlencode($fonts), $url);
            
            $enqueueFonts++;
		}
	}
    if($enqueueFonts == 0){
        return;
    } 
	
}
add_action('wp_enqueue_scripts', 'eryn_google_fonts');