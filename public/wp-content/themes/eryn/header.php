<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package eryn
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if(get_theme_mod('eryn_global_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('eryn_global_favicon')); ?>" />
<?php endif; ?>

<?php if(get_theme_mod('eryn_global_apple_icon')) : ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('eryn_global_apple_icon')); ?>">
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">

<?php wp_head(); ?>
</head>
    
    

<body id="top" <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">        
        <div class="featured-image">
            <div id="page-background" class="page-background">
                <svg class="page-background-loader" width="70" height="20">
                    <circle cx="10" cy="10" r="0">
                        <animate attributeName="r" from="0" to="10" values="0;10;10;10;0" dur="1000ms" repeatCount="indefinite"/>
                    </circle>
                    <circle cx="35" cy="10" r="0">
                        <animate attributeName="r" from="0" to="10" values="0;10;10;10;0" begin="200ms" dur="1000ms" repeatCount="indefinite"/>
                    </circle>
                    <circle cx="60" cy="10" r="0">
                        <animate attributeName="r" from="0" to="10" values="0;10;10;10;0" begin="400ms" dur="1000ms" repeatCount="indefinite"/>
                    </circle>
                </svg>
                <div id="page-background-image-default" class="page-background-image active">    
                    <?php if(get_theme_mod('eryn_logo')): ?>
                        <div class="site-logo">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>">
                                <img src="<?php echo esc_url(get_theme_mod('eryn_logo')); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(!get_theme_mod('hide_site_title_block')): ?>
                        <div class="site-title-block">
                            <h1 class="site-title over-photo">
                                <a href="<?php echo home_url(); ?>">
                                    <span class="title"><?php bloginfo( 'name' ); ?></span>
                                </a>
                            </h1>
                            <h2><span class="tagline"><?php bloginfo( 'description' ); ?></span></h2>
                        </div>
                    <?php endif; ?>

                    <?php
                        if( get_theme_mod('homepage_featured_image_global') && get_theme_mod('eryn_homepage_image') ): ?>
                            <img src="<?php echo esc_url(get_theme_mod('eryn_homepage_image')); ?>" alt"<?php echo esc_attr(get_theme_mod('eryn_homepage_image_alt', __('Sidebar Image', 'eryn'))); ?>"/>
                   
                    <?php
                        elseif( has_post_thumbnail() && ( is_single() || is_page() ) ) :
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-thumb' ); 
                            $thumb_id = get_post_thumbnail_id( $post->ID );
                            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                            if ($image) : 
                    ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr($alt); ?>" />
                    <?php 
                            endif;

                        elseif( get_theme_mod('eryn_homepage_image') ):
                    ?>
                            <img src="<?php echo esc_url( get_theme_mod('eryn_homepage_image') ); ?>" alt"<?php echo esc_attr(get_theme_mod('eryn_homepage_image_alt', __('Sidebar Image', 'eryn'))); ?>"/>
                    <?php   
                        else: 
                    ?>
                         <img src="<?php echo( get_template_directory_uri() . '/css/images/default-header-image.jpg' ); ?>" alt="<?php _e('Default Sidebar Image', 'eryn'); ?>" />
                    <?php 
                        endif; 
                    ?>

                </div>
            </div>
        </div><!-- .featured-image -->
        
    </header>
    
    <nav class="site-navigation">
        <ul class="list-unstyled">
            <li>
                <a class="nav-btn transition" href="#">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
            <li>
                <a class="nav-search-btn transition" href="#" data-type="inline">
                    <i class="fa fa-search"></i>
                </a>			
            </li>
            <?php
                if(!get_theme_mod('eryn_navbar_social_check')) :
                    get_template_part( 'inc/social-media' );
                endif;
            ?>
            <li>
                <a class="nav-to-top-btn transition" href="#top" style="display: none;">
                    <i class="fa fa-chevron-circle-up"></i>
                </a>
            </li>
        </ul>
    </nav>
    <div class="slide-panels">
        <aside class="site-secondary transition">
            <div class="breathing-space">
                <div class="title-wrap">
                    <?php if(is_front_page()) : ?>

                        <?php if(!get_theme_mod('hide_site_title')): ?>
                            <h1 class="site-title">
                                <a href="<?php echo home_url(); ?>">
                                    <span class="title"><?php bloginfo( 'name' ); ?></span>
                                </a>
                            </h1>
                        <?php endif; ?>

                        <?php if(!get_theme_mod('hide_tagline')): ?>
                            <h2 class="site-description">
                                <span class="tagline"><?php bloginfo( 'description' ); ?></span>
                            </h2>
                        <?php endif; ?>

                    <?php else : ?>
                    
                        <?php if(!get_theme_mod('hide_site_title')): ?>
                            <h2 class="site-title">
                                <a href="<?php echo home_url(); ?>">
                                    <span class="title"><?php bloginfo( 'name' ); ?></span>
                                </a>
                            </h2>
                        <?php endif; ?>
                    
                        <?php if(!get_theme_mod('hide_tagline')): ?>
                            <h3 class="site-description">
                                <span class="tagline"><?php bloginfo( 'description' ); ?></span>
                            </h3>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                </div><!-- .title-wrap -->

                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <?php wp_nav_menu( array( 
                        'theme_location' => 'primary', 
                         ) 
                      ); 
                    ?>
                </nav><!-- #site-navigation -->
                <div class="panel-widget">
                    <?php if ( is_active_sidebar( 'nav-bar-1' ) && dynamic_sidebar('nav-bar-1') ) : else : ?>
                    <?php endif; ?>
                </div>
                                
            </div><!-- .breathing-space -->
        </aside>
        <div class="search-panel transition">
            <div class="breathing-space">
                <div class="search-container">
                    <h3 class="site-search"><?php _e('Search', 'eryn'); ?></h3>
                    <h4 class="search-help"><?php _e('Type your search keyword, and press enter', 'eryn'); ?></h4>

                    <div class="search-box">
                        <div class="inner">
                            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                                <label>
                                    <span class="screen-reader-text"><?php _e('Search for then press enter', 'eryn'); ?></span>
                                    <input type="search" class="search-field" placeholder="<?php _e('Search...', 'eryn'); ?>" value="" name="s" title="Search for:">

                                </label>
                            </form>
                        </div><!-- .inner -->
                    </div><!-- .search-box -->
                </div><!-- .search-container -->
                
                <div class="panel-widget">
                    <?php if ( is_active_sidebar( 'search-bar-1' ) && dynamic_sidebar('search-bar-1') ) : else : ?>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .search-panel -->
    </div><!-- .slide-panels -->
    

    <div id="content" class="site-content">
		<?php if(get_theme_mod('eryn_logo_small_screen')): ?>
            <div class="site-logo-small-screen transition">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>">
                    <img src="<?php echo esc_url(get_theme_mod('eryn_logo_small_screen')); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
                </a>
            </div>
        <?php endif; ?>
        <div class="content-wrap  transition">
