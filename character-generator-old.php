

 <?php
 /**
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
            the_content();
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>

        <div id="gen-opts" class="row">
          <div class="col-sm-2 col-xs-6">
            <label>Race</label>
              <select id="cg-race" class="gen-opt" data-ele-holder="#race-container">
                <option value="show">Show</option>
                <option value="lock">Lock</option>
                <option value="hide">Hide</option>
              </select>
          </div>
          <div class="col-sm-2 col-xs-6">
            <label>Class</label>
              <select id="cg-pc_class" class="gen-opt" data-ele-holder="#pc_class-container">
                <option value="show">Show</option>
                <option value="lock">Lock</option>
                <option value="hide">Hide</option>
              </select>
          </div>
          <div class="col-sm-2 col-xs-6">
            <label>Arrival</label>
              <select id="cg-arrival" class="gen-opt" data-ele-holder="#arrival-container">
                <option value="show">Show</option>
                <option value="lock">Lock</option>
                <option value="hide">Hide</option>
              </select>
          </div>
          <div class="col-sm-2 col-xs-6">
            <label>Purpose</label>
              <select id="cg-purpose" class="gen-opt" data-ele-holder="#purpose-container">
                <option value="show">Show</option>
                <option value="lock">Lock</option>
                <option value="hide">Hide</option>
              </select>
          </div>
          <div class="col-sm-2 col-xs-6">
            <label>Profession</label>
              <select id="cg-profession" class="gen-opt" data-ele-holder="#profession-container">
                <option value="show">Show</option>
                <option value="lock">Lock</option>
                <option value="hide">Hide</option>
              </select>
          </div>
          <div class="col-sm-2 col-xs-6">
            <label>Trait</label>
              <select id="cg-quirk" class="gen-opt" data-ele-holder="#quirk-container">
                <option value="show">Show</option>
                <option value="lock">Lock</option>
                <option value="hide">Hide</option>
              </select>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-12 blog-post text-center" style="margin-bottom:3rem;">
            <a id="character-generator" href="#" title="Generate Random Character" class="blog-post-button">Generate Random Character!</a>
          </div>
        </div>

        <div id="generated-character">
          <!-- <div class="row">
            <div class="col-sm-4">
              Name:
            </div>
            <div class="col-sm-8">
              <span class="name-holder"></span>
            </div>
          </div> -->

          <div id="race-container" class="row">
            <div class="col-xs-2">
              <strong>Race:</strong>
            </div>
            <div class="col-xs-10">
              <span id="race-holder"></span>
            </div>
          </div>

          <div id="pc_class-container" class="row">
            <div class="col-xs-2">
              <strong>Class:</strong>
            </div>
            <div class="col-xs-10">
              <span id="pc_class-holder"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-2">
              <strong>Backstory:</strong>
            </div>
            <div class="col-xs-10">
              <p>
                <span id="arrival-container">You <span id="arrival-holder"></span>&nbsp;</span>
                <span id="purpose-container">You are here the purpose of <span id="purpose-holder"></span>&nbsp;</span>
                <span id="profession-container">You are <span id="profession-holder">&nbsp;</span>
                <span id="quirk-container">You <span id="quirk-holder"></span>&nbsp;</span>
              </p>
            </div>
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
          <div class="col-xs-2"></div>
          <div class="col-xs-4 switcher-box">
            <h2 class="switcher active">Races</h2>
          </div>
          <div class="col-xs-4 switcher-box">
            <h2 class="switcher">Classes</h2>
          </div>
          <div class="col-xs-2"></div>
        </div>

        <?php if( have_rows('races') ): ?>
          <div class="race-content switcher-content">

            <div id="cf-races" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <?php while( have_rows('races') ): the_row(); ?>

                    <div class="race" data-race="<?php echo $name; ?>" style="display:none;">

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
                    </div>

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

            jQuery('#character-generator').on('click', function(e){
              e.preventDefault();
              if(jQuery('#cg-race').val() != 'lock'){
                var race = builder_data.races[Math.floor(Math.random()*builder_data.races.length)];
              }
              if(jQuery('#cg-pc_class').val() != 'lock'){
                var pc_class = builder_data.pc_classes[Math.floor(Math.random()*builder_data.pc_classes.length)];
              }
              if(jQuery('#cg-arrival').val() != 'lock'){
                var arrival = builder_data.arrivals[Math.floor(Math.random()*builder_data.arrivals.length)];
              }
              if(jQuery('#cg-purpose').val() != 'lock'){
                var purpose = builder_data.purposes[Math.floor(Math.random()*builder_data.purposes.length)];
              }
              if(jQuery('#cg-profession').val() != 'lock'){
                var quirk = builder_data.quirks[Math.floor(Math.random()*builder_data.quirks.length)];
              }
              if(jQuery('#cg-quirk').val() != 'lock'){
                var profession = builder_data.professions[Math.floor(Math.random()*builder_data.professions.length)];
              }

              jQuery('#generated-character').show();
              if(race != null){
                jQuery('#race-holder').text(race.name);
              }
              if(pc_class != null){
                jQuery('#pc_class-holder').text(pc_class.name);
              }
              jQuery('#purpose-holder').text(end_sentence(purpose));
              jQuery('#quirk-holder').text(end_sentence(quirk));
              jQuery('#profession-holder').text(end_sentence(profession));
              jQuery('#arrival-holder').text(arrival);

            });

            jQuery('.gen-opt').on('change', function(){
              var holder = jQuery(this).data('eleHolder');
              console.log(holder);
              console.log(jQuery(holder).length);
              if(jQuery(this).val() == 'hide') {
                  jQuery(jQuery(this).data('eleHolder')).hide();
                } else {
                  jQuery(jQuery(this).data('eleHolder')).show();
                }
            });

            // jQuery('#cg-quirk, #cg-arrival, #cg-purpose, #cg-profession').on('changed', function(){
            //
            //   if(jQuery(this).val() == 'hide') {
            //     jQuery(jQuery(this).data('eleHolder')).hide();
            //   } else {
            //     jQuery(jQuery(this).data('eleHolder')).show();
            //   }
            // });

          });

          function end_sentence(string) {
            return string.replace(/\.+$/, "") + '.';
          }

        </script>

			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
