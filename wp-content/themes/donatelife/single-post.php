<?php get_header(); ?>
<section class="slider-section">
   <?php 
        
        if ( get_field( 'page_title_section', $post->ID ) ) {
            $feaured_image_array = get_field( 'background_image', $post->ID  );
            $feaured_image = $feaured_image_array['url'];
        } else {
            $feaured_image = get_stylesheet_directory_uri() . "/images/background/17.jpg";
        }

		echo wp_get_attachment_image( $feaured_image_array['id'], 'full', false, array('class' => 'img-responsive') );
   ?>
</section>
<!-- Page Title -->
<section class="page-title page-title-small border-bottom-light border-top-light" id="breadcrumbs">
	<div class="container" style="padding-top:0;padding-bottom:0;">
		<div class="row">
            <div class="col-md-12 col-sm-12 title-line-left" data-wow-duration="300ms">
                <h1 class="black-text"><?php echo get_the_title(); ?></h1>
            </div>
			
		</div>
	<div>
</section>
<section class="blog-seciton blog-pag">
    <div class="container" id="blog">
        <div class="">
            <div class="col-sm-8">
                <div class="divider no-margins"></div>
                <main class="main-content">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('course-details'); ?>>
                        
                                <h2 class="course-details__title"><?php the_title(); ?><span class="st_sharethis_large pull-right" st_url="<?php echo get_the_permalink(); ?>" st_title="<?php echo get_the_title(); ?>" st_image="<?php echo get_the_post_thumbnail_url(); ?>" st_summary=""></span></h2>
                                <div class="list-courses__meta"><i class="fa fa-calendar"></i> <?php echo date('F d, Y',strtotime(get_the_date())); ?></div><br/>
                                <div class="course-details_subtitle"><?php echo stripcslashes(get_the_content()); ?></div>
                        
                        </article>
                    <?php endwhile; endif; ?>
                </main>
                <div id="disqus_thread"></div>
            </div>

            <div class = "col-sm-4" id="blogside">
                <div class="sidebar">
                    <div class="category">
                        <h2>Recent Blogs</h2>
                        <?php 
                        if ( is_active_sidebar( 'page-sidebar' ) ) {
                            dynamic_sidebar('page-sidebar');
                        } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

/**
 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://donatelife-org-in-1.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "37e13c2468560771336a789fba134bff", onhover: false});</script>
<?php get_footer(); ?>