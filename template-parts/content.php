<?php
/**
 * Template part for displaying posts
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

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box masonry-post-item'); ?>>

	<div class="post-inner">
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

	    <div class="inner-post">
			<?php if( $format != 'gallery' && $format != 'image' && $format != 'video' && !has_post_thumbnail() ) restimo_posted_in(); ?>
	        <div class="entry-header">

	            <?php the_title( '<h4 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>

	        </div><!-- .entry-header -->

	        <div class="entry-summary the-excerpt">

	            <?php the_excerpt(); ?>

	        </div><!-- .entry-content -->
		</div>
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if( restimo_get_option( 'post_entry_meta' ) ) { restimo_post_meta(); } ?>
	        <a href="<?php the_permalink(); ?>" class="btn-details"><i class="xp-flaticon-trajectory"></i></a>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
