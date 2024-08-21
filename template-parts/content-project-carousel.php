<?php $cates = get_the_terms(get_the_ID(),'portfolio_cat'); ?>
<div class="project-items">
	<div class="projects-box">
		<div class="projects-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php 
					if( function_exists( 'rwmb_meta' ) ) { 
					$images = rwmb_meta( 'slide_img', array( 'size' =>'full' ) );
					foreach ( $images as $image ) {
				?>
				<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
				<?php } } ?>
			</a>
		</div>
		<div class="portfolio-info">
			<div class="portfolio-info-inner">
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php 
					if ( ! is_wp_error( $cates ) && ! empty( $cates ) ) :
						echo '<p class="portfolio-cates">';	 
						foreach ( (array)$cates as $term ) {
							// The $term is an object, so we don't need to specify the $taxonomy.
							$term_link = get_term_link( $term );
							// If there was an error, continue to the next term.
							if ( is_wp_error( $term_link ) ) {
								continue;
							}
							// We successfully got a link. Print it out.
							echo '<span> / </span><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
						}		                         
						
						echo '</p>';    
					endif; 
				?> 
			</div>
		</div>
	</div>
</div>