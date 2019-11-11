<?php
/*----Custom Header Color----*/ 
function businessup_custom_color() {
$slider_overlay = get_theme_mod('businessup_slider_overlay_color'); 
$businessup_service_text_color = get_theme_mod('businessup_service_text_color');
$businessup_callout_text_color = get_theme_mod('businessup_callout_text_color');
$businessup_news_text_color = get_theme_mod('businessup_news_text_color');
?>
<style type="text/css">
.businessup-blog-post-box h1.title, .businessup-blog-post-box h1.title a, .businessup-blog-post-box .small{
color: <?php echo esc_attr($businessup_news_text_color); ?>;
}

.businessup-callout .overlay h3, .businessup-callout .overlay p { color: <?php echo esc_attr($businessup_callout_text_color); ?>; }

.businessup-heading h3, .businessup-heading h3 a, .businessup-service:hover .businessup-service-inner p {
color: <?php echo esc_attr($businessup_service_text_color); ?>;
} 

#businessup-slider .businessup-slider-inner {
	background: <?php echo esc_attr($slider_overlay); ?>;
}
</style>
<?php
}
?>