<?php 

/**display donated numbers on home page */
add_shortcode('display_donated_number','display_donated_number_callback');
function display_donated_number_callback(){
	ob_start(); ?>
	<div class="row custom-flex">
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-1.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('kidneys_donated','option'); ?></h3>
						<h4>KIDNEYS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>"> Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-2.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('livers_donated','option'); ?></h3>
						<h4>LIVER <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor');?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
			<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-3.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('hearts_donated','option'); ?></h3>
						<h4>HEARTS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/lungs.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('lungs_donated','option'); ?></h3>
						<h4>LUNG <br> DONATED </h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-4.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('pancreas_donated','option'); ?></h3>
						<h4>PANCREAS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-9.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('intestine_donated','option'); ?></h3>
						<h4> INTESTINE <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h7.png" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('hands_donated','option'); ?></h3>
						<h4>HANDS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
			<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-5.jpg" alt="Images" class="img-responsive" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('eyes_donated','option'); ?></h3>
						<h4>EYES <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
	</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h4 class="digit-below">Total <?php echo get_field('total_donated','option'); ?> Organs & Tissues donated which has given New Life & Vision to 1147 persons across Country & Globe.</h4>
			</div>
		</div>
		<?php //$total = $web_arr['kidneys_donated'] + $web_arr['intestine_donated'] + $web_arr['livers_donated'] + $web_arr['hearts_donated'] + $web_arr['pancreas_donated'] + $web_arr['eyes_donated'] + $web_arr['hand_donation']; ?>
		
	<?php 
	return ob_get_clean();
}

/**shortcode for home page awards section */
add_shortcode( 'display_awards_home','display_awards_callback');
function display_awards_callback(){
	ob_start();
	$args = array(
		'post_type' => 'awards_appr',
		'post_status' => 'publish',
		'posts_per_page' => 4,
		'orderby' => 'menu_order',
		'order' => 'asc',
	);
	$awardslist = get_posts($args);
	
	if(!empty($awardslist)){
		foreach($awardslist as $award) {
			$awid = $award->ID;
			$pdf = get_field('award_pdf',$awid);
			$pdflink = !empty($pdf) ? $pdf['url'] : '';
			$featuredimg = get_the_post_thumbnail( $awid,array(370,230), array('class' => 'img-responsive'));
			$desc = $award->post_content;
			?>
			<div class="col-md-6 col-sm-6 col-xs-12 event-block">
				<!-- Start single-item -->
				<div class="event-item">
					<div class="img-holder">
						<a class="event-open" target="_blank" href="<?php echo $pdflink; ?>" title="<?php echo $desc; ?>">
							<i class="eg-icon-search" aria-hidden="true"></i>
							<?php if(has_post_thumbnail( $awid )) { ?>
								<figure><span><?php echo $featuredimg; ?></span></figure>
							<?php } ?>
						
							<div class="text">
								<h4>
									<span class="award-title">
									<?php
										$length = strlen($desc);
										if ($length > 32){
											echo substr($desc, 0 ,32);
											echo "...";
										}
										else{
											echo $desc;
										}

									?>
									</span>
								</h4>
							</div>
						</a>
					</div>
				</div>
				<!-- End single-item -->
			</div>
	<?php } } 
	return ob_get_clean();

}

