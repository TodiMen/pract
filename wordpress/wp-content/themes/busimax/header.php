<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package BusiMax
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"></a>
<div class="wrapper">
<header class="ta-headwidget widtr"> 
  <!--==================== TOP BAR ====================-->
  <div class="ta-head-detail hidden-xs hidden-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-6">
         <ul class="info-left">
            <?php 
              $businessup_head_info_one = get_theme_mod('businessup_head_info_one','<li><a><i class="fa fa-clock-o "></i>Open-Hours:10 am to 7pm</a></li>');
              $businessup_head_info_two = get_theme_mod('businessup_head_info_two','<li><a href="mailto:info@themeansar.com" title="Mail Me"><i class="fa fa-envelope"></i> info@themeansar.com</a></li>');
            ?>
            <li><?php echo wp_kses_post($businessup_head_info_one); ?></li>
            <li><?php echo wp_kses_post($businessup_head_info_two); ?></li>
          </ul>
        </div>
        <div class="col-md-6 col-xs-12">
        <?php if ( has_nav_menu( 'social' ) ) : ?>
          <nav class="ta-social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'busimax' ); ?>">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'social',
                'menu_class'     => 'social-links-menu info-right',
                'depth'          => 1,
                'link_before'    => '<span class="screen-reader-text">',
                'link_after'     => '</span>' . businessup_include_svg_icons( array( 'icon' => 'chain' ) ),
              ) );
            ?>
          </nav><!-- .social-navigation -->
          <?php endif; ?>
       
          </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ta-nav-widget-area">
      <div class="container">
      <div class="row">
          <div class="col-md-3 col-sm-4 text-center-xs">
           <div class="navbar-header">
			<?php the_custom_logo(); ?>
            
			<?php  if ( display_header_text() ) : ?>
			<div class="site-branding-text">
				<h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="color: #<?php header_textcolor(); ?>"><?php bloginfo('name'); ?></a></h1>
				<p class="site-description" style="color: #<?php header_textcolor(); ?>"><?php bloginfo('description'); ?></p>
			</div>
			<?php endif; ?>
			</div>
          </div>
          <div class="col-md-9 col-sm-8">
            <div class="header-widget">
              <div class="col-md-3 col-sm-6 col-xs-6 hidden-sm hidden-xs">
                <div class="ta-header-box">
                  <div class="ta-header-box-icon">
                    <?php $businessup_header_widget_one_icon = get_theme_mod('businessup_header_widget_one_icon');
                    if( !empty($businessup_header_widget_one_icon) ):
                      echo '<i class="fa '.esc_html($businessup_header_widget_one_icon).'">'.'</i>';
                    endif; ?>
                   </div>
                  <div class="ta-header-box-info">
                    <?php $businessup_header_widget_one_title = get_theme_mod('businessup_header_widget_one_title'); 
                    if( !empty($businessup_header_widget_one_title) ):
                      echo '<h4>'.esc_html($businessup_header_widget_one_title).'</h4>';
                    endif; ?>
                    <?php $businessup_header_widget_one_description = get_theme_mod('businessup_header_widget_one_description');
                    if( !empty($businessup_header_widget_one_description) ):
                      echo '<p>'.esc_html($businessup_header_widget_one_description).'</p>';
                    endif; ?> 
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6 hidden-sm hidden-xs">
                <div class="ta-header-box wow animated flipInX">
                  <div class="ta-header-box-icon">
                    <?php $businessup_header_widget_two_icon = get_theme_mod('businessup_header_widget_two_icon');
                    if( !empty($businessup_header_widget_two_icon) ):
                      echo '<i class="fa '.esc_html($businessup_header_widget_two_icon).'">'.'</i>';
                    endif; ?>
                   </div>
                  <div class="ta-header-box-info">
                    <?php $businessup_header_widget_two_title = get_theme_mod('businessup_header_widget_two_title'); 
                    if( !empty($businessup_header_widget_two_title) ):
                      echo '<h4>'.esc_html($businessup_header_widget_two_title).'</h4>';
                    endif; ?>
                    <?php $businessup_header_widget_two_description = get_theme_mod('businessup_header_widget_two_description');
                    if( !empty($businessup_header_widget_two_description) ):
                      echo '<p>'.esc_html($businessup_header_widget_two_description).'</p>';
                    endif; ?> 
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6 hidden-sm hidden-xs">
                <div class="ta-header-box">
                  <div class="ta-header-box-icon">
                    <?php $businessup_header_widget_three_icon = get_theme_mod('businessup_header_widget_three_icon');
                    if( !empty($businessup_header_widget_three_icon) ):
                      echo '<i class="fa '.esc_html($businessup_header_widget_three_icon).'">'.'</i>';
                    endif; ?>
                   </div>
                  <div class="ta-header-box-info">
                    <?php $businessup_header_widget_three_title = get_theme_mod('businessup_header_widget_three_title'); 
                    if( !empty($businessup_header_widget_three_title) ):
                      echo '<h4>'.esc_html($businessup_header_widget_three_title).'</h4>';
                    endif; ?>
                    <?php $businessup_header_widget_three_description = get_theme_mod('businessup_header_widget_three_description');
                    if( !empty($businessup_header_widget_three_description) ):
                      echo '<p>'.esc_html($businessup_header_widget_three_description).'</p>';
                    endif; ?> 
                  </div>
                </div>
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                <div class="ta-header-box wow animated flipInX text-right"> 
                  <?php $businessup_header_widget_four_label = get_theme_mod('businessup_header_widget_four_label'); 
                  $businessup_header_widget_four_link = get_theme_mod('businessup_header_widget_four_link');
                  $businessup_header_widget_four_target = get_theme_mod('businessup_header_widget_four_target'); 

                    if( !empty($businessup_header_widget_four_label) ):?>
                      <a href="<?php echo esc_url($businessup_header_widget_four_link); ?>" <?php if( esc_html($businessup_header_widget_four_target) ==true) { echo "target='_blank'"; } ?> class="btn btn-theme"><?php echo esc_attr($businessup_header_widget_four_label); ?></a> 
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div></div>

    <div class="container"> 
    <div class="ta-menu-full">
      <nav class="navbar navbar-default navbar-static-top navbar-wp">
          <!-- navbar-toggle -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-wp"> <span class="sr-only"><?php esc_attr_e('Toggle Navigation','busimax'); ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <!-- /navbar-toggle --> 
          <!-- Navigation -->
          
          <div class="collapse navbar-collapse" id="navbar-wp">
            <?php wp_nav_menu( array(  
				    'theme_location' => 'primary', 'container'  => '', 'menu_class' => 'nav navbar-nav','fallback_cb' => 'businessup_fallback_page_menu','walker' => new businessup_nav_walker()
				     ) );
		      	?>
            <!-- Right nav -->
            
            <!-- /Right nav -->
          </div>

          <!-- /Navigation --> 
      </nav>
      </div>
  </div>
</header>
<!-- #masthead --> 