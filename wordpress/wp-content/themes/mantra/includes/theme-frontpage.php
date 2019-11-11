<?php
/**
 * Frontpage generation functions
 * Creates the slider, the columns, the titles and the extra text
 *
 * @package mantra
 * @subpackage Functions
 */

// Front page generator
if ( ! function_exists( 'mantra_frontpage_generator' ) ) :
function mantra_frontpage_generator() {
	$mantra_options= mantra_get_theme_options();
	extract($mantra_options);
	?>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			<?php if ($mantra_slideType!="Slider Shortcode") { ?>
			/* Slider */
			jQuery('#slider').nivoSlider({
				effect: '<?php  echo $mantra_fpslideranim; ?>',
				animSpeed: <?php echo $mantra_fpslidertime ?>,
				<?php	if($mantra_fpsliderarrows=="Hidden") { ?> directionNav: false, <?php }
				if($mantra_fpsliderarrows=="Always Visible") { ?>  directionNav: true, <?php } ?>
				pauseTime: <?php echo $mantra_fpsliderpause ?>
			});
			<?php } ?>
		});
	</script>

	<div id="frontpage">
		<?php

		// First FrontPage Title
		if(!empty($mantra_fronttext1)) {?><div id="front-text1"> <h2><?php echo esc_attr($mantra_fronttext1) ?> </h2></div><?php }

		// Slider
		if ($mantra_slideType=="Slider Shortcode") { ?>
			<div class="slider-wrapper">
			<?php echo do_shortcode( $mantra_slideShortcode ); ?>
			</div> <?php
		} else {
			// The built-in slider

			// When a post query has been selected from the Slider type in the admin area
			if ($mantra_slideType != 'Custom Slides') {
				global $post;
				// Initiating query
				$custom_query = new WP_query();

				// Switch for Query type
				switch ($mantra_slideType) {

					case 'Latest Posts':
						$custom_query->query('showposts='.$mantra_slideNumber.'&ignore_sticky_posts=1');
						break;

					case 'Random Posts':
						$custom_query->query('showposts='.$mantra_slideNumber.'&orderby=rand&ignore_sticky_posts=1');
						break;

					case 'Latest Posts from Category':
						$custom_query->query('showposts='.$mantra_slideNumber.'&category_name='.$mantra_slideCateg.'&ignore_sticky_posts=1');
						break;

					case 'Random Posts from Category':
						$custom_query->query('showposts='.$mantra_slideNumber.'&category_name='.$mantra_slideCateg.'&orderby=rand&ignore_sticky_posts=1');
						break;

					case 'Sticky Posts':
						$custom_query->query(array('post__in'  => get_option( 'sticky_posts' ), 'showposts' =>$mantra_slideNumber,'ignore_sticky_posts' => 1));
						break;

					case 'Specific Posts':
						// Transform string separated by commas into array
						$pieces_array = explode(",", $mantra_slideSpecific);
						$custom_query->query(array( 'post_type' => 'any', 'showposts' => -1, 'post__in' => $pieces_array, 'ignore_sticky_posts' => 1, 'orderby' => 'post__in' ));
						break;

				} // switch

				// Variables for matching slider number with caption number
				$mantra_cycle1=0;
				$mantra_cycle2=0; ?>
				<div class="slider-wrapper theme-default">
						<div class="ribbon"></div>
						<div id="slider" class="nivoSlider <?php if($mantra_fpsliderarrows=="Visible on Hover"): ?>slider-navhover<?php endif; ?>">
							<?php
							// Loop for creating the slides
							if ( $custom_query->have_posts() ) while ( $custom_query->have_posts()) :
								$custom_query->the_post();

								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'slider');
								$mantra_cycle1++; ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"  alt=""  title="#caption<?php echo $mantra_cycle1;?>"  /></a> <?php

							endwhile; // end of the loop.
							?>
						</div>
						<?php
						// Loop for creating the captions
						if ($custom_query->have_posts() ) while ( $custom_query->have_posts() ) :
							$custom_query->the_post();
							$mantra_cycle2++; ?>

							<div id="caption<?php echo $mantra_cycle2;?>" class="nivo-html-caption">
								<?php the_title("<h3>","</h3>"); ?>
								<?php echo '<div class="nivo-description">' . get_the_excerpt() . '</div>'; ?>
							</div>
							<?php
						endwhile; // end of the loop. ?>

				</div>
			<?php } else {

			// If Custom Slides have been selected
			?>
			<div class="slider-wrapper theme-default">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider <?php if($mantra_fpsliderarrows=="Visible on Hover"): ?>slider-navhover<?php endif; ?>">
					<?php
					for ( $mantra_cycle1=1; $mantra_cycle1<=5; $mantra_cycle1++ )
						if(${"mantra_sliderimg$mantra_cycle1"}) { ?>
							<a href='<?php echo esc_url(${"mantra_sliderlink$mantra_cycle1"}) ?>'>
								<img src='<?php echo esc_url(${"mantra_sliderimg$mantra_cycle1"}) ?>' alt="" <?php if (${"mantra_slidertitle$mantra_cycle1"} || ${"mantra_slidertext$mantra_cycle1"} ) { ?>title="#caption<?php echo $mantra_cycle1;?>" <?php }?> />
							</a>
						<?php } ?>
				</div>
				<?php
				for ( $mantra_cycle1=1; $mantra_cycle1<=5; $mantra_cycle1++ ) { ?>
					<div id="caption<?php echo $mantra_cycle1;?>" class="nivo-html-caption">
						<?php echo '<h3>'.${"mantra_slidertitle$mantra_cycle1"}.'</h3><div class="nivo-description">'.${"mantra_slidertext$mantra_cycle1"} . '</div>' ?>
					</div>
				<?php } ?>
			</div> <?php
			} // custom slides

		} // built-in slider

		// Second FrontPage title
		if (!empty($mantra_fronttext2)) {?><div id="front-text2"> <h2><?php echo esc_attr($mantra_fronttext2) ?> </h2></div><?php }

		// Frontpage columns
		if ($mantra_nrcolumns) { ?>
			<div id="front-columns" class="front-columns-<?php echo $mantra_nrcolumns;?>">
				<?php for ($mantra_cycle = 1; $mantra_cycle <= $mantra_nrcolumns; $mantra_cycle++ ) { ?>
						<div id="column<?php echo $mantra_cycle ?>">

						<div class="column-image">
							<a href="<?php echo esc_url(${'mantra_columnlink'.$mantra_cycle}) ?>">
								<img src="<?php echo esc_url(${'mantra_columnimg'.$mantra_cycle}) ?>" id="columnImage<?php echo $mantra_cycle ?>" alt="" />
							</a>
						</div>

						<h3><a href="<?php echo esc_url(${'mantra_columnlink'.$mantra_cycle}) ?>"><?php echo ${'mantra_columntitle'.$mantra_cycle} ?></a></h3>

						<div class="column-text"><?php echo do_shortcode (${'mantra_columntext'.$mantra_cycle} ); ?></div>
						<?php if($mantra_columnreadmore) {?>
							<div class="columnmore">
								<a href="<?php echo esc_url(${'mantra_columnlink'.$mantra_cycle}) ?>"><?php echo esc_attr($mantra_columnreadmore) ?> &raquo;</a>
							</div>
						<?php } // if ?>
						</div>
				<?php } // for ?>
			</div>
		<?php } // columns

		// Frontpage text areas
		if (!empty($mantra_fronttext3)) {?><div id="front-text3" class="front-text"><?php echo do_shortcode( force_balance_tags( $mantra_fronttext3 ) ) ?></div><?php }
		if (!empty($mantra_fronttext4)) {?><div id="front-text4" class="front-text"><?php echo do_shortcode( force_balance_tags( $mantra_fronttext4 ) ) ?></div><?php }

		?>
	</div> <!-- frontpage -->
	<?php
} // mantra_frontpage_generator()
endif;

// FIN
