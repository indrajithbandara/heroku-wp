<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry'); ?>> 
    <div class="featured-image-bg" >
        <?php if(has_post_thumbnail()) :  
                $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
                $title = get_post(get_post_thumbnail_id())->post_excerpt; ?>
        	<img src="<?php echo $url; ?>" alt="<?php echo($title); ?>" />
        <?php endif; ?>
    </div>
    <div class="post-wrap">
    
        <div class="entry-meta">
            <span class="post-format"></span>
        </div>
    	
        <blockquote>
            <?php the_content(); ?>
            <?php $name = get_post_meta( $post->ID, '_format_quote_source_name', true ); ?>
            <p><cite> - <?php echo($name); ?> - </cite></p>
        </blockquote>
        
    </div><!-- .post-wrap -->
</article>