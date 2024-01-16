<?php
/**
 * Theme customizations
 *
 * @package  SRPG Theme
 * @author  Teamscal
 * @link  https://teamscal.com
 * @copyright  Copyright (c) 2022, Teamscal
 * @license  GPL-2.0+
 */
// Custom Function to Include
// Load child theme textdomain.
load_child_theme_textdomain( 'SRPG_theme' );

add_action( 'genesis_setup', 'custom_setup',15);

function custom_setup() {

	// Define theme constants.
	define( 'CHILD_THEME_NAME', 'SRPG Theme' );
	define( 'CHILD_THEME_URL', 'https://teamscal.com' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );

	// Add HTML5 markup structure.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );
	
	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );
	
	// Add theme support for accessibility.
	add_theme_support( 'genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
	) );


	// Add custom logo or Enable option in Customizer > Site Identity
	add_theme_support( 'custom-logo', array(
		'width'       => 244,
		'height'      => 315,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => array( '.site-title', '.site-description' ),
	) );

	// Add theme support for footer widgets.
	add_theme_support( 'genesis-footer-widgets', 3 );

		// Unregister layouts that use secondary sidebar.
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	// Unregister secondary sidebar.
	unregister_sidebar( 'sidebar-alt' );


}

// Load style and js for theme
function srpg_enqueue_styles() {
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' );
	    wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), genesis_get_theme_version()  );
        wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,400;1,600;1,700;1,900&display=swap' );
        wp_enqueue_style( 'srgp-style', get_stylesheet_directory_uri() . '/style.css', array(), genesis_get_theme_version()  );
        wp_enqueue_style( 'srgp-customize', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), genesis_get_theme_version()  );
		wp_enqueue_style( 'srgp-customize-responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css', array(), genesis_get_theme_version()  );
		wp_enqueue_style( 'srgp-customize-saffari', get_stylesheet_directory_uri() . '/assets/css/firefox.css', array(), genesis_get_theme_version()  );
		wp_enqueue_style( 'srgp-customize-firefox', get_stylesheet_directory_uri() . '/assets/css/safari.css', array(), genesis_get_theme_version()  );
        wp_enqueue_script( 'bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(), genesis_get_theme_version()  );
		wp_enqueue_script( 'scroll-smooth', 'https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.3/smooth-scroll.polyfills.min.js', array(), genesis_get_theme_version()  );
		wp_enqueue_script( 'simple-tilt-script',  get_stylesheet_directory_uri() . '/assets/js/SimpleTilt.js', array(), genesis_get_theme_version()   );
		wp_enqueue_script( 'flickity-script',  'https://unpkg.com/flickity@2.1.2/dist/flickity.pkgd.min.js' , array(), genesis_get_theme_version()   );
        wp_enqueue_script( 'jquery-script',  get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), genesis_get_theme_version()   );
		wp_enqueue_script( 'jquery-script_counter',  get_stylesheet_directory_uri() . '/assets/js/counter.js', array('jquery'), genesis_get_theme_version()   );
}
add_action( 'wp_enqueue_scripts', 'srpg_enqueue_styles' );

// Add menu for child theme
remove_theme_support ( 'genesis-menus' );
add_theme_support ( 'genesis-menus' , array ( 
	'primary' => 'Primary Navigation Menu' , 
	'secondary' => 'Second Navigation Menu' ,
	'header-menu' => 'Header Menu',
	'home-menu' => 'Home Menu' 
) );



// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
 
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }
    
    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {
          if ( $menu_item->ID == $prev_root_id ) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          } 
        }
      }
    }
 
    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
 
      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

// Add wigget sidebar for theme
function my_custom_sidebar() {
  register_sidebar(
      array (
          'name' => __( 'Custom', 'your-theme-domain' ),
          'id' => 'custom-side-bar',
          'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
          'before_widget' => '<div class="widget-content">',
          'after_widget' => "</div>",
          'before_title' => '<h3 class="widget-title">',
          'after_title' => '</h3>',
      )
  );
}
add_action( 'widgets_init', 'my_custom_sidebar' );
//  Add class for menu top
function add_classes_on_li($classes, $item, $args) {
  $classes[] = 'nav-item';
  return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);

