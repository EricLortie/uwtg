<?php
/**
 *	Sets up theme defaults and registers support for various WordPress features.
 *
 *	Note that this function is hooked into the after_setup_theme hook, which
 *	runs before the init hook. The init hook is too late for some features, such
 *	as indicating support for post thumbnails.
 */
if(!function_exists('illdy_setup')) {
	add_action( 'after_setup_theme', 'illdy_setup' );
	function illdy_setup() {
		// Extras
		require_once( 'inc/extras.php' );

		// Template Tags
		require_once( 'inc/template-tags.php' );

		// Customizer
		require_once( 'inc/customizer/customizer.php' );

		// JetPack
		require_once( 'inc/jetpack.php' );

		// TGM Plugin Activation
		require_once( 'inc/tgm-plugin-activation/tgm-plugin-activation.php' );

		// Components
		require_once( 'inc/components/pagination/class.mt-pagination.php' );
		require_once( 'inc/components/entry-meta/class.mt-entry-meta.php' );
		require_once( 'inc/components/author-box/class.mt-author-box.php' );
		require_once( 'inc/components/related-posts/class.mt-related-posts.php' );
		require_once( 'inc/components/nav-walker/class.mt-nav-walker.php' );

		// Widgets
		require_once( 'widgets/class-widget-recent-posts.php' );
		require_once( 'widgets/class-widget-skill.php' );
		require_once( 'widgets/class-widget-project.php' );
		require_once( 'widgets/class-widget-service.php' );
		require_once( 'widgets/class-widget-counter.php' );
		require_once( 'widgets/class-widget-person.php' );

		// Load Theme Textdomain
		load_theme_textdomain( 'illdy', get_template_directory() . '/languages' );

		// Add Theme Support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'custom-header', array(
				'default-image'		=> esc_url( get_template_directory_uri() . '/layout/images/blog/blog-header.png' ),
				'width'				=> 1920,
				'height'			=> 532,
				'flex-height'		=> true,
				'random-default'	=> false,
				'header-text'		=> false
		) );

		// Add Image Size
		add_image_size( 'illdy-blog-list', 653, 435, true );
		add_image_size( 'illdy-widget-recent-posts', 70, 70, true );
		add_image_size( 'illdy-blog-post-related-articles', 240, 206, true );
		add_image_size( 'illdy-front-page-latest-news', 360, 213, true );
		add_image_size( 'illdy-front-page-testimonials', 127, 127, true );
		add_image_size( 'illdy-front-page-projects', 476, 476, true );
		add_image_size( 'illdy-front-page-person', 125, 125, true );

		// Register Nav Menus
		register_nav_menus( array(
			'primary-menu'	=> esc_html__( 'Primary Menu', 'illdy' ),
		) );
	}
}


/**
 *	Set the content width in pixels, based on the theme's design and stylesheet.
 *
 *	Priority 0 to make it available to lower priority callbacks.
 *
 *	@global int $content_width
 */
if(!function_exists('illdy_content_width')) {
	add_action( 'after_setup_theme', 'illdy_content_width', 0 );
	function illdy_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'illdy_content_width', 640 );
	}
}

/**
 *	WP Enqueue Stylesheets
 */
if(!function_exists('illdy_enqueue_stylesheets')) {
	add_action( 'wp_enqueue_scripts', 'illdy_enqueue_stylesheets' );

	function illdy_enqueue_stylesheets() {
		// Google Fonts
		$google_fonts_args = array(
			'family'	=> 'Source+Sans+Pro:400,900,700,300,300italic'
		);

		// WP Register Style
		wp_register_style( 'illdy-google-fonts', add_query_arg( $google_fonts_args, 'https://fonts.googleapis.com/css' ), array(), null );

		// WP Enqueue Style
		if( get_theme_mod( 'illdy_preloader_enable', 1 ) == 1 ) {
			wp_enqueue_style( 'illdy-pace', get_template_directory_uri() . '/layout/css/pace.min.css', array(), '', 'all' );
		}
		wp_enqueue_style( 'illdy-google-fonts' );
		wp_enqueue_style( 'illdy-bootstrap', get_template_directory_uri() . '/layout/css/bootstrap.min.css', array(), '3.3.6', 'all' );
		wp_enqueue_style( 'illdy-bootstrap-theme', get_template_directory_uri() . '/layout/css/bootstrap-theme.min.css', array(), '3.3.6', 'all' );
		wp_enqueue_style( 'illdy-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.5.0', 'all' );
		wp_enqueue_style( 'illdy-owl-carousel', get_template_directory_uri() . '/layout/css/owl-carousel.min.css', array(), '2.0.0', 'all' );
		wp_enqueue_style( 'tribe-events-full', '/wp-content/plugins/the-events-calendar/src/resources/css/tribe-events-full.min.css', array(), '2.0.0', 'all' );
		wp_enqueue_style( 'illdy-style', get_stylesheet_uri(), array(), '1.0.0', 'all' );
	}
}


