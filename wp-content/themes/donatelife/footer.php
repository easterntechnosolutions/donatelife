<div class="scroll-to-top scroll-to-target" data-target=".main-header" style="display: block;"><span class="fa fa-long-arrow-up"></span></div>
<div class="news-seciton">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="news-text">
                    <h4>Newsletter Sign-up</h4>
                    <p>Sign-up to be updated about our activities and initiatives </p>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="news-form">
                    
						<?php //newsletter form
						echo do_shortcode('[contact-form-7 id="dae43c8" title="Subscribe Form"]'); ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Footer -->
<footer class="footer-section">
    <div class="container">
        
		<div class="row">
			<div class="footer-item">
				
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="date-widget fot-link">
						<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
						<?php dynamic_sidebar('footer-1'); ?>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="date-widget fot-link">
						<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
						<?php dynamic_sidebar('footer-2'); ?>
						<?php } ?>
					</div>
				</div>
				
			
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="date-widget widget social">
						<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
						<?php dynamic_sidebar('footer-3'); ?>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="date-widget">
						<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
						<?php dynamic_sidebar('footer-4'); ?>
						<?php } ?>
					</div>
				</div>
				
			</div>
		</div>
        
    </div><!-- auto-container -->

	<!-- copyright -->
    <div class="footer-bottom">
        <div class="container">
			<div class="col-sm-12">
				<?php if ( is_active_sidebar( 'copyrights' ) ) { ?>
				<?php dynamic_sidebar('copyrights'); ?>
				<?php } else { ?>
					Copyrights &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> All Rights Reserved. | Designed by : <a
					href="https://easternts.com.au/" title="Eastern Techno Solutions" target="_blank"> Eastern Techno
					Solutions</a><?php
				} ?>
			</div>
        </div>
    </div>
</footer>

<!-- Modal popup on home page -->
<?php 
if(is_front_page()) {
	if(get_field('display_popup','option') == true) { ?>
		<div id="modal-popup" class="modal fade" role="dialog" tabindex = "-1">
			<div class="modal-dialog">
			<div class="modal-content">
				<?php 
				$popuptype = get_field('popup_type','option');
					if($popuptype == 'Image')
					{
						$cl = 'img_pop';
					}else{
						$cl = 'video_pop';
					}
				?>
				
				<div class="modal-body">
					<div class="img-wrap <?php echo $cl;?>">
						<a class="close" data-dismiss="modal"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/closebutton.png" width="30" height="30"></a>
						<?php
							
							if($popuptype == 'Image')
							{
								$imgdata = get_field('image_data','option');
								$popup_content = $imgdata['popup_image']['url'];
								$title = $imgdata['img_caption'];
								
								echo '<img id = "popup-image" src="'.$popup_content.'" class = "img-responsive" style = "max-height:550px;margin:auto;">';

								$short_desc = '';

								$share_image = $popup_content;
								$short_desc = stripslashes($imgdata['image_description']);
								$link = home_url();


								$facebook_link = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($link) . '&picture=' . urlencode($share_image) . '&title=' . urlencode($title) . '&description=' . urlencode($short_desc);
								$twitter_link = 'https://twitter.com/intent/tweet?url=' . urlencode($link) . '&text=' . urlencode($title);
								$linkedin_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($link) . '&title=' . urlencode($title) . '&summary=' . urlencode($short_desc);
								$pinterest_link = 'https://pinterest.com/pin/create/button/?url=' . urlencode($link) . '&media=' . urlencode($share_image) . '&description=' . urlencode($short_desc);

							}
							else
							{
								$videodata = get_field('video_data','option');
								$popup_content = $videodata['video_embed_url'];
								$link = home_url();
								$video_link = $videodata['video_actual_url'];
								$title = 'DonateLife';
								$short_desc = '';
								$pinterest_display = '';
								

								echo '<iframe width="100%" height="300" src="'.$popup_content.'?rel=0" frameborder="0" allowfullscreen></iframe>';

								$facebook_link = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($video_link) . '&title=' . urlencode($title) . '&description=' . urlencode($short_desc);
								$twitter_link = 'https://twitter.com/intent/tweet?url=' . urlencode($video_link) . '&text=' . urlencode($title);
								$linkedin_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($video_link) . '&title=' . urlencode($title) . '&summary=' . urlencode($short_desc);
								$pinterest_link = 'https://pinterest.com/pin/create/button/?url=' . urlencode($video_link) . '&media=' . urlencode($popup_content) . '&description=' . urlencode($short_desc);
								
							}
						?>
				
						<div class="row padding-top-5">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
								<ul class="social-popup">
									<li class=""><a target = "_blank" href = "<?php echo $facebook_link; ?>" class="facebook-share"><i class = "fa fa-facebook"></i></a></li>
									<li class=""><a target = "_blank" href = "<?php echo $twitter_link; ?>" class="twitter-share"><i class = "fa fa-twitter"></i></a></li>
									<li class=""><a target = "_blank" href = "<?php echo $linkedin_link; ?>"><i class = "fa fa-linkedin"></i></a></li>
									<li class=""><a target = "_blank" href = "<?php echo $pinterest_link; ?>"><i class = "fa fa-pinterest"></i></a></li>
								</ul>
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
			</div>
		</div>
<?php } 
} ?>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<?php wp_footer(); ?>
</div><!-- page-wrapper -->
</body>
</html>