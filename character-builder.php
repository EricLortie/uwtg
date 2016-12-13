

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
          builder_data.character.frags_avail = 0;
          builder_data.character.frags_spent = 0;
          builder_data.races = [];
          builder_data.pc_classes = [];
          builder_data.spell_spheres = [];
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
              'Specialization +1: Simple',
              'Specialization +1: Medium',
              'Specialization +1: Large',
              'Specialization +1: Exotic',
            ]
          }


        </script>

        <?php if( have_rows('races', get_id_by_slug('codex-races')) ): ?>
          <?php $races = []; ?>
          <?php while( have_rows('races',get_id_by_slug('codex-races')) ): the_row(); ?>


            <?php // vars
            $name = get_sub_field('name');
            $lifespan = get_sub_field('lifespan');
            $frag_cost = get_sub_field('frag_cost');
            $description = get_sub_field('description');
            $racial_characteristics = get_sub_field('racial_characteristics');
            $advantages = get_sub_field('advantages');
            $disadvantages = get_sub_field('disadvantages');

            array_push($races, [$name, $frag_cost]);

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
          <?php $classes = []; ?>
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
          <?php while( have_rows('spell_spheres', get_id_by_slug('codex-magic')) ): the_row(); ?>

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
                var skill_row = jQuery('<div class="row skill_row spell_sphere"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="col-xs-1">
                    <i class="fa fa-plus-square skill_add spell_sphere_add" aria-hidden="true"></i>
                    <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                  </div>
                  <div class="col-xs-11">
                    <span class="name"><?php echo $name; ?></span>
                    &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                    <?php if($prereq != ""){ ?>
                      &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                    <?php } ?>
                    &nbsp;
                    <span class="sphere_cost skill_cost"></span>

                  </div>
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
                `);

                skill_row.data('name', `<?php echo $name ?>`),
                skill_row.data('description', `<?php echo $description ?>`),
                skill_row.data('requirements', `Read Magic`),
                skill_row.data('multiple', `<?php echo $multiple ?>`),
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
            $description = get_sub_field('description');
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
                var skill_row = jQuery('<div class="row skill_row"><div class="col-sm-12 skill" style=""></div></div>');
                var skill_ele = skill_row.find('.skill');
                skill_ele.append(`
                  <div class="col-xs-1">
                    <i class="fa fa-plus-square skill_add" aria-hidden="true"></i>
                    <i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
                  </div>
                  <div class="col-xs-11">
                    <span class="name"><?php echo $name; ?></span>
                    &nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                    <?php if($prereq != ""){ ?>
                      &nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
                    <?php } ?>
                    &nbsp;
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
                    <?php if ($prereq != "") { ?>
                      <p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Requirements: <?php echo $prereq; ?></p>
                    <?php } ?>
                    <p>Multiple Purchases: <?php echo (($multiple) ? "Yes" : "No"); ?></p>
                    <?php echo $description; ?>
                    <hr />
                    <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                  </div>
                `);

                skill_row.data('name', `<?php echo $name ?>`),
                skill_row.data('description', `<?php echo $description ?>`),
                skill_row.data('requirements', `<?php echo $prereq ?>`),
                skill_row.data('multiple', `<?php echo $multiple ?>`),
                //skill_row.data('frag', `<?php echo $frag_cost ?>`),
                // skill_row.data('mercenary_cost', `<?php echo $mercenary_cost ?>`),
                // skill_row.data('ranger_cost', `<?php echo $ranger_cost ?>`),
                // skill_row.data('templar_cost', `<?php echo $templar_cost ?>`),
                // skill_row.data('nightblade_cost', `<?php echo $nightblade_cost ?>`),
                // skill_row.data('assassin_cost', `<?php echo $assassin_cost ?>`),
                // skill_row.data('witchhunter_cost', `<?php echo $witchhunter_cost ?>`),
                // skill_row.data('mage_cost', `<?php echo $mage_cost ?>`),
                // skill_row.data('druid_cost', `<?php echo $druid_cost ?>`),
                // skill_row.data('bard_cost', `<?php echo $bard_cost ?>`)

                <?php if($prereq != ''){ ?>
                  skill_row.addClass('has_req');
                  skill_row.addClass('locked');
                <?php } ?>

                has_alias = jQuery.grep(builder_data.skill_aliases, function(e){ console.log(e.id); return e.id == '<?php echo $name; ?>'; });
                if(has_alias.length > 0){
                  console.log('has_alias');
                  console.log(has_alias);
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
                jQuery('#btn_generate').show();
                jQuery('#cb-race').val('');
                jQuery('#cb-class').val('');
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

                jQuery('.skill_cost').hide();
                jQuery('.' + jQuery(this).find('option:selected').data('cost-ele')).show();
              });

              jQuery('#btn_generate').on('click', function(e){
                e.preventDefault();
                reset_character();
                jQuery('.mandatory_section').show();
                jQuery(this).hide();
                jQuery('#cb-race').attr('disabled', true);
                jQuery('#cb-class').attr('disabled', true);
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
                tinysort('.skill_row', {data:'cost'});
              });

              jQuery('#btn_sort_name').on('click', function(){
                tinysort('.skill_row', 'span.name');
              });

              // jQuery('#btn_toggle_skills').on('click', function(){
              //   jQuery('.locked:not(purchased)').toggle();
              // });


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
                update_character();
                update_skills();
              }

              function reset_character() {

                builder_data.character.level = 1;
                builder_data.character.blankets_spent = 0;
                builder_data.character.cp_avail = 150;
                if(builder_data.character.race == "Human"){
                  builder_data.character.cp_avail = 200;
                }

                builder_data.character.spell_spheres = 0;
                builder_data.character.cp_spent = 0;
                builder_data.character.cp_total = 0;
                builder_data.character.level_data = builder_data.level_chart[0];
                builder_data.character.blanket_value = builder_data.character.level_data.cppb;
                builder_data.character.body_points = builder_data.character.level_data['bp_' + builder_data.type];
                builder_data.character.skills = {};

                jQuery('span:contains("Weapon Group Proficiency: Simple")').closest('.skill_row').find('.skill_add').trigger('click');

                update_character();

                tinysort('.skill_row', 'span.name');

              }

              function update_character(){
                jQuery('#cb_blankets_spent').html(builder_data.character.blankets_spent);
                jQuery('#cb_blanket_next').html(builder_data.character.blanket_value);
                jQuery('#cb_cp_avail').html(builder_data.character.cp_avail);
                console.log(builder_data.character.cp_avail);
                jQuery('#cb_level').html(builder_data.character.level);
                jQuery('#cb_cp_spent').html(builder_data.character.cp_spent);
                jQuery('#cb_frags_spent').html(builder_data.character.frags_spent);
                jQuery('#cb_bp').html(builder_data.character.body_points);
                jQuery('#cb_skills').html(output_skills(builder_data.character.skills));

                builder_data.character.sphere_cost = builder_data.sphere_chart[builder_data.character.spell_spheres][jQuery('#cb-class').find('option:selected').data('cost-ele')];

                jQuery('.sphere_cost').show();
                jQuery('.sphere_cost').closest('.skill_row').attr('data-cost', builder_data.character.sphere_cost)
                jQuery('.sphere_cost').html(builder_data.character.sphere_cost);

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
                  if(typeof jQuery(this).attr('data-cost') == undefined){
                    jQuery(this).attr('data-cost', cost);
                  }
                  var has_req = (jQuery(this).data('requirements') != "");
                  if (cost > builder_data.character.cp_avail || jQuery(this).hasClass('purchased') || (has_req && !meets_req(jQuery(this)))) {
                    jQuery(this).find('.skill_add').hide();
                    jQuery(this).addClass('locked');
                  } else {
                    jQuery(this).find('.skill_add').show();
                    jQuery(this).removeClass('locked');
                  }
                  jQuery(this).data('cost', cost);
                });

              }

              function meets_req(skill_row){
                var req = skill_row.data('requirements')
                reqs = [];
                var times_2 = false;
                var times_x = false;

                if(req != ""){
                  items = req.split(', ');
                  for (req in items) {
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
                    if(char_skills.hasOwnProperty(reqs[i])){
                      skill_row.find('.skill_req').hide();
                      return true;
                    }
                  }
                } else {
                  return false;
                }
                return false;
              }

              function reset_skills(){
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
              <a id="btn_generate" href="#" title="Build Character" class="blog-post-button locked">Start Character</a>
            </div>

            <div class="blog-post text-center mandatory_section" style="margin-bottom:3rem;">
              <a id="btn_reset" href="#" title="Reset" class="blog-post-button">Reset Character</a>
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
              <br />
              <h4>Skills</h4>
              <div id="cb_skills"></div>

              <hr />
            </div>

          </div>
          <div class="col-sm-8">
            <div id="skills_section" class="mandatory_section">
              <div id="skill_header" class="row">
                <!--
                  <div class="col-xs-4 text-center">
                          <button id="btn_toggle_skills" class="skill_menu btn">Toggle Available</button>
                  </div>
                -->
                <div class="col-xs-2"></div>
                <div class="col-xs-4 text-center">
                  <button id="btn_sort_name" class="skill_menu btn btn-danger">Sort by Name</button>
                </div>
                <div class="col-xs-4 text-center">
                  <button id="btn_sort_cost" class="skill_menu btn btn-danger">Sort by Cost</button>
                </div>
                <div class="col-xs-2"></div>
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
<link rel="javascript"
<?php get_footer(); ?>
