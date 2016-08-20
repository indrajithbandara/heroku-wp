<?php
/**
 * @package eryn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry'); ?>>

    <header class="entry-header">
        
        <!-- // Post Title & Category -->
        <?php if(is_single()): ?>
            <h1 class="post-title ee">
                <?php the_title(); ?>
            </h1>
        <?php else: ?>
            <h2 class="post-title">
                <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
            </h2>
        <?php endif; ?>
		<span class="post-format"></span>
        <div class="meta-data">
            <!-- // Published Date -->
            <?php if(is_single()): ?>
                <span class="date"><?php the_time( get_option('date_format') ); ?></span>
            <?php else: ?>
                <a href="<?php the_permalink();?>"><span class="date"><?php the_time( get_option('date_format') ); ?></span></a>
            <?php endif; ?>
            <!-- // author -->
            <span class="author"><?php the_author_posts_link(); ?></span>
            <!-- // Categories -->
             <span class="cat-links"><?php eryn_category(' - '); ?></span>
            <!-- // Comment Count -->
            <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                <span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'eryn' ), __( '1 Comment', 'eryn' ), __( '% Comments', 'eryn' ) ); ?></span>
            <?php endif; ?>
        </div><!-- / .meta-data -->

    </header><!--/ .entry-header -->

    <div class="entry-content <?php if(is_single()):echo 'single-post';endif;?>">		
         <!-- Featured Media Section-->
            <?php if(has_post_format('gallery')) : ?>

                <?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>

                <?php if($images) : ?>
                    <div class="flexslider carousel post-image">
                        <ul class="slides">
                            <?php foreach($images as $image) : ?>
                                <?php $the_image = wp_get_attachment_image_src( $image, 'full-thumb' ); ?> 											 <?php $the_caption = get_post_field('post_excerpt', $image); ?>
                                <li><img src="<?php echo $the_image[0]; ?>" alt="<?php if($the_caption) : ?><?php echo $the_caption; ?><?php else: ?>Slide Image<?php endif; ?>"/></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            <?php elseif(has_post_format('audio')) : ?>

                <div class="post-image audio">
                    <?php $audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
                    <?php if(wp_oembed_get( $audio )) : ?>
                        <?php echo wp_oembed_get($audio); ?>
                    <?php else : ?>
                        <?php echo $audio; ?>
                    <?php endif; ?>
                </div>

            <?php elseif(get_post_meta( $post->ID, '_format_video_embed', true )) : ?>

                <div class="post-image video">
                    <?php $video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
                    <?php if(wp_oembed_get( $video )) : ?>
                        <?php echo wp_oembed_get($video); ?>
                    <?php else : ?>
                        <?php echo $video; ?>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('eryn_hide_post_featured')) : ?>
                        <div class="post-image featured-image">
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
            <?php endif; ?>

        <?php
            the_content( sprintf(
                __( '<div class="read-more"> Continue reading %s </div>', 'eryn' ), 
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
        ?>
        
		<?php wp_link_pages(); ?>
        
        <?php edit_post_link( __( 'Edit', 'eryn' ), '<span class="edit-link">', '</span>' ); ?>
                    
        
        <?php if(is_single()) : ?>
            <div class="post-tags">
                <?php the_tags('<span class="fa fa-tag"></span> ', ' <span class="tag-divider">&bull;</span> '); ?> 
            </div>
        <?php endif; ?>

    </div><!-- .entry-content -->


    <?php if(is_single()):

         eryn_post_nav(); ?>

         <footer class="entry-footer">

            <?php if(!get_theme_mod('eryn_hide_post_related')) : ?>
                <?php if(is_single()) : ?>
                    <?php get_template_part('inc/templates/related_posts'); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(!get_theme_mod('eryn_hide_post_author')) : ?>
                <?php if(is_single()) : ?>
                    <?php get_template_part('inc/templates/about_author'); ?>
                <?php endif; ?>
            <?php endif; ?>

        </footer><!-- .entry-footer -->

    <?php endif;?>

</article><!-- #post-## -->		