/**
 *	WP Enqueue JavaScripts
 */
if(!function_exists('illdy_enqueue_javascripts')) {
	add_action( 'wp_enqueue_scripts', 'illdy_enqueue_javascripts' );

	function illdy_enqueue_javascripts() {
		if( get_theme_mod( 'illdy_preloader_enable', 1 ) == 1 ) {
			wp_enqueue_script( 'illdy-pace', get_template_directory_uri() . '/layout/js/pace/pace.min.js', array( 'jquery' ), '', false );
		}
		wp_enqueue_script( 'jquery-ui-progressbar', '', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-bootstrap', get_template_directory_uri() . '/layout/js/bootstrap/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
		wp_enqueue_script( 'illdy-owl-carousel', get_template_directory_uri() . '/layout/js/owl-carousel/owl-carousel.js', array( 'jquery' ), '2.0.0', true );
		wp_enqueue_script( 'illdy-count-to', get_template_directory_uri() . '/layout/js/count-to/count-to.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-visible', get_template_directory_uri() . '/layout/js/visible/visible.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-plugins', get_template_directory_uri() . '/layout/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-scripts', get_template_directory_uri() . '/layout/js/scripts.js', array( 'jquery' ), '', true );


		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/**
 *	Widgets
 */
if(!function_exists('illdy_widgets')) {
	add_action( 'widgets_init', 'illdy_widgets' );

	function illdy_widgets() {

		// Blog Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Blog Sidebar', 'illdy' ),
			'id'			=> 'blog-sidebar',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in blog page.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title"><h3>',
			'after_title'	=> '</h3></div>',
		) );

		// Footer Sidebar 1
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 1', 'illdy' ),
			'id'			=> 'footer-sidebar-1',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in first block from footer.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title"><h3>',
			'after_title'	=> '</h3></div>',
		) );

		// Footer Sidebar 2
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 2', 'illdy' ),
			'id'			=> 'footer-sidebar-2',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in second block from footer.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title"><h3>',
			'after_title'	=> '</h3></div>',
		) );

		// Footer Sidebar 3
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 3', 'illdy' ),
			'id'			=> 'footer-sidebar-3',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in third block from footer.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title"><h3>',
			'after_title'	=> '</h3></div>',
		) );

		// About Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Front page - About Sidebar', 'illdy' ),
			'id'			=> 'front-page-about-sidebar',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in about section from front page.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 col-lg-4 col-lg-offset-0 %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '',
			'after_title'	=> '',
		) );

		// Projects Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Front page - Projects Sidebar', 'illdy' ),
			'id'			=> 'front-page-projects-sidebar',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in projects section from front page.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="col-sm-3 col-xs-6 no-padding %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '',
			'after_title'	=> '',
		) );

		// Services Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Front page - Services Sidebar', 'illdy' ),
			'id'			=> 'front-page-services-sidebar',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in services section from front page.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="col-sm-4 %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '',
			'after_title'	=> '',
		) );

		// Counter Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Front page - Counter Sidebar', 'illdy' ),
			'id'			=> 'front-page-counter-sidebar',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in counter section from front page.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="col-sm-4 %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '',
			'after_title'	=> '',
		) );

		// Team Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Front page - Team Sidebar', 'illdy' ),
			'id'			=> 'front-page-team-sidebar',
			'description'	=> esc_html__( 'The widgets added in this sidebar will appear in team section from front page.', 'illdy' ),
			'before_widget'	=> '<div id="%1$s" class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '',
			'after_title'	=> '',
		) );
	}
}

/**
 *  Checkbox helper function
 */
if( !function_exists( 'illdy_value_checkbox_helper' ) ) {
	function illdy_value_checkbox_helper( $value ) {
	    if ($value == 1) {
	        return 1;
	    } else {
	        return 0;
	    }
	}
}


