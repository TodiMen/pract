<?php $businessup_news_enable = get_theme_mod('businessup_news_enable','true');
$disable_news_meta = get_theme_mod('disable_news_meta','false');

$businessup_news_subtitle = get_theme_mod('businessup_news_subtitle');

	if($businessup_news_enable !='false')
	{ $businessup_total_posts = get_option('posts_per_page'); /* number of latest posts to show */
	
	if( !empty($businessup_total_posts) && ($businessup_total_posts > 0) ):
	?>

<!--==================== BLOG SECTION ====================-->
<section id="blog" class="businessup-blog-section">
	<div class="overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-12 padding-bottom-50 text-center">
          <div class="businessup-heading">
            <?php $businessup_news_title = get_theme_mod('businessup_news_title');
          
            if( !empty($businessup_news_title) ):
              echo '<h3 class="businessup-heading-inner">'.esc_attr($businessup_news_title).'</h3>';
            endif;  
          
           if( !empty($businessup_news_subtitle) ):

              echo '<p class="subtitle">'.esc_attr($businessup_news_subtitle).'</p>';

            endif; ?> 
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <div class="row">
        <div id="home-news">
        <?php $news_select = get_theme_mod('news_select',3);
			   $businessup_latest_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => $news_select, 'order' => 'DESC','ignore_sticky_posts' => true, ''));
			    if ( $businessup_latest_loop->have_posts() ) :
			     while ( $businessup_latest_loop->have_posts() ) : $businessup_latest_loop->the_post();?>
       <div class="col-md-4">
          <div class="businessup-blog-post-box">
            <?php if(has_post_thumbnail()): ?>
            <a title="<?php the_title_attribute(); ?>" href="<?php esc_url(the_permalink()); ?>" class="ta-blog-thumb"> 
              <?php $defalt_arg =array('class' => "img-responsive"); ?>
              <?php the_post_thumbnail('', $defalt_arg); ?>
            </a>  
            <?php endif; ?>
            <article class="small">
              <h1 class="title"> <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_title() ?></a> </h1>
              <?php if($disable_news_meta !=true) {?>
			  <div class="ta-blog-category">
                <span class="ta-blog-date"><?php echo get_the_date('M'); ?> <?php echo get_the_date('j'); ?>, </span>
                <?php $cat_list = get_the_category_list();
								if(!empty($cat_list)) { ?>
                <?php the_category(', '); ?>
                <?php } ?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <?php echo esc_html_e('by','businessup'); ?>
                <?php the_author(); ?>
                </a> 
              </div>
			  <?php } ?>
			<?php the_excerpt(); ?>
            </article>
          </div>
        </div>
		<?php endwhile; endif;	wp_reset_postdata(); ?>
      </div>
        
      </div></div>
    </div>
    <!-- /.container --> 
  </div>
</section>
<?php endif; ?>
<?php } ?>