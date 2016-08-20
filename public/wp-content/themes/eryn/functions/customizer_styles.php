<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function eryn_customizer_css() {

	?>
			
	<style>
		
		.site-header{
			background-repeat:<?php echo get_theme_mod('eryn_background_header_repeat'); ?>;
		}
		
		.site-logo {
			left:<?php echo get_theme_mod( 'eryn_header_left' ); ?>px;
			top:<?php echo get_theme_mod( 'eryn_header_top' ); ?>px;
		}
		
		<?php if(get_theme_mod('upload_site_background_image')):?>
			.site-content{
				background:url(<?php echo get_theme_mod('upload_site_background_image') ;?>) top left;
				background-repeat: <?php echo(get_theme_mod('upload_site_background_image_repeat')); ?>;
				<?php if(get_theme_mod('upload_site_background_image_repeat') === 'no-repeat'):?>
					background-size: 100% 100%;
				<?php endif; ?>
			}
		<?php endif; ?>
		
		<?php if(get_theme_mod('eryn_title_uppercase')):?>
			.title{ text-transform:uppercase; }
		<?php endif; ?>
		
		<?php if(get_theme_mod('eryn_tagline_uppercase')):?>
			.tagline{ text-transform:uppercase; }
		<?php endif; ?>
		
		/* Header Colors */
		.featured-image .site-title a .title{color:<?php echo get_theme_mod('header_title_color'); ?>;}
		.featured-image .site-title a:hover .title, .featured-image .site-title a:focus .title, .featured-image .site-title a:hover .tagline, .featured-image .site-title a:focus .tagline {color:<?php echo get_theme_mod('header_title_hover_color'); ?>;}
		.featured-image .tagline{color:<?php echo get_theme_mod('header_tagline_color'); ?>;}
		
		/* Panels Colors */
		.site-navigation,
		.site-secondary, 
		.search-panel{ 
			background-color: <?php echo get_theme_mod('panels_bg_color'); ?>; 
		}
		.site-description, 
		.search-help,
		.panel-widget h4{
			color:<?php echo get_theme_mod('panels_text_color'); ?>;
		}
		.site-navigation a, 
		.site-navigation a:visited, 
		.slide-panels a, 
		.slide-panels a:visited{
			color:<?php echo get_theme_mod('panels_link_color'); ?>;
		}
		.site-navigation a:hover, 
		.site-navigation a:focus{
			background-color: <?php echo get_theme_mod('panels_hover_color'); ?>;
		}
		.slide-panels a:hover, 
		.slide-panels a:focus, 
		.slide-panels a:active{
			color: <?php echo get_theme_mod('panels_hover_color'); ?>;
		}
		/* Content Area Colors */
        body, button, input, select, textarea {
            color: <?php echo(get_theme_mod('main_txt_color')); ?>
        }
        .meta-data a, 
        .meta-data a:visited, 
        .entry-content a, 
        .entry-content a:visited,
        .entry-footer a, 
        .entry-footer a:visited, 
        .comments-area a, 
        .comments-area a:visited {
            color: <?php echo(get_theme_mod('main_link_color')); ?> 
        }
        .meta-data a:hover, 
        .meta-data a:focus, 
        .entry-content a:hover, 
        .entry-content a:focus,
        .entry-footer a:hover, 
        .entry-footer a:focus, 
        .comments-area a:hover, 
        .comments-area a:focus,
        .comment-form input[type="submit"]:hover,
        article .post-title a:hover,
        article .post-title a:focus{
            color:<?php echo(get_theme_mod('main_link_hover')); ?> 
        }
		/* Footer Colors */
		.footer-widgets .content-wrap,
        .site-copyright .content-wrap {
			background-color:<?php echo get_theme_mod('foot_bg'); ?>;
            color:<?php echo get_theme_mod('foot_txt'); ?>;
		}
        .footer-widgets .content-wrap td, 
        .footer-widgets .content-wrap th,
        .footer-widgets h4,
        .footer-widgets li:before{
            color:<?php echo get_theme_mod('foot_txt'); ?>;
        }
		.footer-widgets .content-wrap a,
		.footer-widgets .content-wrap a:visited,
        .site-copyright .content-wrap a,
        .site-copyright .content-wrap a:visited
		{
			color:<?php echo get_theme_mod('foot_txt_highlight'); ?>;
		}
		.footer-widgets .content-wrap a:hover,
        .site-copyright .content-wrap a:hover{
			color:<?php echo get_theme_mod('foot_txt_highlight_hover'); ?>;
		}
        
        /* Font Settings */    
        <?php if(get_theme_mod('font_body_display')): ?>
			body {font-family: <?php echo(get_theme_mod('font_body'));?>;}
		<?php endif; ?>
		<?php if(get_theme_mod('font_site_title_display')): ?>
			.site-title-block .site-title {font-family: <?php echo(get_theme_mod('font_site_title'));?>;}
		<?php endif; ?>
        <?php if(get_theme_mod('font_site_title_size')): ?>
            .site-title-block .site-title {font-size: <?php echo(get_theme_mod('font_site_title_size'));?>px;}
        <?php endif; ?>
		<?php if(get_theme_mod('font_headers_display')): ?>
			h1,h2,h3,h4,h5,h6, .footer-widgets h4 {font-family: <?php echo(get_theme_mod('font_headers'));?>;}
		<?php endif; ?>

        
	</style>
	<?php
}
add_action( 'wp_head', 'eryn_customizer_css' ); 