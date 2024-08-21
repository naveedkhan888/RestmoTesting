<?php
/**
 * Template part for displaying widget Portfolio Filter Metro
 *
 * @package Restimo
 */
?>
<?php 
	$cates = get_the_terms(get_the_ID(),'portfolio_cat');
    $cate_id   = '';
    if($cates){
	    foreach((array)$cates as $cate){
	        $cate_id   .= 'category-' . $cate->term_id . ' ';
	    }
	}
	$thumb = '';
	if ( function_exists('rwmb_meta') ) {
		$thumb = rwmb_meta('thumb_size');
	}
?>
<div class="project-item <?php echo esc_attr( $cate_id );  echo esc_attr( $thumb ); ?>">
	<div class="projects-box">
		<div class="projects-thumbnail" data-src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" data-sub-html="<?php the_title(); ?>">
			<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ) {
						if( $thumb == 'double_w' ){
							the_post_thumbnail( 'restimo-portfolio-thumbnail-grid-wdouble' );
						}elseif( $thumb == 'double_wh' ){
							the_post_thumbnail( 'restimo-portfolio-thumbnail-grid-whdouble' );
						}else{
							the_post_thumbnail( 'restimo-portfolio-thumbnail-grid' );
						}
					}
				?>
			</a>
			<span class="overlay"><i class="xp-flaticon-signs"></i></span>
		</div>
		<div class="portfolio-info">
			<a href="<?php the_permalink(); ?>" class="overlay"></a>
			<div class="portfolio-info-inner">
				<a href="<?php the_permalink(); ?>" class="plus"><i class="xp-flaticon-signs"></i></a>
				<h5><a class="title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
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