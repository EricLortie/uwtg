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
				<h1>Team Members</h1>
				<?php do_action( 'mtl_above_content_after_header' ); ?>
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();
                        $team_member_entry['position'] = uit_get_post_custom_value('position');
                        $team_member_entry['facebook'] = uit_get_post_custom_value('facebook');
                        $team_member_entry['twitter'] = uit_get_post_custom_value('twitter');
                        $team_member_entry['google+'] = uit_get_post_custom_value('google+');
                        $team_member_entry['linkedin'] = uit_get_post_custom_value('linkedin');
                        $team_member_entry['youtube'] = uit_get_post_custom_value('youtube');
                        $team_member_entry['bg-color'] = uit_get_post_custom_value('bg-color');
                        if (is_null($team_member_entry['bg-color'])) {
                            $team_member_entry['bg-color'] = '#a6ce39';
                        }
                        ?>
												<hr />
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post archive-post' ); ?>>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-post-title"><?php the_title(); ?></a>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <div class="blog-post-image">
                                            <?php the_post_thumbnail( 'illdy-blog-list' ); ?>
                                        </div><!--/.blog-post-image-->
                                    <?php endif; ?>
                                    <ul class="person-content-social clearfix">
                                        <?php if ($team_member_entry['facebook'] != '') { ?>
                                            <li>
                                                <a href="<?php echo $team_member_entry['facebook'] ?>" title="Facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($team_member_entry['twitter'] != '') { ?>
                                            <li>
                                                <a href="http://twitter.com/<?php echo $team_member_entry['twitter'] ?>" title="Twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($team_member_entry['google+'] != '') { ?>
                                            <li>
                                                <a href="http://plus.google.com/<?php echo $team_member_entry['google+'] ?>" title="Google+" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($team_member_entry['linkedin'] != '') { ?>
                                            <li>
                                                <a href="<?php echo $team_member_entry['linkedin'] ?>" title="Google+" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($team_member_entry['youtube'] != '') { ?>
                                            <li>
                                                <a href="http://youtube.com/<?php echo $team_member_entry['youtube'] ?>" title="YouTube" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i></a>
                                            </li>
                                        <?php } ?>
                                    </ul><!--/.person-content-social.clearfix-->
                                </div>
                                <div class="col-sm-8">
                                    <h5><?php echo $team_member_entry['position'] ?></h5>
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
