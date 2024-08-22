<?php
/**
 * The template for displaying archive portfolio pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restimo
 */

get_header(); ?>

<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main">	
					<div class="project-filter-wrapper">				
						<ul class="project_filters">
							<li><a href="#" data-filter="*" class="selected"><?php esc_html_e('All', 'restimo'); ?><span class="filter-count"></span></a></li>
							<?php 
								$terms = get_terms("portfolio_cat"); // get all categories, but you can use any taxonomy
								$count = count($terms); //How many are they?
								if ( $count > 0 ){  //If there are more than 0 terms
									foreach ( $terms as $term ) {  //for each term:
										echo "<li><a href='#' data-filter='.category-".$term->term_id."'>" . $term->name . "<span class='filter-count'></span></a></li>\n";
										//create a list item with the current term slug for sorting, and name for label
									}
								} 
							?>
						</ul>	

						<?php $p_count = wp_count_posts('xp_portfolio'); $c = $p_count->publish; if ( have_posts() ) : ?>
							<div id="projects-grid" class="projects-grid img-scale <?php restimo_portfolio_option_class(); ?>" data-load="3" data-count="<?php echo esc_attr($c); ?>">
								<div class="grid-sizer"></div>
								<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										* Include the Post-Type-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Type name) and that will be used instead.
										*/
										get_template_part( 'template-parts/content', 'project' );

									endwhile; 
								?>
							</div>
							<?php if( $c >= restimo_get_option('portfolio_posts_per_page') ) { ?>
								<div class="btn-block"><span id="btn-loadmore" class="btn-loadmore xptf-btn" data-loaded="<?php esc_attr_e('Load More', 'restimo'); ?>" data-loading="<?php esc_attr_e('Loading', 'restimo'); ?>"> <?php esc_html_e('Load More', 'restimo'); ?></span></div>							
							<?php } ?>
						<?php 	
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>	
					</div>	
				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php
get_footer();

