<?php get_header(); ?>

  <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg'); ?>);"></div>
        <div class="page-banner__content container container--narrow">
          <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>Learn how the school of your dreams got started.</p>
        </div>
      </div>  
    </div>

    <div class="container container--narrow page-section">
  <?php
    $post = get_the_ID();
    $theparent = wp_get_post_parent_id($post); 
    //check the blog section
    if(get_the_title($post)=="Blog"){
    /*
     * Template name: Blog section template
     */
    $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1; // get current page number
    $args = array(
            'posts_per_page' => get_option('posts_per_page'), // the value from Settings > Reading by default
            'paged'          => $current_page // current page
                  );
    query_posts( $args );
 
    $wp_query->is_archive = true;
    $wp_query->is_home = false;
 
    while(have_posts()): the_post();
      ?>
      <h2><?php the_title() /* post title */ ?></h2>
      <p><?php the_content() /* post content */ ?></p>
    <?php
    endwhile;
 
    if( function_exists('wp_pagenavi') ) wp_pagenavi(); // WP-PageNavi function

    }else{
    while (have_posts()) {
    the_post(); 
        $post = get_the_ID();
        $theparent = wp_get_post_parent_id($post); 
       if($theparent){ ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theparent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theparent);?></a> <span class="metabox__main"><?php the_title();?></span></p>
    </div>
       <?php } ?> 

    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theparent)?>"><?php echo get_the_title($theparent);?></a></h2>
      <ul class="min-list">
        <?php 
          if($theparent){
            $findchildrenOf = $theparent;
          }else{
            $findchildrenOf = get_the_ID();
          }
          wp_list_pages(array(
            'title_li' => NULL,
                'child_of' => $findchildrenOf 
            ));
        ?>
      </ul>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>

<?php }} get_footer(); ?>