// like get_post_custom_values but only returns the first item. Handy for CPT elements
function uit_get_post_custom_value( $key = '', $post_id = 0 ) {
    if ( !$key )
        return null;

    $custom = get_post_custom($post_id);

    $value = isset($custom[$key]) ? $custom[$key] : null;

    return $value[0];

}

// Gets the attachment img src, rather than an array
function uit_wp_get_attachment_image_src( $attachment_id, $size = 'thumbnail', $icon = false ) {
    // get a thumbnail or intermediate image if there is one
    $image = image_downsize( $attachment_id, $size );
    if ( ! $image ) {
        $src = false;

        if ( $icon && $src = wp_mime_type_icon( $attachment_id ) ) {
            /** This filter is documented in wp-includes/post.php */
            $icon_dir = apply_filters( 'icon_dir', ABSPATH . WPINC . '/images/media' );

            $src_file = $icon_dir . '/' . wp_basename( $src );
            @list( $width, $height ) = getimagesize( $src_file );
        }

        if ( $src && $width && $height ) {
            $image = array( $src, $width, $height );
        }
    }
    $filter = apply_filters( 'wp_get_attachment_image_src', $image, $attachment_id, $size, $icon );
    return $filter[0];
}

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

if ( ! function_exists('sortByOption')) {
	 function sortByOption($a, $b) {
		 return strcmp($a[0], $b[0]);
	 }
 }

 function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}


