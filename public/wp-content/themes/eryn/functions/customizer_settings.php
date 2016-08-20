<?php
/**
 * Customizer - Add Custom Styling
 */
function eryn_customizer_style()
{
	wp_enqueue_style('eryn-customizer', get_template_directory_uri() . '/functions/css/customizer.css', '1.1');
}
add_action('customize_controls_print_styles', 'eryn_customizer_style');

/**
 * Customizer - Live Preview
 */
function eryn_customizer_live_preview() {
	wp_enqueue_script( 
		'eryn-theme-customizer', 
		get_template_directory_uri() . '/js/theme-customizer.js', 
		array( 'customize-preview' ), 
		rand(),  
		true 
	);
}
add_action( 'customize_preview_init', 'eryn_customizer_live_preview' );

/**
 * Customizer - include script to display pro message
 */
if ( ! function_exists( 'eryn_customizer_scripts' ) ) :

	function eryn_customizer_scripts() {

		wp_register_script( 'eryn-customizer-pro', get_template_directory_uri() . '/js/customizer-pro.js', '1.1', 'jquery', true);
		
		// Localize the script with new data
		$translation_array = array(
			'pro_message' 	=> __( 'Check out Pro Version', 'eryn' ),
		);

		wp_localize_script( 'eryn-customizer-pro', 'pro_object', $translation_array );

		wp_enqueue_script( 'eryn-customizer-pro' );

	}

endif;

add_action( 'customize_controls_enqueue_scripts', 'eryn_customizer_scripts' );

/**
 * Customizer - Panels, Sections, Settings & Controls
 */
