<?php
add_action('admin_enqueue_scripts', 'businessup_service_widget_scripts');

function businessup_service_widget_scripts() {    

    wp_enqueue_media();

}

class businessup_service_widget extends WP_Widget {    

    public function __construct() {
        parent::__construct(
            'businessup_service_widget',
            __( 'BUP - Service Widget', 'businessup' )
        );
    }

    function widget($args, $instance) {

        extract($args);
		
		$instance['fa_icon'] = (isset($instance['fa_icon'])?$instance['fa_icon']:'');
		$instance['hide_image'] = (isset($instance['hide_image'])?$instance['hide_image']:'');

        echo $before_widget;
		
		$businessup_btn_target = '_self';
        if( !empty($instance['open_btn_new_window']) ):
            $businessup_btn_target = '_blank';
        endif;


        ?>
    <div class="col-sm-4 col-md-4">
            <div class="businessup-service">
                <div class="businessup-service-inner">
                    <?php if(($instance['fa_icon'])!=null){ ?>
                    <div class="ser-icon"> <?php echo '<i class="'.'fa '.$instance['fa_icon'] .'"></i>'; ?> </div> 
                    <?php } ?>
                    
                    <?php // Check for displaying feature image
                    if($instance['hide_image'] != true):    ?>
                    <div class="businessup-service-inner-img"> 
                        <?php if( !empty($instance['image_uri']) ): ?>

						<img class="img-responsive" src="<?php echo esc_url($instance['image_uri']); ?>">

						<?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <h3><?php echo esc_attr($instance['service_title']); ?></h3>
                    <div class="clearfix"></div>
                   <?php if ( !empty($instance['service_desc']) ): ?>
					<p><?php echo esc_attr($instance['service_desc']); ?></p>
					<?php endif; ?>

                    <?php if ( !empty($instance['btnlink']) ): ?>
                        <a class="btn btn-theme-three" href="<?php echo esc_url($instance['btnlink']); ?>" target="<?php echo esc_attr($businessup_btn_target); ?>"><?php echo esc_attr($instance['btnmore']); ?></a>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
		$instance['fa_icon'] = ( ! empty( $new_instance['fa_icon'] ) ) ? $new_instance['fa_icon'] : '';
        $instance['hide_image'] = isset($new_instance['hide_image']) ? absint($new_instance['hide_image']) : '';
        $instance['btn'] = wp_kses_post($new_instance['btn']);
		$instance['service_title'] = wp_kses_post($new_instance['service_title']);
		$instance['service_desc'] = wp_kses_post($new_instance['service_desc']);
		$instance['image_uri'] = esc_url_raw($new_instance['image_uri']);
		$instance['btnmore'] = wp_kses_post($new_instance['btnmore']);
        $instance['btnlink'] = esc_url_raw($new_instance['btnlink']);
        $instance['open_new_window'] = absint($new_instance['open_new_window']);

        $businessup_btn_target = '_self';
        if( !empty($instance['open_btn_new_window']) ):
            $businessup_btn_target = '_blank';
        endif;

        return $instance;

    }

    function form($instance) {
	$instance['fa_icon'] = isset($instance['fa_icon']) ? $instance['fa_icon'] : '';
	?>
				<div class="clearfix" style="height: 30px;"></div>
                <label for="<?php echo $this->get_field_id( 'fa_icon' ); ?>"><?php _e( 'Enter Font Awesome icon class (like: fa-cloud','businessup'); ?> <a href="https://fontawesome.com/v4.7.0/icons/" target="blank" > <?php _e('Find all icons here','businessup');?> </a></label> 
				  <input class="widefat" id="<?php echo $this->get_field_id( 'fa_icon' ); ?>" name="<?php echo $this->get_field_name( 'fa_icon' ); ?>" type="text" value="<?php echo esc_attr( $instance['fa_icon'] ); ?>" />
				</td>
   	
				<td style="margin-bottom: 30px;">
                    <label for="<?php echo $this->get_field_id('service_title'); ?>"><?php esc_html_e('Title', 'businessup'); ?></label>
                </td>
				<td>
                    <input type="text" name="<?php echo $this->get_field_name('service_title'); ?>" id="<?php echo $this->get_field_id('service_title'); ?>" value="<?php if( !empty($instance['service_title']) ): echo htmlspecialchars_decode($instance['service_title']); endif; ?>" class="widefat"/>
                </td>
				
				<td>
                    <label for="<?php echo $this->get_field_id('service_desc'); ?>"><?php esc_html_e('Description', 'businessup'); ?></label>
                </td>
				<td>
                    <textarea class="widefat" rows="4" cols="20" name="<?php echo $this->get_field_name('service_desc'); ?>" id="<?php echo $this->get_field_id('service_desc'); ?>"><?php if( !empty($instance['service_desc']) ): echo htmlspecialchars_decode($instance['service_desc']); endif; ?></textarea>
                </td>
				<p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php esc_html_e('Image', 'businessup'); ?></label><br/>

            <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" alt="'.__( 'Upload Image', 'businessup' ).'" /><br />';

            endif;

            ?>

            <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">
            <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_team" name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php esc_html_e('Upload Image','businessup'); ?>" style="margin-top:5px;">
        </p>

        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('hide_image'); ?>" id="<?php echo $this->get_field_id('hide_image'); ?>" <?php if( !empty($instance['hide_image']) ): checked( (bool) $instance['hide_image'], true ); endif; ?> ><?php esc_html_e( 'Hide Featured Image','businessup' ); ?>
            </p>
		<table>
        <tr>
        		<td>
        			<label for="<?php echo $this->get_field_id('btnmore'); ?>"><?php esc_html_e('Button Text', 'businessup'); ?></label>
        		</td>
        		<td>
        			<label for="<?php echo $this->get_field_id('btnlink'); ?>"><?php esc_html_e('Button Link', 'businessup'); ?></label>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btnmore'); ?>" id="<?php echo $this->get_field_id('btnmore'); ?>" value="<?php if( !empty($instance['btnmore']) ): echo htmlspecialchars_decode($instance['btnmore']); endif; ?>" class="widefat"/>
        		</td>
        		<td>
        			<input type="text" name="<?php echo $this->get_field_name('btnlink'); ?>" id="<?php echo $this->get_field_id('btnlink'); ?>" value="<?php if( !empty($instance['btnlink']) ): echo $instance['btnlink']; endif; ?>" class="widefat"/>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<span>&nbsp;</span>
        		</td>
        	</tr>
        	<tr>
        		<td colspan="2">
        			<input type="checkbox" name="<?php echo $this->get_field_name('open_new_window'); ?>" id="<?php echo $this->get_field_id('open_new_window'); ?>" <?php if( !empty($instance['open_new_window']) ): checked( (bool) $instance['open_new_window'], true ); endif; ?> ><?php esc_html_e( 'Open link in a new tab','businessup' ); ?>
        		</td>
        	</tr>
		</table>	
    <?php

    }

}