/**Team member listing shortcode */
add_shortcode( 'teamlist','get_team_member_data' );
function get_team_member_data($atts) {
	$typed = shortcode_atts(array('m_type'=>'office-bearers'), $atts);
	ob_start(); 
	$args = array(
		'post_type' => 'team_members',
		'post_status' => 'publish',
		'orderby' =>'menu_order',
		'posts_per_page' => -1,
		'order' => 'asc',
		'tax_query' => array(
			array(
				'taxonomy' => 'team_type',
				'terms' => $typed['m_type'],
				'field' => 'slug',
				'operator' => 'IN'
			),
		),
	);

	$teamlist = get_posts($args);

	if(!empty($teamlist)) {
		foreach($teamlist as $tl) {
			$tid = $tl->ID;
			$imgurl = has_post_thumbnail($tid) ? get_the_post_thumbnail( $tid, 'medium') : '';
			$description = $tl->post_content;
	?>
		<div class="col-md-3 col-sm-6 col-xs-12 team-single-item">
			<!-- Start single-item -->
			<div class="single-item wow fadeInUp">
				<div class="img-holder">
					<figure><?php echo $imgurl; ?></figure>
					<!-- Start overlay -->
					<div class="overlay">
						<div class="link-icon">
						</div>
					</div>
					<!-- End overlay -->
				</div>
				<div class="text">
					<h4><a><?php echo get_the_title( $tid ); ?></a></h4>
					<p><?php echo get_field('member_designation',$tid); ?></p>
					<?php if($description != '') { ?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $tid; ?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View Details</a><?php } ?>
				</div>
			</div>
			<!-- End single-item -->
			<div class="modal fade myModal teamModal" id="myModal<?php echo $tid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><?php echo get_the_title( $tid ); ?></h4>
						</div>
						<div class="modal-body">
							<?php echo $description; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php 
		}
	}else{
		echo 'no data found';
	}
	return ob_get_clean();
}

