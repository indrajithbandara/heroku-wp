<div class="author-info clr">
    <?php if(! is_author()): ?>
	   <h4 class="heading"><?php _e('About the Author ', 'eryn'); ?></h4>
    <?php else: ?>
        <h2 class=""><?php _e('About the Author ', 'eryn'); ?></h2>
    <?php endif; ?>
	<div class="author-info-inner clr">
        <div class="author-avatar clr">
            <?php echo get_avatar( get_the_author_meta('email'), '75' ); ?>
        </div><!-- .author-avatar -->
        <div class="author-description">
            <?php if(! is_author()): ?>
                <h5><?php the_author_posts_link(); ?></h5>
            <?php else: ?>
                <h5><?php the_author(); ?></h5>
            <?php endif; ?>
			<p><?php the_author_meta('description'); ?></p>
            <?php if(! is_author()): ?>
                <p><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php _e('View all author posts', 'eryn'); ?>"><?php _e('View all author posts &rarr;', 'eryn'); ?></a></p>
            <?php endif; ?>
            <div class="author-sn">
                <?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="hastip-author author-social" title="Facebook" href="http://facebook.com/<?php echo the_author_meta('facebook'); ?>"><i class="fa fa-facebook"></i></a><?php endif; ?>
                <?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="hastip-author author-social" title="Twitter" href="http://twitter.com/<?php echo the_author_meta('twitter'); ?>"><i class="fa fa-twitter"></i></a><?php endif; ?>
                <?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="hastip-author author-social" title="Instagram" href="http://instagram.com/<?php echo the_author_meta('instagram'); ?>"><i class="fa fa-instagram"></i></a><?php endif; ?>
                <?php if(get_the_author_meta('google')) : ?><a target="_blank" class="hastip-author author-social" title="Google+" href="http://plus.google.com/<?php echo the_author_meta('google'); ?>?rel=author"><i class="fa fa-google-plus"></i></a><?php endif; ?>
                <?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="hastip-author author-social" title="Pinterest" href="http://pinterest.com/<?php echo the_author_meta('pinterest'); ?>"><i class="fa fa-pinterest"></i></a><?php endif; ?>
                <?php if(get_the_author_meta('tumblr')) : ?><a target="_blank" class="hastip-author author-social" title="Tumblr" href="http://<?php echo the_author_meta('tumblr'); ?>.tumblr.com/"><i class="fa fa-tumblr"></i></a><?php endif; ?>
            </div>
		</div><!-- .author-description -->
	</div><!-- .author-info-inner -->
</div><!-- .author-info -->