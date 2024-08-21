<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restimo
 */

?>

<?php                                                     
	$format = get_post_format();
	$link_video  = get_post_meta(get_the_ID(),'post_video', true);
	$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
	$link_link   = get_post_meta(get_the_ID(),'post_link', true);
	$text_link   = get_post_meta(get_the_ID(),'text_link', true);
	$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
	$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
?> 

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post post-box'); ?>>
    <?php if( $format == 'gallery' ) { ?>

        <div class="entry-media">
            <?php restimo_posted_in(); ?>
            <div class="gallery-post owl-carousel owl-theme">
            <?php if( function_exists( 'rwmb_meta' ) ) { ?>
                <?php $images = rwmb_meta( 'post_gallery', array( 'size' =>'full' ) ); ?>
                <?php if($images){ ?>              
                    <?php foreach ( $images as $image ) {  ?>		
                        <div class="item-image">
                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                        </div>                
                    <?php } ?>                
                <?php } ?>
            <?php } ?>
            </div>
        </div>			

    <?php }elseif( $format == 'image' ) { ?>

        <div class="entry-media">
        <?php restimo_posted_in(); ?>
        <?php if( function_exists( 'rwmb_meta' ) ) { ?>
            <?php $images = rwmb_meta( 'post_image', array( 'size' =>'full' ) ); ?>
            <?php if($images){ ?>              
                <?php foreach ( $images as $image ) {  ?>				            
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                    </a>
                <?php } ?>                
            <?php } ?>
        <?php } ?>
        </div>

    <?php }elseif( $format == 'audio' ){ ?>

        <div class="audio-box padding-box">
        <iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
        </div>

    <?php }elseif( $format == 'video' ){ ?>

        <div class="entry-media">
            <?php restimo_posted_in(); ?>
            <?php if( function_exists( 'rwmb_meta' ) ) { ?>
                <?php $images = rwmb_meta( 'bg_video', array( 'size' =>'full' ) ); ?>
                <?php if($images){ ?>     
                    <div class="video-popup">        
                        <a class="btn-play" href="<?php echo esc_url( $link_video ); ?>">
                            <i class="xp-flaticon-play"></i>
                        </a> 
                    </div>
                    <?php  foreach ( $images as $image ) {  ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
                    <?php } ?>                
                <?php } ?>
            <?php } ?>
        </div>

    <?php }elseif( $format == 'link' ){ ?>

        <div class="link-box padding-box">
            <i class="xp-flaticon-multimedia"></i>
            <a href="<?php echo esc_url( $link_link ); ?>"><?php echo esc_html( $text_link ); ?></a>
        </div>

        <?php }elseif( $format == 'quote' ){ ?>

        <div class="quote-box padding-box font-second">
            <i class="xp-flaticon-left-quote"></i>
            <div class="quote-text">
                <?php echo esc_html( $quote_text ); ?>
                <span><?php echo esc_html( $quote_name ); ?></span>
            </div>
        </div>

    <?php }elseif ( has_post_thumbnail() ) { ?>

        <div class="entry-media">
            <?php restimo_posted_in(); ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>

    <?php } ?>

    <div class="inner-post <?php if( !has_post_thumbnail() ) echo 'no-ptop'; ?>">
        <?php if( $format != 'gallery' && $format != 'image' && $format != 'video' && !has_post_thumbnail() ) restimo_posted_in(); ?>
        <div class="entry-header">
            <div class="entry-meta">
                <?php if( restimo_get_option( 'post_entry_meta' ) ) { restimo_post_meta(); } ?>
            </div>
            <?php if( restimo_get_option( 'ptitle_post' ) ) the_title( '<h4 class="entry-title">', '</h4>' ); ?>

        </div>

        <div class="entry-summary">

            <?php

                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'restimo'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'restimo'),
                    'after' => '</div>',
                ));
            ?>

        </div>
        <div class="entry-footer clearfix">
            <?php restimo_entry_footer(); ?>
        </div>
        <?php if( restimo_get_option('author_box') ) restimo_author_info_box(); ?>
        <?php if( restimo_get_option('post_nav') ) restimo_single_post_nav(); ?>
        <?php if( restimo_get_option('related_post') ) restimo_related_posts(); ?>
    </div>

</article>
