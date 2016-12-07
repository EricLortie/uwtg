

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
          builder_data.arrivals = [];
          builder_data.purposes = [];
          builder_data.quirks = [];
          builder_data.professions = [];
        </script>

        <?php if( have_rows('races'), 812 ): ?>

          <?php while( have_rows('races'), 812 ): the_row(); ?>


            <?php // vars
            $name = get_sub_field('name');
            $lifespan = get_sub_field('lifespan');
            $description = get_sub_field('description');
            $racial_characteristics = get_sub_field('racial_characteristics');
            $advantages = get_sub_field('advantages');
            $disadvantages = get_sub_field('disadvantages');

            ?>

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
        <?php endif; ?>

        <?php if( have_rows('classes'), 815 ): ?>

          <?php while( have_rows('classes'), 815 ): the_row(); ?>

            <?php // vars
            $name = get_sub_field('name');
            $description = get_sub_field('description');
            ?>

            <script type="text/javascript">
              builder_data.pc_classes.push({
                name: `<?php echo $name ?>`,
                description: `<?php echo $description ?>`
              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>


        <?php if( have_rows('skills') ): ?>
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

            <script type="text/javascript">
              builder_data.skills.push({
                name: `<?php echo $name ?>`,
                description: `<?php echo $description ?>`,
                prerequesites: `<?php echo $prereq ?>`,
                mercenary_cost: `<?php echo $mercenary_cost ?>`,
                ranger_cost: `<?php echo $ranger_cost ?>`,
                templaer_cost: `<?php echo $templater_cost ?>`,
                nightblade_cost: `<?php echo $nightblade_cost ?>`,
                assassin_cost: `<?php echo $assassin_cost ?>`,
                witchhunter_cost: `<?php echo $witchhunter_cost ?>`,
                mage_cost: `<?php echo $mage_cost ?>`,
                druid_cost: `<?php echo $druid_cost ?>`,
                bard_cost: `<?php echo $bard_cost ?>`
              });
            </script>

          <?php endwhile; ?>
        <?php endif; ?>

			</section><!--/#blog-->
		</div><!--/.col-sm-7-->
	</div><!--/.row-->
</div><!--/.container-->
<?php get_footer(); ?>
