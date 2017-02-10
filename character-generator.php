

 <?php
 /**
  * Template Name: Character Generator
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
            <a id="character-generator" href="#" title="Generate Random Character" class="blog-post-button">Generate!</a>
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
            <div class="col-sm-2">
              <strong>Backstory:</strong>
            </div>
            <div class="col-sm-10">
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

        <?php if( have_rows('races', get_id_by_slug('codex-races')) ): ?>
          <?php $races = array(); ?>
          <?php while( have_rows('races',get_id_by_slug('codex-races')) ): the_row(); ?>


            <?php // vars
            $name = get_sub_field('name');
            $life_span = get_sub_field('life_span');
            $frag_cost = get_sub_field('frag_cost');
            $description = get_sub_field('description');
            $racial_characteristics = get_sub_field('racial_characteristics');
            $advantages = get_sub_field('advantages');
            $disadvantages = get_sub_field('disadvantages');
            $appendix = get_sub_field('appendix');
            if($appendix != "") {
              continue;
            }
            $photo = get_sub_field('photo');
            $race = new stdClass();
            $race->name = $name;
            $race->life_span = $life_span;
            $race->frag_cost = $frag_cost;
            $race->appendix = $appendix;
            if ($frag_cost != "") {
              $race->race_string = preg_replace('/ \(.*/', "", $name) . " (" . $frag_cost . " frags)";
            } else {
              $race->race_string = preg_replace('/ \(.*/', "", $name);
            }
            $race->description = $description;
            $race->racial_characteristics = $racial_characteristics;
            $race->advantages = $advantages;
            $race->disadvantages = $disadvantages;
            if($photo == ""){
              $race->photo = site_url() . "/wp-content/uploads/2016/06/UWL_logo.png";
            } else {
              $race->photo = $photo;
            }
            array_push($races, $race);

            ?>

            <script type="text/javascript">
              builder_data.races.push({
                name: `<?php echo $name ?>`,
                lifespan: `<?php echo $life_span ?>`,
                racial_characteristics: `<?php echo $racial_characteristics ?>`,
                description: `<?php echo $description ?>`,
                advantages: `<?php echo $advantages ?>`,
                disadvantages: `<?php echo $disadvantages ?>`,
                frag_cost: `<?php  echo $frag_cost; ?>`
              });
            </script>

          <?php endwhile; ?>
          <?php //usort($races, 'sortByOption'); ?>
        <?php endif; ?>

        <div id="race-content" class="col-sm-12">
          <?php foreach ($races as $race) { ?>
            <div class="race content repeater-content" data-name="<?php echo $race->name; ?>">
              <h2><?php echo $race->name; ?></h2>

              <div class="row repeater-row">
                <div class="col-sm-4 column race_meta">

                  <img src="<?php echo $race->photo ?>" class="img-responsive builder_photo" alt="<?php echo $race->name ?>" title="<?php echo $race->name ?>"/>

                  <?php if($race->frag_cost != ""){ ?>
                    <h4>Frag Cost</h4>

                    <p><?php echo $race->frag_cost; ?></p>
                  <?php } ?>

                  <h4>Lifespan</h4>

                  <p><?php echo $race->life_span; ?></p>

                  <h4>Racial Characteristics</h4>

                  <p><?php echo $race->racial_characteristics; ?></p>
                </div>
                <div class="col-sm-8 column race_info <?php echo (wp_is_mobile()) ? "mobile" : "desktop"; ?>">

                  <h4>Descriptipn</h4>
                  <?php echo $race->description; ?>

                  <h4>Advantages</h4>
                  <?php echo $race->advantages; ?>

                  <h4>Disadvantages:</h4>
                  <?php echo $race->disadvantages; ?>

                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        
        <hr/>

        <?php if( have_rows('classes') ): ?>
          <div class="pc_class-content">

            <div id="cf-pc_classes" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <?php while( have_rows('classes') ): the_row(); ?>

                    <?php // vars
                    $name = get_sub_field('name');
                    $description = get_sub_field('description');
                    ?>

                    <div class="pc_class" data-name="<?php echo $name; ?>" style="display:none;">


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
          <?php while( have_rows('backstory_arrival') ): $row = the_row(); ?>

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

              jQuery('.pc_class').hide();
              jQuery('.race').hide();
              console.log(race.name);
              jQuery('.race[data-name="'+race.name+'"]').show();
              jQuery('.pc_class[data-name="'+pc_class.name+'"]').show();
              jQuery('#'+makeSafeForCSS(race.name)).show();

            });

            jQuery('.gen-opt').on('change', function(){
              var holder = jQuery(this).data('eleHolder');
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
            if (string == null) {
              string = "";
            }
            return string.replace(/\.+$/, "") + '.';
          }

          function makeSafeForCSS(name) {
              return name.replace(/[!\"#$%&'\(\)\*\+,\.\/:;<=>\?\@\[\\\]\^`\{\|\}~]/g, '');
          }

        </script>

			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
