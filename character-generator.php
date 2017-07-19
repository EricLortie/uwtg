

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

        <div id="generator-tabs">
          <ul class="nav nav-tabs nav-justified" data-tabs="tabs">
            <li role="presentation" class="active"><a href="#generated-character" class="gen-tab" data-toggle="tab">DETAILS</a></li>
            <li id="race-tab" role="presentation"><a href="#race_list" class="gen-tab" data-toggle="tab">RACE</a></li>
            <li id="class-tab" role="presentation"><a href="#class_list" class="gen-tab" data-toggle="tab">CLASS</a></li>
          </ul>

          <div class="tab-content clearfix">
            <div id="generated-character" class="tab-pane active">

              <div id="pc_race-container" class="row">
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
                    <span id="purpose-container">You are here for the purpose of <span id="purpose-holder"></span>&nbsp;</span>
                    <span id="profession-container">You are <span id="profession-holder"></span>&nbsp;</span>
                    <span id="quirk-container">You <span id="quirk-holder"></span>&nbsp;</span>
                  </p>
                </div>
              </div>
            </div>
            <div id="race_list" class="tab-pane">
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

                  $frag_cost = get_sub_field('frag_cost');
                  if ($frag_cost != "") {
                    continue;
                  }

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

            </div>
            <div id="class_list" class="tab-pane">

              <?php if( have_rows('classes', get_id_by_slug('codex-classes')) ): ?>
                <div class="pc_class-content">

                  <div id="cf-pc_classes" class="cf-repeater">
                    <div class="row repeater-content rf-hidden">
                      <div class="col-lg-12 column">

                        <?php $classes = array(); ?>
                        <?php while( have_rows('classes', get_id_by_slug('codex-classes')) ): the_row(); ?>

                          <?php // vars

                          $frag_cost = get_sub_field('frag_cost');
                          if ($frag_cost != "") {
                            continue;
                          }
                          $optional = get_sub_field('optional');
                          if ( $optional && (in_array('vocation', $optional) || in_array('occupation', $optional)) ) {
                            continue;
                          }

                          $name = get_sub_field('name');
                          $frag_cost = get_sub_field('frag_cost');

                          $description = get_sub_field('description');
                          $photo = get_sub_field('photo');

                          $pc_class = new stdClass();
                          $pc_class->name = $name;
                          $pc_class->description = $description;
                          $pc_class->frag_cost = $frag_cost;
                          if($photo == ""){
                            $pc_class->photo = site_url() . "/wp-content/uploads/2016/06/UWL_logo.png";
                          } else {
                            $pc_class->photo = $photo;
                          }

                          array_push($classes, $pc_class);
                          ?>

                          <script type="text/javascript">
                            builder_data.pc_classes.push({
                              name: `<?php echo $name ?>`,
                              description: `<?php echo $description ?>`
                            });
                          </script>

                      <?php endwhile; ?>

                      <?php foreach ($classes as $pc_class) { ?>
                        <div class="pc_class" data-name="<?php echo $pc_class->name; ?>">
                          <h2><?php echo $pc_class->name; ?></h2>

                          <div class="row repeater-row">
                            <div class="col-sm-4 column class_meta">

                              <img src="<?php echo $pc_class->photo ?>" class="img-responsive builder_photo" alt="<?php echo $pc_class->name ?>" title="<?php echo $pc_class->name ?>"/>

                            </div>
                            <div class="col-sm-8 column class_info">

                              <h4>Descriptipn</h4>
                              <?php echo $pc_class->description; ?>


                              <div class="blog-post text-center" style="margin-bottom:3rem;">
                                <a id="select_class" href="#" title="Select Class" data-class="<?php echo $pc_class->name; ?>" data-frag_cost="<?php echo $pc_class->frag_cost; ?>" data-cost-ele="<?php echo strtolower(substr($pc_class->name, 0, 3)); ?>_cost" class="builder_selector blog-post-button locked">Select <?php echo $pc_class->name; ?></a>
                              </div>

                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

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

        <script type="text/javascript" src="<?php site_url(); ?>/wp-content/themes/illdy/layout/js/character-generator.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
