<?php $businessup_callout_enable = get_theme_mod('businessup_callout_enable','true');
if($businessup_callout_enable !='false')
{
$businessup_callout_background = get_theme_mod('businessup_callout_background');
$businessup_callout_overlay_color = get_theme_mod('businessup_callout_overlay_color');
$businessup_callout_text_align = get_theme_mod('businessup_callout_text_align');
$businessup_callout_button_one_label = get_theme_mod('businessup_callout_button_one_label');
$businessup_callout_button_one_link = get_theme_mod('businessup_callout_button_one_link');
$businessup_callout_button_one_target = get_theme_mod('businessup_callout_button_one_target');
$businessup_callout_button_two_label = get_theme_mod('businessup_callout_button_two_label');
$businessup_callout_button_two_link = get_theme_mod('businessup_callout_button_two_link');
$businessup_callout_button_two_target = get_theme_mod('businessup_callout_button_two_target'); ?>
<!--==================== CALLOUT SECTION ====================-->
<?php if($businessup_callout_background != '') { ?>

<section class="businessup-callout" style="background-image:url('<?php echo esc_url($businessup_callout_background);?>');">
<?php } else { ?>
<section class="businessup-callout">
  <?php } ?>
  <div class="overlay" style="background-color:<?php echo esc_attr($businessup_callout_overlay_color);?>;">
    <div class="container">
      <div class="row">
        <div class="businessup-callout-inner text-xs text-<?php echo $businessup_callout_text_align; ?>">
          <?php $businessup_callout_title = get_theme_mod('businessup_callout_title');
          
            if( !empty($businessup_callout_title) ):

              echo '<h3 class="padding-bottom-30">'.esc_attr($businessup_callout_title).'</h3>';

            endif; ?>
          <?php $businessup_callout_description = get_theme_mod('businessup_callout_description');

            if( !empty($businessup_callout_description) ):

              echo '<p>'.esc_attr($businessup_callout_description).'</p>';

            endif; ?>
          <div class="padding-top-20">
          <?php if( !empty($businessup_callout_button_one_label) ): ?>
      		  <a href="<?php echo esc_url($businessup_callout_button_one_link); ?>" <?php if( $businessup_callout_button_one_target == true) { echo "target='_blank'"; } ?> class="btn btn-theme-two margin-bottom-10">
      		<?php echo esc_attr($businessup_callout_button_one_label); ?></a>
      		<?php
      		endif;

          if( !empty($businessup_callout_button_two_label) ): ?>
      		  <a href="<?php echo esc_url($businessup_callout_button_two_link); ?>" <?php if( $businessup_callout_button_two_target ==true) { echo "target='_blank'"; } ?> class="btn btn-theme margin-bottom-10"><?php echo esc_attr($businessup_callout_button_two_label); ?></a>
    		<?php endif; ?>	
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