function build_skill_row($post, $s_count, $skill_type) {
	$s_count++;
	$name = get_sub_field('name');
	write_log(strpos($name, 'Subsequent'));
	if (strpos($name, 'Subsequent') === false && $name != "Spell Versatility") {

			$description = get_sub_field('description');
			$category = get_sub_field('category');

			if($skill_type == "spell_sphere"){
				$name = "Spell Sphere: " . $name;
				$category = "Spell Sphere";
			}

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
			$focus = get_sub_field('focus');

			$frag_cost = get_sub_field('frag_cost');

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
			$demagogue_cost = get_sub_field('demagogue_cost');
			$champion_cost = get_sub_field('champion_cost');

			$max = get_sub_field('max');

			$race = get_sub_field('race');

			$pc_class = get_sub_field('class');
			$pc_class_string = str_replace(" ", "", $pc_class);
			$class_level = get_sub_field('level');

			if($name == "Mysticism"){
				$max = 10;
			} else if($name == "Physician"){
				$max = 10;
			}

			$optional = get_sub_field('optional_fields');

			$sphere_class = '';
			$btn_class = '';
			$btn_id = 'skill_'+$s_count;
			$spells = get_sub_field('spells');
			if($skill_type == "spell_sphere"){
				$btn_class = 'spell_sphere_add';
				$btn_id = 'sphere_' + $s_count;
				$sphere_class = 'spell_sphere';
				$prereq = 'Read Magic';
				$cat_icon = "fa-magic";
			} else {
				$prereq = get_sub_field('prerequesites');
			}

			$multiple = false;
			if ( $optional && in_array('multiple', $optional) ) {
				$multiple = true;
			}
			$automatic = false;
			if ( $optional && in_array('automatic', $optional) ) {
				$automatic = true;
			}
			$vocation_ability = false;
			if ( $optional && in_array('vocation', $optional) ) {
				return "";
				$vocation_ability = true;
			}

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
					var skill_type = '<?php echo $skill_type; ?>';
					var skill_row = jQuery(`<div class="row skill_row <?php echo $sphere_class; ?> <?php echo $cat; ?> <?php echo $pc_class_string; ?>" skill-name="<?php echo $name; ?>"><div class="col-sm-12 skill" style=""></div></div>`);
					var skill_ele = skill_row.find('.skill');
					skill_ele.append(`
						<div class="row">
							<div class="col-xs-1">
								<i id="<?php echo $btn_class; ?>" class="fa fa-plus-square skill_add <?php echo $btn_class; ?> state_saver <?php echo (($automatic) ? "automatic_skill" : "" ) ?> <?php echo (($name == "Favoured") ? "favoured" : ""); ?>" aria-hidden="true"></i>
								<i class="fa fa-check-square-o skill_purchased" aria-hidden="true"></i>
							</div>
							<div class="col-xs-9">
								<span class="cat_label"><i class="fa <?php echo $cat_icon; ?>" aria-hidden="true"></i></span>&nbsp;
								<span class="name">
								<?php if($skill_type == "frag skill"){ ?>
									<span class="frag_cost"><?php echo $name; ?> (<?php echo $frag_cost; ?>&nbsp;<i class=" fa fa-diamond" aria-hidden="true"></i>)</span> </span>
								<?php } else { ?>
									<?php echo $name; ?>
								<?php } ?>
								</span>
								&nbsp; <i class="fa fa-info-circle skill_expander" aria-hidden="true"></i>
								<?php if($prereq != ""){ ?>
									&nbsp; <i class="fa fa-exclamation-triangle skill_req skill_expander" aria-hidden="true"></i>
								<?php } ?>
								&nbsp;
							</div>
							<div class="col-xs-1">
								<?php if($automatic) { ?>
									<span class="racial_cost skill_cost">0</span>
									<span class="cost" style="display:none">0</span>
								<?php } else if ($skill_type == "race_skill") { ?>
									<span class="racial_cost skill_cost">50</span>
									<span class="cost" style="display:none">50</span>
								<?php } else if ($level_cost != 0) { ?>
									<span class="level_cost skill_cost"><?php echo $level_cost ?></span>
									<span class="cost" style="display:none"><?php echo $level_cost ?></span>
								<?php } else { ?>
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
									<span class="sphere_cost skill_cost"></span>
									<span class="cost" style="display:none"></span>
								<?php } ?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 skill_desc" style="display:none;">
								<?php if ($prereq != "") { ?>
									<p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Requirements: <?php echo $prereq; ?></p>
								<?php } ?>
								<?php if ($focus != "") { ?>
									<p><i class="fa fa-exclamation-triangle skill_req" aria-hidden="true"></i>&nbsp; Focus: <?php echo $focus; ?></p>
								<?php } ?>
								<?php if ($automatic != "") { ?>
									<p>Automatic: Yes</p>
								<?php } ?>
								<?php if ($frag_cost != "") { ?>
									<p>Frag Cost: <?php echo $frag_cost; ?></p>
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


          skill_row.data('racial_skill', false);
					skill_row.data('class_skill', false);

					if(skill_type == "spell_sphere"){

						skill_row.data('category', `S`)
						skill_row.data('cat_string', `Scholar`)
          	skill_row.data('type', `spell sphere`);
						skill_row.data('spell_sphere', true);
						skill_row.find('.cost_strings').remove();

            builder_data.spell_spheres.push({
              name: `<?php echo $name ?>`,
              focus: `<?php echo $focus ?>`,
              spells: `<?php echo $spells ?>`,
              description: `<?php echo $description ?>`,
              frag_cost: `<?php echo $frag_cost ?>`
            });

					} else if(skill_type == "race_skill"){

            skill_row.data('racial_skill', true);
            skill_row.data('automatic', `<?php echo $automatic;?>`);
            skill_row.data('cost', 50)
						skill_row.find('.sphere_cost').remove();

					} else if(skill_type == "class_skill") {

            skill_row.data('class_level', `<?php echo $class_level;?>`);
            skill_row.data('class_skill', true);
            skill_row.data('vocation_skill', `<?php echo $vocation_ability; ?>`)
						skill_row.find('.sphere_cost').remove();

					} else {

						skill_row.data('type', `<?php echo $skill_type; ?>`);
						skill_row.find('.sphere_cost').remove();

					}

					skill_row.data('name', `<?php echo $name ?>`);
          skill_row.data('race', `<?php echo $race;?>`);
          skill_row.data('class', `<?php echo $pc_class;?>`);
					skill_row.data('cat_string', `<?php echo $category; ?>`)
					skill_row.data('frag_cost', `<?php echo $frag_cost; ?>`);
					skill_row.data('category', `<?php echo $cat; ?>`);
					skill_row.data('description', `<?php echo $description ?>`);
					skill_row.data('requirements', `<?php echo $prereq ?>`);
					skill_row.data('multiple', `<?php echo $multiple ?>`);
					skill_row.data('automatic', `<?php echo $automatic; ?>`);
					skill_row.data('max', `<?php echo $max ?>`);

					if(builder_data.circles.indexOf("<?php echo $name; ?>") >= 0){
						skill_row.data('spell_circle', true);
					}

					<?php if($prereq != ''){ ?>
						skill_row.addClass('has_req');
						skill_row.addClass('locked');
					<?php } ?>

					aliases = builder_data.skill_aliases["<?php echo $name; ?>"];
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
						var name = "<?php echo $name?>";
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

	<?php
	}
}
