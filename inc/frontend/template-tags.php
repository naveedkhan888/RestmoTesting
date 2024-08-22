<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Restimo
 */

if ( ! function_exists( 'restimo_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function restimo_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'restimo' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'restimo_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function restimo_posted_in() {
        $categories_list = get_the_category_list( esc_html__( ' ', 'restimo' ) );
        $posted_in = '';
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'restimo' ), $categories_list ); // WPCS: XSS OK.
        }

        echo '<div class="post-cat"><div class="posted-in">' . $posted_in . '</div></div>'; // WPCS: XSS OK.

    };
endif;

if ( ! function_exists( 'restimo_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function restimo_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'restimo' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'restimo_post_meta' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function restimo_post_meta() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'restimo' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( '%s', 'post author', 'restimo' ),
            '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
        );

        $categories_list = get_the_category_list( esc_html__( ', ', 'restimo' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'restimo' ), $categories_list ); // WPCS: XSS OK.
        }

        $comment_num = sprintf(
            /* translators: %s: post author. */
            esc_html_x( '%s', 'post comment', 'restimo' ),
            '<a href="' .get_comments_link(). '">'. get_comments_number_text( esc_html__('0 Comments', 'restimo'), esc_html__('1 Comment', 'restimo'), esc_html__(  '% Comments', 'restimo') ). '</a>' );

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'restimo' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            $tag_with = sprintf( '<span class="tags-links">' . esc_html__( '%1$s', 'restimo' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
        $metas = restimo_get_option( 'post_entry_meta' );
        if ( ! empty( $metas ) ) :
            if( in_array('date', $metas) ) echo '<span class="posted-on">' . $posted_on . '</span>';
            if( in_array('author', $metas) ) echo '<span class="byline"> / ' . $byline . '</span>';
            if( in_array('comm', $metas) ) echo '<span class="comment-num"> / ' . $comment_num . '</span>';
        endif;

    }
endif;

if ( ! function_exists( 'restimo_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function restimo_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'restimo' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tagcloud">' . esc_html__( '%1$s', 'restimo' ) . '</div>', $tags_list ); // WPCS: XSS OK.
            }
            if( restimo_get_option('post_socials') ) restimo_socials_share();
		}

	}
endif;

/** Posts Navigation **/
if ( ! function_exists( 'restimo_posts_navigation' ) ) :
    function restimo_posts_navigation($prev = '<i class="xp-flaticon-arrow-pointing-to-left"></i>', $next = '<i class="xp-flaticon-arrowsoutline"></i>', $pages='') {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        $pagination = array(
            'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'        => '',
            'current'       => max( 1, get_query_var('paged') ),
            'total'         => $pages,
            'prev_text'     => $prev,
            'next_text'     => $next,
            'type'          => 'list',
            'end_size'      => 3,
            'mid_size'      => 3
        );
        $return =  paginate_links( $pagination );
        echo str_replace( "<ul class='page-numbers'>", '<ul class="page-pagination none-style">', $return );
    }
endif;

/** Excerpt blog post **/
if ( ! function_exists( 'restimo_excerpt' ) ) :
function restimo_excerpt($limit) {

    $excerpt = explode(' ', get_the_excerpt(), $limit);
    
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt);
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);

    return $excerpt;
};
endif;

//Custom comment list
if ( ! function_exists( 'restimo_comment_list' ) ) :
    function restimo_comment_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
            <article class="comment-wrap clearfix">

                <div class="gravatar">
                    <?php echo get_avatar( $comment, 80 ); ?>
                </div>

                <div class="comment-content">
                    <div class="comment-meta">
                        <h6 class="comment-author"><?php printf(__('%s','restimo'), get_comment_author()) ?></h6>
                        <span class="comment-time"><?php comment_time( get_option( 'date_format' ) ); ?></span>
                        <div class="comment-reply"><?php echo preg_replace( '/comment-reply-link/', 'comment-reply-link', get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))); ?></div>
                    </div>
                    <div class="comment-text">
                        <?php if ($comment->comment_approved == '0'){ ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.','restimo') ?></em>
                        <?php }else{ ?>
                            <?php comment_text() ?>
                        <?php } ?>
                    </div>
                </div>

            </article>
        </li>

        <?php
    }
