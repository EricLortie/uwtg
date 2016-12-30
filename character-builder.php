

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
            the_content();
            echo '<hr/>';
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>



        <script type="text/javascript">
          var builder_data = {};
          state_counter = 0;
          builder_data.character = {};
          builder_data.character.frags_avail = 0;
          builder_data.character.frags_spent = 0;
          builder_data.character.skill_count = 0;
          builder_data.races = [];
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
            level_data = builder_data.level_chart[level];
            level_data['cp'] += 50;
            builder_data.human_level_chart.push(level_data);
          };
          builder_data.sphere_chart = [
            {'me_cost': 100,'ra_cost': 100, 'te_cost': 75, 'ni_cost': 75, 'as_cost': 100, 'wi_cost': 75, 'ma_cost': 25, 'dr_cost': 50, 'ba_cost': 50},
            {'me_cost': 200,'ra_cost': 200, 'te_cost': 175, 'ni_cost': 175, 'as_cost': 200, 'wi_cost': 175, 'ma_cost': 150, 'dr_cost': 175, 'ba_cost': 175},
            {'me_cost': 300,'ra_cost': 300, 'te_cost': 275, 'ni_cost': 275, 'as_cost': 300, 'wi_cost': 275, 'ma_cost': 200, 'dr_cost': 225, 'ba_cost': 225},
            {'me_cost': "",'ra_cost': "", 'te_cost': "", 'ni_cost': "", 'as_cost': "", 'wi_cost': "", 'ma_cost': "", 'dr_cost': "", 'ba_cost': ""}
          ]

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


        </script>

        <?php if( have_rows('races', get_id_by_slug('codex-races')) ): ?>
          <?php $races = array(); ?>
          <?php while( have_rows('races',get_id_by_slug('codex-races')) ): the_row(); ?>


            <?php // vars
            $name = get_sub_field('name');
            $lifespan = get_sub_field('lifespan');
            $frag_cost = get_sub_field('frag_cost');
            $description = get_sub_field('description');
            $racial_characteristics = get_sub_field('racial_characteristics');
            $advantages = get_sub_field('advantages');
            $disadvantages = get_sub_field('disadvantages');

            array_push($races, array($name, $frag_cost));

            ?>

            <script type="text/javascript">
              builder_data.races[`<?php echo $name; ?>`] = {
                name: `<?php echo $name ?>`,
                lifespan: `<?php echo $lifespan ?>`,
                racial_characteristics: `<?php echo $racial_characteristics ?>`,
                description: `<?php echo $description ?>`,
                advantages: `<?php echo $advantages ?>`,
                disadvantages: `<?php echo $disadvantages ?>`,
                frag_cost: `<?php  echo $frag_cost; ?>`
              }
            </script>

          <?php endwhile; ?>
          <?php usort($races, 'sortByOption'); ?>
        <?php endif; ?>

        <?php if( have_rows('classes', get_id_by_slug('codex-classes')) ): ?>
          <?php $classes = array(); ?>
          <?php while( have_rows('classes', get_id_by_slug('codex-classes')) ): the_row(); ?>

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

            $optional = get_sub_field('optional_fields');
            $multiple = false;
            if ( $optional && in_array('multiple', $optional) ) {
              $multiple = true;
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
                //skill_row.data('frag', `<?php echo $frag_cost ?>`),

                <?php if($prereq != ''){ ?>
                  skill_row.addClass('has_req');
                  skill_row.addClass('locked');
                <?php } ?>

                //console.log('<?php echo $name; ?>: ' + builder_data.skill_aliases['<?php echo $name; ?>']);
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
                  jQuery('#skill_list').append(skill_row);
                }

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

              jQuery('.skill_add').on('click', function(){
                if(jQuery(this).hasClass('spell_sphere_add')) {
                  update_spell_spheres();
                }
                add_skill_to_character(jQuery(this).closest('.skill_row'));
              });

              jQuery('#btn_reset').on('click', function(){
                jQuery('.mandatory_section').hide();
                jQuery('#character_section').hide();
                jQuery('#data_fields').hide();
                jQuery('.non_data_fields:not(#character_section)').show();
                jQuery('#btn_generate').show();
                jQuery('#btn_generate').addClass('locked');
                jQuery('#cb_selectors').show();
                jQuery('#cb-race').val('');
                jQuery('#cb_race_show').html('');
                jQuery('#cb-class').val('');
                jQuery('#cb_class_show').html('');
                jQuery('#cb-race').attr('disabled', false);
                jQuery('#cb-class').attr('disabled', false);
                reset_character();
                reset_skills();
              });

              jQuery('select.mandatory').on('change', function(){

                if (jQuery('#cb-class').val() != '' && jQuery('#cb-race').val() != '') {
                  jQuery('#btn_generate').removeClass('locked');
                } else {
                  jQuery('#btn_generate').addClass('locked');
                  jQuery('#btn_generate').show();
                }
              });

              jQuery('#cb-race').on('change', function(){
                builder_data.character.frags_spent = 0;
                builder_data.character.race = jQuery(this).val();
                jQuery('#cb_race_show').html(jQuery(this).val());
                builder_data.character.frags_spent = parseInt(jQuery(this).find('option:selected').data('fragCost'));
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

                jQuery('#cb_class_show').html(jQuery(this).val());
                jQuery('.skill_cost').hide();
                jQuery('.' + jQuery(this).find('option:selected').data('cost-ele')).show();
              });

              jQuery('#btn_generate').on('click', function(e){
                e.preventDefault();
                if (jQuery('#cb-class').val() != '' && jQuery('#cb-race').val() != '') {
                  reset_character();
                  jQuery('.mandatory_section').show();
                  jQuery(this).hide();
                  jQuery('#cb_selectors').hide();
                  jQuery('#cb-race').attr('disabled', true);
                  jQuery('#cb-class').attr('disabled', true);
                }
              });

              jQuery('.state_saver').on('click', function(e){
                e.preventDefault();
                set_state();
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

              jQuery('#btn_sort_cost').on('click', function(){
                toggleSort('cost');
              });

              jQuery('#btn_sort_name').on('click', function(){
                toggleSort('name');
              });

              function toggleSort(type) {
                jQuery('.btn-sort').toggleClass('active');
                if(type == "name"){
                  jQuery('#sort_string').html('NAME');
                  tinysort('.skill_row', 'span.name');
                } else {
                  jQuery('#sort_string').html('COST');
                  tinysort('.skill_row', {data:'cost'});
                }
              }

              jQuery('#btn_toggle_skills').on('click', function(){
                if(jQuery('#skill_list').hasClass('avail_only')){
                  jQuery('#filter_string').html("AVAILABLE");
                } else {
                    jQuery('#filter_string').html("ALL");
                }
                jQuery(this).toggleClass('active');
                jQuery('#skill_list').toggleClass('avail_only');
              });

              jQuery('.btn-cat').on('click', function(){
                var cat = jQuery(this).data('cat');
                var cat_string = jQuery(this).data('catString');
                jQuery('#skill_list').removeClass('S');
                jQuery('#skill_list').removeClass('W');
                jQuery('#skill_list').removeClass('R');
                jQuery('#skill_list').removeClass('P');
                jQuery('#skill_list').removeClass('A');
                jQuery('#skill_list').removeClass('C');
                jQuery('.btn-cat').removeClass('active');
                jQuery(this).addClass('active');
                jQuery('#skill_list').addClass(cat);
                jQuery('#cat_string').html(cat_string);

              });

              jQuery('#opt-clear').on('click', function(){
                jQuery('#filter_string').html("ALL");
                jQuery('#skill_list').removeClass('avail_only');
                jQuery('#skill_list').removeClass('S');
                jQuery('#skill_list').removeClass('W');
                jQuery('#skill_list').removeClass('R');
                jQuery('#skill_list').removeClass('P');
                jQuery('#skill_list').removeClass('A');
                jQuery('#skill_list').removeClass('C');
                jQuery('.btn-cat').removeClass('active');
                jQuery('#cat_string').html("");
                jQuery('#sort_string').html('NAME');
                tinysort('.skill_row', 'span.name');
              });


              function add_skill_to_character(skill_ele){

                if(skill_ele.data('multiple') == ""){
                  skill_ele.addClass('purchased');
                  skill_ele.find('.skill_add').hide();
                  skill_ele.find('.skill_purchased').slideToggle();
                  skill_ele.addClass('purchased');
                }
                if(skill_ele.data('sphere')){
                  builder_data.character.spell_spheres += 1;
                }
                if(builder_data.character.skills.hasOwnProperty(skill_ele.data('name'))) {
                  builder_data.character.skills[skill_ele.data('name')] += 1;
                } else {
                  builder_data.character.skills[skill_ele.data('name')] = 1;
                }
                var skill_cost = parseInt(skill_ele.find('.' + jQuery("#cb-class").find('option:selected').data('cost-ele')).html());

                builder_data.character.cp_avail -= skill_cost;
                builder_data.character.cp_spent += skill_cost;
                builder_data.character.skill_count += 1
                jQuery('#cb_skill_count').html(builder_data.character.skill_count);
                update_character();
                update_skills();
              }

              function reset_character() {

                builder_data.character.level = 1;
                builder_data.character.blankets_spent = 0;
                builder_data.character.cp_avail = 150;
                if(builder_data.character.race == "Human"){
                  builder_data.character.cp_avail = 200;
                  builder_data.character.level_data = builder_data.human_level_chart[0];
                } else {
                  builder_data.character.level_data = builder_data.level_chart[0];
                }

                builder_data.character.spell_spheres = 0;
                builder_data.character.cp_spent = 0;
                builder_data.character.cp_total = 0;
                builder_data.character.blanket_value = builder_data.character.level_data.cppb;
                builder_data.character.body_points = builder_data.character.level_data['bp_' + builder_data.type];
                builder_data.character.skills = {};

                jQuery('span:contains("Weapon Group Proficiency: Simple")').closest('.skill_row').find('.skill_add').trigger('click');

                update_character();

                tinysort('.skill_row', 'span.name');

              }

              function update_character(){
                jQuery('#cb_race_show').html(builder_data.character.race);
                jQuery('#cb_class_show').html(builder_data.character.class);
                jQuery('#cb_blankets_spent').html(builder_data.character.blankets_spent);
                jQuery('#cb_blanket_next').html(builder_data.character.blanket_value);
                jQuery('#cb_cp_avail').html(builder_data.character.cp_avail);
                jQuery('#cb_level').html(builder_data.character.level);
                jQuery('#cb_cp_spent').html(builder_data.character.cp_spent);
                jQuery('#cb_frags_spent').html(builder_data.character.frags_spent);
                jQuery('#cb_bp').html(builder_data.character.body_points);
                jQuery('#cb_skills').html(output_skills(builder_data.character.skills));
                jQuery('#cb_skill_count').html(builder_data.character.skill_count);

                builder_data.character.sphere_cost = builder_data.sphere_chart[builder_data.character.spell_spheres][jQuery('#cb-class').find('option:selected').data('cost-ele')];

                jQuery('.sphere_cost').show();
                jQuery('.sphere_cost').closest('.skill_row').attr('data-cost', builder_data.character.sphere_cost)
                jQuery('.sphere_cost').html(builder_data.character.sphere_cost);

                update_skills();

              }

              function set_state(){
                state_counter += 1;
                jQuery('#btn_undo').removeClass('locked');
                builder_data.character_states.unshift({'count': state_counter, 'character': jQuery.extend(true, {}, builder_data.character)});
                if(builder_data.character_states.length > 5){
                  builder_data.character_states.splice(4, 1);
                }
              }

              jQuery('#btn_undo').on('click', function(e){
                e.preventDefault();
                if(!jQuery(this).hasClass('locked')){
                  undo();
                }
              });

              function undo() {
                builder_data.character = jQuery.extend(true, {}, builder_data.character_states[0]['character']);
                builder_data.character_states.splice(0, 1);
                if(builder_data.character_states.length == 0){
                  jQuery('#btn_undo').addClass('locked');
                }
                update_character();
                update_skills();
              }

              function output_skills(skills) {
                html = "<ul>";
                for (skill in skills) {
                  if (skills.hasOwnProperty(skill)) {
                    var skill_string = skill;
                    if(skills[skill] > 1) {
                      skill_string = skill_string + " X" + skills[skill];
                    }
                    html += "<li>"+skill_string + "</li>";
                  }
                }
                html += "</ul>";
                return html;
              }

              function update_skills() {
                jQuery('.skill_row').each(function(){
                  var cost = parseInt(jQuery(this).find('.' + jQuery("#cb-class").find('option:selected').data('cost-ele')).html());
                  if(typeof jQuery(this).attr('data-cost') == 'undefined'){
                    jQuery(this).attr('data-cost', cost);
                  }
                  var has_req = (jQuery(this).data('requirements') != "");
                  var spell_circle = is_spell_circle(jQuery(this).find('span.name').html());
                  if (cost > builder_data.character.cp_avail
                      || (jQuery(this).hasClass('purchased') && character_has_skill(jQuery(this).find('span.name').html()))
                      || (!spell_circle && has_req && !meets_req(jQuery(this)))
                      || (spell_circle && !has_circle_req(jQuery(this).find('span.name').html()))) {
                        jQuery(this).find('.skill_add').hide();
                        jQuery(this).addClass('locked');
                  } else {
                    jQuery(this).find('.skill_add').show();
                    jQuery(this).find('.skill_purchased').hide();
                    jQuery(this).removeClass('locked');
                    jQuery(this).removeClass('purchased');
                  }
                  jQuery(this).data('cost', cost);
                });

              }

              function character_has_skill(skill){
                if(builder_data.character.skills[skill] > 0){
                  return true;
                }
                return false;
              }

              function is_spell_circle(skill){
                circle_search = builder_data.circles.indexOf(skill);
                if(circle_search != -1){
                  return true;
                }
                return false;
              }

              function has_circle_req(skill) {
                cur_circle = builder_data.circles.indexOf(skill);
                prev_circle = builder_data.circles[cur_circle-1];
                skills = builder_data.character.skills;
                prev_skill_count = skills[prev_circle];
                cur_skill_count = skills[skill];
                if(typeof cur_skill_count == 'undefined'){
                  cur_skill_count = 0;
                }
                if (cur_skill_count >= 5) {
                  return false;
                } else if (skill == "Spell Slot: Ritual Base" && skills["Read Magic: Ritual"] == 1 && skills["Spell Slot: 9th Circle"] >= 1) {
                  return true;
                } else if(skill == "Spell Slot: 1st Circle" && builder_data.character.spell_spheres == 1){
                  return true;
                } else if (skill != "Spell Slot: 5th Circle" && skill != "Spell Slot: Ritual Base" && circle_math_req(prev_skill_count, cur_skill_count)) {
                  return true;
                } else if (skill == "Spell Slot: 5th Circle" && skill != "Spell Slot: Ritual Base" && skills["Read Magic: Advanced"] == 1 && circle_math_req(prev_skill_count, cur_skill_count)){
                  return true;
                }
                return false;
              }

              function circle_math_req(prev_skill_count, cur_skill_count){
                return ((prev_skill_count > (cur_skill_count+1)) || prev_skill_count == 5)
              }

              function meets_req(skill_row){
                var req = skill_row.data('requirements')
                reqs = [];
                var times_2 = false;
                var times_x = false;

                if(typeof req !== 'undefined' && req != ""){
                  items = req.split(', ');
                  for (req in items) {
                    items[req] = set_req_alias(items[req], skill_row.find('span.name').html());

                    if (items.hasOwnProperty(req)) {
                      var conditionals = items[req].split(" OR ");
                      for (subreq in conditionals) {
                        if (conditionals.hasOwnProperty(subreq)) {
                          reqs.push(conditionals[subreq]);
                          if(conditionals[subreq] == "*2"){
                            times_2 = true;
                          } else if (conditionals[subreq] == "*x"){
                            times_x = true;
                          }
                        } else {
                          if(conditionals[subreq] == "*2"){
                            times_2 = true;
                          } else if (conditionals[subreq] == "*x"){
                            times_x = true;
                          }
                          reqs.push(subreq);
                        }
                      }
                    } else {
                      reqs.push(req);
                    }
                  }

                  char_skills = builder_data.character.skills;
                  for (i = 0; i < reqs.length; i++) {
                    if(reqs[i] == "Spell Sphere: Elemental" && char_skills["Elemental Attunement"] >=4){
                      return false;
                    }
                    if(char_skills.hasOwnProperty(reqs[i])){
                      skill_row.find('.skill_req').hide();
                      return true;
                    }
                    if(reqs[i] == "Sphere of Magic: 1st" && builder_data.character.spell_spheres > 0){
                      return true;
                    }
                  }
                } else {
                  return false;
                }
                return false;
              }

              function set_req_alias(req, skill) {
                switch(req) {
                  case "Elemental Sphere":
                    return "Spell Sphere: Elemental";
                    break;
                  case "Weapon Group Proficiency":
                  case "Group Proficiency":
                    switch(skill) {
                      case "Critical +2: Specific Simple Weapon":
                      case "Critical +2: Simple Group":
                      case "Specialization +1: Simple Group":
                      case "Specialization +1: Simple Weapon":
                        return "Weapon Group Proficiency: Simple";
                        break;
                      case "Critical +2: Specific Medium Weapon":
                      case "Critical +2: Medium Group":
                      case "Specialization +1: Medium Group":
                      case "Specialization +1: Medium Weapon":
                        return "Weapon Group Proficiency: Medium";
                        break;
                      case "Critical +2: Specific Large Weapon":
                      case "Critical +2: Large Group":
                      case "Specialization +1: Large Group":
                      case "Specialization +1: Large Weapon":
                        return "Weapon Group Proficiency: Large";
                        break;
                      case "Critical +2: Specific Exotic Weapon":
                      case "Critical +2: Exotic Group":
                      case "Specialization +1: Exotic Group":
                      case "Specialization +1: Exotic Weapon":
                        return "Weapon Group Proficiency: Exotic";
                        break;
                      }
                    case "Specialization +1: Weapon Group":
                      switch(skill) {
                        case "Slay / Parry: Specific Simple Weapon":
                          return "Specialization +1: Simple Group"
                        case "Slay / Parry: Specific Medium Weapon":
                          return "Specialization +1: Medium Group"
                        case "Slay / Parry: Specific Large Weapon":
                          return "Specialization +1: Large Group"
                        case "Slay / Parry: Specific Exotic Weapon":
                          return "Specialization +1: Exotic Group"
                      }
                    case "Specialization +1: Weapon Specific":
                      switch(skill) {
                        case "Slay / Parry":
                          return "Specialization +1: Simple Weapon"
                      }
                  case "Critical +2: Specific":
                    switch(skill) {
                      case "Execute: Specific Simple Weapon":
                        return "Critical +2: Specific Simple Weapon";
                        break;
                      case "Execute: Specific Medium Weapon":
                        return "Critical +2: Specific Medium Weapon";
                        break;
                      case "Execute: Specific Large Weapon":
                        return "Critical +2: Specific Large Weapon";
                        break;
                      case "Execute: Specific Exotic Weapon":
                        return "Critical +2: Specific Exotic Weapon";
                        break;
                    }
                  case "Critical +2: Group":
                    switch(skill) {
                      case "Execute: Simple Weapon Group":
                        return "Critical +2: Simple Group";
                        break;
                      case "Execute: Medium Weapon Group":
                        return "Critical +2: Medium Group";
                        break;
                      case "Execute: Large Weapon Group":
                        return "Critical +2: Large Group";
                        break;
                      case "Execute: Exotic Weapon Group":
                        return "Critical +2: Exotic Group";
                        break;
                    }
                  case "Execute":
                    switch(skill) {
                      case "Execute: Specific Simple Weapon (Subsequent)":
                        return "Execute: Specific Simple Weapon";
                        break;
                      case "Execute: Specific Medium Weapon (Subsequent)":
                        return "Execute: Specific Medium Weapon";
                        break;
                      case "Execute: Specific Large Weapon (Subsequent)":
                        return "Execute: Specific Large Weapon";
                        break;
                      case "Execute: Specific Exotic Weapon (Subsequent)":
                        return "Execute: Specific Exotic Weapon";
                        break;
                    }

                }
                return req;
              }

              function reset_skills(){

                builder_data.character.skill_count = 0;
                jQuery('#cb_skill_count').html(0);
                jQuery('.skill_row').removeClass('locked');
                jQuery('.skill_row').removeClass('purchased');
                jQuery('.skill_req').show();
                jQuery('.skill_add').show();
                jQuery('.skill_purchased').hide();
              }

              function update_spell_spheres(){

                builder_data.character.spell_spheres++;

                if(builder_data.character.spell_spheres == 3) {
                  jQuery('.spell_sphere').addClass('purchased');
                }
              }
              jQuery('.btn-cb-content ').on('click', function(){
                jQuery('.btn-cb-content').toggleClass('active');
                jQuery('.cb_display_content').toggleClass('active');
              });

              jQuery('.legend_toggler').on('click', function(e){
                e.preventDefault();
                jQuery('#legend').toggleClass('opened').toggleClass('closed');
              });

              jQuery('#btn_data_export, #btn_data_import').on('click', function(e){
                e.preventDefault();
                jQuery('.non_data_fields').hide();
                jQuery('#cb_selectors').hide();
                jQuery('#data_fields').show();
              });
              jQuery('#btn_data_export').on('click', function(e){
                e.preventDefault();
                jQuery('#data_fields_export').show();
                jQuery('#data_fields_import').hide();
              });
              jQuery('#btn_data_import').on('click', function(e){
                e.preventDefault();
                jQuery('#data_fields_export').hide();
                jQuery('#data_fields_import').show();
              });
              jQuery('#btn_close_data').on('click', function(e){
                e.preventDefault();
                console.log(builder_data.character);
                if(builder_data.character['skill_count'] == 0){
                  jQuery('#btn_reset').trigger('click');
                } else {
                  jQuery('.non_data_fields').show();
                  jQuery('#data_fields').hide();
                  jQuery('#char_export_code').val("");
                  jQuery('#data_import').val("");
                  jQuery('.mandatory_section').show();
                  jQuery('#btn_generate').hide();
                  jQuery('#cb_selectors').hide();
                }
              });

              jQuery('#generate_export').on('click', function(e){
                e.preventDefault();
                jQuery('#char_export_code').val(JSON.stringify(builder_data.character));
              });
              jQuery('#process_import').on('click', function(e){
                e.preventDefault();
                var char_import = jQuery('#data_import').val();
                jQuery('.non_data_fields').show();
                jQuery('#data_fields').hide();
                jQuery('#char_export_code').val("");
                jQuery('#data_import').val("");
                jQuery('.mandatory_section').show();
                jQuery('#btn_generate').hide();
                jQuery('#cb_selectors').hide();
                var parsed_char = JSON.parse(char_import);
                builder_data.character = parsed_char;
                jQuery("#cb-class").val(builder_data.character.class);
                jQuery("#cb-race").val(builder_data.character.race);

                update_character();
                update_skills();
              });

              // Cache selectors outside callback for performance.
              var $window = jQuery(window),
                  $stickyEl = jQuery('#character_data'),
                  elTop = $stickyEl.offset().top;

              $window.scroll(function() {
                if(!jQuery('header#header').hasClass('mobile')){
                   $stickyEl.toggleClass('sticky', $window.scrollTop() > elTop);
                 }
               });

              $stickyEl.css({'max-width': $stickyEl.width()});
              $stickyEl.css({'width': $stickyEl.width()});

            });
          </script>

        <?php endif; ?>

        <div class="row">
          <div class="col-sm-4">

            <div id="character_data">
              <div id="cb_selectors">
                <label>Select Your Race</label>
                <select id="cb-race" class="gen-opt mandatory">
                  <option value="">Please select a race</option>
                  <?php foreach ($races as $race) { ?>
                    <?php
                    $name = $race[0];
                    $frag_string = "";
                    if($race[1] != null){
                      $frag_string = "({$race[1]} FRAGS)";
                    }
                    ?>

                    <option value="<?php echo $name; ?>" data-frag-cost="<?php echo $race[1]; ?>"><?php echo $name . " " . $frag_string; ?></option>
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
                  <a id="btn_generate" href="#" title="Build Character" class="blog-post-button state_saver locked">Start Character</a>
                </div>

                <p class="text-center">- OR -</p>

                <div class="btn_warning text-center" style="margin-bottom:3rem;">
                  <a id="btn_data_import" href="#" title="Import" class="blog-post-button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Import</a>
                </div>
              </div>

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
                <div id="data_fields" class="col-xs-12">
                  <div id="data_fields_export">
                    <label>Click the button below to generate your character export. Copy and paste it into a word document to save it.</label>
                    <input type="text" id="char_export_code" disabled="disabled" />
                    <button id="generate_export" class="btn btn-red btn_process_data">Generate Export</button>
                  </div>
                  <div id="data_fields_import">
                    <label>Paste your character data here. Click import to load this character.</label>
                    <input type="text" id="data_import"/>
                    <button id="process_import" class="btn btn-red btn_process_data">Process Import</button>
                  </div>

                  <div class="row">
                    <div class="col-xs-12">
                      <button id="btn_close_data" class="btn btn-red">Back</button>
                    </div>
                  </div>

                </div>
                <div class="col-xs-12 non_data_fields">

                  <button id="btn_add_blanket" class="btn btn-red state_saver mandatory_section">
                    Add Blanket of XP
                  </button>
                </div>
              </div>

              <hr />

              <div id="character_section" class="mandatory_section non_data_fields">

                <div class="row">
                  <div class="col-xs-6">
                    <button id="btn_view_char" class="btn-cb-content btn btn-red active">
                      Character
                    </button>
                  </div>
                  <div class="col-xs-6">
                    <button id="btn_view_skills" class="btn-cb-content btn btn-red">
                      Skills
                    </button>
                  </div>
                </div>
                <hr />
                <div class="cb_data">
                  <div id="cb_character_details" class="cb_display_content active">
                    <h4>Race: <span id="cb_race_show"></span></h4>
                    <h4>Class: <span id="cb_class_show"></span></h4>
                    <h4>Level: <span id="cb_level"></span></h4>
                    <h4>CP Spent: <span id="cb_cp_spent"></span></h4>
                    <h4>CP Available: <span id="cb_cp_avail"></span></h4>
                    <h4>Blankets Value: <span id="cb_blanket_next"></span></h4>
                    <h4>Blankets Spent: <span id="cb_blankets_spent"></span></h4>
                    <h4>Frags Spent: <span id="cb_frags_spent"></span></h4>
                    <h4>Body Points: <span id="cb_bp"></span></h4>
                    <h4>Skills: <span id="cb_skill_count">0</span></h4>
                  </div>

                  <div id="cb_skill_details" class="cb_display_content">
                    <h4>Skills</h4>
                    <div id="cb_skills"></div>

                  </div>
                </div>
              </div>
            </div><!-- /#character_data -->
          </div><!-- /#character_container -->

          <div class="col-sm-8">
            <div id="skills_section" class="mandatory_section">
              <div id="skill_header" class="row">

              <div class="row">
                <div id="legend" class="col-xs-12 closed" style="">
                  <p class="skill_meta">
                    <a href="#" id="legend_close" class="legend_toggler"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close legend</a>
                    <a href="#" id="legend_open" class="legend_toggler"><i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp; open legend</a>
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
                      array('exclamation-triangle', 'Requirement Not Met'),
                      array('info-circle', "Click to view details")
                    );
                   ?>
                   <?php foreach ($legend_items as $li){ ?>
                      <div class="col-sm-4">
                        <div class="col-xs-3 text-center">
                          <i class="fa fa-<?php echo $li[0]?>" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-9 text-left">
                          <?php echo $li[1]; ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div></div>
              </div>

                <div class="col-sm-6 text-center">
                  <h4>Class</h4>
                  <div class="row">
                    <div class="col-xs-2">
                      <button id="btn_warrior" data-cat="W" data-cat-string="Warrior" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-shield" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_rogue" data-cat="R" data-cat-string="Rogue" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-bomb" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_scholar" data-cat="S" data-cat-string="Scholar" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-magic" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_production" data-cat="P" data-cat-string="Production" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_racial" data-cat="A"  data-cat-string="Racial" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-users" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="col-xs-2">
                      <button id="btn_class" data-cat="C" data-cat-string="Class" class="skill_menu btn-cat btn btn-skill">
                        <i class="fa fa-universal-access" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6 text-center">
                  <h4>Available</h4>
                  <div class="row">
                    <div class="col-xs-12">
                      <button id="btn_toggle_skills" class="skill_menu btn btn-skill">Toggle</button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6 text-center">
                  <h4>Sort</h4>
                  <div class="row">
                    <div class="col-xs-6">
                      <button id="btn_sort_cost" class="skill_menu btn-sort btn btn-skill">#</button>
                    </div>
                    <div class="col-xs-6">
                      <button id="btn_sort_name" class="skill_menu btn-sort btn btn-skill active">A-Z</button>
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

			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
