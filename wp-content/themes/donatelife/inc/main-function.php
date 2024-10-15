<?php 
/** 1. Display custom field columns in WP table - post_type=cadaver_donor */
add_filter( 'manage_edit-cadaver_donor_columns', 'add_acf_column_to_cpt' );
function add_acf_column_to_cpt( $columns ) {
    $columns['organ_receiver'] = 'Receiver';
    $columns['cadaver_orgon_donor'] = 'Donor';
    
	unset($columns['date']);
    return $columns;
}

/* 2. Populate the custom column with the ACF field value
* Display custom field value in the populated column - post_type=cadaver_donor
*/
add_action( 'manage_cadaver_donor_posts_custom_column', 'show_acf_field_in_cpt_column', 10, 2 );
function show_acf_field_in_cpt_column( $column, $post_id ) {

	$acf_value = get_field( $column, $post_id ); 
	echo $acf_value ? $acf_value : '—'; 
	 
}

/** Display data in datatable - /awards/ page */
add_action('wp_ajax_fetch_awards_data', 'fetch_awards_data');
add_action('wp_ajax_nopriv_fetch_awards_data', 'fetch_awards_data');
function fetch_awards_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'awards_appr';

    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'year_of_award', 'awarding_authority', 'award_pdf');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order ASC';
	}else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'year_of_award'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'awarding_authority'
                ) LIKE %s
               
            )
        ", "%$search_value%", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish'
    ", $post_type);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query
    ", $post_type);
    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'year_of_award') AS year_of_award,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'awarding_authority') AS awarding_authority,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'award_pdf') AS award_pdf
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query
        ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    // Prepare the data for DataTables
    $data = array();
	$start_index = $offset + 1; // Adjust start index for pagination
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $start_index + $index,
            'award_name' => $row['post_title'],
            'year' => $row['year_of_award'],
            'authority' => $row['awarding_authority'],
            'pdf' => (!empty($row['award_pdf'])) ? '<a href="'.wp_get_attachment_url($row['award_pdf']).'" target="_blank" class="donate-btn">View PDF </a>' : '',
        );
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/**Fetch donations page data in data table */
add_action('wp_ajax_fetch_donor_data', 'fetch_donor_data');
add_action('wp_ajax_nopriv_fetch_donor_data', 'fetch_donor_data');
function fetch_donor_data() {
	global $wpdb;
    // Check and sanitize the post type and taxonomy term
    $post_type = 'cadaver_donor';
	$taxonomy_term = isset($_POST['taxonomy_term']) ? sanitize_text_field($_POST['taxonomy_term']) : '';
	$limit = intval($_POST['length']);
	$offset = intval($_POST['start']);
	$order_column_index = intval($_POST['order'][0]['column']);
	$order_direction = sanitize_text_field($_POST['order'][0]['dir']);
	$search_value = sanitize_text_field($_POST['search']['value']);

	// Columns for ordering
	$columns = array(
		1 => 'donation_date',
		2 => 'organ_receiver',
		3 => 'city',
		4 => 'transplanted_at',
		5 => 'cadaver_orgon_donor'
	);
	$acf_field = isset($columns[$order_column_index]) ? $columns[$order_column_index] : '';
	// $order_by = 'menu_order ASC';

	$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;


	// Search query
	$search_query = "";
	if (!empty($search_value)) {
		$search_query = $wpdb->prepare("
			AND (
				EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'donation_date' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'organ_receiver' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'city' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'transplanted_at' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'cadaver_orgon_donor' AND meta_value LIKE %s)
			)
		", "%$search_value%", "%$search_value%", "%$search_value%", "%$search_value%", "%$search_value%");
	}

	// Total records query
	$total_records_query = $wpdb->prepare("
		SELECT COUNT(*)
		FROM {$wpdb->posts}
		WHERE post_type = %s AND post_status = 'publish'
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'donor_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s)))
	", $post_type, $taxonomy_term);
	$total_records = $wpdb->get_var($total_records_query);

	// Total filtered records query
	$filtered_records_query = $wpdb->prepare("
		SELECT COUNT(*)
		FROM {$wpdb->posts}
		WHERE post_type = %s AND post_status = 'publish'
		$search_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'donor_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s)))
	", $post_type, $taxonomy_term);
	$filtered_records = $wpdb->get_var($filtered_records_query);

	// Fetch records with pagination, ordering, and search
	$results_query = $wpdb->prepare("
		SELECT ID, post_title
		FROM {$wpdb->posts}
		WHERE post_type = %s AND post_status = 'publish'
		$search_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'donor_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s)))
		ORDER BY $order_by
		LIMIT %d OFFSET %d
	", $post_type, $taxonomy_term, $limit, $offset);

	$results = $wpdb->get_results($results_query, ARRAY_A);
	
	// print_r($results_query);
    $data = array();
	
    if ($results) {
		if($taxonomy_term == 'liver') {
			$i = $total_records + 30;
		}else{
			$i = $total_records;
		}
        $start_index = $offset; // + 1  - Adjust start index for pagination
        foreach ($results as $index => $row) {
            
			$postid = $row['ID'];
			//$terms = wp_get_post_terms(get_the_ID(), 'your_taxonomy_name', array('fields' => 'term_id'))
            $data[] = array(
                'id' => $i - $start_index, //$start_index + $index,
                'post_title' => $row['post_title'],
				'date' => get_field('donation_date',$postid),
				'receiver' => get_field('organ_receiver',$postid),
				'city' => get_field('city',$postid),
				'transplant' => get_field('transplanted_at',$postid),
				'donor_name' => get_field('cadaver_orgon_donor',$postid),
                'pdf' => (!empty(get_field('press_coverage',$postid))) ? '<a href="'.get_field('press_coverage',$postid).'" target="_blank" class="btn btn-info btn-block">View PDF </a>' : '',
                
            );
			$newspaperlinks = '';
			if(have_rows('newspaper_links')) : 
				while(have_rows('newspaper_links')) : the_row();
				$newspaperlinks = ob_start();

				$sandeshLink = get_sub_field('sandesh_link',$postid);
				if ($sandeshLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $sandeshLink; ?>" target="_blank">Sandesh</a>&nbsp;&nbsp;
				<?php }

				$navbharatTimes = get_sub_field('navbharat_times',$postid);
				if ($navbharatTimes != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $navbharatTimes; ?>" target="_blank">Navbharat Times</a>&nbsp;&nbsp;
				<?php }
				
				$indiaTimes = get_sub_field('india_times',$postid);
				if ($indiaTimes != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $indiaTimes; ?>" target="_blank">India Times</a>&nbsp;&nbsp;
				<?php }
				
				$gujaratiNews18 = get_sub_field('gujarati_news18',$postid);
				if ($gujaratiNews18 != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $gujaratiNews18; ?>" target="_blank">Gujarat News18</a>&nbsp;&nbsp;
				<?php }
				
				$iamGujarat = get_sub_field('i_am_gujarat',$postid);
				if ($iamGujarat != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $iamGujarat; ?>" target="_blank">I am gujarat</a>&nbsp;&nbsp;
				<?php }
				
				$gujaratSamacharLink = get_sub_field('gujarat_samachar_link',$postid);
				if ($gujaratSamacharLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $gujaratSamacharLink; ?>" target="_blank">Gujarat Samachar</a>&nbsp;&nbsp;
				<?php }
				
				$timesOfIndiaLink = get_sub_field('the_times_of_india_link',$postid);
				if ($timesOfIndiaLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $timesOfIndiaLink; ?>" target="_blank">Times Of India</a>&nbsp;&nbsp;
				<?php }
				
				$divyaBhaskarLink = get_sub_field('divya_bhaskar',$postid);
				if ($divyaBhaskarLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $divyaBhaskarLink; ?>" target="_blank">Divya Bhaskar</a>&nbsp;&nbsp;
				<?php }
				
				$dnaLink = get_sub_field('dna_link',$postid);
				if ($dnaLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $dnaLink; ?>" target="_blank">DNA</a>&nbsp;&nbsp;
				<?php }
				
				$nyoozLink = get_sub_field('nyooz_link',$postid);
				if ($nyoozLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $nyoozLink; ?>" target="_blank">NYOOZ</a>&nbsp;&nbsp;
				<?php }

				$indiaTodayLink = get_sub_field('india_today_link',$postid);
				if ($indiaTodayLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $indiaTodayLink; ?>" target="_blank">India Today</a>&nbsp;&nbsp;
				<?php }

				$medicalDialoguesLink = get_sub_field('medical_dialogues_link',$postid);
				if ($medicalDialoguesLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $medicalDialoguesLink; ?>" target="_blank">Medical Dialogues</a>&nbsp;&nbsp;
				<?php }

				$outlookIndiaLink = get_sub_field('outlook_india_link',$postid);
				if ($outlookIndiaLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $outlookIndiaLink; ?>" target="_blank">Outlook India</a>&nbsp;&nbsp;
				<?php }

				$midDayLink = get_sub_field('mid_day_link',$postid);
				if ($midDayLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $midDayLink; ?>" target="_blank">Mid Day</a>&nbsp;&nbsp;
				<?php }

				$ummidLink = get_sub_field('ummid_link',$postid);
				if ($ummidLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $ummidLink; ?>" target="_blank">Ummid</a>&nbsp;&nbsp;
				<?php }

				$theHinduLink = get_sub_field('the_hindu_link',$postid);
				if ($theHinduLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $theHinduLink; ?>" target="_blank">The Hindu</a>&nbsp;&nbsp;
				<?php }

				$mumbaiMirrorLink = get_sub_field('mumbai_mirror_link',$postid);
				if ($mumbaiMirrorLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $mumbaiMirrorLink; ?>" target="_blank">Mumbai Mirror</a>&nbsp;&nbsp;
				<?php }

				$khabarChheLink = get_sub_field('khabar_chhe_link',$postid);
				if ($khabarChheLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $khabarChheLink; ?>" target="_blank">Khabar Chhe</a>&nbsp;&nbsp;
				<?php }

				$theHealthSiteLink = get_sub_field('the_health_site_link',$postid);
				if ($theHealthSiteLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $theHealthSiteLink; ?>" target="_blank">The Health Site</a>&nbsp;&nbsp;
				<?php }
				
				$NDTVLink = get_sub_field('ndtv_link',$postid);
				if ($NDTVLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $NDTVLink; ?>" target="_blank">NDTV</a>&nbsp;&nbsp;
				<?php }

				$freePressLink = get_sub_field('free_press_link',$postid);
				if ($freePressLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $freePressLink; ?>" target="_blank">Free Press</a>&nbsp;&nbsp;
				<?php }

				$rajesthan_patrika = get_sub_field('rajesthan_patrika',$postid);
				if ($rajesthan_patrika != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $rajesthan_patrika; ?>" target="_blank">Rajesthan Patrika</a>&nbsp;&nbsp;
				<?php }

				$chitralekha = get_sub_field('chitralekha',$postid);
				if ($chitralekha != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $chitralekha; ?>" target="_blank">Chitralekha</a>&nbsp;&nbsp;
				<?php }

				$daily_bhaskar = get_sub_field('daily_bhaskar',$postid);
				if ($daily_bhaskar != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $daily_bhaskar; ?>" target="_blank">Daily Bhaskar</a>&nbsp;&nbsp;
				<?php }

				$indian_express = get_sub_field('indian_express',$postid);
				if ($indian_express != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $indian_express; ?>" target="_blank">Indian Express</a>&nbsp;&nbsp;
				<?php }

				$newspaperlinks = ob_get_clean();
				endwhile;
			endif;
			
			$data[count($data) - 1]['other_links'] = $newspaperlinks;
			
			$i--;
			
        }
        wp_reset_postdata();
    }

    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data,
    );

    echo json_encode($response);
    wp_die();
}

/** Display electronic media in datatable - /electronic-media/ page */
add_action('wp_ajax_fetch_electronic_data', 'fetch_electronic_data');
add_action('wp_ajax_nopriv_fetch_electronic_data', 'fetch_electronic_data');
function fetch_electronic_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'electronic_media';
	$taxonomy_term = isset($_POST['taxonomy_term']) ? sanitize_text_field($_POST['taxonomy_term']) : '';

	 // Get year, month, and day filters from AJAX request
	 $year = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';
	 $month = isset($_POST['month']) ? sanitize_text_field($_POST['month']) : '';
	 $emtype = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'name_of_channel', 'youtube_link', 'em_date');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order DESC';
	}else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

	// Search query for year, month, and day
    $date_query = '';
    if (!empty($year)) {
        $date_query .= " AND YEAR((SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date')) = '$year'";
    }
    if (!empty($month)) {
        $date_query .= " AND MONTH((SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date')) = '$month'";
    }
    if (!empty($emtype)) {
        $date_query .= " AND (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_type') = '$emtype'";
    }
	
    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_channel'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'youtube_link'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date'
                ) LIKE %s
               
            )
        ", "%$search_value%", "%$search_value%", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish'
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query $date_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);

    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_channel') AS name_of_channel,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'youtube_link') AS youtube_link,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date') AS em_date
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query $date_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
        ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $taxonomy_term, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    // Prepare the data for DataTables
    $data = array();
	$i = $total_records;
	$start_index = $offset; //+ 1; // Adjust start index for pagination
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $i - $start_index, //$start_index + $index,
            'em_date' => date('d/m/Y',strtotime($row['em_date'])),
            'description' => $row['post_title'],
            'channel' => $row['name_of_channel'],
            'ytlink' => '<a href="'. $row['youtube_link'].'" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>',
        );

		$i--;
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/** Display data in datatable - /digital-media/ page */
add_action('wp_ajax_fetch_digitalmedia_data', 'fetch_digitalmedia_data');
add_action('wp_ajax_nopriv_fetch_digitalmedia_data', 'fetch_digitalmedia_data');
function fetch_digitalmedia_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'digital_media';
	$taxonomy_term = isset($_POST['taxonomy_term']) ? sanitize_text_field($_POST['taxonomy_term']) : '';
    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'name_of_digital_media', 'dm_date');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order ASC';
	}else if($order_column_index == 1) {
		
		$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'dm_date') " . $order_direction;
	}
	else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_digital_media'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'dm_date'
                ) LIKE %s
               
            )
        ", "%$search_value%", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' 
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'dg_media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'dg_media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);
    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_digital_media') AS name_of_digital_media,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'dm_date') AS dm_date,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'digital_media_link') AS digital_media_link
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query 
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'dg_media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
		ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $taxonomy_term, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    // Prepare the data for DataTables
    $data = array();
	$i = $total_records;
	$start_index = $offset; // + 1; // Adjust start index for pagination
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $i - $start_index, //$start_index + $index,
            'dm_name' => $row['post_title'],
            'date' => date("d/m/Y",strtotime($row['dm_date'])),
            'media' => $row['name_of_digital_media'],
            'link' => (!empty($row['digital_media_link'])) ? '<a href="'.$row['digital_media_link'].'" target="_blank">Link <i class="fa fa-external-link" aria-hidden="true"></i></a>' : '',
        );

		$i--;
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/** Display data in datatable - /press-release/ page */
add_action('wp_ajax_fetch_pressrelease_data', 'fetch_pressrelease_data');
add_action('wp_ajax_nopriv_fetch_pressrelease_data', 'fetch_pressrelease_data');
function fetch_pressrelease_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'press_releases';

    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'press_release_date');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order ASC';
	}else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'press_release_date'
                ) LIKE %s
            )
        ", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish'
    ", $post_type);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query
    ", $post_type);
    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'press_release_date') AS press_release_date
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query
        ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    /**Images, pdf and link data are not currently visible in the website */
    $data = array();
	$i = $total_records;
	$start_index = $offset; // + 1; 
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $i - $start_index, //$start_index + $index,
            'title' => $row['post_title'],
            'date' => date("d/m/Y", strtotime($row['press_release_date'])),
        );

		$i--;
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/**Video layout design */
function get_video_grid_layout($gqry,$posts_per_page,$offset, $type) {
	
	// Check if the query returns any posts
	if ($gqry->have_posts()) {
		while ($gqry->have_posts()) {
			$gqry->the_post();
			$youtube_link = get_field('vg_link'); // Assuming the YouTube link is stored as a post meta
			?>
			<div class="hip-item">
				<iframe width="100%" height="315" src="<?php echo esc_url($youtube_link); ?>?rel=0" loading="lazy" allowfullscreen></iframe>
				
				<p hidden><?php the_title(); ?></p>
				<p hidden><?php echo date("d/m/Y",strtotime(get_field('vg_date'))); ?></p>
			</div>
			<?php
		}
	} else {
		echo "<p style='text-align: center'>No data found</p>";
	}

	// Reset post data
	wp_reset_postdata();
	
	?>
	<?php if ($gqry->found_posts > ($posts_per_page + $offset)) : ?>
		<button class="load-more lm-design" data-type="<?php echo esc_attr($type); ?>" data-offset="<?php echo esc_attr($posts_per_page + $offset); ?>">Load More</button>
	<?php endif; 
}

