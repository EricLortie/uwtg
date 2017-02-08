<?php
/**
 *	The template for dispalying the single.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="single-column col-sm-7">
			<section id="blog">
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();

                        $character_entry['race'] = uit_get_post_custom_value('race');
                        $character_entry['class'] = uit_get_post_custom_value('class');
												$content = get_the_content();
												$excerpt = get_the_excerpt();
												$show_content = true;
												if($content == $excerpt){
													$show_content = false;
												}
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <div class="blog-post-image character-photo">
                                            <?php the_post_thumbnail( 'illdy-blog-list' ); ?>
                                        </div><!--/.blog-post-image-->
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-6">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-post-title"><?php the_title(); ?></a>
                                    <div class="testimonial-meta character-meta" style="font-style: italic; font-weight:normal;">
                                        <?php echo $character_entry['race'] ?> <?php echo $character_entry['class'] ?>
                                    </div><!--/.testimonial-meta-->
				                            <div class="blog-post-excerpt">
				                                <?php echo $excerpt; ?>
				                            </div><!--/.blog-post-entry-->

                                </div>
                            </div>
                            <div class="blog-post-entry">
                                <?php
																if($show_content){
																	the_content();
																}
																?>
                            </div><!--/.blog-post-entry-->
                        </article><!--/#post-<?php the_ID(); ?>.blog-post-->

					<?php endwhile;
				endif;
				?>
			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
		<?php get_sidebar(); ?>
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
