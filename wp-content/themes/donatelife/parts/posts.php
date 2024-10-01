<?php   
	get_header();
	get_template_part('parts/page-title');
?>

<!-- blog-classic -->
<div class="sidebar-page-container">
    <div class="auto-container"> 
        <div class="row clearfix">
            <div style="visibility: visible;" class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12 wow slideInLeft animated animated animated">
                <?php 
                    if ( have_posts() ) {
						while (have_posts()) : the_post(); ?>
							<div style="visibility: visible;" class="news-style-two wow slideInLeft animated animated animated">
								<div class="inner-box">
									<div class="lower-content text-justify">
										<div class="upper-box clearfix">
											<div class="pull-left">
												<div class="post-date">Posted: <span><?php echo get_the_date(); ?></span></div>
											</div>
										</div>
										<h3>
											<?php the_title(); ?>
										</h3>
										<div class="image" style="margin-bottom: 20px">
											<?php
												the_post_thumbnail('medium_large');
											?>
										</div><?php
										$count = 1;
										if( have_rows('content_blocks') ) {
											while( have_rows('content_blocks') ): the_row(); ?>
												<section id="content_block_<?php echo $count; ?>" class="content_blocks_lists content_block_<?php echo $count; ?>">
													<?php
														echo $sub_content_block = get_sub_field('content_block');
													?>
												</section><?php
												$count++;
											endwhile;
										} else { ?>
											<div class="page_contents_section about-section">
												<div class="auto-container"><?php
													if( '' !== get_post()->post_content ) {
														the_content();
													} else {
														echo "<h5 style='font-weight: bold'>No Contents Found.</h5>";
													} ?>
												</div>
											</div><?php
										} ?>
									</div>
								</div>
							</div><?php
						endwhile;
                		wp_reset_postdata();
					} else { ?>
						<h4>No Posts Found.</h4><?php
					}
				?>
            </div>
            <div style="visibility: visible;" class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12 wow slideInRight animated animated animated">
                <aside class="sidebar">
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h2 class="title">Recent Posts</h2>
                        </div>
                        <?php
                            $args = array(
								'post_type' => 'post', 
                                'post_status' => 'publish',
                                'posts_per_page' => 20,
                                'nopaging' => false,
                                'order'    => 'DESC',
                                'orderby'  => 'date',
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
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>