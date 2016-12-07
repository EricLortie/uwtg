<?php
/**
 *	The template for dispalying the archive.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-7">
			<section id="blog">
				<h1>Characters</h1>
				<?php do_action( 'mtl_above_content_after_header' ); ?>
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();
                        $character_entry['race'] = uit_get_post_custom_value('race');
                        $character_entry['class'] = uit_get_post_custom_value('class');
                        ?>

												<hr />
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post archive-post' ); ?>>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-post-title"><?php the_title(); ?></a>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <div class="blog-post-image character-photo">
                                            <?php the_post_thumbnail( 'illdy-blog-list' ); ?>
                                        </div><!--/.blog-post-image-->
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-8">
                                    <div class="testimonial-meta" style="font-style: italic; font-weight:bolder;font-size: 200%;">
                                        <?php echo $character_entry['race'] ?> <?php echo $character_entry['class'] ?>
                                    </div><!--/.testimonial-meta-->
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php _e( 'Read more', 'illdy' ); ?>" class="blog-post-button"><?php _e( 'Read more', 'illdy' ); ?></a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
				<?php do_action( 'mtl_after_content_above_footer' ); ?>
			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
		<?php get_sidebar(); ?>
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
