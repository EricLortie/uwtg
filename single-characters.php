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
				<div class="blog-post">
					<a href="/characters" title="Back to Characters" class="blog-post-button"><?php _e( 'Back to Characters', 'illdy' ); ?></a>
					&nbsp;&nbsp;
					<a href="#" id="popup-bio-form" title="Update Character" class="blog-post-button"><?php _e( 'Suggest Biography Change', 'illdy' ); ?></a>
				</div>
			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
		<?php get_sidebar(); ?>
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
