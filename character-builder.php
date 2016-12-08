

 <?php
 /**
  * Template Name: Character Builder
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



        <script type="text/javascript">
          var builder_data = {};
          builder_data.races = [];
          builder_data.pc_classes = [];
          builder_data.skills = [];
          builder_data.level_chart = [
            {'cp': 150, 'cppb': 65, 'bp_w': 6, 'bp_r': 4, 'bp_s': 3},
            {'cp': 250, 'cppb': 43, 'bp_w': 8, 'bp_r': 5, 'bp_s': 4},
            {'cp': 350, 'cppb': 34, 'bp_w': 10, 'bp_r': 6, 'bp_s': 4},
            {'cp': 450, 'cppb': 28, 'bp_w': 12, 'bp_r': 7, 'bp_s': 5},
            {'cp': 550, 'cppb': 24, 'bp_w': 14, 'bp_r': 8, 'bp_s': 6},
            {'cp': 650, 'cppb': 22, 'bp_w': 16, 'bp_r': 9, 'bp_s': 6},
            {'cp': 750, 'cppb': 19, 'bp_w': 18, 'bp_r': 10, 'bp_s': 7},
            {'cp': 850, 'cppb': 17, 'bp_w': 20, 'bp_r': 11, 'bp_s': 8},
            {'cp': 950, 'cppb': 16, 'bp_w': 22, 'bp_r': 12, 'bp_s': 8},
            {'cp': 1050, 'cppb': 15, 'bp_w': 24, 'bp_r': 13, 'bp_s': 9},
            {'cp': 1150, 'cppb': 14, 'bp_w': 26, 'bp_r': 14, 'bp_s': 10},
            {'cp': 1250, 'cppb': 13, 'bp_w': 28, 'bp_r': 15, 'bp_s': 10},
            {'cp': 1350, 'cppb': 12, 'bp_w': 30, 'bp_r': 16, 'bp_s': 11},
            {'cp': 1450, 'cppb': 12, 'bp_w': 32, 'bp_r': 17, 'bp_s': 12},
            {'cp': 1550, 'cppb': 11, 'bp_w': 34, 'bp_r': 18, 'bp_s': 12},
            {'cp': 1650, 'cppb': 11, 'bp_w': 36, 'bp_r': 19, 'bp_s': 13},
            {'cp': 1750, 'cppb': 10, 'bp_w': 38, 'bp_r': 20, 'bp_s': 14},
            {'cp': 1850, 'cppb': 10, 'bp_w': 40, 'bp_r': 21, 'bp_s': 14},
            {'cp': 1950, 'cppb': 10, 'bp_w': 42, 'bp_r': 22, 'bp_s': 15},
            {'cp': 2050, 'cppb': 10, 'bp_w': 44, 'bp_r': 23, 'bp_s': 16},
          ]


        </script>

        <?php if( have_rows('races', 812) ): ?>
          <?php $races = []; ?>
          <?php while( have_rows('races',812) ): the_row(); ?>


            <?php // vars
            $name = get_sub_field('name');
            $lifespan = get_sub_field('lifespan');
            $description = get_sub_field('description');
            $racial_characteristics = get_sub_field('racial_characteristics');
            $advantages = get_sub_field('advantages');
            $disadvantages = get_sub_field('disadvantages');

            array_push($races, $name);

            ?>

            <script type="text/javascript">
              builder_data.races[`<?php echo $name; ?>`] = {
                name: `<?php echo $name ?>`,
                lifespan: `<?php echo $lifespan ?>`,
                racial_characteristics: `<?php echo $racial_characteristics ?>`,
                description: `<?php echo $description ?>`,
                advantages: `<?php echo $advantages ?>`,
                disadvantages: `<?php echo $disadvantages ?>`
              }
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('classes', 815) ): ?>
          <?php $classes = []; ?>
          <?php while( have_rows('classes', 815) ): the_row(); ?>

            <?php // vars
            $name = get_sub_field('name');
            $description = get_sub_field('description');
            array_push($classes, $name);
            ?>

            <script type="text/javascript">
              builder_data.pc_classes[`<?php echo $name; ?>`] = {
                name: `<?php echo $name ?>`,
                description: `<?php echo $description ?>`
              }
            </script>

          <?php endwhile; ?>
        <?php endif; ?>


        <?php if( have_rows('skills', 825) ): ?>
          <?php while( have_rows('skills', 825) ): the_row(); ?>

            <?php // vars
            $name = get_sub_field('name');
            $description = get_sub_field('description');
            $prereq = get_sub_field('prerequesites');
            $mercenary_cost = get_sub_field('mercenary_cost');
            $ranger_cost = get_sub_field('ranger_cost');
            $templar_cost = get_sub_field('templar_cost');
            $nightblade_cost = get_sub_field('nightblade_cost');
            $assassin_cost = get_sub_field('assassin_cost');
            $witchhunter_cost = get_sub_field('witchblade_cost');
            $mage_cost = get_sub_field('mage_cost');
            $druid_cost = get_sub_field('druid_cost');
            $bard_cost = get_sub_field('bard_cost');


            ?>

            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                console.log('<?php echo $name; ?>');
                builder_data.skills[`<?php echo $name; ?>`] = {
                  name: `<?php echo $name ?>`,
                  description: `<?php echo $description ?>`,
                  prerequesites: `<?php echo $prereq ?>`,
                  mercenary_cost: `<?php echo $mercenary_cost ?>`,
                  ranger_cost: `<?php echo $ranger_cost ?>`,
                  templar_cost: `<?php echo $templar_cost ?>`,
                  nightblade_cost: `<?php echo $nightblade_cost ?>`,
                  assassin_cost: `<?php echo $assassin_cost ?>`,
                  witchhunter_cost: `<?php echo $witchhunter_cost ?>`,
                  mage_cost: `<?php echo $mage_cost ?>`,
                  druid_cost: `<?php echo $druid_cost ?>`,
                  bard_cost: `<?php echo $bard_cost ?>`
                }
              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <div class="row">
          <div class="col-sm-4">

            <label>Select Your Race</label>
            <select id="cb-race" class="gen-opt">
              <?php foreach ($races as $race) { ?>
                <?php if ($race == 'character-builder-beta'){ continue; } ?>
                <option value="<?php echo $race; ?>"><?php echo $race; ?></option>
              <?php } ?>
            </select>

            <hr />

            <label>Select Your Class</label>
            <select id="cb-class" class="gen-opt">
              <?php $count = 0; ?>
              <? foreach ($classes as $class) { ?>
                <option value="<?php echo $count; ?>"><?php echo $class; ?></option>
                <?php $count++; ?>
              <?php } ?>
            </select>

            <hr />

            <h4>Level: <span id="cb_level"></span></h4>
            <h4>CP Spent: <span id="cb_cp_spent"></span></h4>
            <h4>CP Available: <span id="cb_cp_avail"></span></h4>
            <h4>Frags Spent: <span id="cb_frags_spent"></span></h4>
            <h4>Body Points: <span id="cb_bp"></span></h4>

            <hr />

          </div>
          <div class="col-sm-8">

            <div id="skill_list" class="row">

            </div>

            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                console.log(builder_data.skills.length);
                if(builder_data.skills.length > 0) {
                  console.log('in loop');
                  for (skill in builder_data.skills) {
                    console.log(skill);
                    var cost = 3;
                    var skill_row = jQuery('<div class="col-sm-12 skill_item"></div>');
                    jQuery('#skill_list').append('<div class="col-xs-5">' +
                        skill.name +
                      '</div>' +
                      '<div class="col-xs-5">' +
                        skill.prerequesites +
                      '</div>' +
                      '<div class="col-xs-2">' +
                        skill.cost +
                      '</div>'
                    );
                  }
                }
              });
            </script>
          </div>
        </div>



			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
