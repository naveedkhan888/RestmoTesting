<?php
/**
 * The template for displaying all portfolios
 *
 * This is the template that displays all portfolio by default.
 * Please note that this is the WordPress construct of portfolios
 * and that other 'portfolios' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restimo
 */

get_header();
?>

<?php
    while ( have_posts() ) : the_post();
        the_content();                            
    endwhile; // End of the loop.
?>

<?php if( restimo_get_option('pf_nav') || restimo_get_option('pf_related_switch') ) { ?>
<div class="container">
    <div class="project-bottom">        
        <?php if( restimo_get_option('pf_nav') ) { ?>
        <div class="single-portfolio-navigation">
            <?php restimo_single_post_nav(); ?>
        </div>
        <?php } ?>

        <?php if( restimo_get_option('pf_related_switch') ) { ?>
        <div class="portfolio-related-posts-wrap">
            <div class="portfolio-related-title-wrap">
                <h4 class="portfolio-related-title"><?php echo restimo_get_option('pf_related_text'); ?></h4>
            </div>
            <div class="portfolio-related-posts projects-grid img-scale">
                <div class="owl-carousel owl-theme">   
                    <?php 
                    // get the custom post type's taxonomy terms                    
                    $custom_taxterms = wp_get_object_terms( $post->ID, 'portfolio_cat', array('fields' => 'ids') );
                    // arguments
                    $args = array(
                        'post_type' => 'xp_portfolio',
                        'post_status' => 'publish',
                        'posts_per_page' => 3, // you may edit this number
                        'ignore_sticky_posts' => 1,
                        'orderby' => 'rand',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_cat',
                                'field' => 'id',
                                'terms' => $custom_taxterms
                            )
                        ),
                        'post__not_in' => array ($post->ID),
                    );
                    $second_query = new WP_Query( $args );

                    //Loop through posts and display...
                    if($second_query->have_posts()) : while ($second_query->have_posts() ) : $second_query->the_post(); 
                        /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                        get_template_part( 'template-parts/content', 'project' );
                    endwhile; wp_reset_query(); endif; 
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>         
    </div>
</div>
<?php } ?>

<?php
get_footer();