<?php
/**
 *	The template for displaying the bottom header section in front page.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>
<?php
$show_videos = get_theme_mod( 'illdy_jumbotron_general_show_videos', false );
$first_row_from_title = get_theme_mod( 'illdy_jumbotron_general_first_row_from_title', esc_html__( 'Clean', 'illdy' ) );
$second_row_from_title = get_theme_mod( 'illdy_jumbotron_general_second_row_from_title', esc_html__( 'Slick', 'illdy' ) );
$third_row_from_title = get_theme_mod( 'illdy_jumbotron_general_third_row_from_title', esc_html__( 'Pixel Perfect', 'illdy' ) );
$entry = get_theme_mod( 'illdy_jumbotron_general_entry', esc_html__( 'lldy is a great one-page theme, perfect for developers and designers but also for someone who just wants a new website for his business. Try it now!', 'illdy' ) );
$first_button_title = get_theme_mod( 'illdy_jumbotron_general_first_button_title', esc_html__( 'Learn more', 'illdy' ) );
$first_button_url = get_theme_mod( 'illdy_jumbotron_general_first_button_url', esc_url( '#' ) );
$second_button_title = get_theme_mod( 'illdy_jumbotron_general_second_button_title', esc_html__( 'Download', 'illdy' ) );
$second_button_url = get_theme_mod( 'illdy_jumbotron_general_second_button_url', esc_url( '#' ) );
$show_videos = false;
?>
	<div class="bottom-header front-page">
        <?php if (!wp_is_mobile() || !$show_videos) { ?>
		<video id="awesome_video" src="<?php echo get_theme_root_uri() . '/illdy/inc/larp1.mp4'; ?>" autoplay ></video>
        <?php } ?>
		<div class="container">
			<div class="row">

				<?php if( $first_row_from_title || $second_row_from_title || $third_row_from_title ): ?>
					<div class="col-sm-12">
						<h2 class='jumbotron_text'><?php if( $first_row_from_title ): echo '<span data-customizer="first-row-from-title">'. illdy_sanitize_html( $first_row_from_title ) .'</span><span class="span-dot first-span-dot">'. __( '.', 'illdy' ) .'</span>'; endif; ?> <?php if( $second_row_from_title ): echo '<span data-customizer="second-row-from-title">'. illdy_sanitize_html( $second_row_from_title ) .'</span><span class="span-dot second-span-dot">'. __( '.', 'illdy' ) .'</span>'; endif; ?> <?php if( $third_row_from_title ): echo '<span data-customizer="third-row-from-title">'. illdy_sanitize_html( $third_row_from_title ) .'</span><span class="span-dot first-span-dot">'. __( '.', 'illdy' ) .'</span>'; endif; ?></h2>
					</div><!--/.col-sm-12-->
				<?php endif; ?>
				<div class="col-sm-8 col-sm-offset-2">
					<?php if( $entry ): ?>
						<p><?php echo illdy_sanitize_html( $entry ); ?></p>
					<?php endif; ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if( $first_button_title && $first_button_url ): ?>
                                <a href="<?php echo esc_url( $first_button_url ); ?>" title="<?php echo esc_attr( $first_button_title ); ?>" class="header-button-one"><?php echo esc_html( $first_button_title ); ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php if( $second_button_title && $second_button_url ): ?>
                                <a href="<?php echo esc_url( $second_button_url ); ?>" title="<?php echo esc_attr( $second_button_title ); ?>" class="header-button-two"><?php echo esc_html( $second_button_title ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
				</div><!--/.col-sm-8.col-sm-offset-2-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.bottom-header.front-page-->

    <?php if (!wp_is_mobile() || !$show_videos) { ?>
		<script type="text/javascript">
		  var index = 1,
		      playlist = [
                  '<?php echo get_theme_root_uri() . '/illdy/inc/larp1.mp4' ?>',
                  '<?php echo get_theme_root_uri() . '/illdy/inc/larp2.mp4' ?>',
                  '<?php echo get_theme_root_uri() . '/illdy/inc/larp3.mp4' ?>',
                  '<?php echo get_theme_root_uri() . '/illdy/inc/larp4.mp4' ?>'
		      ]
		      video = document.getElementById('awesome_video');

		  video.addEventListener('ended', rotate_video, false);

		  function rotate_video() {
		    video.setAttribute('src', playlist[index]);
		    video.load();
		    index++;
		    if (index >= playlist.length) { index = 0; }
		  }
		</script>
    <?php } ?>
