<?php
/**
 *	The template for displaying the testimonials section in front page.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>
<?php
$general_title = get_theme_mod( 'illdy_testimonials_general_title', esc_html__( 'Characters', 'illdy' ) );
$general_background_image = get_theme_mod( 'illdy_testimonials_general_background_image', '' );
$number_of_posts = get_theme_mod( 'illdy_testimonials_number_of_posts', absint( 4 ) );
?>

<section id="testimonials" class="front-page-section" style="<?php if( $general_background_image ): echo 'background-image: url('. esc_url( $general_background_image ) .')'; endif; ?>">
	<?php if( $general_title ): ?>
		<div class="section-header">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3><?php echo illdy_sanitize_html( $general_title ); ?></h3>
					</div><!--/.col-sm-12-->
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.section-header-->
	<?php endif; ?>
    <div class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 no-padding">
                    <?php

                    $character_entries = array();
                    // Args
                    $args = array(
                        'post_type'         => 'characters',
                        'showposts'         => 3,
                        'orderby'           => 'rand'

                    );

                    // The Query
                    $query1 = new WP_Query($args);

                    // The Loop
                    while ($query1->have_posts()) {
                        $query1->the_post();
                        $character_entry = Array();
                        $character_entry['name'] = get_the_title();
                        $character_entry['url'] = get_permalink();
                        $character_entry['biography'] = get_the_excerpt();
                        $character_entry['race'] = uit_get_post_custom_value('race');
                        $character_entry['class'] = uit_get_post_custom_value('class');
                        if (is_null($character_entry['bg-color'])) {
                            $character_entry['bg-color'] = '#a6ce39';
                        }
                        $character_entry['image'] = uit_wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                        array_push($character_entries, $character_entry);
                    }

                    ?>
                    <div class="testimonials-carousel <?php if( count($character_entries) > 1 ): echo 'owl-carousel-enabled'; endif; ?>">

                            <?php
                            $character_counter = 1;
                            foreach ($character_entries as $character_entry) { ?>

                                <div class="carousel-testimonial" style="<?php if( count($character_entries) == 1 ): echo 'margin-bottom: 42px;'; endif; ?>">
                                    <div class="testimonial-image">
                                        <img src="<?php echo $character_entry['image'] ?>" class="illdy-front-page-testimonials" alt="<?php echo $character_entry['name'] ?>" title="<?php echo $character_entry['name'] ?>">
                                    </div><!--/.testimonial-image-->
                                    <div class="testimonial-content">
                                        <blockquote><q><?php echo esc_html( $character_entry['biography'] ); ?></q></blockquote>
                                    </div><!--/.testimonial-content-->
                                    <div class="testimonial-meta">
                                        <a href="<?php echo $character_entry['url']; ?>" title="<?php echo $character_entry['name']; ?>" class="blog-post-title"><?php echo $character_entry['name']; ?></a>
                                    </div><!--/.testimonial-meta-->
                                    <div class="testimonial-meta" style="font-style: italic; font-weight:normal;">
                                        <?php echo $character_entry['race'] ?> <?php echo $character_entry['class'] ?>
                                    </div><!--/.testimonial-meta-->
                                </div><!--/.carousel-testimonial-->


                                <?php $character_counter++; ?>
                            <?php } ?>

														<?php
				                    /* Restore original Post Data
				                    * NB: Because we are using new WP_Query we aren't stomping on the
				                    * original $wp_query and it does not need to be reset with
				                    * wp_reset_query(). We just need to set the post data back up with
				                    * wp_reset_postdata().
				                    */
				                    wp_reset_postdata();
														?>

                    </div><!--/.testimonials-carousel.owl-carousel-enabled-->
                </div><!--/.col-sm-10.col-sm-offset-1.no-padding-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!--/.section-content-->
<?php wp_reset_postdata(); ?>

</section><!--/#testimonials.front-page-section-->