endif;

//Generate custom search form
function restimo_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <label><span class="screen-reader-text">Search for:</span>
    <input type="search" class="search-field" placeholder="' . esc_attr__( 'Search&hellip;', 'restimo' ) . '" value="' . get_search_query() . '" name="s" /></label>
	<button type="submit" class="search-submit"><i class="xp-flaticon-search-1"></i></button>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'restimo_search_form' );

//Add span to category post count
function restimo_cat_count_span($links) {
    $links = str_replace('</a> (', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('wp_list_categories', 'restimo_cat_count_span');

//Add span to archive post count
function restimo_archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'restimo_archive_count_span');

/** Socials Share Post**/
if ( ! function_exists( 'restimo_socials_share' ) ) :

    function restimo_socials_share(){
        $share = restimo_get_option( 'post_socials' );
        echo '<div class="share-post">';

        if( in_array('twit', $share) ) echo '<a class="twit" target="_blank" href="https://twitter.com/intent/tweet?text=' .get_the_title(). '&url=' .get_the_permalink(). '" title="Twitter"><i class="fab fa-twitter"></i></a>';
        if( in_array('face', $share) ) echo '<a class="face" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' .get_the_permalink(). '" title="Facebook"><i class="fab fa-facebook-f"></i></a>';
        if( in_array('pint', $share) ) echo '<a class="pint" target="_blank" href="https://www.pinterest.com/pin/create/button/?url=' .get_the_permalink(). '&description=' .get_the_title(). '" title="Pinterest"><i class="fab fa-pinterest-p"></i></a>';
        if( in_array('link', $share) ) echo '<a class="linked" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' .get_the_permalink(). '&title=' .get_the_title(). '&summary=' .esc_url( get_home_url('/') ). '&source=' .get_bloginfo( 'name' ). '" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>';
        if( in_array('google', $share) ) echo ' <a class="google" target="_blank" href="https://plus.google.com/share?url=' .get_the_permalink(). '" title="Google Plus"><i class="fab fa-google-plus-g"></i></a>';
        if( in_array('tumblr', $share) ) echo ' <a class="tumblr" target="_blank" href="http://www.tumblr.com/share/link?url=' .get_the_permalink(). '&name=' .get_the_title(). '&description=' .get_the_excerpt(). '" title="Tumblr"><i class="fab fa-tumblr"></i></a>';
        if( in_array('reddit', $share) ) echo '<a class="reddit" href="http://reddit.com/submit?url=' .get_the_permalink(). '&title=' .get_the_title(). '" target="_blank" title="Reddit"><i class="fab fa-reddit-alien" aria-hidden="true"></i></a>';
        if( in_array('vk', $share) ) echo '<a class="vk" href="http://vk.com/share.php?url=' .get_the_permalink(). '" target="_blank" title="VK"><i class="fab fa-vk"></i></a>';

        echo '</div>';
    };
endif;

/** Single Post Navigation**/
if ( ! function_exists( 'restimo_single_post_nav' ) ) :

    function restimo_single_post_nav(){
        echo '<div class="post-nav clearfix">';
        $class = '';
        $pcate = '';
        $ncate = '';
        if ( get_previous_post() ) {
            $ppost  = get_previous_post();
            $ptitle = get_the_title( $ppost->ID );
            $pdate  = get_the_time( get_option( 'date_format' ), $ppost->ID );
            $pimage = get_the_post_thumbnail( $ppost->ID , 'thumbnail');
            if( is_singular('xp_portfolio') ){
                $terms  = get_the_terms($ppost->ID,'portfolio_cat');
                $count  = count($terms);
                if ( $count > 0 ){  //If there are more than 0 terms
                    foreach ( $terms as $term ) { 
                        $pcate   .= $term->name. '<span> / </span>';
                    }
                }
                $pdate = $pcate; 
            }
            if( !$pimage ) $class = ' not-thumb';
            echo '<div class="post-prev'.$class.'">';
            previous_post_link( '%link', '<div class="thumb-post">'.$pimage.'</div><div class="info-post"><h6>'.$ptitle.'</h6><span>'.$pdate.'</span></div>' );
            echo '</div>';
        }
        if ( get_next_post() ) {
            $npost  = get_next_post();
            $ntitle = get_the_title( $npost->ID );
            $ndate  = get_the_time( get_option( 'date_format' ), $npost->ID );
            $nimage = get_the_post_thumbnail( $npost->ID , 'thumbnail');
            if( is_singular('xp_portfolio') ){
                $terms  = get_the_terms($npost->ID,'portfolio_cat');
                $count  = count($terms);
                if ( $count > 0 ){  //If there are more than 0 terms
                    foreach ( $terms as $term ) { 
                        $ncate   .= $term->name. ' ';
                    }
                }
                $ndate = $ncate; 
            }
            if( !$nimage ) $class = ' not-thumb';
            echo '<div class="post-next'.$class.'">';
            next_post_link( '%link', '<div class="thumb-post">'.$nimage.'</div><div class="info-post"><h6>'.$ntitle.'</h6><span>'.$ndate.'</span></div>' );
            echo '</div>';
        }
        echo '</div>';
    };
endif;

/** Add Contact Methods in the User Profile **/
function restimo_user_contact_methods( $user_contact ) {
    $user_contact['facebook']   = esc_html__( 'Facebook URL', 'restimo' );
    $user_contact['skype']      = esc_html__( 'Skype Username', 'restimo' );
    $user_contact['twitter']    = esc_html__( 'Twitter Handle', 'restimo' );
    $user_contact['youtube']    = esc_html__( 'Youtube Channel', 'restimo' );
    $user_contact['linkedin']   = esc_html__( 'LinkedIn', 'restimo' );
    $user_contact['googleplus'] = esc_html__( 'Google +', 'restimo' );
    $user_contact['pinterest']  = esc_html__( 'Pinterest', 'restimo' );
    $user_contact['instagram']  = esc_html__( 'Instagram', 'restimo' );
    $user_contact['github']     = esc_html__( 'Github Profile', 'restimo' ); 
    return $user_contact; 
};
add_filter( 'user_contactmethods', 'restimo_user_contact_methods' );

function restimo_author_info_box() {

    global $post;

    $author_details = '';
    // Get author's display name - NB! changed display_name to first_name. Error in code.
    $display_name = get_the_author_meta( 'display_name', $post->post_author );

    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );

    // Get author's biographical information or description
    $user_description   = get_the_author_meta( 'user_description', $post->post_author );
    $user_twitter       = get_the_author_meta('twitter', $post->post_author);
    $user_facebook      = get_the_author_meta('facebook', $post->post_author);
    $user_skype         = get_the_author_meta('skype', $post->post_author);
    $user_linkedin      = get_the_author_meta('linkedin', $post->post_author);
    $user_youtube       = get_the_author_meta('youtube', $post->post_author);
    $user_googleplus    = get_the_author_meta('googleplus', $post->post_author);
    $user_pinterest     = get_the_author_meta('pinterest', $post->post_author);
    $user_instagram     = get_the_author_meta('instagram', $post->post_author);
    $user_github        = get_the_author_meta('github', $post->post_author);

    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
    if ( ! empty( $display_name ) )
    // Author avatar - - the number 90 is the px size of the image.
    $author_details .= '<div class="author-image">' . get_avatar( get_the_author_meta('ID') , 160 ) . '</div>';
    $author_details .= '<div class="author-info">';
    $author_details .= '<p class="title text-primary font-second">' . esc_html__('Author', 'restimo'). '</p>';
    $author_details .= '<h6>' . $display_name . '</h6>';
    $author_details .= '<p class="des">' . get_the_author_meta( 'description' ). '</p>';
    $author_details .= '<div class="author-socials">';

    // Check if author has Twitter in their profile
    if ( ! empty( $user_twitter ) ) {
        $author_details .= ' <a href="' . $user_twitter .'" target="_blank" rel="nofollow" title="Twitter" class="tooltip"><i class="fab fa-twitter"></i> </a>';
    }

    if ( ! empty( $user_facebook ) ) {
        $author_details .= ' <a href="' . $user_facebook .'" target="_blank" rel="nofollow" title="Facebook" class="tooltip"><i class="fab fa-facebook-f"></i> </a>';
    }

    if ( ! empty( $user_skype ) ) {
        $author_details .= ' <a href="' . $user_skype .'" target="_blank" rel="nofollow" title="Username paaljoachim Skype" class="tooltip"><i class="fab fa-skype"></i> </a>';
    }

    if ( ! empty( $user_linkedin ) ) {
        $author_details .= ' <a href="' . $user_linkedin .'" target="_blank" rel="nofollow" title="LinkedIn" class="tooltip"><i class="fab fa-linkedin-in"></i> </a>';
    }

    if ( ! empty( $user_youtube ) ) {
        $author_details .= ' <a href="' . $user_youtube .'" target="_blank" rel="nofollow" title="Youtube" class="tooltip"><i class="fab fa-youtube"></i> </a>';
    }

    if ( ! empty( $user_googleplus ) ) {
        $author_details .= ' <a href="' . $user_googleplus .'" target="_blank" rel="nofollow" title="Google+" class="tooltip"><i class="fab fa-google-plus"></i> </a>';
    }

    if ( ! empty( $user_pinterest ) ) {
        $author_details .= ' <a href="' . $user_pinterest .'" target="_blank" rel="nofollow" title="Pinterest" class="tooltip"><i class="fab fa-pinterest"></i> </a>';
    }

    if ( ! empty( $user_instagram ) ) {
        $author_details .= ' <a href="' . $user_instagram .'" target="_blank" rel="nofollow" title="Instagram" class="tooltip"><i class="fab fa-instagram"></i> </a>';
    }

    if ( ! empty( $user_github ) ) {
        $author_details .= ' <a href="' . $user_github .'" target="_blank" rel="nofollow" title="Github" class="tooltip"><i class="fab fa-github"></i> </a>';
    }

    $author_details .= '</div></div>';

    // Pass all this info to post content 
    echo '<div class="author-bio" >' . $author_details . '</div>';
}
/** Allow HTML in author bio section **/
//remove_filter('pre_user_description', 'wp_filter_kses');

