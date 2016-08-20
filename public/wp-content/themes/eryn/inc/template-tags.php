<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package eryn
 */

if ( ! function_exists( 'eryn_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function eryn_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'eryn' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'eryn' ) ); ?></div>
			<?php endif; ?>
			
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'eryn' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'eryn_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function eryn_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'eryn' ); ?></h1>
		<div class="nav-links">
        <?php 
			$next_post = get_next_post();
			$prev_post = get_previous_post();
        
       	 	if (!empty( $prev_post )): ?>
            	<div class="nav-previous">
                	<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                        <span class="meta-nav">&larr;</span>
                        <?php _e('Previous Post', 'eryn'); ?>
                    </a>
                </div>
			<?php endif; ?>
			
			<?php if (!empty( $next_post )): ?>
            	<div class="nav-next">
					<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php _e('Next Post', 'eryn'); ?>
                    	<span class="meta-nav">&rarr;</span>
                    </a>
                </div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'eryn_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function eryn_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'eryn' ),
		'<a href="' . esc_url( the_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'eryn' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'eryn_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function eryn_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'eryn' ) );
		if ( $categories_list && eryn_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'eryn' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'eryn' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'eryn' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'eryn' ), __( '1 Comment', 'eryn' ), __( '% Comments', 'eryn' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'eryn' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function eryn_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'eryn_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'eryn_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so eryn_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so eryn_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in eryn_categorized_blog.
 */
function eryn_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'eryn_categories' );
}
add_action( 'edit_category', 'eryn_category_transient_flusher' );
add_action( 'save_post',     'eryn_category_transient_flusher' );
