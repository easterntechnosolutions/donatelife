<?php get_header(); 

$pagedata = get_queried_object();
$pageid = $pagedata->ID;
	if ( get_field( 'page_title_section', $pageid) ) {
        $feaured_image_array = get_field( 'background_image', $pageid );   
		$feaured_image = $feaured_image_array['url'];
	} else {
		$feaured_image = get_stylesheet_directory_uri() . "/images/background/17.jpg";
	}
?>
<section class="slider-section">
    <?php 
    echo wp_get_attachment_image( $feaured_image_array['id'], 'full', false, array('class' => 'img-responsive') );
    ?>
</section>

<section class="page-title page-title-small border-bottom-light border-top-light" id="breadcrumbs">
	<div class="container" style="padding-top:0;padding-bottom:0;">
		<div class="row">
			<div class="col-md-6 col-sm-12 title-line-left" data-wow-duration="300ms">
				<h1>Blog</h1>
			</div>
			<div class="col-md-6 text-uppercase xs-display-none hidden-xs hidden-sm" data-wow-duration="600ms">
				<ul class="breadcrumb-list">
					<?php ah_breadcrumb(); ?>
				</ul>
			</div>
		</div>
	<div>
</section>

<section class="blog-seciton blog-pag">
    <div class="container">
    
    <?php 
    if (have_posts()) : ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <div class="post col-md-4 col-sm-6 col-xs-12 clearfix wow zoomIn blog-post" data-wow-duration="2s">
                    <div class="blog-item wow fadeInUp">
                        <div class="img-holder">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php echo get_the_post_thumbnail(get_the_ID(),array('370','220')); ?>
                                    <?php endif; ?>
                                </a>
                            </figure>
                        </div>
                        <div class="text">
                            <h4><a href="<?php the_permalink(); ?>"><?php echo substr(stripslashes(get_the_title()),0,60).'...'; ?></a></h4>
                            <h5><i class="fa fa-calendar"></i><span><?php echo date('F d, Y',strtotime(get_the_date())); ?></span></h5><br>
                            <div class="blog-read-more">
                                <a href="<?php the_permalink(); ?>" class="dont-btn">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <ol class="pagination">
            <li class="page-item">
                <?php 
                    // Check if it's the first page
                    if (get_query_var('paged') > 1) {
                        previous_posts_link('«');
                    } else {
                        echo '<span class="disabled">«</span>';
                    }
                ?>
                
            </li>
            <li class="page-item">
                <?php 
                    global $wp_query;
                    $max_pages = $wp_query->max_num_pages;
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    // Check if it's the last page
                    if ($paged < $max_pages) {
                        next_posts_link('»');
                    } else {
                        echo '<span class="disabled">»</span>';
                    }
                ?>
            </li>
        </ol>
        
    <?php else : ?>
        <p><?php _e('No posts found.', 'donatelife'); ?></p>
    <?php endif; ?>
    </div>

</section>
<?php get_footer(); ?>