function eryn_register_theme_customizer( $wp_customize ) {
	
	//  List Arrays
	$list_social_channels = array( // 1
		'twitter'			=> __( 'Twitter url', 'eryn' ),
		'facebook'			=> __( 'Facebook url', 'eryn' ),
		'googleplus'		=> __( 'Google + url', 'eryn' ),
		'linkedin'			=> __( 'LinkedIn url', 'eryn' ),
		'flickr'			=> __( 'Flickr url', 'eryn' ),
		'pinterest'			=> __( 'Pinterest url', 'eryn' ),
		'youtube'			=> __( 'YouTube url', 'eryn' ),
		'vimeo'				=> __( 'Vimeo url', 'eryn' ),
		'tumblr'			=> __( 'Tumblr url', 'eryn' ),
		'dribble'			=> __( 'Dribbble url', 'eryn' ),
		'github'			=> __( 'Github url', 'eryn' ),
		'instagram'			=> __( 'Instagram url', 'eryn' ),
	);
	
	$list_hide_homepage_elements = array( // 1
		'categories'		=> __( 'Hide Categories', 'eryn'),
		'date'				=> __( 'Hide Date', 'eryn'),
		'comment_count'		=> __( 'Hide Comment Count', 'eryn'),
		'author'			=> __( 'Hide Author', 'eryn'),
		'featured'			=> __( 'Hide Featured Pin', 'eryn'),
	);
	   
   	$array_header_color_controls = array(
		array('header_title_color', __('Title Color', 'eryn'), '#FFF', true),
		array('header_tagline_color', __('Tagline Color', 'eryn'), '#FFF', true),
		array('header_title_hover_color', __('Title & Tagline Hover Color', 'eryn'), '#E0B549', false),
	);
	$array_panel_color_controls = array(
		array('panels_bg_color', __('Background color', 'eryn'), '#1b1b1b', true),
		array('panels_text_color', __('Text color', 'eryn'), '#FFF', true),
		array('panels_link_color', __('Link color', 'eryn'), '#FFF', true),
		array('panels_hover_color', __('link Hover Color', 'eryn'), '#db971a', false),
	);
    $array_body_color_controls = array(
        array('main_txt_color', __('Text Color', 'eryn'), '#2b2b2b', true),
        array('main_link_color', __('Link Color', 'eryn'), '#E0B549', true),
        array('main_link_hover', __('Link Hover Color', 'eryn'), '#E0B549', false),
    );
	
	$array_footer_color_controls = array(
		array('foot_bg', __('Footer Background Color', 'eryn'), '#FBFBFB', true),
		array('foot_txt', __('Footer Text Color', 'eryn'), '#2b2b2b', true),
		array('foot_txt_highlight', __('Footer Link Color', 'eryn'), '#E0B549', true),
		array('foot_txt_highlight_hover', __('Footer Link Hover Color', 'eryn'), '#E0B549', false),
	);
	
	$list_footer_hide_elements	= array(
		'widget_area'			=> __( 'Hide Widget Area', 'eryn' ),
		'copyright_area'		=> __( 'Hide Copyright Bar', 'eryn' ),
	);

if(! class_exists('PremiumEryn')){	
	// ======== Google Font Setup
	
	$list_fonts        		= array(); // 1
	$list_font_weights 		= array(); // 2
	$webfonts_array    		= file(get_template_directory() . '/inc/fonts.json');
	$webfonts          		= implode( '', $webfonts_array );
	$list_fonts_decode 		= json_decode( $webfonts, true );
	$defaultFont			= 'Open Sans';
	foreach ( $list_fonts_decode['items'] as $key => $value ) {
		$item_family                     = $list_fonts_decode['items'][$key]['family'];
		$list_fonts[$item_family]        = $item_family; 
		$list_font_weights[$item_family] = $list_fonts_decode['items'][$key]['variants'];
	}

	$list_all_font_weights = array( // 3
		'100'       => __( 'Thin', 'eryn' ),
		'300'       => __( 'Light', 'eryn' ),
		'400'  	=> __( 'Regular', 'eryn' ),
		'600'       => __( 'Semi-Bold', 'eryn' ),
		'700'       => __( 'Bold', 'eryn' ),
		'800'       => __( 'Extra Bold', 'eryn' ),
	);
	$list_font_sizes = array( // 3
		'12'    => __( 'Small', 'eryn' ),
		'16' 	=> __( 'Medium', 'eryn' ),
		'28'    => __( 'Large', 'eryn' ),
		'48' 	=> __( 'Extra Large', 'eryn' ),
		'70'	=> __('XX Large', 'eryn'),
        '120'   => __('Massive', 'eryn'),
	);
	$array_font_sections = array(
		array('font_site_title', __('Fonts - Site Title', 'eryn'), 'Open Sans', '400', '48', false),
		array('font_body', __('Fonts - Body Text', 'eryn'), 'Open Sans', '400', '16', false),
		array('font_headers', __('Fonts - Headers', 'eryn'), 'Open Sans', '400', '12', false),
	);

	$priority = 0;

	// ====== END font setup
}
			
	// Add Panels
	$priority = 10;
	if(method_exists('WP_Customize_Manager', 'add_panel')):
		$wp_customize->add_panel('eryn_header_panel', array(
			'title'	=> __('Site Settings', 'eryn'),
			'priority'	=> $priority++,
		));
		$wp_customize->add_panel('eryn_global_panel', array(
			'title'	=> __('Global Settings', 'eryn'),
			'priority'	=> $priority++,
		));
		$wp_customize->add_panel('eryn_homepage_panel', array(
			'title'	=> __('Homepage Settings', 'eryn'),
			'priority'	=> $priority++,
		));
		$wp_customize->add_panel('eryn_footer_panel', array(
			'title'	=> __('Footer Settings', 'eryn'),
			'priority'	=> $priority++,
		));
		
		$wp_customize->add_panel('eryn_post_page_panel', array(
			'title'	=> __('Post &amp; Page Settings', 'eryn'),
			'priority'	=> $priority++,
		));
		
		$wp_customize->add_panel('eryn_colors_panel', array(
			'title'	=> __('Color &amp; Fonts', 'eryn'),
			'priority'	=> $priority++,
		));	
	endif;

    
	$priority = 2;
    
	// Site Settings Panel
    $wp_customize->add_section('eryn_homepage_layout', array(
		'title'		     => __('Large Sidebar Image', 'eryn'),
        'description'   => __('Replace default sidebar image. This image will be replaced by any featured image on posts or pages.', 'eryn'),
		'panel'		     => 'eryn_header_panel',
		'priority'   	 => $priority++,
	));
	$wp_customize->add_section( 'eryn_logo_header' , array(
   		'title'      	=> __('Logos', 'eryn'),
        'description'   => __('Upload three versions of your logo for full experience on all devices.', 'eryn'),
		'panel'			=> 'eryn_header_panel',
   		'priority'   	=> $priority++,
	) );

	$wp_customize->add_section( 'eryn_social_section', array(
		'title'			=> __('Social Media Accounts', 'eryn'),
		'panel'			=> 'eryn_header_panel',
		'priority'		=> $priority++,
	));
    $wp_customize->add_section( 'eryn_global_icons' , array(
		'title'      => __('Favicon & App Icons', 'eryn'),
		'panel'		 => 'eryn_header_panel',
		'priority'	=> $priority++,
	) );

	$wp_customize->add_section( 'eryn_global_layout' , array(
		'title'      => __('Background Image', 'eryn'),
		'panel'		 => 'eryn_header_panel',
		'priority'	=> $priority++,
	) );

    
    // Homepage Panel
    $wp_customize->add_section( 'eryn_homepage_hide_section' , array(
		'title'      => __('Hide Elements', 'eryn'),
		'panel'		 => 'eryn_homepage_panel',
		'priority'   => 2,
	) );
    
    
	// Post Page Panel
	$wp_customize->add_section( 'eryn_post_settings_section', array(
		'title'			=> __('Single Post Settings', 'eryn'),
		'panel'			=> 'eryn_post_page_panel',
		'priority'		=> 2,
	));
	$wp_customize->add_section( 'eryn_hide_show_page_section', array(
		'title'			=> __('Page Settings', 'eryn'),
		'panel'			=> 'eryn_post_page_panel',
		'priority'		=> 3,
	));	
		
	// Footer Panel
	$wp_customize->add_section( 'eryn_footer_copyright', array(
		'title'			=> __('Copyright Settings', 'eryn'),
        'description'   => __('You can use HTML links in this text-field.', 'eryn'),
		'panel'			=> 'eryn_footer_panel',
		'priority'	   => $priority++,
	));	
	
    $wp_customize->add_section( 'eryn_hide_footer_elements', array(
	 	'title'			=> __('Hide Footer Sections', 'eryn'),
	 	'panel'			=> 'eryn_footer_panel', 
        'priority'	 => $priority++,
    ));
    
    //widgets Panel
    $wp_customize->add_section( 'eryn_footer_widgets', array(
        'title'         => __('Display Widget Settings', 'eryn'),
        'panel'         => 'widgets',
    ));
    

	// Color & Fonts Panel 
    $wp_customize->add_section('eryn_header_colors_section', array(
		'title'		 => __('Colors - Image Sidebar', 'eryn'),
		'description' => __('Change the color of the text on the main sidebar (with the background image).', 'eryn'),
        'panel'		=> 'eryn_colors_panel',
		'priority'	=> $priority++,
	));
	$wp_customize->add_section('eryn_panels_colors_section', array(
		'title'		 => __('Colors - Navigation Panel', 'eryn'),
		'description' => __('Change the colors on the navigation panel.', 'eryn'),
        'panel'		=> 'eryn_colors_panel',
		'priority'	=> $priority++,
	));
    $wp_customize->add_section('eryn_main_colors_section', array(
		'title'		=> __('Colors - Main Body', 'eryn'),
        'description' => __('Control the main body colors like text and links.', 'eryn'),
		'panel'		=> 'eryn_colors_panel',
		'priority'	=> $priority++,
	));
    $wp_customize->add_section('eryn_footer_colors_section', array(
		'title'		=> __('Colors - Footer', 'eryn'),
        'description' => __('Change your footer area colors to seperate from main content.', 'eryn'),
		'panel'		=> 'eryn_colors_panel',
		'priority'	=> $priority++,
	));
	if(! class_exists('PremiumEryn')){	
		$arraycount = count($array_font_sections);
		for ($row = 0; $row <  $arraycount; $row++) {
			$wp_customize->add_section($array_font_sections[$row][0], array(
				'title'		=> $array_font_sections[$row][1],
				'description' => __('Please Note, certain fonts have limited weights or sizes. If you do not see your fonts change try a different weight or size.', 'eryn'),
				'panel'		=> 'eryn_colors_panel',
				'priority'	=> $priority++,
			));	
		}
	}
	
// Add Setting
// ------------------------------------------------------------------------------------------
       
	//Title/tagline Uppercase
    $wp_customize->add_setting('hide_site_title_block', array(
		'default'		=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
    
	$wp_customize->add_setting('eryn_title_uppercase', array(
		'default'			=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
	$wp_customize->add_setting('eryn_tagline_uppercase', array(
		'default'			=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));

    $wp_customize->add_setting('hide_site_title', array(
		'default'		=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
	$wp_customize->add_setting('hide_tagline', array(
		'default'		=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
	
	$arraycount = count($array_header_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		
		// check what transport method is needed
		if($array_header_color_controls[$row][3] == true){
			$transportMethod = 'postMessage';
		}else{
			$transportMethod = 'refresh';
		}
		
		$wp_customize->add_setting(
			$array_header_color_controls[$row][0],
			array(
				'default'     		=> $array_header_color_controls[$row][2],
				'sanitize_callback'	=> 'eryn_sanitize_color',
				'transport'			=> $transportMethod,
			)
		);	
	}

	$arraycount = count($array_panel_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		
		// check what transport method is needed
		if($array_panel_color_controls[$row][3] == true){
			$transportMethod = 'postMessage';
		}else{
			$transportMethod = 'refresh';
		}
		
		$wp_customize->add_setting(
			$array_panel_color_controls[$row][0],
			array(
				'default'     		=> $array_panel_color_controls[$row][2],
				'sanitize_callback'	=> 'eryn_sanitize_color',
				'transport'			=> $transportMethod,
			)
		);	
	}
    
    $arraycount = count( $array_body_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		
		// check what transport method is needed
		if($array_body_color_controls[$row][3] == true){
			$transportMethod = 'postMessage';
		}else{
			$transportMethod = 'refresh';
		}
		
		$wp_customize->add_setting(
			$array_body_color_controls[$row][0],
			array(
				'default'     		=> $array_body_color_controls[$row][2],
				'sanitize_callback'	=> 'eryn_sanitize_color',
				'transport'			=> $transportMethod,
			)
		);	
	}
	
	$arraycount = count($array_footer_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
				
		// check what transport method is needed
		if($array_footer_color_controls[$row][3] == true){
			$transportMethod = 'postMessage';
		}else{
			$transportMethod = 'refresh';
		}
		
		$wp_customize->add_setting(
			$array_footer_color_controls[$row][0],
			array(
				'default'     => $array_footer_color_controls[$row][2],
				'sanitize_callback'	=> 'eryn_sanitize_color',
				'transport'			=> $transportMethod,
			)
		);	
	}
	$wp_customize->add_setting('global_color_scheme_override', array(
		'default' => false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
	$wp_customize->add_setting('global_color_scheme', array(
		'default' => 'blue',
		'sanitize_callback'	=> 'eryn_sanitize_text',
	));
	
	if(! class_exists('PremiumEryn')){	
		// Font Settings
		$arraycount = count($array_font_sections);
		for ($row = 0; $row <  $arraycount; $row++) {
			$wp_customize->add_setting(
				$array_font_sections[$row][0],
				array(
					'default'     => $array_font_sections[$row][2],
					'sanitize_callback'	=> 'eryn_sanitize_text',
				)
			);
			$wp_customize->add_setting(
				$array_font_sections[$row][0].'_weight',
				array(
					'default'     => $array_font_sections[$row][3],
					'sanitize_callback'	=> 'eryn_sanitize_text',
				)
			);
			$wp_customize->add_setting(
				$array_font_sections[$row][0].'_size',
				array(
					'default'     => $array_font_sections[$row][4],
					'sanitize_callback'	=> 'eryn_sanitize_text',
				)
			);	
			$wp_customize->add_setting(
				$array_font_sections[$row][0].'_display',
				array(
					'default'     => $array_font_sections[$row][5],
					'sanitize_callback'	=> 'eryn_sanitize_checkbox',
				)
			);			
		}
	}


	// Global Icons
	$wp_customize->add_setting('eryn_global_favicon', array(
		'sanitize_callback'	=> 'eryn_sanitize_upload',
	));
	$wp_customize->add_setting('eryn_global_apple_icon', array(
		'sanitize_callback'	=> 'eryn_sanitize_upload',
	));
	
	// Global Layout
	$wp_customize->add_setting('eryn_global_css', array(
		'sanitize_callback'	=> 'eryn_sanitize_textarea',
	));
	$wp_customize->add_setting('upload_site_background_image', array(
		'sanitize_callback'	=> 'eryn_sanitize_upload',
	));
	$wp_customize->add_setting('upload_site_background_image_repeat', array(
		'default' 			=> 'repeat',
		'sanitize_callback'	=> 'eryn_sanitize_text',
	));


	
    // Homepage Featured Image
    $wp_customize->add_setting('eryn_homepage_image', array(
		'sanitize_callback'		=> 'eryn_sanitize_upload',
	));
    $wp_customize->add_setting('eryn_homepage_image_alt', array(
		'sanitize_callback'		=> 'eryn_sanitize_text',
	));
	$wp_customize->add_setting('homepage_featured_image_global', array(
		'default'				=> false,
		'sanitize_callback'		=> 'eryn_sanitize_checkbox',
	));
    
	// Homepage Hide Elements
	foreach($list_hide_homepage_elements as $key => $value){
		$wp_customize->add_setting(
			'eryn_homepage_hide_'.$key, array(
				'default'	=> false,
				'sanitize_callback'	=> 'eryn_sanitize_checkbox',
			)
		);
	}    

	
	// Header and logo
	$wp_customize->add_setting('eryn_logo', array(
		'sanitize_callback'	=> 'eryn_sanitize_upload',
	));
	$wp_customize->add_setting('eryn_logo_small_screen', array(
		'sanitize_callback'	=> 'eryn_sanitize_upload',
	));
	$wp_customize->add_setting('eryn_logo_retina', array(
		'sanitize_callback'		=> 'eryn_sanitize_upload',
	));
    
	$wp_customize->add_setting(
        'eryn_header_top',
        array(
            'default'    		=> '40',
			'sanitize_callback'	=> 'eryn_sanitize_integer',
        )
    );
	$wp_customize->add_setting(
        'eryn_header_left',
        array(
            'default'     => '20',
			'sanitize_callback'	=> 'eryn_sanitize_integer',
        )
    );
    
	// Social Media Acocunts
	foreach ($list_social_channels as $key => $value) {
		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => 'eryn_sanitize_upload',
		));
	}

	// Footer Settings
	$wp_customize->add_setting('footer_copyright_strapline', array(
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'eryn_sanitize_text',
	));	
    $wp_customize->add_setting('eryn_hide_footer_widget_area', array(
		'default'			=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
	$wp_customize->add_setting('eryn_hide_copyright_bar', array(
		'default'			=> false,
		'sanitize_callback'	=> 'eryn_sanitize_checkbox',
	));
		
// Add Control
        
	//Title/tagline Uppercase
	$priority = 20;
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eryn_title_uppercase',
			array(
				'label'      	=> __('Display Title in Uppercase', 'eryn'),
				'section'    	=> 'title_tagline',
				'settings'   	=> 'eryn_title_uppercase',
				'type'		 	=> 'checkbox',
				'priority'		=> $priority++,
                
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eryn_tagline_uppercase',
			array(
				'label'      	=> __('Display Tagline in Uppercase', 'eryn'),
				'section'    	=> 'title_tagline',
				'settings'   	=> 'eryn_tagline_uppercase',
				'type'		 	=> 'checkbox',
				'priority'		=> $priority++,
			)
		)
	);
	
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_site_title_block_control',
			array(
				'label'      => __('Hide Title Block From Sidebar', 'eryn'),
				'section'    => 'title_tagline',
				'settings'   => 'hide_site_title_block',
				'type'		 => 'checkbox',
				'priority'		=> $priority++,
			)
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_site_title_control',
			array(
				'label'      => __('Hide Site Title from sliding panels', 'eryn'),
				'section'    => 'title_tagline',
				'settings'   => 'hide_site_title',
				'type'		 => 'checkbox',
				'priority'		=> $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_tagline_control',
			array(
				'label'      => __('Hide Tagline from sliding panels', 'eryn'),
				'section'    => 'title_tagline',
				'settings'   => 'hide_tagline',
				'type'		 => 'checkbox',
				'priority'		=> $priority++,
			)
		)
	);
	


	//Color Controls	
	$priority = 0;
		
	$arraycount = count($array_header_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$array_header_color_controls[$row][0],
				array(
					'label'      =>  $array_header_color_controls[$row][1],
					'section'    => 'eryn_header_colors_section',
					'settings'   => $array_header_color_controls[$row][0],
					'priority'	 => $priority++,
				)
			)
		);
	}	

	$arraycount = count($array_panel_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$array_panel_color_controls[$row][0],
				array(
					'label'      =>  $array_panel_color_controls[$row][1],
					'section'    => 'eryn_panels_colors_section',
					'settings'   => $array_panel_color_controls[$row][0],
					'priority'	 => $priority++,
				)
			)
		);
	}	
	
    
    $arraycount = count($array_body_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$array_body_color_controls[$row][0],
				array(
					'label'      =>  $array_body_color_controls[$row][1],
					'section'    => 'eryn_main_colors_section',
					'settings'   => $array_body_color_controls[$row][0],
					'priority'	 => $priority++,
				)
			)
		);
	}  
        
	$arraycount = count($array_footer_color_controls);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$array_footer_color_controls[$row][0],
				array(
					'label'      =>  $array_footer_color_controls[$row][1],
					'section'    => 'eryn_footer_colors_section',
					'settings'   => $array_footer_color_controls[$row][0],
					'priority'	 => $priority++,
				)
			)
		);
	}
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'global_color_scheme_override_control',
			array(
				'label'      	=> __('Override custom colors with pre-defined color scheme below', 'eryn'),
				'section'    	=> 'eryn_global_colors_section',
				'settings'   	=> 'global_color_scheme_override',
				'priority'	 	=> $priority++,
				'type'		 	=> 'checkbox',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'global_color_scheme_control',
			array(
				'label'          => __('Choose Color Scheme', 'eryn'),
				'section'        => 'eryn_global_colors_section',
				'settings'       => 'global_color_scheme',
				'type'           => 'radio',
				'priority'	 => $priority++,
				'choices'        => array(
					'blue'   		=> __('Beau Blue', 'eryn'),
					'red'  			=> __('Firebrick Red', 'eryn'),
					'orange'		=> __('Mango Tango', 'eryn'),
					'green'			=> __('Celadon green', 'eryn'),
				)
			)
		)
	);	
	
	if(! class_exists('PremiumEryn')){
		// Font Controls
		$arraycount = count($array_font_sections);
		for ($row = 0; $row <  $arraycount; $row++) {
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					$array_font_sections[$row][0].'_display',
					array(
						'label'      	=> __('Enable these settings', 'eryn'),
						'section'    	=> $array_font_sections[$row][0],
						'settings'   	=> $array_font_sections[$row][0].'_display',
						'type'		 	=> 'checkbox',
						'priority'		=> $priority++,
					)
				)
			);
			$wp_customize->add_control( $array_font_sections[$row][0], array(
				'type'     => 'select',
				'label'    => __( 'Font Family', 'eryn' ),
				'section'  => $array_font_sections[$row][0],
				'priority' =>$priority++,
				'choices'  => $list_fonts
			));
			$wp_customize->add_control( $array_font_sections[$row][0].'_weight', array(
				'type'     => 'select',
				'label'    => __( 'Font Weight', 'eryn' ),
				'section'  => $array_font_sections[$row][0],
				'priority' =>$priority++,
				'choices'  => $list_all_font_weights
			));		
			$wp_customize->add_control( $array_font_sections[$row][0].'_size', array(
				'type'     => 'select',
				'label'    => __( 'Font Size', 'eryn' ),
				'section'  => $array_font_sections[$row][0],
				'priority' => $priority++,
				'choices'  => $list_font_sizes
			));
		}
	}
	
	//Post & Page Show/Hide Elements
	$priority =0;

	// Global Icons
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'eryn_global_favicon',
			array(
				'label'      => __('Upload Favicon', 'eryn'),
				'section'    => 'eryn_global_icons',
				'settings'   => 'eryn_global_favicon',
				'priority'	 => 1
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'eryn_global_apple_icon',
			array(
				'label'      => __('Upload Apple App Icon', 'eryn'),
				'section'    => 'eryn_global_icons',
				'settings'   => 'eryn_global_apple_icon',
				'priority'	 => 1
			)
		)
	);
	
	// Global Layout
	$priority = 0;
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'upload_site_background_image',
			array(
				'label'      => __('Upload Background Image or Texture', 'eryn'),
				'section'    => 'eryn_global_layout',
				'settings'   => 'upload_site_background_image',
				'priority'	 => $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'upload_site_background_image_repeat',
			array(
				'label'          => __('Background Repeat Image', 'eryn'),
				'section'        => 'eryn_global_layout',
				'settings'       => 'upload_site_background_image_repeat',
				'type'           => 'radio',
				'priority'	 => $priority++,
				'choices'        => array(
					'no-repeat'  	=> __('No Repeat', 'eryn'),
					'repeat'		=> __('Tile', 'eryn'),
					'repeat-x'   	=> __('Repeat Horizontally', 'eryn'),
					'repeat-y'		=> __('Repeat Vertically', 'eryn'),
				)
			)
		)
	);

	$priority = 0;

    
    
    // Homepage Featured Image
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'upload_homepage_featured_image',
			array(
				'label'      => __('Upload Default Featured Image', 'eryn'),
				'section'    => 'eryn_homepage_layout',
				'settings'   => 'eryn_homepage_image',
				'priority'	 => $priority++,
			)
		)
	);
    $wp_customize->add_control( 'homepage_featured_image_alt', array(
        'label'   => __('Alt Text for Image', 'eryn'),
        'section' => 'eryn_homepage_layout',
        'settings'   => 'eryn_homepage_image_alt',
        'type'    => 'text',
        'priority'	 => $priority++,
    ) );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_featured_image_global_control',
			array(
				'label'      => __('Use Image throughout Site', 'eryn'),
				'section'    => 'eryn_homepage_layout',
				'settings'   => 'homepage_featured_image_global',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);

	// Homepage Hide Elements
	foreach($list_hide_homepage_elements as $key => $value){
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'homepage_hide_'.$key,
				array(
					'label'      => $value,
					'section'    => 'eryn_homepage_hide_section',
					'settings'   => 'eryn_homepage_hide_'.$key,
					'type'		 => 'checkbox',
					'priority'	 => $priority++,
				)
			)
		);
	}

	
	// Background Image
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eryn_background_header_repeat',
			array(
				'label'          => __('Background Repeat Image', 'eryn'),
				'section'        => 'header_image',
				'settings'       => 'eryn_background_header_repeat',
				'type'           => 'radio',
				'priority'	 => 12,
				'choices'        => array(
					'no-repeat'  	=> __('No Repeat', 'eryn'),
					'repeat'		=> __('Tile', 'eryn'),
					'repeat-x'   	=> __('Repeat Horizontally', 'eryn'),
					'repeat-y'		=> __('Repeat Vertically', 'eryn'),
				)
			)
		)
	);

	// Header and Logo
	$priority = 0;
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'upload_logo',
			array(
				'label'      => __('Upload Default Logo', 'eryn'),
				'section'    => 'eryn_logo_header',
				'settings'   => 'eryn_logo',
				'priority'	 => $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'eryn_logo_small_screen',
			array(
				'label'      => __('Upload Small Screen Logo', 'eryn'),
				'section'    => 'eryn_logo_header',
				'settings'   => 'eryn_logo_small_screen',
				'priority'	 => $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'upload_logo_retina',
			array(
				'label'      => __('Upload Logo (Retina Version)', 'eryn'),
				'section'    => 'eryn_logo_header',
				'settings'   => 'eryn_logo_retina',
				'priority'	 => $priority++,
			)
		)
	);
    
    
	$wp_customize->add_control(
		new Customize_Number_Control(
			$wp_customize,
			'header_top_position',
			array(
				'label'      => __('Position from top', 'eryn'),
                'description' => __('Minimum Value is 1px', 'eryn'),
				'section'    => 'eryn_logo_header',
				'settings'   => 'eryn_header_top',
				'type'		 => 'number',
				'priority'	 => $priority++,
			)
		)
	);
	
	$wp_customize->add_control(
		new Customize_Number_Control(
			$wp_customize,
			'header_side_position',
			array(
				'label'      => __('Position from left', 'eryn'),
                'description' => __('Minimum Value is 1px', 'eryn'),
				'section'    => 'eryn_logo_header',
				'settings'   => 'eryn_header_left',
				'type'		 => 'number',
				'priority'	 => $priority++,
			)
		)
	);
	   
	// Social Media Acocunts
	foreach ($list_social_channels as $key => $value) {
		$wp_customize->add_control( $key, array(
			'label'   => $value,
			'section' => 'eryn_social_section',
			'type'    => 'url',
		) );
	}
	
	// Footer Controls
	$wp_customize->add_control( 'footer_copyright_strapline', array(
		'label'    	=> __( 'Copyright Strapline', 'eryn' ),
		'settings'	=> 'footer_copyright_strapline',
		'section'  	=> 'eryn_footer_copyright',
	));	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eryn_hide_footer_widget_area',
			array(
				'label'      	=> __('Hide Footer Widget Area', 'eryn'),
				'section'    	=> 'eryn_hide_footer_elements',
				'settings'   	=> 'eryn_hide_footer_widget_area',
				'type'		 	=> 'checkbox',
                
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'eryn_hide_copyright_bar',
			array(
				'label'      	=> __('Hide Copyright Bar', 'eryn'),
				'section'    	=> 'eryn_hide_footer_elements',
				'settings'   	=> 'eryn_hide_copyright_bar',
				'type'		 	=> 'checkbox',
                
			)
		)
	);
    
    
		
	// Remove Sections
	
	$wp_customize->get_section( 'title_tagline' )->panel = 'eryn_header_panel';
	$wp_customize->get_section( 'title_tagline' )->priority = 1;
	$wp_customize->get_section( 'header_image' )->panel = 'eryn_header_panel';
	$wp_customize->get_section( 'header_image' )->priority = 3;
    $wp_customize->remove_section('background_image');
	$wp_customize->remove_section( 'header_image' );
    $wp_customize->get_control( 'blogname' )->priority = 1;
	$wp_customize->remove_control( 'font_body_size' );
    $wp_customize->remove_control( 'font_headers_size' );
	$wp_customize->remove_section( 'colors');
	
	// Change defaults for live preview
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
}
add_action( 'customize_register', 'eryn_register_theme_customizer' );


// SANITIZATION
// ==============================

// Sanitize Text
function eryn_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Sanitize Textarea
function eryn_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}
// Sanitize Checkbox
function eryn_sanitize_checkbox( $input ) {
	if( $input ):
		$output = '1';
	else:
		$output = false;
	endif;
	return $output;
}
// Sanitize Numbers
function eryn_sanitize_integer( $input ) {
	$value = (int) $input; // Force the value into integer type.
    return ( 0 < $input ) ? $input : null;
}
function eryn_sanitize_float( $input ) {
	return floatval( $input );
}

// Sanitize Uploads
function eryn_sanitize_upload($input){
	return esc_url_raw($input);	
}

// Sanitize Colors
function eryn_sanitize_color($input){
	return maybe_hash_hex_color($input);
}