<?php
/**
 * The front-page.php corresponds to the "static front page"
 * when setting static front page in Settings > Reading 
 */
?>

<?php //get_header();

if( get_option('page_on_front') == "" || get_option('page_on_front') == "0" ) {
    get_template_part('parts/posts');
} else { 
    get_template_part('parts/pages');
}

//get_footer();
?>
