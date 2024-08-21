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
							<div class="pagination-wrapper">
								<?php restimo_posts_navigation(); ?>
							</div>
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