/**Testimonial listing shortcode */
add_shortcode( 'list_testimonials','get_testimonial_list' );
function get_testimonial_list($atts){
	$typed = shortcode_atts( array('type'=>'testimonial'), $atts );
	ob_start();

	$args = array(
		'post_type' => 'testimonials',
		'post_status' => 'publish',
		'orderby' =>'menu_order',
		'order' => 'asc',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'testimonial_type',
				'terms' => $typed['type'],
				'field' => 'slug',
				'operator' => 'IN'
			),
		),
	);

	$testimonidal_data = get_posts( $args );
	$size = ($typed['type'] == 'feelings-of-organ-recipients') ? 'large' : array(260,340);
	$colsize9 =  ($typed['type'] == 'feelings-of-organ-recipients') ? 'col-sm-6' : 'col-sm-9';
	$colsize3 =  ($typed['type'] == 'feelings-of-organ-recipients') ? 'col-sm-6' : 'col-sm-3';
	if(!empty($testimonidal_data)) {
		$i = 1;
		foreach($testimonidal_data as $ttdata) {
			$ttid = $ttdata->ID;
			$title = get_the_title( $ttid );
			$desc = $ttdata->post_content;
			$designation = get_field('tt_designation',$ttid);
			$ytlink = get_field('tt_youtube_link',$ttid);
			
			$image = (has_post_thumbnail( $ttid )) ? get_the_post_thumbnail( $ttid, $size, array('class' => 'img-responsive') ) : '';
 			if(wp_is_mobile()) { ?>
				<div class="news-well wow fadeInUp news-line animated testimonial-block visible-xs" style="visibility: visible; animation-name: fadeInUp;">
					<div class="row">
						<div class="<?php echo $colsize9; ?>"><p><i class="quote">“</i> </p>
							<p><?php echo $desc; ?></p>
							<h3>- &nbsp;<?php echo $title; if ($designation != '' ) { ?>&nbsp;(<?php echo $designation; ?>)<?php } ?></h3>
							<?php if ($ytlink != '') { ?>
								<div class="video-gallery">
									<a href="<?php echo $ytlink;?>" >
										<div class=" btn-3">
											<i class="fa fa-youtube-square" aria-hidden="true"></i>
											View Video
										</div>
									</a>
								</div>
							<?php } ?>
						</div>
						<div class="<?php echo $colsize3; ?>"><?php echo $image; ?></div>
					</div>
				</div>
			<?php 
			}else{
				if($i % 2 == 0 ) {  ?>
                    <div class="news-well wow fadeInUp news-line animated testimonial-block hidden-xs" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                            <div class="<?php echo $colsize3; ?>"><?php echo $image; ?></div>
                            <div class="<?php echo $colsize9; ?>"><p><i class="quote">“</i> </p>
                                <p><?php echo $desc; ?></p>
                                <h3>- &nbsp;<?php echo $title; if ($designation != '' ) { ?>&nbsp;(<?php echo $designation; ?>)<?php } ?></h3>

                                <?php if ($ytlink != '') { ?>
                                    <div class="video-gallery">
                                        <a href="<?php echo $ytlink;?>">
                                            <div class=" btn-3">
                                                <i class="fa fa-youtube-square" aria-hidden="true"></i>
                                                    View Video
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="news-well wow fadeInUp news-line animated testimonial-block hidden-xs" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                            <div class="<?php echo $colsize9; ?>"><p><i class="quote">“</i> </p>
                                <p><?php echo $desc; ?></p>
                                <h3>- &nbsp;<?php echo $title; if ($designation != '' ) { ?>&nbsp;(<?php echo $designation; ?>)<?php } ?></h3>

                                <?php if ($ytlink != '') { ?>
                                <div class="video-gallery">
                                    <a href="<?php echo $ytlink;?>" >
                                        <div class=" btn-3">
                                            <i class="fa fa-youtube-square" aria-hidden="true"></i>
                                                View Video
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="<?php echo $colsize3; ?>"><?php echo $image; ?></div>
                        </div>

                    </div>
			<?php }
			}
			$i++;
		}
	}
	return ob_get_clean();
}

/**Display filters on electronic media page */
add_shortcode( 'display_date_filters','display_date_filter' );
function display_date_filter(){
	ob_start(); 
	global $wpdb;

    // Query for all posts with the custom field 'em_date'
    $post_type = 'electronic_media';
    $meta_key = 'em_date';

    // Get unique years
    $years = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT YEAR(meta_value) AS year 
        FROM {$wpdb->postmeta}
        WHERE meta_key = %s and meta_value != ''
        ORDER BY year DESC", $meta_key
    ),ARRAY_A);

    // Get unique months
    $months = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT MONTH(meta_value) AS month 
        FROM {$wpdb->postmeta}
        WHERE meta_key = %s and meta_value != ''
        ORDER BY month ASC", $meta_key
    ),ARRAY_A);

    // Get unique days
    $emtypes = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT meta_value AS type 
        FROM {$wpdb->postmeta}
        WHERE meta_key ='em_type'
        ORDER BY type ASC"
    ),ARRAY_A);


	?>
	<div class="row">
            <form class="filter-form">
                <div class="col-sm-3">
                    <div class="form-group">
						<select class="form-control" name="month" id="month">
							<option value="">Select Month</option>
							<?php foreach($months as $mnt) {
								if($mnt['month'] != '') {
									echo '<option value="'.$mnt['month'].'">'. date("F", mktime(0,0,0,$mnt['month'])).'</option>';
								}
							} ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
						<select class="form-control" name="year" id="year">
							<option value="">Select Year</option>
                            <?php foreach($years as $yr) {
								if($yr['year'] != '') {

									echo '<option value="'.$yr['year'].'">'.$yr['year'].'</option>';
								}
							} ?>
                        </select>
                        
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="type" id="type">
							<option value="">Select Type</option>
							<?php foreach($emtypes as $dy) {
								echo '<option value="'.$dy['type'].'">'.$dy['type'].'</option>';
							} ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-color btn-block" id="filter_btn">Apply Filter</button>
                    </div>
                </div>
            </form>
        </div>
		<hr>
	<?php return ob_get_clean();
}

