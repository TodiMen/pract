<?php
/**
 * The template for displaying search results pages.
 *
 * @package businessup
 */

get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<main id="content">
  <div class="container">
    <div class="row">
      <div class="<?php if( !is_active_sidebar('sidebar-1')) { echo "col-md-12"; } else { echo "col-md-9"; } ?> col-sm-8">
        <div class="row">
          <?php 
		global $i;
		if ( have_posts() ) : ?>
		<h2><?php printf( __( "Search Results for: %s", 'businessup' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		<?php while ( have_posts() ) : the_post();  
		 get_template_part('content','');
		 endwhile; else : ?>
		<h2><?php esc_attr_e( "Nothing Found", 'businessup' ); ?></h2>
		<div class="">
		<p><?php esc_attr_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'businessup' ); ?>
		</p>
		<?php get_search_form(); ?>
		</div><!-- .blog_con_mn -->
		<?php endif; ?>
         </div>
      </div>
	  <aside class="col-md-3">
        <?php get_sidebar(); ?>
      </aside>
    </div>
  </div>
</main>
<?php
get_footer();
?>