<?php   
/*
Template Name: Blog
*/

get_header();
get_template_part('parts/page-title');
?>

<!-- blog-classic -->
<div class="sidebar-page-container">
    <div class="auto-container"> 
        <div class="row clearfix">
            <div style="visibility: visible;" class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12 wow slideInLeft animated animated animated">
                <?php 
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array( 
                        'post_type' => 'post', 
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'paged' => $paged,
                        'order' => 'DESC',
                        'orderby' => 'date',
                        'category_name' => 'articles'
                    );
                    $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="news-style-two">
                                <div class="inner-box">
                                    <div class="image">
                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php
                                                the_post_thumbnail('medium_large');
                                            ?>
                                        </a>
                                    </div>
                                    <div class="lower-content text-justify">
                                        <div class="upper-box clearfix">
                                            <div class="pull-left">
                                                <div class="post-date">Posted: <span><?php echo get_the_date(); ?></span></div>
                                            </div>
                                        </div>
                                        <h3>
                                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="text">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="read-more blog_btn">Read More</a>
                                    </div>
                                </div>
                            </div><?php
                        endwhile;
                    } else { ?>
                        <h4>No Posts Found.</h4><?php
                    } ?>
                    <div class="pagination-wrapper centred">
                        <ul class="pagination">
                            <li>
                                <?php
                                    echo paginate_links(array(
                                        'total' => $loop->max_num_pages,
                                        'current' => max(1, get_query_var('paged')),
                                        'prev_text' => '&laquo;',
                                        'next_text' => '&raquo;',
                                    ));
                                ?>
                            </li>
                        </ul>
                    </div><?php
                wp_reset_postdata(); ?>
            </div>
            <?php /* <div style="visibility: visible;" class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12 wow slideInRight animated animated animated">
                <aside class="sidebar">
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h2 class="title">Recent Posts</h2>
                        </div>
                        <?php
                            $args = array( 'post_type' => 'post', 
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'nopaging' => false,
                                'order'    => 'DESC',
                                'orderby'  => 'date',
                                'taxonomy' =>'category',
                                'paged' => $paged
                            );
                            $loop = new WP_Query( $args ); 
                            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <article class="post">
                                    <figure class="post-thumb">
                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php
                                                the_post_thumbnail('medium_large');
                                            ?>
                                        </a>
                                    </figure>
                                    <div class="text">
                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </div>
                                    <div class="post-info">On: <?php echo get_the_date(); ?></div>
                                </article><?php
                            endwhile;
                        ?>
                    </div>           
                </aside>
            </div> */ ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>