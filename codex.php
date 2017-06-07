

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
		<div class="col-xs-12">
			<section id="blog">

        <?php $races = array(); ?>
        <?php $classes = array(); ?>
        <?php $vocations = array(); ?>
        <?php $occupations = array(); ?>
				<?php
				if( have_posts() ):
					while( have_posts() ):
            $slug = get_post_field( 'post_name' );
						the_post();
            the_content();
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
        <br/>
        <script type="text/javascript">
          var builder_data = {};
          builder_data.character = {};
          builder_data.character.class = "";
          builder_data.character.race = "";
          builder_data.character.skills = {};
          builder_data.character.class_skills = {};
          builder_data.character.frags_avail = 0;
          builder_data.character.frags_spent = 0;
          builder_data.character.skill_count = 0;
          builder_data.races = [];
          builder_data.vocations = [];
          builder_data.occupations = [];
          builder_data.pc_classes = [];
          builder_data.spell_spheres = [];
          builder_data.character_states = [];
          builder_data.skills = [];
        </script>

        <p><i class="fa fa-info-circle" aria-hidden="true"></i>: Click for info</p>
        <p><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i>: Work in progress. Description missing.</p>


        <?php if($slug == "codex-spells" || $slug == 'codex-frag-spells'): ?>
        <?php $spell_spheres = []; ?>

            <?php if( have_rows('spells', get_id_by_slug('codex-spells')) ): ?>
              <?php while( have_rows('spells', get_id_by_slug('codex-spells')) ): the_row(); ?>

                <?php $spell = new stdClass(); ?>
                <?php $spell->name = preg_replace('<type>', '[type]', get_sub_field('name')); ?>
                <?php $spell->sphere = get_sub_field('sphere'); ?>
                <?php $spell->incant = preg_replace('<type>', '[type]', get_sub_field('incant')); ?>
                <?php $spell->level = get_sub_field('level'); ?>
                <?php $spell->duration = get_sub_field('duration'); ?>
                <?php $spell->desc = preg_replace('<type>', '[type]', get_sub_field('description')); ?>
                <?php
                  if($spell_spheres[$spell->sphere] == null){
                    $spell_spheres[$spell->sphere] = [];
                  }
                  if($spell_spheres[$spell->sphere][$spell->level] == null){
                    $spell_spheres[$spell->sphere][$spell->level] = [];
                  }
                  array_push($spell_spheres[$spell->sphere][$spell->level], $spell);
                ?>

              <?php endwhile; ?>
            <?php endif; ?>

            <?php if( have_rows('spells', get_id_by_slug('codex-frag-spells')) ): ?>
              <?php while( have_rows('spells', get_id_by_slug('codex-frag-spells')) ): the_row(); ?>

                <?php $spell = new stdClass(); ?>
                <?php $spell->name = preg_replace('<type>', '[type]', get_sub_field('name')); ?>
                <?php $spell->sphere = "Frag Sphere: " . get_sub_field('sphere'); ?>
                <?php $spell->incant = preg_replace('<type>', '[type]', get_sub_field('incant')); ?>
                <?php $spell->level = get_sub_field('level'); ?>
                <?php $spell->duration = get_sub_field('duration'); ?>
                <?php $spell->desc = preg_replace('<type>', '[type]', get_sub_field('description')); ?>
                <?php
                  if($spell_spheres[$spell->sphere] == null){
                    $spell_spheres[$spell->sphere] = [];
                  }
                  if($spell_spheres[$spell->sphere][$spell->level] == null){
                    $spell_spheres[$spell->sphere][$spell->level] = [];
                  }
                  array_push($spell_spheres[$spell->sphere][$spell->level], $spell);
                ?>

              <?php endwhile; ?>
            <?php endif; ?>

            <div id="spheres" class="row">
              <?php foreach ($spell_spheres as $sphere => $spells) {?>
                <div class="col-sm-4">
                  <table class="sphere" border="1">
                    <tr>
                      <th colspan="2" class="sphere_header"><label><?php echo $sphere; ?></label></th>
                    </tr>
                      <?php foreach($spells as $level){ ?>
                        <tr>
                          <?php foreach($level as $spell){ ?>
                            <td class="spell_data">
                              <?php echo $spell->name; ?>&nbsp<i class="fa fa-info-circle spell_expander" aria-hidden="true"></i>
                              <?php if( $spell->desc == ""){ ?>
                                <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i>
                                <?php } ?>
                              <div class="spell_info">
                                <p><strong>Incant: <?php echo $spell->incant; ?></strong></p>
                                <p>Duration: <?php echo $spell->duration; ?></p>
                                <hr/>
                                <p><?php echo $spell->desc; ?></p>
                              </div>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php } ?>
                  </table>
                </div>

              <?php } ?>
            </div>

        <?php endif; ?>

        <?php if( have_rows('races') ): ?>
            <?php while( have_rows('races')): the_row(); ?>


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
        <?php endif; ?>

        <?php if( have_rows('classes') ): ?>
          <?php while( have_rows('classes')): the_row(); ?>

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
          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('spell_spheres') ): ?>
          <div class="race-content switcher-content">

            <div id="cf-magic" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <?php while( have_rows('spell_spheres') ): the_row(); ?>



                    <?php // vars
                    $name = get_sub_field('name');
                    $description = get_sub_field('description');
                    $focus = get_sub_field('focus');
                    $frag_cost = get_sub_field('frag_cost');
                    $spells = get_sub_field('spells');

                    ?>
                    <h2><?php echo $name; ?></h2>

                    <div class="row repeater-row">
                      <div class="col-sm-4 column">

                        <h5><i>Focus: <?php echo $focus; ?></i></h5>
                        <?php if ($frag_cost != "") { ?>
                          <h4><i>Frag Cost: <?php echo $frag_cost; ?></i></h4>
                        <?php } ?>

                      </div>
                      <div class="col-sm-8 column">

                        <h4>Description</h4>
                        <?php echo $description; ?>

                        <?php if ($frag_cost != "") { ?>
                          <h4>Spells</h4>
                          <?php echo $spells; ?>
                        <?php } ?>

                      </div>
                    </div>

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
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if( have_rows('skills') ): ?>
          <div class="skill-content switcher-content">

            <div id="cf-skills" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <div class="row skill_header">
                    <div class="col-xs-3">
                      Name
                    </div>
                    <div class="col-xs-1">
                      M
                    </div>
                    <div class="col-xs-1">
                      R
                    </div>
                    <div class="col-xs-1">
                      T
                    </div>
                    <div class="col-xs-1">
                      N
                    </div>
                    <div class="col-xs-1">
                      A
                    </div>
                    <div class="col-xs-1">
                      W
                    </div>
                    <div class="col-xs-1">
                      M
                    </div>
                    <div class="col-xs-1">
                      D
                    </div>
                    <div class="col-xs-1">
                      B
                    </div>
                  </div>

                  <?php while( have_rows('skills') ): the_row(); ?>

                    <?php // vars
                    $name = get_sub_field('name');

                    $category = get_sub_field('category');
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

                    <div class="row skill_row">
                      <div class="col-xs-3">
                        <?php echo $name; ?>&nbsp <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $mercenary_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $ranger_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $templar_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $nightblade_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $assassin_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $witchhunter_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $mage_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $druid_cost; ?>
                      </div>
                      <div class="col-xs-1">
                        <?php echo $bard_cost; ?>
                      </div>
                      <div class="col-xs-12 skill_desc" style="display:none;">
                        <?php echo $description; ?>
                        <hr />
                        <p class="skill_meta"><a href="#" class="skill_closer"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; close</a></p>
                      </div>
                    </div>

                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          </div>

        <?php endif; ?>

        <?php if(count($races) > 0 ) { ?>
          <div id="" class="row">

            <div id="race-menu" class="col-sm-12 mobile">
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
        <?php } ?>

        <?php if(count($classes) > 0 ) { ?>
          <div id="" class="row">

            <div id="class-menu" class="col-sm-12 mobile">
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

                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>

			</section><!--/#blog-->
		</div><!--/.col-xs-7-->
	</div><!--/.row-->
</div><!--/.container-->

<script type="text/javascript" src="<?php site_url(); ?>/wp-content/themes/illdy/layout/js/character-builder.js"></script>
<script type="text/javascript" src="<?php site_url(); ?>/wp-content/themes/illdy/layout/js/codex.js"></script>
<?php get_footer(); ?>


<div class="modal fade builder_modal" id="spell_modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Spell Details</h4>
      </div>
      <div id="spell_info" class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