/**Ajax call for video-gallery load more button */
add_action('wp_ajax_load_more_videos', 'load_more_videos');
add_action('wp_ajax_nopriv_load_more_videos', 'load_more_videos');
function load_more_videos() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'all';
	$posts_per_page = 18;
	$search_vg = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    // Prepare the query arguments
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
		'post_status' => 'publish'
    );
	if($type === 'all') {
		$args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => array('awareness-aw','speech-sp','vyakti-vishesh-ci'),
            ),
        );
	} else if ($type === 'awareness') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'awareness-aw',
            ),
        );
    } else if ($type === 'speech') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'speech-sp',
            ),
        );
    }

	if (!empty($search_vg)) {
        add_filter('posts_search', function($search, $wp_query) use ($search_vg) {
            global $wpdb;
            if (!empty($search_vg)) {
                // Construct the search condition to target only the post title
                $search = " AND ({$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_vg)) . "%')";
            }
            return $search;
        }, 10, 2);
    }

	
    $gqry = new WP_Query($args);
	
	get_video_grid_layout($gqry,$posts_per_page,$offset,$type);
    die(); // End AJAX request
}

/* ajax call for video-gallery-all load more button */
add_action('wp_ajax_abt_load_more_videos', 'abt_load_more_videos');
add_action('wp_ajax_nopriv_abt_load_more_videos', 'abt_load_more_videos');
function abt_load_more_videos() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'all';
	$posts_per_page = 18;
	$search_vg = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    // Prepare the query arguments
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
		'post_status' => 'publish'
    );
	
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'vi_gl_type',
			'field'    => 'slug',
			'terms'    => $type,
		),
	);

	if (!empty($search_vg)) {
        add_filter('posts_search', function($search, $wp_query) use ($search_vg) {
            global $wpdb;
            if (!empty($search_vg)) {
                // Construct the search condition to target only the post title
                $search = " AND ({$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_vg)) . "%')";
            }
            return $search;
        }, 10, 2);
    }

	
    $gqry = new WP_Query($args);
	
	get_video_grid_layout($gqry,$posts_per_page,$offset,$type);
    die(); // End AJAX request
}

