<?php
/**
 *	The template for displaying the latest news section in front page.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>

<?php

$general_background_type = get_theme_mod( 'illdy_latest_news_background_type', 'image' );
$general_background_image = get_theme_mod( 'illdy_latest_news_background_image', esc_url( get_template_directory_uri() . '/inc/medieval-bg.jpg' ) );
$general_background_color = get_theme_mod( 'illdy_latest_news_background_color', '#000000' );
$general_title = get_theme_mod( 'illdy_latest_news_general_title', esc_html__( 'Latest News', 'illdy' ) );
$general_entry = get_theme_mod( 'illdy_latest_news_general_entry', esc_html__( 'If you are interested in the latest articles in the industry, take a sneak peek at our blog. You’ve got nothing to loose!', 'illdy' ) );
$button_text = get_theme_mod( 'illdy_latest_news_button_text', esc_html__( 'See blog', 'illdy' ) );
$button_url = get_theme_mod( 'illdy_latest_news_button_url', esc_url( '#' ) );
$number_of_posts = get_theme_mod( 'illdy_latest_news_number_of_posts', absint( 3 ) );
?>
<?php
if( $general_background_type == 'image' ):
	$counter_style = 'background: url('. esc_url( $general_background_image ) .') no-repeat center center fixed;background-size: 100%;';
elseif( $general_background_type == 'color' ):
	$counter_style = 'background-color:' . $general_background_color;
endif;
?>
<section id="latest-news" class="front-page-section" style="<?php echo $counter_style; ?>">

	<?php if( $button_text && $button_url ): ?>
		<a href="<?php echo esc_url( $button_url ); ?>" title="<?php echo esc_attr( $button_text ); ?>" class="latest-news-button"><i class="fa fa-chevron-circle-right"></i><?php echo esc_html( $button_text ); ?></a>
	<?php endif; ?>
	<?php
	$post_query_args = array (
		'post_type'					=> array( 'post' ),
		'nopaging'					=> false,
		'posts_per_page'			=> absint( $number_of_posts ),
		'ignore_sticky_posts'		=> true,
		'cache_results'				=> true,
		'update_post_meta_cache'	=> true,
		'update_post_term_cache'	=> true,
	);
	?>

	<?php $post_query = new WP_Query( $post_query_args ); ?>
	<?php if( $post_query->have_posts() ): ?>
		<div class="section-content">
			<div class="container">
				<div class="row">
					<?php while( $post_query->have_posts() ): ?>
						<?php $post_query->the_post(); ?>
						<?php $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'illdy-front-page-latest-news' ); ?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="post" style="<?php if( !$post_thumbnail ): echo 'padding-top: 40px;'; endif; ?>">
								<?php if( $post_thumbnail ): ?>
									<div class="post-image" style="background-image: url('<?php echo esc_url( $post_thumbnail[0] ); ?>');"></div>
								<?php endif; ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title"><?php the_title(); ?></a>
								<div class="post-entry">
									<?php the_excerpt(); ?>
								</div><!--/.post-entry-->
								<a href="<?php the_permalink(); ?>" title="<?php _e( 'Read more', 'illdy' ); ?>" class="post-button"><i class="fa fa-chevron-circle-right"></i><?php _e( 'Read more', 'illdy' ); ?></a>
							</div><!--/.post-->
						</div><!--/.col-sm-4-->
					<?php endwhile; ?>
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.section-content-->
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</section><!--/#latest-news.front-page-section-->
