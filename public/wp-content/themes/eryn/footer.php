<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package eryn
 */
?>
            </div><!-- .content-wrap -->
        </div><!-- .site-content -->

        <?php if (!get_theme_mod('eryn_hide_footer_widget_area')): ?>
            <div class="footer-widgets">
                <div class="content-wrap">
                    <div class="foot-widget">
                        <?php if ( is_active_sidebar( 'footer-1' ) && dynamic_sidebar('footer-1') ) : else : ?>
                        <?php endif; ?>
                    </div>
                    <div class="foot-widget">
                        <?php if ( is_active_sidebar( 'footer-2' ) && dynamic_sidebar('footer-2') ) : else : ?>
                        <?php endif; ?>
                    </div>
                    
            	</div><!-- .content-wrap -->
            </div><!-- .footer-widgets -->
        <?php endif; ?>

        <?php if (!get_theme_mod('eryn_hide_copyright_bar')): ?>
            <div class="site-copyright" role="contentinfo">
                <div class="content-wrap">
                    <?php 
                        $allowedTags = array(
                            'a' => array(
                                'href' => array(),
                                'title' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array(),
                        );
                        $copyright = wp_kses(get_theme_mod('footer_copyright_strapline'), $allowedTags); ?>
                    <?php if($copyright && strlen($copyright) > 0) : ?>
                        <p><?php echo $copyright;  ?></p>
                    <?php else: ?>
                    <?php
                        $link    = 'http://templateexpress.com';
                        $company = 'Template Express';
                        $year    = date('Y'); 
                        $copyrightString = sprintf(
                            __( '<p><a href="%1$s">Eryn - Theme developed by %2$s &copy %3$d</a></p>', 'eryn' ),
                            $link,
                            $company,
                            $year
                        );
                        echo $copyrightString;
                    ?>
                    <?php endif; ?>
                </div><!-- .content-wrap -->
            </div><!-- .site-copyright -->
        <?php endif; ?>


        <?php wp_footer(); ?>

	</body>
</html>
