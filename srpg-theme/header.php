<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @since srpg Theme 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name='viewport' content='width=device-width, minimum-scale=1, user-scalable=yes' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site d-sm-flex">
    <img class="img_bg_sidebar position-fixed" src=" <?php echo get_stylesheet_directory_uri()?>/assets/images/bg_sidebar.png"/>
    <div class="sidebar-left" id="open-sidebar">
        <div class="container-fluid">
            <?php get_sidebar( 'left' ); ?>
        </div>
    </div>
    <!-- <div id="toggle-vissible-sidebar" class="d-lg-none">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M-8 0H28C36.8366 0 44 7.16344 44 16V28C44 36.8366 36.8366 44 28 44H-8V0Z" fill="#C29E66"/>
                <path opacity="0.6" d="M21 15L10 15" stroke="#232529" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 22L35 22" stroke="#232529" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.6" d="M21 29L10 29" stroke="#232529" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M28 15L35 22L28 29" stroke="#232529" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
    </div> -->
    <div class="main-body">
        <div class="container-fluid">
            <header class="header row sticky-top">
                <div class="left-nav col-8 d-lg-block d-none">
                <?php 
                        wp_nav_menu(
                            array(
                            'theme_location'  => 'header-menu',
                            'items_wrap' => '<ul class="nav">%3$s</ul>',
                            'container' => 'nav',
                            'container_class' => 'nav justify-content-left',
                            'menu_class'  => 'navbar-nav nav',
                        )
                        ); 
                    ?>
                </div>
                <!-- <div class="right-nav col-lg-4 col-12">
                        <div class="menu-header-container">
                            <div class=""><a href="https://srpgdev.wpengine.com/sola-one/"><img style = "height:29px; width:auto;" src = "https://www.srpropertygroup.com.au/wp-content/uploads/2023/09/sola-one-logo-1.png"></a></div>
                        </div>
                    </div> -->

    