/**downloads page shortcode */
add_shortcode( 'downloads_pdf', 'fetch_pdf_data' );
function fetch_pdf_data(){
	ob_start();
	$args = array(
		'post_type' => 'downloadspdf', 
		'post_status' => 'publish', 
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'asc',
	);

	$getpdflist = get_posts( $args );
	
	if(!empty($getpdflist)){
		foreach($getpdflist as $index => $row) {
			$downloadid = $row->ID;
			$file = get_field('upload_pdf', $downloadid);
			$image = has_post_thumbnail( $downloadid ) ? get_the_post_thumbnail_url( $row->ID ) : '';
			$downloadTitle = $row->post_title;
			$downloadDate = get_field('pdf_date', $downloadid);
			$newDate = date("M d, Y", strtotime($downloadDate));
			?>

			<div class="col-md-4 col-sm-6 photogallery-block">
				<div class="gallery-item">
					<div class="img-holder">
						<div class="text-center csr-gallery position-relative wow fadeInUp" data-wow-duration="300ms">
							<a class="" href="<?php echo $file; ?>" target="_blank">
								<figure>
									<img src="<?php echo $image; ?>" alt="<?php echo $downloadTitle; ?>" class="" height="300" loading="lazy"/>
									<div class="overlay">
										<span class="overlay-span">
											<i class="fa fa-search" aria-hidden="true"></i>
										</span>
									</div>
								</figure>
							</a>
						</div>
					</div>
					<h4><?php echo $downloadTitle; ?></h4>
				</div>
			</div>

		<?php } } 
	return ob_get_clean();
}

//video gallery shortcode for founder pages and gallery pages.
add_shortcode('abt_video_gallery', 'abt_video_gallery_shortcode');
function abt_video_gallery_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'type' => 'vyakti-vishesh-ci', 
    ), $atts);
	$posts_per_page = 18;
	$offset = 0;
    // Start output buffering
    ob_start();

    // Prepare the query arguments based on the selected type
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => 18,
        'offset' => $offset,
		'post_status' => 'publish'
    );

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'vi_gl_type',
			'field'    => 'slug',
			'terms'    => $atts['type'],
		),
	);

    // The query
    $gqry = new WP_Query($args);
    ?>
	<div class="search-box">
		
		<input type="text" placeholder="Search" value="" name="vg_srch" id="vg_srch" class="hip-search-input" data-term="<?php echo $atts['type']; ?>">
	</div>

	<div class="items-container hip-grid" id="abt-video-gallery">
		<?php get_video_grid_layout($gqry,$posts_per_page,$offset,$atts['type']); ?>
	</div>

    <?php
    return ob_get_clean(); // Return the buffered output
}

/**Display tabs for video gallery - video-gallery-all */
add_shortcode('video_gallery', 'video_gallery_shortcode');
function video_gallery_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'type' => 'all', 
    ), $atts);
	$posts_per_page = 18;
	$offset = 0;
    // Start output buffering
    ob_start();

    // Prepare the query arguments based on the selected type
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => 18,
        'offset' => $offset,
		'post_status' => 'publish',
		// 'orderby' => 'meta_value',
        // 'meta_key' => 'vg_date', 
        // 'order' => 'DESC',
    );
	if($atts['type'] === 'all') {
		$args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => array('awareness-aw','speech-sp','vyakti-vishesh-ci'),
            ),
        );
	} else if ($atts['type'] === 'awareness') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'awareness-aw',
            ),
        );
    } else if ($atts['type'] === 'speech') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'speech-sp',
            ),
        );
    }

    // The query
    $gqry = new WP_Query($args);
	
    ?>
    <section class="gallery-section">
        <div class="container">
			<div class="filters text-center">
                <ul class="filter-tabs filter-btns clearfix">
                    <li class="filter <?php echo ($atts['type'] == 'all') ? 'active' : ''; ?>" data-type="all"><a href="<?php echo home_url('/video-gallery-all/'); ?>"><span>ALL</span></a></li>
                    <li class="filter <?php echo ($atts['type'] == 'awareness') ? 'active' : ''; ?>" data-type="awareness"><a href="<?php echo home_url('/video-gallery-awareness/'); ?>"><span>Awareness</span></a></li>
                    <li class="filter <?php echo ($atts['type'] == 'speech') ? 'active' : ''; ?>" data-type="speech"><a href="<?php echo home_url('/video-gallery-speech/'); ?>"><span>Speech</span></a></li>
                </ul>
            </div>
			<div class="search-box">
				
				<input type="text" placeholder="Search" value="" name="vg_srch" id="vg_srch" class="hip-search-input" data-term="<?php echo $atts['type']; ?>">
			</div>

            <div class="items-container hip-grid" id="video-gallery">
                <?php get_video_grid_layout($gqry,$posts_per_page,$offset,$atts['type']); ?>
                
            </div>

        </div>
    </section>
    <?php
    return ob_get_clean(); // Return the buffered output
}

