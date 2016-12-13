

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
				<?php
				if( have_posts() ):
					while( have_posts() ):
						the_post();
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>

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
                      <div class="col-xs-4 column">

                        <h4>Lifespan: <?php echo $lifespan; ?></h4>

                        <p><?php echo $racial_characteristics; ?></p>
                      </div>
                      <div class="col-xs-8 column">

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
          <div class="race-content switcher-content">

            <div id="cf-classes" class="cf-repeater">
              <div class="row repeater-content rf-hidden">
                <div class="col-lg-12 column">

                  <?php while( have_rows('classes') ): the_row(); ?>

                    <?php // vars
                    $name = get_sub_field('name');
                    $description = get_sub_field('description');
                    ?>

                    <h4><?php echo $name; ?></h4>
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
            });
          </script>

        <?php endif; ?>

			</section><!--/#blog-->
		</div><!--/.col-xs-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
