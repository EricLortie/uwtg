

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
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<section id="blog">
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();
            the_content();
            echo '<hr/>';
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>



        <script type="text/javascript">
          var builder_data = {};

          var saved_char = localStorage.getItem('saved_character');

          state_counter = 0;
          builder_data.character = {};
          builder_data.character.class = "";
          builder_data.character.race = "";
          builder_data.character.skills = {};
          builder_data.character.class_skills = {};
          builder_data.character.frags_avail = 0;
          builder_data.character.frags_spent = 0;
          builder_data.character.skill_count = 0;
          builder_data.character.rulebook = 0;
          builder_data.character.racial_skills = 0;
          builder_data.character.automatic_racial_skills = 0;
          builder_data.races = [];
          builder_data.skill = 0;
          builder_data.step = 0;
          builder_data.vocations = [];
          builder_data.occupations = [];
          builder_data.pc_classes = [];
          builder_data.spell_spheres = [];
          builder_data.character_states = [];
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
          builder_data.human_level_chart = [];
          for (level in builder_data.level_chart){
            var level_data =  jQuery.extend({}, builder_data.level_chart[level]);
            level_data['cp'] += 50;
            builder_data.human_level_chart.push(level_data);
          };
          builder_data.sphere_chart = [
            {'mer_cost': 100,'ran_cost': 100, 'tem_cost': 75, 'nig_cost': 75, 'ass_cost': 100, 'wit_cost': 75, 'mag_cost': 25, 'dru_cost': 50, 'bar_cost': 50, 'cha_cost': 50, 'dem_cost': 50},
            {'mer_cost': 200,'ran_cost': 200, 'tem_cost': 175, 'nig_cost': 175, 'ass_cost': 200, 'wit_cost': 175, 'mag_cost': 150, 'dru_cost': 175, 'bar_cost': 175, 'cha_cost': 200, 'dem_cost': 175},
            {'mer_cost': 300,'ran_cost': 300, 'tem_cost': 275, 'nig_cost': 275, 'ass_cost': 300, 'wit_cost': 275, 'mag_cost': 200, 'dru_cost': 225, 'bar_cost': 225, 'cha_cost': 300, 'dem_cost': 225},
            {'mer_cost': "",'ran_cost': "", 'tem_cost': "", 'nig_cost': "", 'ass_cost': "", 'wit_cost': "", 'mag_cost': "", 'dru_cost': "", 'bar_cost': "", 'cha_cost': "", 'dem_cost': ""}
          ]
          builder_data.categories = {
            'Warrior': ['Mercenary', 'Ranger', 'Templar', 'Paladin', 'Dread Knight'],
            'Rogue': ['Assassin', 'Nightblade', 'Witch Hunter'],
            'Scholar': ['Mage', 'Druid', 'Bard', 'Darkweaver', 'Lightweaver', 'Dragon Knight'],
          }

          builder_data.skill_aliases = {
            'Weapon Group Proficiency': [
              'Weapon Group Proficiency: Simple',
              'Weapon Group Proficiency: Medium',
              'Weapon Group Proficiency: Large',
              'Weapon Group Proficiency: Exotic'
            ],
            'Specialization +1: Weapon Group': [
              'Specialization +1: Simple Group',
              'Specialization +1: Medium Group',
              'Specialization +1: Large Group',
              //'Specialization +1: Exotic Group',
            ],
            'Specialization +1: Weapon Specific': [
              'Specialization +1: Simple Weapon',
              'Specialization +1: Medium Weapon',
              'Specialization +1: Large Weapon',
              //'Specialization +1: Exotic Weapon',
            ],
            'Critical +2: Group': [
              'Critical +2: Simple Group',
              'Critical +2: Medium Group',
              'Critical +2: Large Group',
              //'Critical +2: Exotic Group'
            ],
            'Critical +2: Specific': [
              'Critical +2: Specific Simple Weapon',
              'Critical +2: Specific Medium Weapon',
              'Critical +2: Specific Large Weapon',
              //'Critical +2: Specific Exotic Weapon'
            ],
            "Execute" : [
              'Execute: Specific Simple Weapon',
              'Execute: Specific Medium Weapon',
              'Execute: Specific Large Weapon',
              //'Execute: Specific Exotic Weapon',
            ],
            "Execute: Subsequent" : [
              'Execute: Specific Simple Weapon (Subsequent)',
              'Execute: Specific Medium Weapon (Subsequent)',
              'Execute: Specific Large Weapon (Subsequent)',
              //'Execute: Specific Exotic Weapon (Subsequent)',
            ],
            "Execute: Master" : [
              'Execute: Simple Weapon Group',
              'Execute: Medium Weapon Group',
              'Execute: Large Weapon Group',
              //'Execute: Exotic Weapon Group',
            ],
            "Execute: Master Subsequent" : [
              'Execute: Simple Weapon Group (Subsequent)',
              'Execute: Medium Weapon Group (Subsequent)',
              'Execute: Large Weapon Group (Subsequent)',
              //'Execute: Exotic Weapon Group (Subsequent)',
            ],
            "Slay / Parry" : [
              'Slay / Parry: Specific Simple Weapon',
              'Slay / Parry: Specific Medium Weapon',
              'Slay / Parry: Specific Large Weapon',
              'Slay / Parry: Specific Exotic Weapon',
            ],
            "Slay / Parry: Subsequent" : [
              'Slay / Parry: Specific Simple Weapon (Subsequent)',
              'Slay / Parry: Specific Medium Weapon (Subsequent)',
              'Slay / Parry: Specific Large Weapon (Subsequent)',
              'Slay / Parry: Specific Exotic Weapon (Subsequent)',
            ],
            "Slay / Parry: Master" : [
              'Slay / Parry (Master): All Simple Weapons',
              'Slay / Parry (Master): All Medium Weapons',
              'Slay / Parry (Master): All Large Weapons',
              'Slay / Parry (Master): All Exotic Weapons',
            ],
            "Slay / Parry: Master Subsequent" : [
              'Slay / Parry (Master): All Simple Weapons (Subsequent)',
              'Slay / Parry (Master): All Medium Weapons (Subsequent)',
              'Slay / Parry (Master): All Large Weapons (Subsequent)',
              'Slay / Parry (Master): All Exotic Weapons (Subsequent)',
            ]
          }

            builder_data.circles = [
              "Spell Slot: 1st Circle", "Spell Slot: 2nd Circle", "Spell Slot: 3rd Circle",
              "Spell Slot: 4th Circle", "Spell Slot: 5th Circle", "Spell Slot: 6th Circle",
              "Spell Slot: 7th Circle", "Spell Slot: 8th Circle", "Spell Slot: 9th Circle",
              "Spell Slot: Ritual Base"
            ]


            builder_data.test_api_character = {
              step: 1,
              character: JSON.stringify(builder_data.character),
              category: builder_data.character.category,
              class: builder_data.character.class,
              vocation: builder_data.character.vocation,
              occupation: builder_data.character.occupation,
              race: builder_data.character.race,
              skill: "test",
              skill_count: builder_data.character.skill_count,
              frags_spent: builder_data.character.frags_spent,
              spell_spheres: builder_data.character.spell_spheres,
              cp_spent: builder_data.character.sp_spent
            };

            function push_to_remote(character, step, skill){

              var api_character = {
                rulebook: character.rulebook,
                character_id: character.character_id,
                category: character.category,
                step: step,
                character: JSON.stringify(character),
                class: character.class,
                vocation: character.vocation,
                occupation: character.occupation,
                race: character.race,
                skill: skill,
                skill_count: character.skill_count,
                frags_spent: character.frags_spent,
                spell_spheres: character.spell_spheres,
                cp_spent: character.cp_spent
              };
              jQuery.ajax({
                  type: "POST",
                  data :JSON.stringify(api_character),
                  headers: { 'X-API-KEY': "tempest_grove" },
                  url: "https://arcane-sierra-27033.herokuapp.com/character_steps",
                  contentType: "application/json",
                  dataType: "json"
              });
            }

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
              builder_data.races[`<?php echo $name; ?>`] = {
                name: `<?php echo $name ?>`,
                lifespan: `<?php echo $life_span ?>`,
                racial_characteristics: `<?php echo $racial_characteristics ?>`,
                description: `<?php echo $description ?>`,
                advantages: `<?php echo $advantages ?>`,
                disadvantages: `<?php echo $disadvantages ?>`,
                frag_cost: `<?php  echo $frag_cost; ?>`
              }
            </script>

          <?php endwhile; ?>
          <?php //usort($races, 'sortByOption'); ?>
        <?php endif; ?>

        <?php if( have_rows('classes', get_id_by_slug('codex-classes')) ): ?>
          <?php $classes = array(); ?>
          <?php $vocations = array(); ?>
          <?php $occupations = array(); ?>
          <?php while( have_rows('classes', get_id_by_slug('codex-classes')) ): the_row(); ?>

            <?php // vars

            $name = get_sub_field('name');
            $frag_cost = get_sub_field('frag_cost');

            $description = get_sub_field('description');
            $photo = get_sub_field('photo');
            $frag_cost = get_sub_field('frag_cost');

            $pc_class = new stdClass();
            $pc_class->name = $name;
            $pc_class->description = $description;
            $pc_class->frag_cost = $frag_cost;
            if($photo == ""){
              $pc_class->photo = site_url() . "/wp-content/uploads/2016/06/UWL_logo.png";
            } else {
              $pc_class->photo = $photo;
            }

            $optional = get_sub_field('optional');
            if ( $optional && in_array('vocation', $optional) ) {
              array_push($vocations, $pc_class); ?>
              <script type="text/javascript">
                builder_data.vocations[`<?php echo $name; ?>`] = {
                  name: `<?php echo $name ?>`,
                  description: `<?php echo $description ?>`
                }
              </script>
              <?php
            } else if($optional && in_array('occupation', $optional)) {
              array_push($occupations, $pc_class); ?>
              <script type="text/javascript">
                builder_data.occupations[`<?php echo $name; ?>`] = {
                  name: `<?php echo $name ?>`,
                  description: `<?php echo $description ?>`
                }
              </script>
              <?php
            } else {
              array_push($classes, $pc_class); ?>

              <script type="text/javascript">
                builder_data.pc_classes[`<?php echo $name; ?>`] = {
                  name: `<?php echo $name ?>`,
                  description: `<?php echo $description ?>`
                }
              </script>

            <?php } ?>


          <?php endwhile;
        endif; ?>

        <?php if( have_rows('spell_spheres', get_id_by_slug('codex-magic')) ): ?>
          <?php $count = 0; ?>
          <?php while( have_rows('spell_spheres', get_id_by_slug('codex-magic')) ): the_row(); ?>
            <?php $count++; ?>

            <?php // vars
            $name = "Spell Sphere: " . get_sub_field('name');
            $description = get_sub_field('description');
            $focus = get_sub_field('focus');
            $frag_cost = get_sub_field('frag_cost');
            $spells = get_sub_field('spells');
            $prereq = 'Read Magic';
            $multiple = false;

            ?>


            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                var skill_row = jQuery('<div class="row skill_row spell_sphere S"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="row">
                    <div class="col-xs-1">
                      <i id="sphere_<?php echo $count; ?>" class="fa fa-plus-square skill_add spell_sphere_add state_saver" aria-hidden="true"></i>
                      <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9">
                      <span class="cat_label"><i class="fa fa-magic" aria-hidden="true"></i></span>&nbsp;
                      <span class="name"><?php echo $name; ?></span>
                      <br class="visible-sm"/>
                      &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                      <?php if($prereq != ""){ ?>
                        &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                      <?php } ?>
                      &nbsp;
                    </div>
                    <div class="col-xs-1">
                      <span class="sphere_cost skill_cost"></span>
                      <span class="cost" style="display:none"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 skill_desc" style="display:none;">
                      <?php if ($prereq != "") { ?>
                        <p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Requirements: <?php echo $prereq; ?></p>
                      <?php } ?>
                      <?php if ($focus != "") { ?>
                        <p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Requirements: <?php echo $prereq; ?></p>
                      <?php } ?>
                      <?php echo $description; ?>
                      <hr />
                      <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                    </div>
                  </div>
                `);

                skill_row.data('name', `<?php echo $name ?>`),
                skill_row.data('description', `<?php echo $description ?>`),
                skill_row.data('requirements', `Read Magic`),
                skill_row.data('multiple', `<?php echo $multiple ?>`)
                skill_row.data('category', `S`)
                skill_row.data('cat_string', `Scholar`)
                skill_row.data('class_skill', false);
                skill_row.data('spell_sphere', true);
                skill_row.data('automatic', `<?php echo $automatic; ?>`);
                //skill_row.data('frag_cost', `<?php echo $frag_cost ?>`),

                jQuery('#skill_list').append(skill_row);

              });
            </script>

            <script type="text/javascript">
              builder_data.spell_spheres.push({
                name: `<?php echo $name ?>`,
                focus: `<?php echo $focus ?>`,
                spells: `<?php echo $spells ?>`,
                description: `<?php echo $description ?>`,
                frag_cost: `<?php echo $frag_cost ?>`
              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>


        <?php if( have_rows('skills', get_id_by_slug('codex-racial-abilities')) ): ?>
          <?php $s_count = 0; ?>
          <?php while( have_rows('skills', get_id_by_slug('codex-racial-abilities')) ): the_row(); ?>


            <?php // vars
            $s_count++;
            $name = get_sub_field('name');
            $description = get_sub_field('description');
            $category = get_sub_field('category');
            $cat_icon = "fa-users";
            $pc_class = get_sub_field('class');
            $cat =  "A";
            $prereq = get_sub_field('prerequesites');
            $optional_fields = get_sub_field('optional_fields');
            $race = get_sub_field('race');

            $optional = get_sub_field('optional_fields');
            $multiple = false;
            if ( $optional && in_array('multiple', $optional) ) {
              $multiple = true;
            }
            $automatic = false;
            if ( $optional && in_array('automatic', $optional) ) {
              $automatic = true;
            }
            ?>

            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                var skill_row = jQuery('<div class="row skill_row <?php echo $cat; ?> <?php echo $pc_class; ?>"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="row">
                    <div class="col-xs-1">
                      <i id="skill_<?php echo $s_count; ?>" class="fa fa-plus-square skill_add state_saver <?php echo (($automatic) ? "automatic_skill" : "" ) ?>" aria-hidden="true"></i>
                      <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9">
                      <span class="cat_label"><i class="fa <?php echo $cat_icon; ?>" aria-hidden="true"></i></span>&nbsp;
                      <span class="name"><?php echo $name; ?></span>
                      &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                      <?php if($prereq != ""){ ?>
                        &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                      <?php } ?>
                      &nbsp;
                    </div>
                    <div class="col-xs-1">
                      <?php if($automatic) { ?>
                        <span class="racial_cost skill_cost"></span>
                        <span class="cost" style="display:none">0</span>
                      <?php } else { ?>
                        <span class="racial_cost skill_cost">50</span>
                        <span class="cost" style="display:none">50</span>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 skill_desc" style="display:none;">
                      <h4>Race: <?php echo $race; ?></h4>
                      <p>Automatic: <?php echo (($automatic) ? "Yes" : "No"); ?></p>
                      <p>Multiple Purchases: <?php echo (($multiple) ? "Yes" : "No"); ?></p>
                      <?php echo $description; ?>
                      <hr />
                      <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                    </div>
                  </div>
                `);

                var row_id = "row_" + Math.floor((Math.random() * 10000) + 1);
                skill_row.attr('id', row_id)
                skill_row.data('name', `<?php echo $name ?>`);
                skill_row.data('cat_string', `<?php echo $category; ?>`);
                skill_row.data('category', `<?php echo $cat; ?>`);
                skill_row.data('description', `<?php echo $description ?>`);
                skill_row.data('requirements', `<?php echo $prereq ?>`);
                skill_row.data('multiple', `<?php echo $multiple ?>`);
                //skill_row.data('frag', `<?php echo $frag_cost ?>`),

                skill_row.data('race', `<?php echo $race;?>`);
                skill_row.data('racial_skill', true);
                skill_row.data('automatic', `<?php echo $automatic;?>`);
                skill_row.data('cost', `50`)

                jQuery('#skill_list').append(skill_row);

              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>



        <?php if( have_rows('skills', get_id_by_slug('codex-class-skills')) ): ?>
          <?php $s_count = 0; ?>
          <?php while( have_rows('skills', get_id_by_slug('codex-class-skills')) ): the_row(); ?>


            <?php // vars
            $s_count++;
            $name = get_sub_field('name');


            $optional = get_sub_field('optional_fields');
            $vocation_ability = false;
            if ( $optional && in_array('vocation', $optional) ) {
              continue;
              $vocation_ability = true;
            }
            $multiple = false;
            if ( $optional && in_array('multiple', $optional) ) {
              $multiple = true;
            }
            $automatic = false;
            if ( $optional && in_array('automatic', $optional) ) {
              $automatic = true;
            }

            if (strpos($name, 'Subsequent') !== false) {
              continue;
            }

            $description = get_sub_field('description');
            $category = get_sub_field('category');
            $pc_class = get_sub_field('class');
            $pc_class_string = str_replace(" ", "", $pc_class);
            $class_level = get_sub_field('level');
            $cat_icon = "fa-universal-access";

            $cat =  substr($category, 0, 1);

            $prereq = get_sub_field('prerequesites');

            $level = get_sub_field('level');
            $level_cost = 0;
            if($level == 3){
              $level_cost = 30;
            } else if ($level == 6) {
              $level_cost = 60;
            } else if ($level == 9) {
              $level_cost = 90;
            } else if($level == 12){
              $level_cost = 120;
            }

            ?>

            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                var skill_row = jQuery('<div class="row skill_row <?php echo $cat; ?> <?php echo $pc_class_string; ?>"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="row">
                    <div class="col-xs-1">
                      <i id="skill_<?php echo $s_count; ?>" class="fa fa-plus-square skill_add state_saver" aria-hidden="true"></i>
                      <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9">
                      <span class="cat_label"><i class="fa <?php echo $cat_icon; ?>" aria-hidden="true"></i></span>&nbsp;
                      <span class="name"><?php echo $name; ?></span>
                      &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                      <?php if($prereq != ""){ ?>
                        &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                      <?php } ?>
                      &nbsp;
                    </div>
                    <div class="col-xs-1">
                      <span class="level_cost skill_cost"><?php echo $level_cost ?></span>
                      <span class="cost" style="display:none"><?php echo $level_cost ?></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 skill_desc" style="display:none;">
                      <h4>Class: <?php echo $pc_class; ?></h4>
                      <p>Multiple Purchases: <?php echo (($multiple) ? "Yes" : "No"); ?></p>
                      <?php echo $description; ?>
                      <hr />
                      <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                    </div>
                  </div>
                `);

                var row_id = "row_" + Math.floor((Math.random() * 10000) + 1);
                skill_row.attr('id', row_id)
                skill_row.data('name', `<?php echo $name ?>`);
                skill_row.data('cat_string', `<?php echo $category; ?>`);
                skill_row.data('category', `<?php echo $cat; ?>`);
                skill_row.data('description', `<?php echo $description ?>`);
                skill_row.data('requirements', `<?php echo $prereq ?>`);
                skill_row.data('multiple', `<?php echo $multiple ?>`);
                //skill_row.data('frag', `<?php echo $frag_cost ?>`),

                skill_row.data('class', `<?php echo $pc_class;?>`);
                skill_row.data('class_level', `<?php echo $class_level;?>`);
                skill_row.data('class_skill', true);
                skill_row.data('automatic', `<?php echo $automatic; ?>`);
                skill_row.data('vocation_skill', `<?php echo $vocation_ability; ?>`)
                skill_row.data('cost', `<?php echo $level_cost; ?>`)

                jQuery('#skill_list').append(skill_row);

              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>




        <?php if( have_rows('skills', get_id_by_slug('codex-skills')) ): ?>
          <?php $s_count = 0; ?>
          <?php while( have_rows('skills', get_id_by_slug('codex-skills')) ): the_row(); ?>


            <?php // vars
            $s_count++;
            $name = get_sub_field('name');

            if (strpos($name, 'Subsequent') !== false) {
              continue;
            }

            $description = get_sub_field('description');
            $category = get_sub_field('category');


            if($category == "Warrior"){
              $cat_icon = "fa-shield";
            } else if ($category == "Rogue"){
              $cat_icon = "fa-bomb";
            } else if ($category == "Scholar"){
              $cat_icon = "fa-magic";
            } else if ($category == "Production"){
              $cat_icon = "fa-cog";
            } else if ($category == "Racial Ability"){
              $category = "Abilities (Racial)";
              $cat_icon = "fa-users";
            } else if ($category == "Class Ability"){
              $cat_icon = "fa-universal-access";
            }

            $cat =  substr($category, 0, 1);

            $prereq = get_sub_field('prerequesites');

            $optional_fields = get_sub_field('optional_fields');
            $mercenary_cost = get_sub_field('mercenary_cost');
            $ranger_cost = get_sub_field('ranger_cost');
            $templar_cost = get_sub_field('templar_cost');
            $nightblade_cost = get_sub_field('nightblade_cost');
            $assassin_cost = get_sub_field('assassin_cost');
            $witchhunter_cost = get_sub_field('witchblade_cost');
            $mage_cost = get_sub_field('mage_cost');
            $druid_cost = get_sub_field('druid_cost');
            $bard_cost = get_sub_field('bard_cost');
            $demagogue_cost = get_sub_field('demagogue_cost');
            $champion_cost = get_sub_field('champion_cost');

            $optional = get_sub_field('optional_fields');
            $multiple = false;
            if ( $optional && in_array('multiple', $optional) ) {
              $multiple = true;
            }
            $automatic = false;
            if ( $optional && in_array('automatic', $optional) ) {
              $automatic = true;
            }


            ?>

            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                var skill_row = jQuery('<div class="row skill_row <?php echo $cat; ?>"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="row">
                    <div class="col-xs-1">
                      <i id="skill_<?php echo $s_count; ?>" class="fa fa-plus-square skill_add state_saver" aria-hidden="true"></i>
                      <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9">
                      <span class="cat_label"><i class="fa <?php echo $cat_icon; ?>" aria-hidden="true"></i></span>&nbsp;
                      <span class="name"><?php echo $name; ?></span>
                      &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                      <?php if($prereq != ""){ ?>
                        &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                      <?php } ?>
                      &nbsp;
                    </div>
                    <div class="col-xs-1">
                      <div class="cost_strings">
                        <span class="mer_cost skill_cost"><?php echo $mercenary_cost ?></span>
                        <span class="ran_cost skill_cost"><?php echo $ranger_cost ?></span>
                        <span class="tem_cost skill_cost"><?php echo $templar_cost ?></span>
                        <span class="nig_cost skill_cost"><?php echo $nightblade_cost ?></span>
                        <span class="ass_cost skill_cost"><?php echo $assassin_cost ?></span>
                        <span class="wit_cost skill_cost"><?php echo $witchhunter_cost ?></span>
                        <span class="mag_cost skill_cost"><?php echo $mage_cost ?></span>
                        <span class="dru_cost skill_cost"><?php echo $druid_cost ?></span>
                        <span class="bar_cost skill_cost"><?php echo $bard_cost ?></span>
                        <span class="dem_cost skill_cost"><?php echo $demagogue_cost ?></span>
                        <span class="cha_cost skill_cost"><?php echo $champion_cost ?></span>
                      </div>
                      <span class="cost" style="display:none"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 skill_desc" style="display:none;">
                      <?php if ($prereq != "") { ?>
                        <p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Requirements: <?php echo $prereq; ?></p>
                      <?php } ?>
                      <p>Multiple Purchases: <?php echo (($multiple) ? "Yes" : "No"); ?></p>
                      <?php echo $description; ?>
                      <hr />
                      <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                    </div>
                  </div>
                `);

                var row_id = "row_" + Math.floor((Math.random() * 10000) + 1);
                skill_row.attr('id', row_id)
                skill_row.data('name', `<?php echo $name ?>`);
                skill_row.data('cat_string', `<?php echo $category; ?>`);
                skill_row.data('category', `<?php echo $cat; ?>`);
                skill_row.data('description', `<?php echo $description ?>`);
                skill_row.data('requirements', `<?php echo $prereq ?>`);
                skill_row.data('multiple', `<?php echo $multiple ?>`);
                skill_row.data('automatic', `<?php echo $automatic; ?>`);
                skill_row.data('max', 5);
                //skill_row.data('frag', `<?php echo $frag_cost ?>`),

                skill_row.data('class_skill', false);

                <?php if($prereq != ''){ ?>
                  skill_row.addClass('has_req');
                  skill_row.addClass('locked');
                <?php } ?>

                aliases = builder_data.skill_aliases['<?php echo $name; ?>'];
                if(typeof aliases !== 'undefined'){
                  alias_rows = [];
                  for (alias in aliases) {
                    var alias_row = skill_row.clone(true);
                    var row_id = "row_" + Math.floor((Math.random() * 10000) + 1);
                    alias_row.attr('id', row_id)
                    alias_row.data('name', aliases[alias]);
                    alias_row.find('span.name').html(aliases[alias]);
                    alias_row.appendTo("#skill_list");
                  }
                } else {
                  var name = '<?php echo $name?>';
                  if(~name.indexOf("Circle")){
                    var cost_string = `<span class="mer_cost skill_cost"><?php echo $mercenary_cost+10; ?></span>
                    <span class="ran_cost skill_cost"><?php echo $ranger_cost+10; ?></span>
                    <span class="tem_cost skill_cost"><?php echo $templar_cost+10; ?></span>
                    <span class="nig_cost skill_cost"><?php echo $nightblade_cost+10; ?></span>
                    <span class="ass_cost skill_cost"><?php echo $assassin_cost+10; ?></span>
                    <span class="wit_cost skill_cost"><?php echo $witchhunter_cost+10; ?></span>
                    <span class="mag_cost skill_cost"><?php echo $mage_cost+10; ?></span>
                    <span class="dru_cost skill_cost"><?php echo $druid_cost+10; ?></span>
                    <span class="bar_cost skill_cost"><?php echo $bard_cost+10; ?></span>
                    <span class="dem_cost skill_cost"><?php echo $demagogue_cost+10; ?></span>
                    <span class="cha_cost skill_cost"><?php echo $champion_cost+10; ?></span>`;

                    var alias_row = skill_row.clone(true);
                    var row_id = "row_" + Math.floor((Math.random() * 10000) + 1);
                    alias_row.attr('id', row_id)
                    alias_row.find('.cost_strings').html(cost_string);
                    alias_row.data('name', "Spell Versatility: " + name);
                    var name_string = "<span class='frag_cost'>"+"Spell Versatility: " + name+" ("+cost_string+"&nbsp;<i class='fa fa-diamond' aria-hidden='true'></i>)</span>"
                    alias_row.find('span.name').html(name_string);
                    alias_row.appendTo("#skill_list");
                    alias_row.find('.row').addClass('frag_row');
                    alias_row.data('requirements', name);
                    alias_row.data('max', 5);
                    alias_row.data('multiple', true);
                    jQuery('#skill_list').append(alias_row);
                  }
                  jQuery('#skill_list').append(skill_row);
                }

              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('skills', get_id_by_slug('codex-frag-skills')) ): ?>
          <?php $s_count = 0; ?>
          <?php while( have_rows('skills', get_id_by_slug('codex-frag-skills')) ): the_row(); ?>


            <?php // vars
            $s_count++;
            $name = get_sub_field('name');

            if (strpos($name, 'Subsequent') !== false || $name == "Spell Versatility") {
              continue;
            }

            $description = get_sub_field('description');
            $category = get_sub_field('category');


            $cat_icon = "fa-diamond";
            if($category == "Warrior"){
              $cat_icon = "fa-shield";
            } else if ($category == "Rogue"){
              $cat_icon = "fa-bomb";
            } else if ($category == "Scholar"){
              $cat_icon = "fa-magic";
            } else if ($category == "Production"){
              $cat_icon = "fa-cog";
            } else if ($category == "Racial Ability"){
              $category = "Abilities (Racial)";
              $cat_icon = "fa-users";
            } else if ($category == "Class Ability"){
              $cat_icon = "fa-universal-access";
            }

            $cat =  substr($category, 0, 1);

            $prereq = get_sub_field('prerequesites');
            $optional_fields = get_sub_field('optional_fields');
            $mercenary_cost = get_sub_field('mercenary_cost');
            $ranger_cost = get_sub_field('ranger_cost');
            $templar_cost = get_sub_field('templar_cost');
            $nightblade_cost = get_sub_field('nightblade_cost');
            $assassin_cost = get_sub_field('assassin_cost');
            $witchhunter_cost = get_sub_field('witchblade_cost');
            $mage_cost = get_sub_field('mage_cost');
            $druid_cost = get_sub_field('druid_cost');
            $bard_cost = get_sub_field('bard_cost');
            $frag_cost = get_sub_field('frag_cost');
            $demagogue_cost = get_sub_field('demagogue_cost');
            $champion_cost = get_sub_field('champion_cost');

            $pc_class = get_sub_field('class');
            $pc_class_string = str_replace(" ", "", $pc_class);

            $optional = get_sub_field('optional_fields');
            $multiple = false;
            if ( $optional && in_array('multiple', $optional) ) {
              $multiple = true;
            }
            $automatic = false;
            if ( $optional && in_array('automatic', $optional) ) {
              $automatic = true;
            }


            ?>

            <script type="text/javascript">
              jQuery(document).on('ready', function(){
                var skill_row = jQuery('<div class="row skill_row frag_row <?php echo $cat; ?> <?php echo $pc_class_string; ?>"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="row">
                    <div class="col-xs-1">
                      <i id="skill_<?php echo $s_count; ?>" class="fa fa-plus-square skill_add state_saver <?php echo (($name == "Favoured") ? "favoured" : ""); ?>" aria-hidden="true"></i>
                      <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9">
                      <span class="cat_label">
                        <i class="fa <?php echo $cat_icon; ?>" aria-hidden="true"></i>
                      </span>&nbsp;
                      <span class="name"><span class="frag_cost"><?php echo $name; ?> (<?php echo $frag_cost; ?>&nbsp;<i class=" fa fa-diamond" aria-hidden="true"></i>)</span> </span>
                      &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                      <?php if($prereq != ""){ ?>
                        &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                      <?php } ?>
                      &nbsp;
                    </div>
                    <div class="col-xs-1">
                      <span class="mer_cost skill_cost"><?php echo $mercenary_cost ?></span>
                      <span class="ran_cost skill_cost"><?php echo $ranger_cost ?></span>
                      <span class="tem_cost skill_cost"><?php echo $templar_cost ?></span>
                      <span class="nig_cost skill_cost"><?php echo $nightblade_cost ?></span>
                      <span class="ass_cost skill_cost"><?php echo $assassin_cost ?></span>
                      <span class="wit_cost skill_cost"><?php echo $witchhunter_cost ?></span>
                      <span class="mag_cost skill_cost"><?php echo $mage_cost ?></span>
                      <span class="dru_cost skill_cost"><?php echo $druid_cost ?></span>
                      <span class="bar_cost skill_cost"><?php echo $bard_cost ?></span>
                      <span class="dem_cost skill_cost"><?php echo $demagogue_cost ?></span>
                      <span class="cha_cost skill_cost"><?php echo $champion_cost ?></span>
                      <span class="cost" style="display:none"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 skill_desc" style="display:none;">
                      <?php if ($prereq != "") { ?>
                        <p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Requirements: <?php echo $prereq; ?></p>
                      <?php } ?>
                      <p>Multiple Purchases: <?php echo (($multiple) ? "Yes" : "No"); ?></p>
                      <p>Frag Cost: <?php echo $frag_cost; ?></p>
                      <?php echo $description; ?>
                      <hr />
                      <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                    </div>
                  </div>
                `);

                var row_id = "row_" + Math.floor((Math.random() * 10000) + 1);
                skill_row.attr('id', row_id)
                skill_row.data('name', `<?php echo $name ?>`);
                skill_row.data('cat_string', `<?php echo $category; ?>`);
                skill_row.data('category', `<?php echo $cat; ?>`);
                skill_row.data('description', `<?php echo $description ?>`);
                skill_row.data('requirements', `<?php echo $prereq ?>`);
                skill_row.data('multiple', `<?php echo $multiple ?>`);
                skill_row.data('frag_cost', `<?php echo $frag_cost ?>`),

                skill_row.data('class_skill', false);
                skill_row.data('class', `<?php echo $pc_class; ?>`);
                skill_row.data('automatic', `<?php echo $automatic; ?>`);

                <?php if($prereq != ''){ ?>
                  skill_row.addClass('has_req');
                  skill_row.addClass('locked');
                <?php } ?>

                jQuery('#skill_list').append(skill_row);

              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

        <div id="launcher" class="row">
          <div class="col-sm-12">

            <div id="menu_launcher" class="row bg_<?php echo rand(1,5); ?>">
              <div class="col-sm-12">
                <div id="menu_items">
                  <div id="menu_primary">
                    <div class="blog-post text-center col-sm-12" style="margin-bottom:3rem;">
                      <a id="btn_choose_race" href="#" title="Choose Race" class="full-width blog-post-button state_saver locked">Select Race <i class="fa fa-check-square passed" aria-hidden="true"></i></a>
                    </div>

                    <div class="blog-post text-center col-sm-12" style="margin-bottom:3rem;">
                      <a id="btn_choose_class" href="#" title="Choose Class" class="full-width blog-post-button state_saver locked">Select Class <i class="fa fa-check-square passed" aria-hidden="true"></i></a>
                    </div>

                    <div class="blog-post text-center" style="">
                      <div id="category-menu" class="col-sm-12 <?php echo (wp_is_mobile()) ? "mobile" : "desktop"; ?>">
                        <label>SELECT A CATEGORY <i class="fa fa-info-circle" aria-hidden="true" title="This is not required but will be useful for future projects."></i></label>
                        <p style="margin-bottom:3rem;"><span class="full-width styled-dropdown custom-dropdown custom-dropdown--red">
                          <select id="category-dropdown" class="full-width builder_selector custom-dropdown__select custom-dropdown__select--red">
                            <option>---</option>
                            <?php $categories = array("Crafter", "Defender", "Attacker", "Damage Dealer", "Tank", "Guard", "Healer", "Passifist", "Hero", "Villain", "Storyteller", "Politician", "Merchant", "Jack of All Trades", "Specialist", "Observer", "Other"); ?>
                            <?php foreach ($categories as $category) { ?>
                              <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                            <?php } ?>
                          </select>
                        </span></p>
                      </div>
                    </div>

                    <div class="blog-post text-center col-sm-12" style="margin-bottom:3rem;">
                      <a id="btn_generate" href="#" title="Build Character" class="full-width blog-post-button state_saver locked">Start Character</a>
                    </div>

                    <div class="btn_warning text-center" style="margin-bottom:3rem;">
                      <a id="btn_data_import" href="#" title="Import" class="blog-post-button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Import</a>
                    </div>
                  </div>

                  <div id="data_fields" class="" style="padding-bottom:3rem;">
                    <div id="data_fields_export">
                      <label>Click the button below to generate your character export. Copy and paste it into a word document to save it.</label>
                      <input type="text" id="char_export_code" disabled="disabled" />
                      <button id="generate_export" class="btn btn-red btn_process_data">Generate Export</button>

                      <label>Alternatively, click the button below to save this character to your browser. You can only have one saved character.</label>
                      <button id="save_character" class="btn btn-red btn_process_data">Save</button>
                      <p id="save_warning">Note: This character was saved only to this browser on this device.</p>
                    </div>
                    <div id="data_fields_import">
                      <label>Paste your character data here. Click import to load this character.</label>
                      <input type="text" id="data_import"/>
                      <button id="process_import" class="btn btn-red btn_process_data">Process Import</button>

                      <div id="load_character_section">
                        <label>Press this button to load your saved character from your browser.</label>
                        <button id="load_character" class="btn btn-red btn_process_data">Load Saved Character</button>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-12">
                        <button id="btn_close_data" class="btn btn-red">Back</button>
                      </div>
                    </div>

                </div>
              </div>
            </div>

            <div id="selector_elements" class="col-sm-12">
              <div id="race_selector" class="row">

                <div id="race-menu" class="col-sm-12 <?php echo (wp_is_mobile()) ? "mobile" : "desktop"; ?>">
                  <p><span class="custom-dropdown custom-dropdown--red">
                    <select id="race-dropdown" class="builder_selector custom-dropdown__select custom-dropdown__select--red">
                    <option>Select a race</option>
                      <?php foreach ($races as $race) { ?>
                        <?php
                        $race_string = ($race->frag_cost > 0) ? $race->name . " (" . $race->frag_cost . " FRAGS)" : $race->name;
                        if(is_array($race->appendix)) {
                          $race_string .= " (APPENDIX RULEBOOK)";
                        }
                        ?>

                        <option value="<?php echo $race->name; ?>"><?php echo $race_string ?></option>
                      <?php  }?>
                    </select>
                  </span></p>
                </div>

                <div id="race-content" class="col-sm-12">
                  <?php foreach ($races as $race) { ?>
                    <div class="race content repeater-content" data-name="<?php echo $race->name; ?>">
                      <h2><?php echo $race->name; ?></h2>

                      <div class="row repeater-row">
                        <div class="col-sm-4 column race_meta">

                          <img src="<?php echo $race->photo ?>" class="img-responsive builder_photo" alt="<?php echo $race->name ?>" title="<?php echo $race->name ?>"/>

                          <div class="blog-post text-center" style="margin-bottom:3rem;">
                            <a id="select_race" href="#" title="Select Race" data-race="<?php echo $race->name; ?>" data-frag_cost="<?php echo $race->frag_cost; ?>" class="builder_selector blog-post-button state_saver locked">
                              Select <?php echo $race->race_string; ?>
                            </a>
                          </div>

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

              <div id="class_selector" class="row">

                <div id="class-menu" class="col-sm-12 <?php echo (wp_is_mobile()) ? "mobile" : "desktop"; ?>">
                  <p><span class="custom-dropdown custom-dropdown--red">
                    <select id="class-dropdown" class="builder_selector custom-dropdown__select custom-dropdown__select--red">
                    <option>Select a class</option>
                      <?php foreach ($classes as $class) { ?>
                        <?php $class_string = ($class->frag_cost > 0) ? $class->name . " (" . $class->frag_cost . " FRAGS)" : $class->name; ?>
                        <option value="<?php echo $class->name; ?>"><?php echo $class_string ?></option>
                      <?php } ?>
                    </select>
                  </span></p>
                </div>

                <div id="class-content" class="col-sm-12">
                  <?php foreach ($classes as $pc_class) { ?>
                    <div class="class content repeater-content" data-name="<?php echo $pc_class->name; ?>">
                      <h2><?php echo $pc_class->name; ?></h2>

                      <div class="row repeater-row">
                        <div class="col-sm-4 column class_meta">

                          <img src="<?php echo $pc_class->photo ?>" class="img-responsive builder_photo" alt="<?php echo $pc_class->name ?>" title="<?php echo $pc_class->name ?>"/>

                        </div>
                        <div class="col-sm-8 column class_info">

                          <h4>Descriptipn</h4>
                          <?php echo $pc_class->description; ?>


                          <div class="blog-post text-center" style="margin-bottom:3rem;">
                            <a id="select_class" href="#" title="Select Class" data-class="<?php echo $pc_class->name; ?>" data-frag_cost="<?php echo $pc_class->frag_cost; ?>" data-cost-ele="<?php echo strtolower(substr($pc_class->name, 0, 3)); ?>_cost" class="builder_selector blog-post-button state_saver locked">Select <?php echo $pc_class->name; ?></a>
                          </div>

                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>

            </div>

          </div>
        </div>

        <div id="details_section" class="row">
          <div class="col-sm-4">

            <div id="character_data">

              <div class="row">
                <div class="col-xs-4 non_data_fields">
                  <div class="btn_warning text-center mandatory_section" style="margin-bottom:3rem;">
                    <a id="btn_reset" href="#" title="Reset" class="blog-post-button state_saver"><i class="fa fa-trash" aria-hidden="true"></i> Reset</a>
                  </div>
                </div>
                <div class="col-xs-4 non_data_fields">
                  <div class="btn_warning text-center mandatory_section" style="margin-bottom:3rem;">
                    <a id="btn_undo" href="#" title="Undo" class="blog-post-button"><i class="fa fa-undo" aria-hidden="true"></i> Undo</a>
                  </div>
                </div>
                <div class="col-xs-4 non_data_fields">
                  <div class="btn_warning text-center mandatory_section" style="margin-bottom:3rem;">
                    <a id="btn_data_export" href="#" title="Export" class="blog-post-button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Export</a>
                  </div>
                </div>

                <div class="col-xs-12 non_data_fields">

                  <button id="btn_add_blanket" class="btn btn-red state_saver mandatory_section" style="margin: 2rem 0;">
                    Add Blanket of XP
                  </button>
                </div>
              </div>


              <div id="character_section" class="mandatory_section non_data_fields">

                <div class="row">
                  <div class="col-xs-4">
                    <button id="btn_view_char" class="btn-cb-content btn btn-red active" data-tab="Character">
                      Character
                    </button>
                  </div>
                  <div class="col-xs-4">
                    <button id="btn_view_skills" class="btn-cb-content btn btn-red" data-tab="Skills">
                      Skills
                    </button>
                  </div>
                  <div class="col-xs-4">
                    <button id="btn_view_armour" class="btn-cb-content btn btn-red" data-tab="Armour">
                      Armour
                    </button>
                  </div>
                </div>
                <hr />
                <div class="cb_data">
                  <div id="cb_character_details" class="cb_display_content active" data-tab="Character">
                    <h4>Race: <span id="cb_race_show"></span></h4>
                    <h4>Class: <span id="cb_class_show"></span></h4>
                    <h4 id="char_vocation">Vocation: <span id="cb_vocation_show"></span></h4>
                    <h4>Level: <span id="cb_level"></span></h4>
                    <h4>CP Spent: <span id="cb_cp_spent"></span></h4>
                    <h4>CP Available: <span id="cb_cp_avail"></span></h4>
                    <h4>CP Applied per Blanket: <span id="cb_blanket_next"></span></h4>
                    <h4>Blankets Spent: <span id="cb_blankets_spent"></span></h4>
                    <h4>Frags Spent: <span id="cb_frags_spent"></span></h4>
                    <h4>Body Points: <span id="cb_bp"></span></h4>
                    <h4>Skills: <span id="cb_skill_count">0</span></h4>
                  </div>

                  <div id="cb_skill_details" class="cb_display_content" data-tab="Skills">
                    <h4>Skills</h4>
                    <div id="cb_skills"></div>

                  </div>

                  <div id="cb_armour_details" class="cb_display_content"  data-tab="Armour">
                    <h4>Armour</h4>

                  </div>
                </div>
              </div>
            </div><!-- /#character_data -->

            </div>

          <div class="col-sm-8" style="padding:0 4rem;">
            <div id="skills_section" class="mandatory_section">
              <div id="skill_header" class="row">

              <div class="row">
                <div id="legend" class="col-xs-12 closed" style="">
                  <p class="skill_meta">
                    <a href="#" id="legend_close" class="legend_toggler"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close icon legend</a>
                    <a href="#" id="legend_open" class="legend_toggler"><i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp; open icon legend</a>
                  </p>
                  <div id="legend_content" class="row">
                  <?php
                    $legend_items = array(
                      array('shield', 'Warrior Skill'),
                      array('bomb', 'Rogue Skill'),
                      array('magic', 'Scholar Skill'),
                      array('cog', 'Production Skill'),
                      array('users', 'Racial Skill'),
                      array('universal-access', 'Class Skill'),
                      array('diamond', 'Frag Skill'),
                      array('exclamation-triangle', 'Requirement Not Met'),
                      array('info-circle', "Click to view details")
                    );
                   ?>
                   <?php foreach ($legend_items as $li){ ?>
                      <div class="col-sm-4">
                        <div class="col-xs-2 text-center">
                          <i class="fa fa-<?php echo $li[0]?>" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-10 text-left">
                          <?php echo $li[1]; ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div></div>
              </div>

                <div class="col-sm-6 text-center">
                  <h4>Filter</h4>
                  <div class="row">
                    <div class="col-xs-2">
                      <button id="btn_warrior" title="Warrior Skills" data-cat="W" data-cat-string="Warrior" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-shield" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_rogue" title="Rogue Skills" data-cat="R" data-cat-string="Rogue" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-bomb" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_scholar" title="Scholar Skills" data-cat="S" data-cat-string="Scholar" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-magic" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_production" title="Production Skills" data-cat="P" data-cat-string="Production" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_racial" title="Racial Skills" data-cat="A"  data-cat-string="Racial" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-users" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_class" title="Class Skills" data-cat="C" data-cat-string="Class" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-universal-access" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6 text-center">
                  <h4>Toggle</h4>
                  <div class="row">
                    <div class="col-xs-6">
                      <button id="btn_toggle_skills" title="Toggle Available Skills" class="skill_menu btn btn-skill">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-6">
                      <button id="btn_frag" title="Frag Skills" class="skill_menu btn btn-skill">
                        <i class="fa fa-diamond" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6 text-center">
                  <h4>Sort</h4>
                  <div class="row">
                    <div class="col-xs-6">
                      <button id="btn_sort_cost" title="Sort by Cost" class="skill_menu btn-sort btn btn-skill">#</button>
                    </div>
                    <div class="col-xs-6">
                      <button id="btn_sort_name" title="Sort by Name" class="skill_menu btn-sort btn btn-skill active">A-Z</button>
                    </div>
                  </div>
                </div>
              </div>

              <div id="skill_header" class="row">
                <p id="option_string">Showing <span id="filter_string" class="opt">ALL</span> <span id="cat_string" class="opt"></span> skills, sorted by <span id="sort_string" class="opt">NAME</span>.&nbsp;
                <i id="opt-clear" class="fa fa-close" aria-hidden="true"></i></p>
              </div>
              <div id="skill_list" class="row">

              </div>
            </div>
          </div>

          </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinysort/2.3.6/tinysort.js"></script>

        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
        <script type="text/javascript" src="<?php site_url(); ?>/wp-content/themes/illdy/layout/js/character-builder.js"></script>

			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->

<div id="blog">

    <div id="occupation_selector" class="row">

      <div id="occupation-menu" class="col-sm-12 <?php echo (wp_is_mobile()) ? "mobile" : "desktop"; ?>">
        <p><span class="custom-dropdown custom-dropdown--red">
          <select id="occupation-dropdown" class="builder_selector custom-dropdown__select custom-dropdown__select--red">
          <option>Select a Renowned Occupation</option>
            <?php foreach ($occupations as $class) { ?>
              <?php $class_string = ($class->frag_cost > 0) ? $class->name . " (" . $class->frag_cost . " FRAGS)" : $class->name; ?>
              <option value="<?php echo $class->name; ?>"><?php echo $class_string ?></option>
            <?php } ?>
          </select>
        </span></p>
      </div>

      <div id="occupation-content" class="col-sm-12">
        <?php foreach ($occupations as $pc_class) { ?>
          <div class="occupation content repeater-content" data-name="<?php echo $pc_class->name; ?>">
            <h2><?php echo $pc_class->name; ?></h2>

            <div class="row repeater-row">
              <div class="col-sm-4 column class_meta">

                <img src="<?php echo $pc_class->photo ?>" class="img-responsive builder_photo" alt="<?php echo $pc_class->name ?>" title="<?php echo $pc_class->name ?>"/>

              </div>
              <div class="col-sm-8 column class_info">

                <h4>Descriptipn</h4>
                <?php echo $pc_class->description; ?>


                <div class="blog-post text-center" style="margin-bottom:3rem;">
                  <a id="select_occupation" href="#" title="Select Class" data-class="<?php echo $pc_class->name; ?>" data-frag_cost="<?php echo $pc_class->frag_cost; ?>" data-cost-ele="<?php echo strtolower(substr($pc_class->name, 0, 3)); ?>_cost" class="builder_selector occupation blog-post-button state_saver locked">Select <?php echo $pc_class->name; ?></a>
                </div>

              </div>
            </div>
          </div>
        <?php } ?>
      </div>

    </div>
    <div id="vocation_selector" class="row">

      <div id="vocation-menu" class="col-sm-12 <?php echo (wp_is_mobile()) ? "mobile" : "desktop"; ?>">
        <p><span class="custom-dropdown custom-dropdown--red">
          <select id="vocation-dropdown" class="builder_selector custom-dropdown__select custom-dropdown__select--red">
          <option>Select a Vocation</option>
            <?php foreach ($vocations as $class) { ?>
              <?php $class_string = ($class->frag_cost > 0) ? $class->name . " (" . $class->frag_cost . " FRAGS)" : $class->name; ?>
              <option value="<?php echo $class->name; ?>"><?php echo $class_string ?></option>
            <?php } ?>
          </select>
        </span></p>
      </div>

      <div id="occupation-content" class="col-sm-12">
        <?php foreach ($vocations as $pc_class) { ?>
          <div class="vocation content repeater-content" data-name="<?php echo $pc_class->name; ?>">
            <h2><?php echo $pc_class->name; ?></h2>

            <div class="row repeater-row">
              <div class="col-sm-4 column class_meta">

                <img src="<?php echo $pc_class->photo ?>" class="img-responsive builder_photo" alt="<?php echo $pc_class->name ?>" title="<?php echo $pc_class->name ?>"/>

              </div>
              <div class="col-sm-8 column class_info">

                <h4>Descriptipn</h4>
                <?php echo $pc_class->description; ?>


                <div class="blog-post text-center" style="margin-bottom:3rem;">
                  <a id="select_vocation" href="#" title="Select Class" data-class="<?php echo $pc_class->name; ?>" data-frag_cost="0" data-cost-ele="<?php echo strtolower(substr($pc_class->name, 0, 3)); ?>_cost" class="builder_selector vocation blog-post-button state_saver locked">Select <?php echo $pc_class->name; ?></a>
                </div>

              </div>
            </div>
          </div>
        <?php } ?>
      </div>

    </div>



</div>
<?php get_footer(); ?>
