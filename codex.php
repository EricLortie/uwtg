

 <?php
 /**
  * Template Name: Codex
  *
  * @package WordPress
  * @subpackage Illdy
  * @since Illdy 1.0
  */

 ?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<section id="blog">
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>

        <div class="row">
          <div class="col-sm-12 blog-post">
            <a id="character-generator" href="#" title="Generate Random Character" class="blog-post-button">Generate Random Character!</a>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            Name:
          </div>
          <div class="col-sm-8">
            <span class="name-holder"></span>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            Race:
          </div>
          <div class="col-sm-8">
            <span class="race-holder"></span>
          </div>
        </div>


        <script type="text/javascript">
          var builder_data = {};
          builder_data.races = [];
          builder_data.pc_classes = [];
          builder_data.arrivals = [];
          builder_data.purposes = [];
          builder_data.quirks = [];
          builder_data.professions = [];
        </script>

        <div class="row switcher-element">
          <div class="col-sm-2"></div>
          <div class="col-sm-4 switcher-box">
            <h2 class="switcher active">Races</h2>
          </div>
          <div class="col-sm-4 switcher-box">
            <h2 class="switcher">Classes</h2>
          </div>
          <div class="col-sm-2"></div>
        </div>

        <?php if( have_rows('races') ): ?>
          <div class="race-content switcher-content">

            <div id="cf-races" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <?php while( have_rows('races') ): the_row(); ?>


                    <?php // vars
                    $name = get_sub_field('name');
                    $lifespan = get_sub_field('lifespan');
                    $description = get_sub_field('description');
                    $racial_characteristics = get_sub_field('racial_characteristics');
                    $advantages = get_sub_field('advantages');
                    $disadvantages = get_sub_field('disadvantages');

                    ?>
                    <h2><?php echo $name; ?></h2>

                    <div class="row repeater-row">
                      <div class="col-sm-4 column">

                        <h4>Lifespan: <?php echo $lifespan; ?></h4>

                        <p><?php echo $racial_characteristics; ?></p>
                      </div>
                      <div class="col-sm-8 column">

                        <h4>Descriptipn</h4>
                        <?php echo $description; ?>

                        <h4>Advantages</h4>
                        <?php echo $advantages; ?>

                        <h4>Disadvantages:</h4>
                        <?php echo $disadvantages; ?>

                      </div>
                    </div>

                    <script type="text/javascript">
                      builder_data.races.push({
                        name: `<?php echo $name ?>`,
                        lifespan: `<?php echo $lifespan ?>`,
                        racial_characteristics: `<?php echo $racial_characteristics ?>`,
                        description: `<?php echo $description ?>`,
                        advantages: `<?php echo $advantages ?>`,
                        disadvantages: `<?php echo $disadvantages ?>`
                      });
                    </script>

                    <?php endwhile; ?>
                  </div>
                </div>
              </div>
            </div>
        <?php endif; ?>
        <?php if( have_rows('classes') ): ?>
          <div class="race-content switcher-content" style="display:none;">

            <div id="cf-classes" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <?php while( have_rows('classes') ): the_row(); ?>

                    <?php // vars
                    $name = get_sub_field('name');
                    $description = get_sub_field('description');
                    ?>

                    <h2><?php echo $name; ?></h2>
                    <p><?php echo $description; ?></p>
                    <br/>

                    <script type="text/javascript">
                      builder_data.pc_classes.push({
                        name: `<?php echo $name ?>`,
                        description: `<?php echo $description ?>`
                      });
                    </script>

                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if( have_rows('backstory_arrival') ): ?>
          <?php while( have_rows('backstory_arrival') ): the_row(); ?>

            <?php // vars
            $arrival = get_sub_field('arrival');
            ?>

            <script type="text/javascript">
              builder_data.arrivals.push(`<?php echo $arrival; ?>`);
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('backstory_purpose') ): ?>
          <?php while( have_rows('backstory_purpose') ): the_row(); ?>

            <?php // vars
            $purpose = get_sub_field('purpose');
            ?>

            <script type="text/javascript">
              builder_data.purposes.push(`<?php echo $purpose; ?>`);
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('backstory_quirk') ): ?>
          <?php while( have_rows('backstory_quirk') ): the_row(); ?>

            <?php // vars
            $quirk = get_sub_field('quirk');
            ?>

            <script type="text/javascript">
              builder_data.quirks.push(`<?php echo $quirk; ?>`);
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('backstory_profession') ): ?>
          <?php while( have_rows('backstory_profession') ): the_row(); ?>

            <?php // vars
            $profession = get_sub_field('profession');
            ?>

            <script type="text/javascript">
              builder_data.professions.push(`<?php echo $profession; ?>`);
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <script type="text/javascript">
          jQuery(document).on('ready', function(){
            jQuery('.switcher').on('click', function(){
              if(!jQuery(this).hasClass('active')){
                jQuery('.switcher-content').toggle();
                jQuery('.switcher').toggleClass('active');
              }
            });
          });

        </script>

			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
