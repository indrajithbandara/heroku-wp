<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package eryn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrap">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
    
        <div class="entry-content">
            <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('eryn_hide_post_featured')) : ?>
                        <div class="post-image featured-image">
                            <figure>
                                <div>
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-thumb' ); 
                                    if ($image) : ?>
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
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'eryn' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
    
        <footer class="entry-footer">
            <?php edit_post_link( __( 'Edit', 'eryn' ), '<span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-footer -->
    </div><!-- .post-wrap -->
</article><!-- #post-## -->