/** Related Posts **/
function restimo_related_posts() {

    global $post;

    $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 2, 'post__not_in' => array($post->ID) ) );
    if( $related ) : 

    echo '<div class="related-posts">';
    echo '<h4>'.esc_html__( 'Related Posts', 'restimo' ).'</h4>';
    echo '<div class="row">';
    foreach( $related as $post ) {
    setup_postdata($post); ?>
    
    <div class="col-sm-6">
        <div class="post-box post-item">
            <div class="post-inner">
                <?php if(has_post_thumbnail()) { ?>
                <div class="entry-media post-cat-abs">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'restimo-post-thumbnail-grid' ); ?></a>
                    <?php restimo_posted_in(); ?>
                </div>
                <?php } ?>
                <div class="inner-post">
                    <?php if( !has_post_thumbnail() ) restimo_posted_in(); ?>
                    <div class="entry-header">
                        <?php the_title( '<h5 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
                    </div>
                </div>
                <div class="entry-meta">
                    <?php if( restimo_get_option( 'post_entry_meta' ) ) { restimo_post_meta(); } ?>
                    <a href="<?php the_permalink(); ?>" class="btn-details"><i class="xp-flaticon-trajectory"></i></a>
                </div>
            </div>
        </div>
    </div>

    <?php } wp_reset_postdata();

    echo '</div>';
    echo '</div>';

    endif;
};

/** Custom widget recent post **/
require get_template_directory() . '/inc/frontend/widgets/recent-posts.php';
require get_template_directory() . '/inc/frontend/widgets/author-widget.php';