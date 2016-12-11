

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
          builder_data.character = {};
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
            $frag_race = get_sub_field('frag_race');
            $description = get_sub_field('description');
            $racial_characteristics = get_sub_field('racial_characteristics');
            $advantages = get_sub_field('advantages');
            $disadvantages = get_sub_field('disadvantages');

            array_push($races, [$name, $frag_race]);

            ?>

            <script type="text/javascript">
              builder_data.races[`<?php echo $name; ?>`] = {
                name: `<?php echo $name ?>`,
                lifespan: `<?php echo $lifespan ?>`,
                racial_characteristics: `<?php echo $racial_characteristics ?>`,
                description: `<?php echo $description ?>`,
                advantages: `<?php echo $advantages ?>`,
                disadvantages: `<?php echo $disadvantages ?>`,
                frag_race: `<?php ($frag_race) ? true : false ?>`
              }
            </script>

          <?php endwhile; ?>
          <?php usort($races, 'sortByOption'); ?>
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

          <?php endwhile;
        endif; ?>


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
                var skill_row = jQuery('<div class="col-sm-12 skill_row" style=""></div>');
                skill_row.append(`
                  <div class="col-xs-1">
                    <i class="fa fa-plus-square skill_add" aria-hidden="true"></i>
                  </div>
                  <div class="col-xs-4">
                    <?php echo $name; ?>&nbsp <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                  </div>
                  <div class="col-xs-5">
                    <?php echo $prereq; ?>
                  </div>
                  <div class="col-xs-2">
                    <span class="me_cost skill_cost"><?php echo $mercenary_cost ?></span>
                    <span class="ra_cost skill_cost"><?php echo $ranger_cost ?></span>
                    <span class="te_cost skill_cost"><?php echo $templar_cost ?></span>
                    <span class="ni_cost skill_cost"><?php echo $nightblade_cost ?></span>
                    <span class="as_cost skill_cost"><?php echo $assassin_cost ?></span>
                    <span class="wi_cost skill_cost"><?php echo $witchhunter_cost ?></span>
                    <span class="ma_cost skill_cost"><?php echo $mage_cost ?></span>
                    <span class="dr_cost skill_cost"><?php echo $druid_cost ?></span>
                    <span class="ba_cost skill_cost"><?php echo $bard_cost ?></span>
                  </div>
                  <div class="col-xs-12 skill_desc" style="display:none;">
                    <?php echo $description; ?>
                    <hr />
                    <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                  </div>
                `);

                skill_row.data('name', `<?php echo $name ?>`),
                skill_row.data('description', `<?php echo $description ?>`),
                skill_row.data('prerequesites', `<?php echo $prereq ?>`),
                skill_row.data('mercenary_cost', `<?php echo $mercenary_cost ?>`),
                skill_row.data('ranger_cost', `<?php echo $ranger_cost ?>`),
                skill_row.data('templar_cost', `<?php echo $templar_cost ?>`),
                skill_row.data('nightblade_cost', `<?php echo $nightblade_cost ?>`),
                skill_row.data('assassin_cost', `<?php echo $assassin_cost ?>`),
                skill_row.data('witchhunter_cost', `<?php echo $witchhunter_cost ?>`),
                skill_row.data('mage_cost', `<?php echo $mage_cost ?>`),
                skill_row.data('druid_cost', `<?php echo $druid_cost ?>`),
                skill_row.data('bard_cost', `<?php echo $bard_cost ?>`)

                <?php if($prereq != ''){ ?>
                  skill_row.hide();
                <?php } ?>

                jQuery('#skill_list').append(skill_row);

              });
            </script>

          <?php endwhile; ?>

          <script type="text/javascript">
            jQuery(document).on('ready', function(){

              jQuery('.skill_expander').on('click', function(){
                var desc = jQuery(this).closest('.skill_row').find('.skill_desc');
                desc.slideToggle();
              });

              jQuery('.skill_closer').on('click', function(e){
                e.preventDefault();
                var desc = jQuery(this).closest('.skill_desc');
                desc.slideToggle();
              });

              jQuery('select.mandatory').on('change', function(){

                reset_character();

                if (jQuery('#cb-class').val() != '' && jQuery('#cb-race').val() != '') {
                  jQuery('#btn_generate').removeClass('locked');
                } else {
                  jQuery('#btn_generate').addClass('locked');
                  jQuery('#btn_generate').show();
                }
              });

              jQuery('#cb-race').on('change', function(){
                builder_data.character.race = jQuery(this).val();
                builder_data.character.cp_avail = 150;
                if(jQuery(this).val() == "Human"){
                  builder_data.character.cp_avail = 200;
                }
                builder_data.character.cp_spent = 0;
              });

              jQuery('#cb-class').on('change', function(){
                var pc_class = jQuery(this).val();
                builder_data.character.class =  pc_class;

                if(pc_class == "Mercenary" || pc_class == "Ranger" || pc_class == "Templar"){
                  builder_data.type = "w";
                } else if (pc_class == "Assassin" || pc_class == "Nightblade" || pc_class == "Witchhunter") {
                  builder_data.type = "r";
                } else {
                  builder_data.type = "s";
                }

                jQuery('.skill_cost').hide();
                jQuery('.' + jQuery(this).find('option:selected').data('cost-ele')).show();
              });

              jQuery('#btn_generate').on('click', function(e){
                e.preventDefault();
                reset_character();
                jQuery('.mandatory_section').show();
                jQuery(this).hide();
              });

              jQuery('#btn_add_blanket').on('click', function(e){
                e.preventDefault();
                builder_data.character.blankets_spent += 1;
                builder_data.character.cp_avail += builder_data.character.blanket_value;
                builder_data.character.cp_total = (builder_data.character.cp_avail + builder_data.character.cp_spent);
                if(builder_data.character.cp_total >= (builder_data.character.level_data['cp']+100)){
                  builder_data.character.level += 1;
                  builder_data.character.level_data = builder_data.level_chart[builder_data.character.level-1];
                  builder_data.character.blanket_value = builder_data.character.level_data.cppb;
                  builder_data.character.body_points = builder_data.character.level_data['bp_' + builder_data.type];
                }
                update_character();
              });

              function reset_character() {

                builder_data.character.level = 1;
                builder_data.character.blankets_spent = 0;
                builder_data.character.cp_avail = 0;
                builder_data.character.cp_total = 0;
                builder_data.character.frags_avail = 0;
                builder_data.character.frags_spent = 0;
                builder_data.character.level_data = builder_data.level_chart[0];
                builder_data.character.blanket_value = builder_data.character.level_data.cppb;
                builder_data.character.body_points = builder_data.character.level_data['bp_' + builder_data.type];

                update_character();

              }

              function update_character(){
                jQuery('#cb_blankets_spent').html(builder_data.character.blankets_spent);
                jQuery('#cb_blanket_next').html(builder_data.character.blanket_value);
                jQuery('#cb_cp_avail').html(builder_data.character.cp_avail);
                jQuery('#cb_level').html(builder_data.character.level);
                jQuery('#cb_cp_spent').html(builder_data.character.cp_spent);
                jQuery('#cb_frags_spent').html(builder_data.character.frags_spent);
                jQuery('#cb_bp').html(builder_data.character.body_points);
              }

            });
          </script>

        <?php endif; ?>

        <div class="row">
          <div class="col-sm-4">

            <label>Select Your Race</label>
            <select id="cb-race" class="gen-opt mandatory">
              <option value="">Please select a race</option>
              <?php foreach ($races as $race) { ?>
                <?php
                $name = $race[0];
                $frag_string = "";
                if($race[1] != null){
                  $frag_string = "(FRAG RACE)";
                }

                ?>

                <option value="<?php echo $name; ?>" data-frag-race="<?php echo $name; ?>"><?php echo $name . " " . $frag_string; ?></option>
              <?php } ?>
            </select>

            <hr />

            <label>Select Your Class</label>
            <select id="cb-class" class="gen-opt mandatory">
              <option value="">Please select a class</option>
              <?php $count = 0; ?>
              <?php foreach ($classes as $pc_class) { ?>
                <option value="<?php echo $pc_class; ?>" data-cost-ele="<?php echo strtolower(substr($pc_class, 0, 2)); ?>_cost"><?php echo $pc_class; ?></option>
                <?php $count++; ?>
              <?php } ?>
            </select>

            <hr />

            <div class="blog-post text-center" style="margin-bottom:3rem;">
              <a id="btn_generate" href="#" title="Build Character" class="blog-post-button locked">Start Character</a>
            </div>

            <div class="blog-post text-center mandatory_section" style="margin-bottom:3rem;">
              <a id="btn_add_blanket" href="#" title="Add Blanket" class="blog-post-button">Add Blanket</a>
            </div>

            <hr />

            <div id="character_section" class="mandatory_section">
              <h4>Level: <span id="cb_level"></span></h4>
              <h4>CP Spent: <span id="cb_cp_spent"></span></h4>
              <h4>CP Available: <span id="cb_cp_avail"></span></h4>
              <h4>Blankets Value: <span id="cb_blanket_next"></span></h4>
              <h4>Blankets Spent: <span id="cb_blankets_spent"></span></h4>
              <h4>Frags Spent: <span id="cb_frags_spent"></span></h4>
              <h4>Body Points: <span id="cb_bp"></span></h4>

              <hr />
            </div>

          </div>
          <div class="col-xs-8">
            <div id="skills_section" class="mandatory_section">
              <div id="skill_header" class="row">
                <div class="col-xs-1">
                  Add
                </div>
                <div class="col-xs-4">
                  Name
                </div>
                <div class="col-xs-5">
                  Requirements
                </div>
                <div class="col-xs-2">
                  Cost
                </div>
              </div>
              <div id="skill_list" class="row">

              </div>
            </div>
          </div>

          </div>
        </div>



			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
