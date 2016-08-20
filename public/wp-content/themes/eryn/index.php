<?php
/**
 * The main template file.
 *
 * @package eryn
 */

get_header(); ?>


    <?php 
        while ( have_posts() ) : the_post();
            if(is_front_page()):
                get_template_part( 'content', 'home' );
            else:
                get_template_part('content');
            endif;
        endwhile; 
    ?>     
    <?php eryn_paging_nav(); ?>

	
<?php get_footer(); ?>