// Add custom post our_project
function cptui_register_my_cpts_our_project() {

	/**
	 * Post Type: Our Projects.
	 */

	$labels = [
		"name" => __( "Projects", "teamscal.com" ),
		"singular_name" => __( "Projects", "teamscal.com" ),
		'add_new'         => __( 'Add New Project' ),
		'add_new_item'   => __( 'Add New Project' ),
		'edit_item'      => __( 'Edit Project' ),
		'new_item'       => __( 'New Project' ),
		'all_items'      => __( 'All Project' ),
		'view_item'      => __( 'View Project' ),
		'search_items'   => __( 'Search Project' ),
		'featured_image' => 'Poster',
		'set_featured_image' => 'Add Poster'
	];

	$args = [
		"label" => __( "Projects", "teamscal.com" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "our_project", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail",'excerpt', 'comments', 'custom-fields'  ],
		"show_in_graphql" => false,
    	'taxonomies' => array('post_tag','template','category')
	];

	register_post_type( "our_project", $args );
}

add_action( 'init', 'cptui_register_my_cpts_our_project' );



// Add custom post our_story
function register_my_cpts_our_story() {

	/**
	 * Post Type: Our Projects.
	 */

	$labels = [
		"name" => __( "Story", "teamscal.com" ),
		"singular_name" => __( "Story", "teamscal.com" ),
		'add_new'         => __( 'Add New Story' ),
		'add_new_item'   => __( 'Add New Story' ),
		'edit_item'      => __( 'Edit Story' ),
		'new_item'       => __( 'New Story' ),
		'all_items'      => __( 'All Story' ),
		'view_item'      => __( 'View Story' ),
		'search_items'   => __( 'Search Story' ),
		'featured_image' => 'Poster',
		'set_featured_image' => 'Add Poster'
	];

	$args = [
		"label" => __( "Story", "teamscal.com" ),
		"labels" => $labels,
		"description" => "Manage post type of project",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "our_story", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail",'excerpt', 'comments', 'custom-fields'  ],
		"show_in_graphql" => false,
    	'taxonomies' => array('post_tag','template','category')
	];

	register_post_type( "our_story", $args );
}

add_action( 'init', 'register_my_cpts_our_story' );

// function my_cpt_post_types( $post_types ) {
//   $post_types[] = 'Projects';
//   $post_types[] = 'story';
//   return $post_types;
// }
// add_filter( 'cpt_post_types', 'my_cpt_post_types' );

// Hide br and p tag of contact-form 7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// Add custom class
function prefix_conditional_body_class( $classes ) {
    if( is_page_template('default-template.php') )
        $classes[] = 'default-template';

    return $classes;
}
add_filter( 'body_class', 'prefix_conditional_body_class' );

// shortcode for project page 
function all_projects($args, $content) {
	$type_project = $args['category'];	
	$argsc = array(
        'post_type' => 'our_project',
		'posts_per_page' => -1,
		// 'tag' => $type_project ? $type_project : 'all'
    );
	if($type_project){
		$argsc['category_name'] = $type_project;
	}
	$query = new WP_Query($argsc);
	if ($query->have_posts() ) : 
		echo '<div class="list-projects ms-lg-0 ms-1 row">
				<div class="col item-project">
				<a href="/sola-one">
				<div style=" background: 
				linear-gradient(180deg, rgba(25, 27, 31, 0.003) 0%, rgba(34, 37, 41, 0.01) 100%), 
				url(https://srpgdev.wpengine.com/wp-content/uploads/2023/09/sola_one_entry-copy.jpeg);" class="project">
					<p class="text-center  text-uppercase top for-sale">FOR SALE</p>
					<p class="text-center bot">View project
						<svg class="icon-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.53033 0.46967C7.23744 0.176777 6.76256 0.176777 6.46967 0.46967C6.17678 0.762563 6.17678 1.23744 6.46967 1.53033L7.53033 0.46967ZM14 8L14.5303 8.53033C14.8232 8.23744 14.8232 7.76256 14.5303 7.46967L14 8ZM6.46967 14.4697C6.17678 14.7626 6.17678 15.2374 6.46967 15.5303C6.76256 15.8232 7.23744 15.8232 7.53033 15.5303L6.46967 14.4697ZM6.46967 1.53033L13.4697 8.53033L14.5303 7.46967L7.53033 0.46967L6.46967 1.53033ZM13.4697 7.46967L6.46967 14.4697L7.53033 15.5303L14.5303 8.53033L13.4697 7.46967Z" fill="#EBEBEB"></path>
							<g opacity="0.6">
							<path d="M9.03033 3.03033C9.32322 2.73744 9.32322 2.26256 9.03033 1.96967C8.73744 1.67678 8.26256 1.67678 7.96967 1.96967L9.03033 3.03033ZM7.96967 14.0303C8.26256 14.3232 8.73744 14.3232 9.03033 14.0303C9.32322 13.7374 9.32322 13.2626 9.03033 12.9697L7.96967 14.0303ZM5.46967 4.46967C5.17678 4.76256 5.17678 5.23744 5.46967 5.53033C5.76256 5.82322 6.23744 5.82322 6.53033 5.53033L5.46967 4.46967ZM6.53033 10.4697C6.23744 10.1768 5.76256 10.1768 5.46967 10.4697C5.17678 10.7626 5.17678 11.2374 5.46967 11.5303L6.53033 10.4697ZM7.96967 1.96967L5.46967 4.46967L6.53033 5.53033L9.03033 3.03033L7.96967 1.96967ZM5.46967 11.5303L7.96967 14.0303L9.03033 12.9697L6.53033 10.4697L5.46967 11.5303Z" fill="#EBEBEB"></path>
							<path d="M2.53033 0.46967C2.23744 0.176777 1.76256 0.176777 1.46967 0.46967C1.17678 0.762563 1.17678 1.23744 1.46967 1.53033L2.53033 0.46967ZM9 8L9.53033 8.53033C9.82322 8.23744 9.82322 7.76256 9.53033 7.46967L9 8ZM1.46967 14.4697C1.17678 14.7626 1.17678 15.2374 1.46967 15.5303C1.76256 15.8232 2.23744 15.8232 2.53033 15.5303L1.46967 14.4697ZM1.46967 1.53033L8.46967 8.53033L9.53033 7.46967L2.53033 0.46967L1.46967 1.53033ZM8.46967 7.46967L1.46967 14.4697L2.53033 15.5303L9.53033 8.53033L8.46967 7.46967Z" fill="#EBEBEB"></path>
							</g>
						</svg>
					</p>
				</div>
				<p class="text-center mt-md-2 mt-4"><img style = "margin-top:10px; width:80px;" src="https://www.srpropertygroup.com.au/wp-content/uploads/2023/09/sola-one-logo-1.png"></p>
				</a>
			</div>';
		while ( $query->have_posts() ) : $query->the_post();
				$post_id = get_the_ID();
				$status_project =  get_field( "status_project", $post_id );
				$class_title ='';
				if( $status_project && $status_project == 'FOR SALE'){
					$class_title = 'for-sale';
				}
				echo '<div class="col item-project">
						<a href="../our-projects?postID='.$post_id.'">
						<div style=" background: 
						linear-gradient(180deg, rgba(25, 27, 31, 0.003) 0%, rgba(34, 37, 41, 0.01) 100%), 
						url('. get_the_post_thumbnail_url( $post_id, 'medium' ).');" class="project">
							<p class="text-center  text-uppercase top '.$class_title.'">'. $status_project .'</p>
							<p class="text-center bot">View project
								<svg class="icon-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.53033 0.46967C7.23744 0.176777 6.76256 0.176777 6.46967 0.46967C6.17678 0.762563 6.17678 1.23744 6.46967 1.53033L7.53033 0.46967ZM14 8L14.5303 8.53033C14.8232 8.23744 14.8232 7.76256 14.5303 7.46967L14 8ZM6.46967 14.4697C6.17678 14.7626 6.17678 15.2374 6.46967 15.5303C6.76256 15.8232 7.23744 15.8232 7.53033 15.5303L6.46967 14.4697ZM6.46967 1.53033L13.4697 8.53033L14.5303 7.46967L7.53033 0.46967L6.46967 1.53033ZM13.4697 7.46967L6.46967 14.4697L7.53033 15.5303L14.5303 8.53033L13.4697 7.46967Z" fill="#EBEBEB"/>
									<g opacity="0.6">
									<path d="M9.03033 3.03033C9.32322 2.73744 9.32322 2.26256 9.03033 1.96967C8.73744 1.67678 8.26256 1.67678 7.96967 1.96967L9.03033 3.03033ZM7.96967 14.0303C8.26256 14.3232 8.73744 14.3232 9.03033 14.0303C9.32322 13.7374 9.32322 13.2626 9.03033 12.9697L7.96967 14.0303ZM5.46967 4.46967C5.17678 4.76256 5.17678 5.23744 5.46967 5.53033C5.76256 5.82322 6.23744 5.82322 6.53033 5.53033L5.46967 4.46967ZM6.53033 10.4697C6.23744 10.1768 5.76256 10.1768 5.46967 10.4697C5.17678 10.7626 5.17678 11.2374 5.46967 11.5303L6.53033 10.4697ZM7.96967 1.96967L5.46967 4.46967L6.53033 5.53033L9.03033 3.03033L7.96967 1.96967ZM5.46967 11.5303L7.96967 14.0303L9.03033 12.9697L6.53033 10.4697L5.46967 11.5303Z" fill="#EBEBEB"/>
									<path d="M2.53033 0.46967C2.23744 0.176777 1.76256 0.176777 1.46967 0.46967C1.17678 0.762563 1.17678 1.23744 1.46967 1.53033L2.53033 0.46967ZM9 8L9.53033 8.53033C9.82322 8.23744 9.82322 7.76256 9.53033 7.46967L9 8ZM1.46967 14.4697C1.17678 14.7626 1.17678 15.2374 1.46967 15.5303C1.76256 15.8232 2.23744 15.8232 2.53033 15.5303L1.46967 14.4697ZM1.46967 1.53033L8.46967 8.53033L9.53033 7.46967L2.53033 0.46967L1.46967 1.53033ZM8.46967 7.46967L1.46967 14.4697L2.53033 15.5303L9.53033 8.53033L8.46967 7.46967Z" fill="#EBEBEB"/>
									</g>
								</svg>
							</p>
						</div>
						<p class="text-center mt-md-2 mt-4">'. get_the_title().'</p>
						</a>
					</div>';
		endwhile;
		echo '</div>';
		wp_reset_postdata();
	endif;
}

add_shortcode( 'projects', 'all_projects' );


// shortcode for slider project page 
function slider_individual_projects($args, $content) {
	$id_post = $args['id'];
	if(!$id_post){
		return 'please provide params id post'; 
	}
	$countBtn = 0;
	$argsc = array(
        'post_type' => 'our_project',
		'posts_per_page' => -1,
    );
	$query = new WP_Query($argsc);
	if ($query->have_posts() ) : 
		echo '<div id="carouselExampleIndicators"class="carousel slide sider_projects" data-bs-ride="carousel">
				<div class="carousel-indicators">';
					// Loop button for slider
					while ( $query->have_posts() ) : $query->the_post();
						if($id_post == get_the_ID()){
							echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$countBtn.'" class="active  photo-counter-ui" aria-current="true" aria-label="Slide '.$countBtn.'"></button>';
						}else{
							echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$countBtn.'" class="photo-counter-ui"  aria-current="true" aria-label="Slide '.$countBtn.'"></button>';
						}				
						$countBtn++;
					endwhile;
				echo '</div><div class="carousel-inner">';
				// Loop image projects
				while ( $query->have_posts() ) : $query->the_post();
						if($id_post == get_the_ID()){
							echo 	'<div class="carousel-item active" data-bs-interval="15000">
										<img src="'.get_field( "image_slider",get_the_ID()).'" class="d-block w-100" alt="...">
									</div>';
						}else{
							echo 	'<div class="carousel-item " data-bs-interval="1">
										<img src="'.get_field( "image_slider",get_the_ID()).'" class="d-block w-100" alt="...">
									</div>';
						}				
				$countBtn++;
				endwhile;	
				echo'</div>
					<button class="carousel-control-prev carousel-control" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next carousel-control" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>';
		wp_reset_postdata();
	endif;
}

add_shortcode( 'slider_individual_projects', 'slider_individual_projects' );


// Add short_code for our story post 
function our_story_fnc($args, $content) {
	$class = $args['class'] ? $args['class'] : '';
	$id_post = $args["id"] ? $args["id"] : '';
	ob_start();
	if(!$id_post){
		return 'please provide params id for post_story';
	}
	$post = get_post($id_post);
	if(!$post){
		return "!!! Story post does not exist !!!";
	}else {
		if($post->post_type != 'our_story'){
			return "!!! Posts must be of type story post !!!";
		}
		$title = get_field("title_story",$id_post) ?  get_field("title_story",$id_post) : get_the_title($id_post);
		echo '<div class="row story-post d-flex  justify-content-center handle-menu-right '.$class.'">
				<div class="col-lg-6 d-flex align-items-center col-12 text-center  pb-5 pt-3 pe-md-4 ps-md-4 img-post">
					<img class="mt-5 feature-image" src="'.get_the_post_thumbnail_url( $id_post ).'" alt="...">
				</div>
				<div class="col-lg-6 col-12 p-md-5 pl-2 content-post">
					<h1 class="heading">'.$title.'</h1>
					<p class="content">'.get_field("content_story",$id_post ).'</p>
				</div>
			</div>';
		if(get_field("footer_story",$id_post )){
			echo '<div class="row footer-story-post d-flex justify-content-lg-center">
				<div class="col-1 text-end">
					<svg width="57" height="54" viewBox="0 0 57 54" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M56.3179 4.03211L56.3179 5.88811C54.4619 7.66677 52.6832 10.3348 50.9819 13.8921C49.2805 17.4494 48.4299 21.6254 48.4299 26.4201C48.4299 28.7401 48.7779 30.5961 49.4739 31.9881C50.0925 33.4574 51.0592 35.0041 52.3739 36.6281C53.5339 38.1748 54.4232 39.5281 55.0419 40.6881C55.5832 41.9254 55.8539 43.4334 55.8539 45.2121C55.8539 47.6868 55.0032 49.7361 53.3019 51.3601C51.5232 53.0614 49.3579 53.9121 46.8059 53.9121C44.2539 53.9121 41.9725 53.0228 39.9619 51.2441C37.8739 49.4654 36.2499 47.1068 35.0899 44.1681C33.9299 41.2294 33.3499 38.0974 33.3499 34.7721C33.3499 29.3588 34.3165 24.2548 36.2499 19.4601C38.1832 14.6654 40.5806 10.5668 43.4419 7.16411C46.3032 3.83877 49.0486 1.48011 51.6779 0.0881115L51.7939 0.0881115L56.3179 4.03211ZM23.0259 4.03211L23.0259 5.8881C21.1699 7.66677 19.3912 10.3348 17.6899 13.8921C15.9886 17.4494 15.1379 21.6254 15.1379 26.4201C15.1379 28.7401 15.4859 30.5961 16.1819 31.9881C16.8006 33.4574 17.7672 35.0041 19.0819 36.6281C20.2419 38.1748 21.1312 39.5281 21.7499 40.6881C22.2912 41.9254 22.5619 43.4334 22.5619 45.2121C22.5619 47.6868 21.7112 49.7361 20.0099 51.3601C18.2312 53.0614 16.1045 53.9121 13.6299 53.9121C11.0779 53.9121 8.75789 53.0228 6.66989 51.2441C4.58189 49.4654 2.95788 47.1068 1.79788 44.1681C0.637883 41.2294 0.0578932 38.0974 0.0578935 34.7721C0.057894 29.3588 1.02453 24.2548 2.95786 19.4601C4.89119 14.6654 7.28854 10.5668 10.1499 7.1641C13.0112 3.83877 15.7566 1.48011 18.3859 0.0881086L18.5019 0.0881086L23.0259 4.03211Z" fill="#A3A4A6" fill-opacity="0.08"/>
					</svg>
				</div>
				<div class="col-lg-9 col-md-9 col-12 text-lg-center text-start">
					<h2>'.get_field("footer_story",$id_post ).'</h2>
				</div>
				<div class="col-1">
					<svg width="57" height="54" viewBox="0 0 57 54" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.682129 49.9679V48.1119C2.53813 46.3332 4.31679 43.6652 6.01813 40.1079C7.71946 36.5506 8.57013 32.3746 8.57013 27.5799C8.57013 25.2599 8.22212 23.4039 7.52612 22.0119C6.90746 20.5426 5.9408 18.9959 4.62613 17.3719C3.46613 15.8252 2.5768 14.4719 1.95813 13.3119C1.4168 12.0746 1.14612 10.5666 1.14612 8.78789C1.14612 6.31322 1.99679 4.26389 3.69812 2.63988C5.47679 0.938555 7.64212 0.0878906 10.1941 0.0878906C12.7461 0.0878906 15.0275 0.977227 17.0381 2.75589C19.1261 4.53456 20.7501 6.89322 21.9101 9.83189C23.0701 12.7706 23.6501 15.9026 23.6501 19.2279C23.6501 24.6412 22.6835 29.7452 20.7501 34.5399C18.8168 39.3346 16.4194 43.4332 13.5581 46.8359C10.6968 50.1612 7.95145 52.5199 5.32211 53.9119H5.20612L0.682129 49.9679ZM33.9741 49.9679V48.1119C35.8301 46.3332 37.6088 43.6652 39.3101 40.1079C41.0115 36.5506 41.8621 32.3746 41.8621 27.5799C41.8621 25.2599 41.5141 23.4039 40.8181 22.0119C40.1994 20.5426 39.2328 18.9959 37.9181 17.3719C36.7581 15.8252 35.8688 14.4719 35.2501 13.3119C34.7088 12.0746 34.4381 10.5666 34.4381 8.78789C34.4381 6.31322 35.2888 4.26389 36.9901 2.63988C38.7688 0.938555 40.8955 0.0878906 43.3701 0.0878906C45.9221 0.0878906 48.2421 0.977227 50.3301 2.75589C52.4181 4.53456 54.0421 6.89322 55.2021 9.83189C56.3621 12.7706 56.9421 15.9026 56.9421 19.2279C56.9421 24.6412 55.9755 29.7452 54.0421 34.5399C52.1088 39.3346 49.7115 43.4332 46.8501 46.8359C43.9888 50.1612 41.2434 52.5199 38.6141 53.9119H38.4981L33.9741 49.9679Z" fill="#A3A4A6" fill-opacity="0.08"/>
					</svg>
				</div>
			</div>';
		}
		return ob_get_clean();
	}

}

add_shortcode( 'our_story', 'our_story_fnc' );

// Add short_code for our story post 
function gallery_post_fnc($args, $content) {
	$class = $args['class'] ? $args['class'] : '';
	$id_post = $args["id"] ? $args["id"] : '';
	ob_start();
	if(!$id_post){
		return 'please provide params id for post_story';
	}
	$post = get_post($id_post);
	if(!$post){
		return "!!! Gallery post does not exist !!!";
	}else {
		if($post->post_type != 'our_story'){
			return "!!! Posts must be of type story post !!!";
		}
		$title = get_field("title_story",$id_post) ?  get_field("title_story",$id_post) : get_the_title($id_post);
		echo '<div class="row gallery-post d-flex  justify-content-center handle-menu-right'.$class.'">
				<div class="col-xl-6 col-12 pe-xl-5  content-post">
					<img class="img-heading-gallery"  src="'.get_the_post_thumbnail_url( $id_post ).'"></img>
					<div class="body-content">
						<p class="content mt-5">'.get_field("content_story",$id_post ).'</p>
					</div>
				</div>
				<div class="col-xl-6 col-12 text-center  pb-5 pt-3 ps-0">
						<div class="row img-post justify-content-center" >';
							if(get_field( "image_gallery_story", $id_post )){
								foreach (get_field( "image_gallery_story",$id_post ) as $key => $value) {
									if($key == 1){
										echo '<div class="col-3 img-post-gallery pe-0"> 
											<img  src="'.$value.'" />
										</div>';
									}else {
										echo '<div class="col-4 img-post-gallery pe-0"> 
											<img  src="'.$value.'" />
										</div>';
									}
								} 
							}
					echo'</div>
				</div>
			</div>';
		if(get_field("footer_story",$id_post )){
			echo '<div class="row footer-story-post d-flex justify-content-lg-center">
				<div class="col-1 text-end">
					<svg width="57" height="54" viewBox="0 0 57 54" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M56.3179 4.03211L56.3179 5.88811C54.4619 7.66677 52.6832 10.3348 50.9819 13.8921C49.2805 17.4494 48.4299 21.6254 48.4299 26.4201C48.4299 28.7401 48.7779 30.5961 49.4739 31.9881C50.0925 33.4574 51.0592 35.0041 52.3739 36.6281C53.5339 38.1748 54.4232 39.5281 55.0419 40.6881C55.5832 41.9254 55.8539 43.4334 55.8539 45.2121C55.8539 47.6868 55.0032 49.7361 53.3019 51.3601C51.5232 53.0614 49.3579 53.9121 46.8059 53.9121C44.2539 53.9121 41.9725 53.0228 39.9619 51.2441C37.8739 49.4654 36.2499 47.1068 35.0899 44.1681C33.9299 41.2294 33.3499 38.0974 33.3499 34.7721C33.3499 29.3588 34.3165 24.2548 36.2499 19.4601C38.1832 14.6654 40.5806 10.5668 43.4419 7.16411C46.3032 3.83877 49.0486 1.48011 51.6779 0.0881115L51.7939 0.0881115L56.3179 4.03211ZM23.0259 4.03211L23.0259 5.8881C21.1699 7.66677 19.3912 10.3348 17.6899 13.8921C15.9886 17.4494 15.1379 21.6254 15.1379 26.4201C15.1379 28.7401 15.4859 30.5961 16.1819 31.9881C16.8006 33.4574 17.7672 35.0041 19.0819 36.6281C20.2419 38.1748 21.1312 39.5281 21.7499 40.6881C22.2912 41.9254 22.5619 43.4334 22.5619 45.2121C22.5619 47.6868 21.7112 49.7361 20.0099 51.3601C18.2312 53.0614 16.1045 53.9121 13.6299 53.9121C11.0779 53.9121 8.75789 53.0228 6.66989 51.2441C4.58189 49.4654 2.95788 47.1068 1.79788 44.1681C0.637883 41.2294 0.0578932 38.0974 0.0578935 34.7721C0.057894 29.3588 1.02453 24.2548 2.95786 19.4601C4.89119 14.6654 7.28854 10.5668 10.1499 7.1641C13.0112 3.83877 15.7566 1.48011 18.3859 0.0881086L18.5019 0.0881086L23.0259 4.03211Z" fill="#A3A4A6" fill-opacity="0.08"/>
					</svg>
				</div>
				<div class="col-lg-9 col-md-9 col-12 text-lg-center text-start">
					<h2>'.get_field("footer_story",$id_post ).'</h2>
				</div>
				<div class="col-1">
					<svg width="57" height="54" viewBox="0 0 57 54" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.682129 49.9679V48.1119C2.53813 46.3332 4.31679 43.6652 6.01813 40.1079C7.71946 36.5506 8.57013 32.3746 8.57013 27.5799C8.57013 25.2599 8.22212 23.4039 7.52612 22.0119C6.90746 20.5426 5.9408 18.9959 4.62613 17.3719C3.46613 15.8252 2.5768 14.4719 1.95813 13.3119C1.4168 12.0746 1.14612 10.5666 1.14612 8.78789C1.14612 6.31322 1.99679 4.26389 3.69812 2.63988C5.47679 0.938555 7.64212 0.0878906 10.1941 0.0878906C12.7461 0.0878906 15.0275 0.977227 17.0381 2.75589C19.1261 4.53456 20.7501 6.89322 21.9101 9.83189C23.0701 12.7706 23.6501 15.9026 23.6501 19.2279C23.6501 24.6412 22.6835 29.7452 20.7501 34.5399C18.8168 39.3346 16.4194 43.4332 13.5581 46.8359C10.6968 50.1612 7.95145 52.5199 5.32211 53.9119H5.20612L0.682129 49.9679ZM33.9741 49.9679V48.1119C35.8301 46.3332 37.6088 43.6652 39.3101 40.1079C41.0115 36.5506 41.8621 32.3746 41.8621 27.5799C41.8621 25.2599 41.5141 23.4039 40.8181 22.0119C40.1994 20.5426 39.2328 18.9959 37.9181 17.3719C36.7581 15.8252 35.8688 14.4719 35.2501 13.3119C34.7088 12.0746 34.4381 10.5666 34.4381 8.78789C34.4381 6.31322 35.2888 4.26389 36.9901 2.63988C38.7688 0.938555 40.8955 0.0878906 43.3701 0.0878906C45.9221 0.0878906 48.2421 0.977227 50.3301 2.75589C52.4181 4.53456 54.0421 6.89322 55.2021 9.83189C56.3621 12.7706 56.9421 15.9026 56.9421 19.2279C56.9421 24.6412 55.9755 29.7452 54.0421 34.5399C52.1088 39.3346 49.7115 43.4332 46.8501 46.8359C43.9888 50.1612 41.2434 52.5199 38.6141 53.9119H38.4981L33.9741 49.9679Z" fill="#A3A4A6" fill-opacity="0.08"/>
					</svg>
				</div>
			</div>';
		}
		return ob_get_clean();
	}

}

add_shortcode( 'design_gallery', 'gallery_post_fnc' );


// Add short_code for our story post 
function content_block_function($args, $content) {
	$class = "";
	$bgcolor = $args['cb_bgcolor'] ? $args['cb_bgcolor'] : '';
	if($bgcolor) {
		$text = "#282828";
	}
	else{
		$bgcolor = "#282828";
	}
	$img_align = "cb-img-left";
	$cb_reverse = $args['cb_reverse'] ? $args['cb_reverse'] : '';
	$cb_text = $args["cb_text"] ? $args["cb_text"] : '';
	$cb_heading = $args["cb_heading"] ? $args["cb_heading"] : '';
	$cb_img = $args["cb_img"] ? $args["cb_img"] : '';
	if($cb_reverse == "yes") {
		$class = "flex-row-reverse";
		$img_align = "cb-img-right"	;	
	}
	ob_start();
	
	echo '<div class = "container-fluid-custom"><div class = "">
			<div class="cb-container d-flex  justify-content-center '.$class.'">
				<div class="col-lg-7 d-flex align-items-center col-12 text-center">
					<div class="d-flex flex-grow-1 cb-img '.$img_align.' " style="background-image: url(&quot;'.$cb_img.'&quot;)"></div>
				</div>
				<div class="d-flex cb-content col-lg-5 col-12" style ="background:'.$bgcolor.'">
					<div style = "color:'.$text.'"class = "d-flex flex-column h-100 justify-content-center">
						<h2 class="heading">'.$cb_heading.'</h2>
						<p class="content">'.$cb_text.'</p>
					</div>
				</div>
			</div>
		</div>
		</div>';
		return ob_get_clean();
}

add_shortcode( 'content_block', 'content_block_function' );

// Add short_code for our story post 
function srpg_form_function($args, $content) {
	$srpg_form_text = $args["srpg_form_text"] ? $args["srpg_form_text"] : '';
	$srpg_form_heading = $args["srpg_form_heading"] ? $args["srpg_form_heading"] : '';
	ob_start();
	
	echo '<div class = "container-fluid-custom srpg-form-container"><div class = "container srpg-form">
			<div class="row  d-flex  justify-content-center '.$class.'">
				<div class="col-lg-5 d-flex justify-content-center flex-column  col-12">
					<h2 class="heading">'.$srpg_form_heading.'</h2>
					<p class="content">'.$srpg_form_text.'</p>
				</div>
				<div id="mc_embed_signup" class="d-flex col-lg-7 col-12 flex-column justify-content-center">
					<form class="sola-form" action="https://abi-international.us21.list-manage.com/subscribe/post?u=130769da0a36a318ca92d469a&amp;id=2301ce5b40&amp;f_id=0085f0e6f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
						<div id="mc_embed_signup_scroll">
							<fieldset>
								<legend>Name</legend>
								<input type="text" name="FNAME" class=" text" id="mce-FNAME" value="">
							</fieldset>
							<fieldset>
								<legend>Email</legend>
								<input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value="">
							</fieldset>
						</div>
						<!-- <div id="mc_embed_signup_scroll">
							<div class="mc-field-group"><label for="mce-FNAME">Name </label><input type="text" name="FNAME" class=" text" id="mce-FNAME" value=""></div><div class="mc-field-group"><label for="mce-EMAIL">Email <span class="asterisk">*</span></label><input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value=""></div> -->
						<div id="mce-responses" class="clear foot">
							<div class="response" id="mce-error-response" style="display: none;"></div>
							<div class="response" id="mce-success-response" style="display: none;"></div>
						</div>
						<div aria-hidden="true" style="position: absolute; left: -5000px;">
							/* real people should not fill this in and expect good things - do not remove this or risk form bot signups */
							<input type="text" name="b_130769da0a36a318ca92d469a_2301ce5b40" tabindex="-1" value="">
						</div>
							<input style = "border-radius:unset; width:160px;"type="submit" name="subscribe" id="mc-embedded-subscribe" class="" value="Register">
					</form>
				</div>
			</div>
		</div></div>';
		return ob_get_clean();
}

add_shortcode( 'srpg_form', 'srpg_form_function' );


function srpg_img_function($args, $content){
	$srpg_img_src = $args["srpg_img_src"] ? $args["srpg_img_src"] : '';
	$srpg_img_class = $args["srpg_img_class"] ? $args["srpg_img_class"] : '';
	ob_start();
	
	echo '<div style = "position:relative;" class = "container-fluid-custom"><div  class = "'.$srpg_img_class.'">
			</div>
		<img class = "entry-video-logo" src = "https://www.srpropertygroup.com.au/wp-content/uploads/2023/09/sola-one-logo-1.png">
		</div>';
		return  ob_get_clean();
}
add_shortcode( 'srpg_img', 'srpg_img_function' );

function srpg_counter_function($args, $content){
	$srpg_counter1 = $args["srpg_counter1"] ? $args["srpg_counter1"] : '';
	$srpg_counter2 = $args["srpg_counter2"] ? $args["srpg_counter2"] : '';
	$srpg_counter3 = $args["srpg_counter3"] ? $args["srpg_counter3"] : '';
	$srpg_counter4 = $args["srpg_counter4"] ? $args["srpg_counter4"] : '';
	$srpg_counter5 = $args["srpg_counter5"] ? $args["srpg_counter5"] : '';
	$srpg_counter1_title = $args["srpg_counter1_title"] ? $args["srpg_counter1_title"] : '';
	$srpg_counter2_title = $args["srpg_counter2_title"] ? $args["srpg_counter2_title"] : '';
	$srpg_counter3_title = $args["srpg_counter3_title"] ? $args["srpg_counter3_title"] : '';
	$srpg_counter4_title = $args["srpg_counter4_title"] ? $args["srpg_counter4_title"] : '';
	$srpg_counter5_title = $args["srpg_counter5_title"] ? $args["srpg_counter5_title"] : '';
	
	ob_start();
	
	echo '<div class = "container-fluid-custom"><div id = "counter-wrapper" class = "container">
			<div  class ="d-flex  sola-one-counter">
				<div class = "d-flex flex-column  text-center counter">
					<div id = "counter-trigger-top"></div>
					<div id="counter-number1" class ="counter-number"></div>
					<div id = "counter-trigger-bottom"></div>
					<div id="counter-number-hidden1" style = "display:none;"">'.$srpg_counter1.'</div>
					<h3>'.$srpg_counter1_title.'</h3>
				</div>
				<div class = "d-flex flex-column  text-center counter">
					<div id="counter-number2" class ="counter-number"></div>
					<div id="counter-number-hidden2" style = "display:none;"">'.$srpg_counter2.'</div>
					<h3>'.$srpg_counter2_title.'</h3> 
				</div>
				<div class = "d-flex flex-column  text-center counter">
					<div id="counter-number3" class ="counter-number"></div>
					<div id="counter-number-hidden3" style = "display:none;"">'.$srpg_counter3.'</div>
					<h3>'.$srpg_counter3_title.'</h3>
				</div>
				<div class = "d-flex flex-column  text-center counter">
					<div id="counter-number4" class ="counter-number"></div>
					<div id="counter-number-hidden4" style = "display:none;"">'.$srpg_counter4.'</div>
					<h3>'.$srpg_counter4_title.'</h3>
				</div>
				<div class = "d-flex flex-column  text-center counter">
					<div id="counter-number5" class ="counter-number"></div>
					<div id="counter-number-hidden5" style = "display:none;"">'.$srpg_counter5.'</div>
					<h3>'.$srpg_counter5_title.'</h3>
				</div>
			</div>
		</div>
		</div>';
		return ob_get_clean();
}
add_shortcode( 'srpg_counter', 'srpg_counter_function' );

function srpg_img_overlay_function($args, $content){
	ob_start();
	
	echo '<div class = "image-scroll-animation container-fluid-custom" style = "height:600vh">
			<div class="image-container">
			</div>
			
		
			<div class = "screen-detector"></div>
		</div>';
		return ob_get_clean();
}
add_shortcode( 'srpg_img_overlay', 'srpg_img_overlay_function' );

function srpg_img_mobile_function($args, $content){
	$srpg_img_src = $args["srpg_img_src"] ? $args["srpg_img_src"] : '';	
	ob_start();
	echo '<div class = "image-container-mobile container-fluid-custom">
			<img  src = "'.$srpg_img_src.'">
		</div>';
		return  ob_get_clean();
}
add_shortcode( 'srpg_img_mobile', 'srpg_img_mobile_function' );
?>
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>