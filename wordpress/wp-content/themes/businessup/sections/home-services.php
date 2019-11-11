<?php $businessup_service_enable = get_theme_mod('businessup_service_enable','true'); 
$businessup_service_overlay_color = get_theme_mod('businessup_service_overlay_color');
if($businessup_service_enable !='false') { ?>
<!--==================== SERVICE SECTION ====================-->
<section id="service" class="businessup-section text-center" style="background: <?php echo esc_attr($businessup_service_overlay_color);?>;">
  <div class="container">
    <div class="row">
        <div class="col-md-12 fadeInDown animated padding-bottom-80">
          <div class="businessup-heading">
            <?php $businessup_service_title = get_theme_mod('businessup_service_title');
          
            if( !empty($businessup_service_title) ):

              echo '<h3 class="businessup-heading-inner">'.esc_attr($businessup_service_title).'</h3>';

            endif; ?>
          
          <?php $businessup_service_subtitle = get_theme_mod('businessup_service_subtitle');

            if( !empty($businessup_service_subtitle) ):

              echo '<p class="subtitle">'.esc_attr($businessup_service_subtitle).'</p>';

            endif; ?>
          </div>
        </div>
      </div>
    <div class="row">
     <div id="service-home">
      <?php 
		if(is_active_sidebar( 'servicehome_widget_area' )):
						
			dynamic_sidebar( 'servicehome_widget_area' );
      
		endif;
	  ?></div>
    </div>
  </div>
</section>
<?php } ?>