/** display FAQ data */
add_shortcode( 'faq_list', 'fetch_faq_data' );
function fetch_faq_data(){
	ob_start();
	
	$args = array(
		'post_type' => 'faq_post', 
		'post_status' => 'publish', 
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'asc',
	);

	$faqlist = get_posts( $args );

	foreach($faqlist as $index => $row){
	$title = $row->post_title;
	$description = $row->post_content;
	?>

	<div class="faq-box">
		<h2 class="faq-head"><?php echo $title; ?></h2>
		<p><?php echo $description; ?></p>
	</div>
		<?php
	}
	return ob_get_clean();
}

/**About founder gallery ul li tab view - founder-photo-gallery */
add_shortcode( 'founder_tabs', 'display_category_list');
function display_category_list($atts){ 
	$args = shortcode_atts( array('category'=>'dignitaries'), $atts );
	$catname = $args['category'];
	
	ob_start();
	?>
	<ul class="filter-tabs filter-btns clearfix">
		<?php /* <li class="filter <?php echo ($catname == 'all') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-photo-gallery"><span class="txt">ALL</span></a></li> */ ?>
		<li class="filter <?php echo ($catname == 'dignitaries') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/dignitaries-photo-gallery"><span class="txt">Dignitaries</span></a></li>
		<li class="filter <?php echo ($catname == 'awareness') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/awareness-program-photo-gallery"><span class="txt">Awareness program</span></a></li>
		<li class="filter <?php echo ($catname == 'organ-donation') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/organ-donation-photo-gallery"><span class="txt">Organ donation</span></a></li>
		<li class="filter <?php echo ($catname == 'organ-recipients') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/organ-recipients-photo-gallery"><span class="txt">Organ recipients</span></a></li>
	</ul>
	<?php 
	return ob_get_clean();
}

/**Media coverage ul li tab view - founder-direct-coverage */
add_shortcode( 'media_coverage_tabs', 'display_tabs_list');
function display_tabs_list($atts){ 
	$args = shortcode_atts( array('tabs'=>'press-coverage'), $atts );
	$catname = $args['tabs'];
	
	ob_start();
	?>
	<ul class="filter-tabs filter-btns clearfix">
		<li class="filter <?php echo ($catname == 'press-coverage') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-direct-coverage"><span class="txt">Press Coverage</span></a></li>
		<li class="filter <?php echo ($catname == 'vyakti-vishesh-ci') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/video-gallery-interview"><span class="txt">Vyakti Vishesh</span></a></li>
		<li class="filter <?php echo ($catname == 'el-media') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-electronic-media"><span class="txt">Electronic Media</span></a></li>
		<li class="filter <?php echo ($catname == 'dl-media') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-digital-media"><span class="txt">Digital Media</span></a></li>
		<li class="filter <?php echo ($catname == 'radio-talk-rt') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/video-gallery-radiotalk"><span class="txt">Radio Talk</span></a></li>
	</ul>
	<?php 
	return ob_get_clean();
}

/**Media coverage ul li tab view - founder-direct-coverage */
add_shortcode( 'press_coverage_tabs', 'display_press_tabs_list');
function display_press_tabs_list($atts){ 
	$args = shortcode_atts( array('tabs'=>'cadaver-activities'), $atts );
	$catname = $args['tabs'];
	
	ob_start();
	?>
	<ul class="filter-tabs filter-btns clearfix">
		<li class="filter <?php echo ($catname == 'cadaver-activities') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/cadaver-organ-donation-activities"><span class="txt">Cadaver Organ Donation Activities</span></a></li>
		<li class="filter <?php echo ($catname == 'life-activities') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/donate-life-activities"><span class="txt">Donate Life Activities</span></a></li>
		<li class="filter <?php echo ($catname == 'press-other') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/press-other"><span class="txt">Others</span></a></li>
		
	</ul>
	<?php 
	return ob_get_clean();
}