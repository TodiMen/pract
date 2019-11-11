<?php
/**
 * Theme functions and definitions
 *
 * @package BusiMax
 */

if ( ! function_exists( 'busimax_enqueue_styles' ) ) :

	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function busimax_enqueue_styles() {

		wp_enqueue_style( 'businessup-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'busimax-style', get_stylesheet_directory_uri() . '/style.css', array( 'businessup-style-parent' ), '1.0' );
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style( 'busimax-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
		wp_dequeue_style( 'default',get_template_directory_uri() .'/css/colors/default.css');
	}

endif;

add_action( 'wp_enqueue_scripts', 'busimax_enqueue_styles', 99 );

//Header Two Custom Color
function busimax_header_widget_style() {

busimax_slider_style();
}
add_action('wp_footer','busimax_header_widget_style');  

function busimax_slider_style() {
 ?>
<style>
#businessup-slider .slide-caption {
    width: 100%;
    margin: 10% auto auto;
}
#businessup-slider .slide-caption h1
{
    font-size: 80px;
    font-weight: 700;
    color: rgb(255, 255, 255);
    letter-spacing: 0px;
    line-height: 1;
}

#businessup-slider .slide-caption {
    text-align: left;
}

#businessup-slider .btn:last-child {
    margin-left: 0;
}

#businessup-slider .slide-caption .description p
{
max-width: 642px;
white-space: normal;
font-size: 20px;
line-height: 32px;
font-weight: 400;
color: rgb(255, 255, 255);
letter-spacing: 0px;
margin: 0px;
padding: 0px;
transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
transform-origin: 50% 50% 0px;
}
#businessup-slider .slide-caption.slide-center .description p {
	margin: 0 auto;
}
.businessup-breadcrumb-section .overlay {
    padding: 350px 0px 135px 0px;
}
@media screen and (min-width: 768px) and (max-width: 980px) {
#businessup-slider .slide-caption h1
{
    font-size: 100%;
    line-height: 60px;
}
}
@media screen and (min-width: 240px) and (max-width: 767px) {
#businessup-slider .slide-caption h1
{
    font-size: 200%;
}
#businessup-slider .slide-caption {
    width: 100%;
    margin: 50% auto auto;
}
.businessup-breadcrumb-title h1 {
    font-size: 100%;
    line-height: 20px;
}
.businessup-breadcrumb-section .overlay {
    padding: 180px 0px 70px 0px;
}

#businessup-slider .slide-caption .description p
{
font-size: 14px;
line-height: 20px;
}
}
</style>
<?php } if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     *
     * @since Twenty Nineteen 1.4
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         *
         * @since Twenty Nineteen 1.4
         */
        do_action( 'wp_body_open' );
    }
endif; ?>