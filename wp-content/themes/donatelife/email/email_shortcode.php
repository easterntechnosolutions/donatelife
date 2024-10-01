<?php 
/**Email header shortcode */
add_shortcode('email_header_template','get_email_header');
function get_email_header(){
	ob_start(); 
	?>
	<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
		<style>
			p{display: none;}
		</style>
	</head>
   	<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
      	<div>
         	<div style="font-size:1px;display:none!important"></div>
         		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#fff" align="center">
					<tbody>
						<tr>
							<td>
								<table width="800px" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f4f4" align="center">
									<tbody>
									<tr valign="top">
										<td align="center" style="padding-top:30px">
											<a href="" target="_blank"><img src="<?php echo wp_get_attachment_url( get_option( 'site_logo' ) ); ?>" height="70" border="0" alt="" style="display:block;color:#4c9ac9" align="middle" class="CToWUd"></a>
										</td>
									</tr>
									<tr>
										<td style="color:#cccccc;padding-top:30px" valign="top">
											<hr color="cccccc" size="1">
										</td>
									</tr>
									<tr>
										<td valign="top" style="padding:30px;font-family:Helvetica neue,Helvetica,Arial,Verdana,sans-serif;color:#000;font-size:16px;line-height:40px;text-align:left;" align="middle">
                                            <!-- body content here -->
											
	<?php
	return ob_get_clean();
}

/**Email footer shortcode */
add_shortcode('email_footer_template','get_email_footer');
function get_email_footer(){
	ob_start(); ?>
												
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="800px" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f4f4" align="center">
								<tbody>
								<tr>
									<td style="color:#cccccc" valign="top">
										<hr color="cccccc" size="1">
									</td>
								</tr>
								<tr>
									<td valign="top" style="padding-top:10px; padding-bottom:10px;font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;color:#707070;font-size:12px;line-height:18px;text-align:center;font-weight:none" align="center"> <b>Phone</b> : +91 7573011101 | <b>Email</b> : info@donatelife.org.in </td>
								</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="800px" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f4f4" align="center">
								<tbody>
								<tr>
									<td style="color:#cccccc" valign="top">
										<hr color="cccccc" size="1">
									</td>
								</tr>
								<tr>
									<td valign="top" style="padding-top:10px; padding-bottom:40px; font-family:Helvetica,Helvetica neue,Arial,Verdana,sans-serif;color:#707070;font-size:12px;line-height:18px;text-align:center;font-weight:none" align="center">&copy;
										<?php echo date("Y"); ?>
										Donate Life. All Rights Reserved. Designed by <a href="http://www.easternts.com" target="_blank">Eastern Techno Solutions</a>
									</td>
								</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
	<?php 
	return ob_get_clean();
}