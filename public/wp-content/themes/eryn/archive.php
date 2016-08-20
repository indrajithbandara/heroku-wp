<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eryn
 */

get_header(); ?>
    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php if(! is_author()): ?>
            <h1 class="page-title">
                <?php
                    if ( is_category() ) :
                        single_cat_title();

                    elseif ( is_tag() ) :
                        single_tag_title();

                    elseif ( is_day() ) :
                        printf( __( 'Day: %s', 'eryn' ), '<span>' . get_the_date() . '</span>' );

                    elseif ( is_month() ) :
                        printf( __( 'Month: %s', 'eryn' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'eryn' ) ) . '</span>' );

                    elseif ( is_year() ) :
                        printf( __( 'Year: %s', 'eryn' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'eryn' ) ) . '</span>' );

                    elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                        _e( 'Asides', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
                        _e( 'Galleries', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                        _e( 'Images', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                        _e( 'Videos', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                        _e( 'Quotes', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                        _e( 'Links', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
                        _e( 'Statuses', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
                        _e( 'Audios', 'eryn' );

                    elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
                        _e( 'Chats', 'eryn' );

                    else :
                        _e( 'Archives', 'eryn' );

                    endif;
                ?>
            </h1>
            <?php endif; ?>
        </header><!-- .page-header -->

        <?php if(is_author()): ?>
            <?php get_template_part('inc/templates/about_author'); ?>
        <?php endif; ?>

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <?php
                /* Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'content', get_post_format() );
            ?>

        <?php endwhile; ?>

        <?php eryn_paging_nav(); ?>

    <?php else : ?>

        <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; ?>

	<?php 
		if(	
			(is_author() && get_theme_mod('eryn_global_sidebar_author')) ||
			(is_archive() && !is_author() && get_theme_mod('eryn_global_sidebar_archive'))
		) :
			get_sidebar(); 
		endif;

	?>
<?php get_footer(); ?>
