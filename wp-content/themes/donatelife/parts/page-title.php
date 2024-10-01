
<?php

	global $post;
	if ( get_field( 'page_title_section', $post->ID ) ) {
		$feaured_image_array = get_field( 'background_image', $post->ID  );
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
<!-- Page Title -->
<section class="page-title page-title-small border-bottom-light border-top-light" id="breadcrumbs">
	<div class="container" style="padding-top:0;padding-bottom:0;">
		<div class="row">
			<div class="col-md-6 col-sm-12 title-line-left" data-wow-duration="300ms">
				<?php
				if ( is_front_page() && is_home() ) {
					echo  "<h2>";
				} else {
					echo "<h1>";
				}
				if (is_blog()) :
					if (is_category()) :
						single_cat_title("Category: ");

					elseif (is_tag()) :
						single_tag_title("Tag: ");

					elseif (is_day()) : 
						echo "Day of : " . get_the_time('l, F j, Y');

					elseif (is_month()) :
						echo "Month of : " . get_the_time('F Y');

					elseif (is_year()) :
						echo "Year of : " . get_the_time('Y');

					elseif (is_single()) :
						// echo get_the_title( get_option( 'page_for_posts' ) );
						if ( get_field( 'page_title_section', $post->ID ) ) {
							if ( get_field('custom_page_title', $post->ID ) ) {
								echo get_field('custom_page_title', $post->ID );
							}
						} else {
							echo get_the_title( get_option( 'page_for_posts' ) );
						}

					else:
						echo get_the_title( get_option( 'page_for_posts' ) );
				endif;

				elseif (is_post_type_archive()) :
					post_type_archive_title();

				elseif (is_tax()) :
					global $wp_query;
					$term = $wp_query->get_queried_object();
					$title = $term->name; 
					echo $title;

				elseif (is_404()):
					echo "Page not found";

				elseif (is_search()):
					echo "Search results";

				elseif (is_author()) : 
					global $post;
					$author_id = $post->post_author; ?>
					Posts by <?php $field='display_name'; echo the_author_meta( $field, $author_id );

				else  :
					if ( get_field( 'page_title_section', $post->ID ) ) {
						if ( get_field('custom_page_title', $post->ID ) ) {
							echo get_field('custom_page_title', $post->ID );
						}
					} else {
						the_title();
					}

				endif;
				if ( is_front_page() && is_home() ) {
					echo  "</h2>";
				} else {
					echo "</h1>";
				} ?>
			
			</div>
			<div class="col-md-6 text-uppercase xs-display-none hidden-xs hidden-sm" data-wow-duration="600ms">
				<ul class="breadcrumb-list">
					<?php ah_breadcrumb(); ?>
				</ul>
			</div>
		</div>
	<div>
</section>
<!-- End Page Title -->
