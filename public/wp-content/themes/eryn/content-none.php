<?php
/**
 * @package eryn
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h2><?php _e('Sorry no results' , 'eryn'); ?></h2>
<p><?php _e('Try changing your search criteria' , 'eryn'); ?></p>

    <div class="no-results">
    
        <?php get_search_form(); ?>
    
		<?php $args = array(
            'numberposts' => 5,
            'offset' => 0,
            'category' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'draft, publish, future, pending, private',
            'suppress_filters' => true );
        
            $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
        ?>
        
        <h3><?php _e('Recent posts' , 'eryn'); ?></h3>
        <ul>
        <?php
            $recent_posts = wp_get_recent_posts();
            foreach( $recent_posts as $recent ){
                echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
            }
        ?>
        </ul>
        
    </div>
    
</article>