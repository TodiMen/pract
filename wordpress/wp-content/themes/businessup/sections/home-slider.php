<?php 
$businessup_slider_enable = get_theme_mod('businessup_slider_enable','true');
if($businessup_slider_enable != 'false')
{ ?>
<!--==================== SLIDER SECTION ====================-->
<section class="businessup-slider-warraper">
	<div id="businessup-slider" class="owl-carousel">
    	<?php if(is_active_sidebar( 'sidebar-slider' )):
        	dynamic_sidebar( 'sidebar-slider' );
    	endif; ?>
	</div>
</section>
<?php } ?>
<div class="clearfix"></div>