<?php
/**
* Template Name: Sola
* Description: Template for a Hello Bar page
*/
//* Add custom body class
 // displays header
// displays header
get_header();
?> </header> 
<?php
// Remove sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
the_content();
get_footer(); //displays footer
