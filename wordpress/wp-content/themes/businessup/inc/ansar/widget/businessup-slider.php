<?php
add_action('admin_enqueue_scripts', 'businessup_slider_widget_scripts');

function businessup_slider_widget_scripts() {    

    wp_enqueue_media();

    wp_enqueue_script('businessup_slider_widget_script', get_template_directory_uri() . '/js/widget-slider.js', false, '1.0', true);

}

class businessup_slider_widget extends WP_Widget {    

    public function __construct() {
        parent::__construct(
            'businessup_slider-widget',
            __( 'BUP - Slider Widget', 'businessup' )
        );
    }

    function widget($args, $instance) {

        extract($args);

        echo $before_widget;
        
        $businessup_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $businessup_btnone_target = '_blank';
        endif;

        $businessup_btntwo_target = '_self';
        if( !empty($instance['open_btntwo_new_window']) ):
            $businessup_btntwo_target = '_blank';
        endif;

        ?>
    <div class="item">
        <figure>
            <?php if( !empty($instance['image_uri']) ): ?>

                    <img src="<?php echo esc_url($instance['image_uri']); ?>"/>

                <?php else:

                    echo '<img src="'.esc_url( get_template_directory_uri() ).'/images/slide/slide.jpg" class="img-responsive"/>'; 
                
                endif; ?>
        </figure>
		
        
      <div class="businessup-slider-inner">
        <div class="container inner-table">
          <div class="inner-table-cell">
            <div class="slide-caption slide">
             <div class="slide-inner-Default">
              <h1><?php echo esc_attr($instance['slider_title']); ?></h1>
              <div class="description">
				<?php if ( !empty($instance['slider_desc']) ): ?>
                <p><?php echo esc_attr($instance['slider_desc']); ?></p>
                <?php endif; ?>
              </div>
               <?php if ( !empty($instance['btnonelink']) ): ?>
                <a class="btn btn-tislider"  href="<?php echo esc_url($instance['btnonelink']); ?>" target="<?php echo esc_attr($businessup_btnone_target); ?>"><?php echo esc_attr($instance['btnone']); ?></a>
                <?php endif; ?>   
                </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['btnone'] = wp_kses_post($new_instance['btnone']);
		$instance['slider_title'] = wp_kses_post($new_instance['slider_title']);
		$instance['slider_desc'] = wp_kses_post($new_instance['slider_desc']);
		$instance['btnonelink'] = esc_url_raw($new_instance['btnonelink']);
        $instance['open_btnone_new_window'] = absint($new_instance['open_btnone_new_window']);
        $instance['image_uri'] = esc_url_raw($new_instance['image_uri']);

        $businessup_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $businessup_btnone_target = '_blank';
        endif;

		return $instance;

    }

    function form($instance) {
	?>
    
				<div style="width: 100%;">
				
				</div>	
				<td>
                    <label for="<?php echo $this->get_field_id('slider_title'); ?>"><?php esc_attr_e('Title', 'businessup'); ?></label>
                </td>
				<td>
                    <input type="text" name="<?php echo $this->get_field_name('slider_title'); ?>" id="<?php echo $this->get_field_id('slider_title'); ?>" value="<?php if( !empty($instance['slider_title']) ): echo $instance['slider_title']; endif; ?>" class="widefat"/>
                </td>
				
				<td>
                    <label for="<?php echo $this->get_field_id('slider_desc'); ?>"><?php esc_attr_e('Description', 'businessup'); ?></label>
                </td>
				<td>
                    <input type="text" name="<?php echo $this->get_field_name('slider_desc'); ?>" id="<?php echo $this->get_field_id('slider_desc'); ?>" value="<?php if( !empty($instance['slider_desc']) ): echo $instance['slider_desc']; endif; ?>" class="widefat"/>
                </td>
				<p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_attr_e('Image', 'businessup'); ?></label><br/>

            <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" alt="'.__( 'Upload Image', 'businessup' ).'" /><br />';

            endif;

            ?>

            <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">
            <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_team" name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php esc_attr_e('Upload Image','businessup'); ?>" style="margin-top:5px;">
        </p>
			
        <table>
			<tr>
                <td style="width: 50%;">
                    <label for="<?php echo $this->get_field_id('btnone'); ?>"><?php esc_attr_e('Button Text', 'businessup'); ?></label>
                </td>
                <td>
                    <label for="<?php echo $this->get_field_id('btnonelink'); ?>"><?php esc_attr_e('Button Link', 'businessup'); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name('btnone'); ?>" id="<?php echo $this->get_field_id('btnone'); ?>" value="<?php if( !empty($instance['btnone']) ): echo htmlspecialchars_decode($instance['btnone']); endif; ?>" class="widefat"/>
                </td>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name('btnonelink'); ?>" id="<?php echo $this->get_field_id('btnonelink'); ?>" value="<?php if( !empty($instance['btnonelink']) ): echo $instance['btnonelink']; endif; ?>" class="widefat"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="checkbox" name="<?php echo $this->get_field_name('open_btnone_new_window'); ?>" id="<?php echo $this->get_field_id('open_btnone_new_window'); ?>" <?php if( !empty($instance['open_btnone_new_window']) ): checked( (bool) $instance['open_btnone_new_window'], true ); endif; ?> ><?php esc_attr_e( 'Open link in a new tab','businessup' ); ?>
                </td>
            </tr>
        </table>
    <?php

    }

}