add_action('admin_menu', 'custom_table_menu');
function custom_table_menu() {
    add_menu_page(
        'Donor Data',     
        'Donor Data',     
        'manage_options',   
        'donor-data',      
        'get_wp_donor_data', 
        'dashicons-list-view', 
        6                    
    );

	add_menu_page(
        'Volunteer Data',     
        'Volunteer Data',     
        'manage_options',   
        'volunteer-data',      
        'get_wp_volunteer_data', 
        'dashicons-list-view', 
        7                    
    );

	add_menu_page(
        'Online Donation Data',     
        'Online Donation Data',     
        'manage_options',   
        'online-donation-data',      
        'get_wp_online_donation_data', 
        'dashicons-list-view', 
        8                    
    );
	
	add_menu_page(
        'Contact Data',      
        'Contact Data',      
        'manage_options',   
        'contact-form-data',      
        'get_wp_contact_form_data', 
        'dashicons-list-view', 
        9                    
    );
	
	add_menu_page(
        'Subscription Data',      
        'Subscription Data',      
        'manage_options',   
        'subscription-form-data',      
        'get_wp_subscription_form_data', 
        'dashicons-list-view', 
        10                   
    );

	add_menu_page(
        'Latest Figure',      
        'Latest Figure',      
        'manage_options',   
        'last-figure-data',      
        'get_wp_latest_figure_data', 
        'dashicons-schedule', 
        11                   
    );

	add_menu_page(
        'Donor & Recepients Data',      
        'Donor & Recepients Data',      
        'manage_options',   
        'donor-recepients-data',      
        'get_wp_recepients_data', 
        'dashicons-database', 
        12                   
    );
}

