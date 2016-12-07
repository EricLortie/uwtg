<?php
/**
 *	The template for dispalying the team section in front page.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>
<?php
$general_title = get_theme_mod( 'illdy_team_general_title', esc_html__( 'Team', 'illdy' ) );
$general_entry = get_theme_mod( 'illdy_team_general_entry', esc_html__( 'Meet some of the people that make Tempest Grove amazing.', 'illdy' ) );
?>
<section id="team" class="front-page-section">
	<?php if( $general_title || $general_entry ): ?>
		<div class="section-header">
			<div class="container">
				<div class="row">
					<?php if( $general_title ): ?>
						<div class="col-sm-12">
							<h3><?php echo illdy_sanitize_html( $general_title ); ?></h3>
						</div><!--/.col-sm-12-->
					<?php endif; ?>
					<?php if( $general_entry ): ?>
						<div class="col-sm-10 col-sm-offset-1">
							<p><?php echo illdy_sanitize_html( $general_entry ); ?></p>
						</div><!--/.col-sm-10.col-sm-offset-1-->
					<?php endif; ?>
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.section-header-->
	<?php endif; ?>
	<div class="section-content">
		<div class="container">
			<div class="row">
                <?php

                $team_member_entries = array();
                // Args
                $args = array(
                    'post_type'         => 'team-members',
                    'showposts'         => 3,
                    'orderby'           => 'rand'

                );

                // The Query
                $query1 = new WP_Query($args);

                // The Loop
                while ($query1->have_posts()) {
                $query1->the_post();
                $team_member_entry = Array();
                $team_member_entry['name'] = get_the_title();
                $team_member_entry['team_member'] = get_the_excerpt();
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
                $team_member_entry['image'] = uit_wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                array_push($team_member_entries, $team_member_entry);
                }

                /* Restore original Post Data
                * NB: Because we are using new WP_Query we aren't stomping on the
                * original $wp_query and it does not need to be reset with
                * wp_reset_query(). We just need to set the post data back up with
                * wp_reset_postdata().
                */
                wp_reset_postdata();
                ?>



                <?php
                $team_member_counter = 1;
                foreach ($team_member_entries as $team_member_entry) { ?>

                    <div class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 widget_illdy_person">
                        <div class="person clearfix row" data-person-color="<?php echo $team_member_entry['bg-color'] ?>">
                            <div class="person-image col-sm-6">
                                <img src="<?php echo $team_member_entry['image'] ?>" alt="<?php echo $team_member_entry['name'] ?>" title="<?php echo $team_member_entry['name'] ?>">
                            </div><!--/.person-image-->
                            <div class="person-content col-sm-6">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-post-title"><?php echo $team_member_entry['name']; ?></a>
                                </h4>
                                <h5><?php echo $team_member_entry['position'] ?></h5>
                                <?php echo $team_member_entry['team_member'] ?>
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
                            </div><!--/.person-content-->
                        </div>

                        <?php $team_member_counter++; ?>
                    </div>
                <?php } ?>

                <!-- End Content Section -->

			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.section-content-->
</section><!--/#team.front-page-section-->