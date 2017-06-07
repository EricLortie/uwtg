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
		<div class="col-sm-12">
			<section id="blog" class="characters">
				<h1>Characters</h1>
				<p>Here you'll find a list of all currently listed Tempest Grove characters.
					This list includes <strong>Player Characters</strong> and <strong>Non-Player Characters</strong>.<p>
				<p>If you'd like to see your character listed with a detailed biography please <a href="/character-biography-form/" target="_blank">fill out this form.</a></p>
				<br/>
				<hr/>
				<br/>
				<?php do_action( 'mtl_above_content_after_header' ); ?>
				<?php

				// Args
				$args = array(
						'post_type'         => 'characters',
						'posts_per_page'         => -1,
						'orderby'						=> 'title',
						'order' 						=> 'ASC'

				);

				// The Query
				$query1 = new WP_Query($args); ?>

				<div class="row">

					<?php // The Loop
					$i = 0;
					while ($query1->have_posts()) {
						$query1->the_post();
	          $character_entry['race'] = uit_get_post_custom_value('race');
	          $character_entry['class'] = uit_get_post_custom_value('class');
						$content = get_the_content();
						$excerpt = get_the_excerpt();
						$show_content = true;
						if($content == $excerpt){
							$show_content = false;
						}
	          ?>
						<div class="col-sm-6">
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
													<?php if ($show_content){ ?>
		                      	<a href="<?php the_permalink(); ?>" title="<?php _e( 'Read more', 'illdy' ); ?>" class="blog-post-button"><?php _e( 'Read more', 'illdy' ); ?></a>
													<?php } else { ?>
														<a href="#" id="popup-bio-form" title="Update Character" class="" style="color:red;"><?php _e( 'Suggest Public Biography', 'illdy' ); ?></a>
													<?php } ?>
											</div>
		              </div>
		          </article>
						</div>
						<?php
		        $i++;
		        if ($i % 2 == 0) {
		            echo "</div><div class='row'>";
		        }
						?>
		       <?php } ?>
				 </div>
				<?php do_action( 'mtl_after_content_above_footer' ); ?>
			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>


<script type="text/javascript">
jQuery(document).on('ready', function(){
	jQuery('#popup-bio-form').on('click', function(){ jQuery('#character_bio_modal').modal(); })
});
</script>


<div class="modal fade builder_modal" id="character_bio_modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Suggest Character Biography</h4>
      </div>
      <div class="modal-body">
				<p>You can suggest additions or changes to this character by submitting this form. This should only be publicly known information. This of this as "Here's what you may have heard about this character around town."</p>
				<?php echo do_shortcode('[contact-form-7 id="421" title="Character Biography Form"]'); ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
