<?php
/**
 * @package eryn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php  post_class( 'masonry-entry'); ?>>
    <div class="inner-post">
        <header class="entry-header">
            <h2 class="post-title">
                <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
            </h2>
            <span class="post-format"></span>
            <div class="meta-data">
                <!-- // Published Date -->
                <?php if(!get_theme_mod('eryn_homepage_hide_date')) : ?>
                    <a href="<?php the_permalink();?>">
                        <span class="date"><?php the_time( get_option('date_format') ); ?></span>
                    </a>
                <?php endif; ?>
                <!-- // author -->
                <?php if(!get_theme_mod('eryn_homepage_hide_author')) : ?>
                    <span class="author"><?php the_author_posts_link(); ?></span>
                <?php endif; ?>
                <!-- // Categories -->
                <?php if(!get_theme_mod('eryn_homepage_hide_categories')) : ?>
                    <span class="cat-links">
                        <span><?php eryn_category(' - '); ?></span>											
                    </span>
                <?php endif;?>
                <!-- // Comment Count -->
                <?php if(!get_theme_mod('eryn_homepage_hide_comment_count')) : ?>
                    <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                        <span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'eryn' ), __( '1 Comment', 'eryn' ), __( '% Comments', 'eryn' ) ); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(!get_theme_mod('eryn_homepage_hide_featured')): ?>
                    <?php if(is_sticky($post->ID)):?>
                        <span class="sticky-icon"><span class="sticky-text"><?php _e('Featured', 'eryn'); ?> </span><i class="fa fa-thumb-tack"></i></span>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- / .meta-data -->
        </header>

        <div class="entry-content <?php if(is_single()):echo 'single-post';endif;?>">		


            <?php if(has_post_thumbnail()) : ?>
                <?php if(!get_theme_mod('eryn_hide_post_featured')) : ?>
                    <div class="post-image">
                        <figure>
                            <div>
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-thumb' ); 
                                if ($image) : ?>
                                    <a href="<?php the_permalink() ?>" class="overlay"><span><?php _e('Read More', 'eryn'); ?></span></a>
                                    <img src="<?php echo $image[0]; ?>" alt="" />

                                <?php endif; ?> 
                            </div>
                            <?php if(get_post(get_post_thumbnail_id())->post_excerpt): ?>
                                <figcaption>
                                    <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
                                </figcaption>
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php
                /* translators: %s: Name of current post */
                the_content( sprintf(
                    __( '<div class="read-more"> Continue reading... %s</div>', 'eryn' ), 
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
            ?>

        </div><!-- .entry-content -->
    </div><!-- .post-wrap -->
</article><!-- #post-## -->		