function get_wp_donor_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_donor_data.php'; 

	$table = new Donor_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Donor Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_volunteer_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_volunteer_data.php'; 

	$table = new Volunteer_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Volunteer Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_online_donation_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_online_donation_data.php'; 

	$table = new Online_Donation_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Online Donation Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_contact_form_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_contact_form_data.php'; 

	$table = new Contact_Form_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Contact form Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_subscription_form_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_subscription_form_data.php'; 

	$table = new Subscription_Form_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Subscription Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_latest_figure_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_latest_figure_data.php'; 

	$table = new Latest_Figure_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Latest Figure Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_recepients_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once get_stylesheet_directory().'/class/wp_list_recepients_data.php'; 

	$table = new Donor_Recepients_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Donor & Recepients Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

/**Load donor data in popup in wp-admin */
add_action('wp_ajax_load_modal_content', 'load_modal_content_callback');
function load_modal_content_callback() {
	global $wpdb;
	$id = $_POST['id'];
	$table_name = $wpdb->prefix . 'donor_master'; // Replace with your custom table name
	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	$dfirstname = $row['dfirstname'];
	$dmiddlename = $row['dmiddlename'];
	$dlastname = $row['dlastname'];
	$daged = $row['daged'];
	$ddate = date('Y-m-d',strtotime($row['ddate']));
	$dgender = $row['dgender'];
	$dwhatsapp = $row['dwhatsapp'];
	$dOrgan = $row['dOrgan'];
	$dTissues = $row['dTissues'];
	$dbloodgroup = $row['dbloodgroup'];
	$dcontact = $row['dcontact'];
	$demail = $row['demail'];
	$daddress = $row['daddress'];
	$dtaluka = $row['dtaluka'];
	$ddist = $row['ddist'];
	$dstate = $row['dstate'];
	$dfirstNameOfWitness = $row['dfirstNameOfWitness'];
	$dmiddleNameOfWitness = $row['dmiddleNameOfWitness'];
	$dlastNameOfWitness = $row['dlastNameOfWitness'];
	$dwaged = $row['dwaged'];
	$dwcontact = $row['dwcontact'];
	$dwemail = $row['dwemail'];
	$dwgender = $row['dwgender'];
	$dwaddress = $row['dwaddress'];
	$dwtaluka = $row['dwtaluka'];
	$dwdist = $row['dwdist'];
	$dwstate = $row['dwstate'];
	$dwNearRelative = $row['dwNearRelative'];
	$todaydate = $row['todaydate'];
	$photo = stripslashes($row['donor_card']);
	$ganesha_mandal = $row['ganesha_mandal'];
	$html = ob_start();
	?>

	<!--<link rel="stylesheet" href="stylesheet.css" type="text/css" media="screen" />-->
	<table class="table table-bordered" cellspacing="3" cellpadding="3" width="100%">
		<tr>
			<th align="right" width="130">ID.&nbsp;:&nbsp;</th>
			<td><?php echo $id; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">First Name.&nbsp;:&nbsp;</th>
			<td><?php echo $dfirstname; ?></td>
		</tr>


		<tr>
			<th align="right" width="130">Middle Name&nbsp;:&nbsp;</th>
			<td><?php echo $dmiddlename; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Last Name &nbsp;:&nbsp;</th>
			<td><?php echo $dlastname; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Aged&nbsp;:&nbsp;</th>
			<td><?php echo $daged; ?></td>
		</tr>

		<tr>
			<th align="right">Date&nbsp;:&nbsp;</th>
			<td><?php echo $ddate; ?></td></tr>

		<tr>
			<th align="right">Gender &nbsp;:&nbsp;</th>
			<td><?php echo $dgender; ?></td>
		</tr>

		<tr>
			<th align="right">Whatsapp No&nbsp;:&nbsp;</th>
			<td><?php echo $dwhatsapp; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Organs &nbsp;:&nbsp;</th>
			<td><?php echo $dOrgan; ?></td>
		</tr>

		<tr>
			<th align="right" width="130"> Tissues &nbsp;:&nbsp;</th>
			<td><?php echo $dTissues; ?></td>
		</tr>

		<tr>
			<th align="right"> Blood Group &nbsp;:&nbsp;</th>
			<td><?php echo $dbloodgroup; ?></td></tr>

		<tr>
			<th align="right">Contact No. &nbsp;:&nbsp;</th>
			<td><?php echo $dcontact; ?></td>
		</tr>

		<tr>
			<th align="right">EMail &nbsp;:&nbsp;</th>
			<td><?php echo $demail; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Address :&nbsp;</th>
			<td><?php echo $daddress; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Taluka &nbsp;:&nbsp;</th>
			<td><?php echo $dtaluka; ?></td>
		</tr>

		<tr>
			<th align="right">Dist. &nbsp;:&nbsp;</th>
			<td><?php echo $ddist; ?></td></tr>

		<tr>
			<th align="right">State &nbsp;:&nbsp;</th>
			<td><?php echo $dstate; ?></td>
		</tr>

		<tr>
			<th align="right">First Name (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dfirstNameOfWitness; ?></td>
		</tr>

		<tr>
			<th align="right">Middle Name (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dmiddleNameOfWitness; ?></td>
		</tr>

		<tr>
			<th align="right">Last Name (Witness)  &nbsp;:&nbsp;</th>
			<td><?php echo $dlastNameOfWitness; ?></td>
		</tr>


		<tr>
			<th align="right">Aged (Witness)  &nbsp;:&nbsp;</th>
			<td><?php echo $dwaged; ?></td>
		</tr>

		<tr>
			<th align="right">Contact No. (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwcontact; ?></td>
		</tr>


		<tr>
			<th align="right">Email ID (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwemail; ?></td>
		</tr>

		<tr>
			<th align="right">Gender (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwgender; ?></td>
		</tr>

		<tr>
			<th align="right">Address (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwaddress; ?></td>
		</tr>

		<tr>
			<th align="right">Taluka (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwtaluka; ?></td>
		</tr>

		<tr>
			<th align="right">State (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwdist; ?></td>
		</tr>

		<tr>
			<th align="right">Dist. (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwstate; ?></td>
		</tr>

		<tr>
			<th align="right">Your Relation with applicant &nbsp;:&nbsp;</th>
			<td><?php echo $dwNearRelative; ?></td>
		</tr>
		
		<tr>
			<th align="right">Ref/Ganesha Mandal &nbsp;:&nbsp;</th>
			<td><?php echo $ganesha_mandal; ?></td>
		</tr>
		
		<tr>
			<th align="right">Form Date :&nbsp;</th>
			<td><?php echo $todaydate; ?></td>
		</tr>


		<tr>
			<th align="right">Photo :&nbsp;</th>
			<?php 
			$upload_dir = wp_upload_dir();
    		$pdf_file_path = $upload_dir['baseurl'] . '/donor_card/'; ?>
			<td><a href="<?php echo $pdf_file_path.$photo; ?>" target = "_blank">Click Here to View Donor Card</a></td>
		</tr>

	</table>
	<?php 		
	$html = ob_get_clean();
	echo $html;
	wp_die();
}

/**Load volunteer data in popup in wp-admin */
add_action('wp_ajax_load_volunteer_data', 'load_volunteer_data_callback');
function load_volunteer_data_callback() {
	global $wpdb;
	$id = $_POST['id'];
	$table_name = $wpdb->prefix . 'volunteer_master'; // Replace with your custom table name
	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	$vid = $row['id'];
    $vfullname = $row['vfullname'];
    $date = date("d-m-Y",strtotime($row['vdate']));
    $todaydate = date("d-m-Y",strtotime($row['todaydate']));
    $vaddress1 = $row['vaddress1'];
    $vbloodgroup = $row['vbloodgroup'];
    $vcity = $row['vcity'];
    $vstate = $row['vstate'];
    $vemail = $row['vemail'];
    $vmobile = stripslashes($row['vmobile']);
    $vcountry = stripslashes($row['vcountry']);
    $vgender = stripslashes($row['vgender']);
    $timeOfContribution = stripslashes($row['timeOfContribution']);
    $areaOfInterest = stripslashes($row['areaOfInterest']);
    $vphone = stripslashes($row['vphone']);
    $photo = stripslashes($row['photo']);


	?>
	

	<table class="table table-bordered" cellspacing="3" cellpadding="3" width="100%">
        <tr>
		<th align="right" width="130">ID.&nbsp;:&nbsp;</th>
		<td><?php echo $vid; ?></td>
		</tr>

        <tr>
            <th align="right" width="130">Name.&nbsp;:&nbsp;</th>
            <td><?php echo $vfullname; ?></td>
        </tr>

        <tr>
            <th align="right" width="130">Date Of Birth&nbsp;:&nbsp;</th>
            <td><?php echo $date; ?></td>
        </tr>

        <tr>
            <th align="right" width="130">E-mail&nbsp;:&nbsp;</th>
            <td><?php echo $vemail; ?></td>
        </tr>

        <tr>
            <th align="right" width="130">Blood Group 2&nbsp;:&nbsp;</th>
            <td><?php echo $vbloodgroup; ?></td>
        </tr>

        <tr>
		<th align="right" width="130">Address&nbsp;:&nbsp;</th>
		<td><?php echo $vaddress1; ?></td>
		</tr>
		
		<tr>
		<th align="right">City&nbsp;:&nbsp;</th>
		<td><?php echo $vcity; ?></td></tr>
		
		<tr>
		<th align="right">State&nbsp;:&nbsp;</th>
		<td><?php echo $vstate; ?></td>
		</tr>
		
		<tr>
		<th align="right">Mobile No. &nbsp;:&nbsp;</th>
		<td><?php echo $vmobile; ?></td>
		</tr>

        <tr>
            <th align="right">Phone No&nbsp;:&nbsp;</th>
            <td><?php echo $vphone; ?></td>
        </tr>

        <tr>
            <th align="right">Gender&nbsp;:&nbsp;</th>
            <td><?php echo $vgender; ?></td>
        </tr>


        <tr>
            <th align="right">Time Of Contribution&nbsp;:&nbsp;</th>
            <td><?php echo $timeOfContribution; ?></td>
        </tr>

        <tr>
            <th align="right">Area Of Interest&nbsp;:&nbsp;</th>
            <td><?php echo $areaOfInterest; ?></td>
        </tr>

        <tr>
            <th align="right">Photo :&nbsp;</th>
			<?php 
			$upload_dir = wp_upload_dir();
    		$volunteer_path = $upload_dir['baseurl'] . '/volunteer/'; ?>
            <td><a href="<?php echo $volunteer_path.$photo; ?>" target = "_blank">Click Here to View Image</a></td>

        </tr>

        <tr>
            <th align="right" width="130">Form Date :&nbsp;</th>
            <td><?php echo $todaydate; ?></td>
        </tr>

	</table>
	<?php 		
	$html = ob_get_clean();
	echo $html;
	wp_die();
}

/**Load online donation data in popup in wp-admin */
add_action('wp_ajax_load_online_donation_content', 'load_online_donation_content_callback');
function load_online_donation_content_callback() {
	global $wpdb;
	$id = $_POST['id'];
	$table_name = $wpdb->prefix . 'online_donation_master'; // Replace with your custom table name
	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	$odid = $row['id'];
	$odname = $row['odname'];
	$odaddress = $row['odaddress'];
	$odcity = $row['odcity'];
	$odstate = $row['odstate'];
	$odpin = $row['odpin'];
	$odcountry = $row['odcountry'];
	$odmobile = $row['odmobile'];
	$odemail = $row['odemail'];
	$oddetails = $row['oddetails'];
	$odamount = $row['odamount'];
	$odstatus = $row['odstatus'];

	?>

	<!--<link rel="stylesheet" href="stylesheet.css" type="text/css" media="screen" />-->
	<table class="table table-bordered" cellspacing="3" cellpadding="3" width="100%">
		<tr>
			<th align="right" width="130">ID.&nbsp;:&nbsp;</th>
			<td><?php echo $odid; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Name :&nbsp;</th>
			<td><?php echo $odname; ?></td>
		</tr>


		<tr>
			<th align="right" width="130">Address&nbsp;:&nbsp;</th>
			<td><?php echo $odaddress; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">City &nbsp;:&nbsp;</th>
			<td><?php echo $odcity; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">State&nbsp;:&nbsp;</th>
			<td><?php echo $odstate; ?></td>
		</tr>

		<tr>
			<th align="right">Pin Code&nbsp;:&nbsp;</th>
			<td><?php echo $odpin; ?></td></tr>

		<tr>
			<th align="right">Country &nbsp;:&nbsp;</th>
			<td><?php echo $odcountry; ?></td>
		</tr>

		<tr>
			<th align="right"> Mobile Number&nbsp;:&nbsp;</th>
			<td><?php echo $odmobile; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Email Address &nbsp;:&nbsp;</th>
			<td><?php echo $odemail; ?></td>
		</tr>

		<tr>
			<th align="right" width="130"> Donation Amount &nbsp;:&nbsp;</th>
			<td><?php echo $odamount; ?></td>
		</tr>

	</table>
	<?php 		
	$html = ob_get_clean();
	echo $html;
	wp_die();
}

function dl_redirect_404() {
    global $wp_query;
    if ( $wp_query->is_404 ) {
      wp_redirect( home_url(), 301 );
      exit;
    }
}
add_action('template_redirect', 'dl_redirect_404', 1);