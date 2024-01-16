<?php
/**
 * This file adds the Home Page to the SRPG Theme.
 *
 * @author Teamscal
 * @package SRPG Theme
 * @subpackage Customizations
 */
 
 // displays header
 get_header();
 ?> </header> 
<?php
 // Remove sidebar
 remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
?>
<div class="row mt-4 home-page  d-flex justify-content-center align-items-center">
    <div class="col-xl-8 col-md-10 col-12  home-page-content">
        <div class="row">
            <?php
                wp_nav_menu(
                    array(
                    'theme_location'  => 'home-menu',
                    'items_wrap' => '<ul class="nav">%3$s</ul>',
                    'container' => 'nav',
                    'container_class' => 'nav menu-home',
                    'menu_class'  => 'navbar-nav nav',
                    'after'  => '   <svg class="icon-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.53033 0.46967C7.23744 0.176777 6.76256 0.176777 6.46967 0.46967C6.17678 0.762563 6.17678 1.23744 6.46967 1.53033L7.53033 0.46967ZM14 8L14.5303 8.53033C14.8232 8.23744 14.8232 7.76256 14.5303 7.46967L14 8ZM6.46967 14.4697C6.17678 14.7626 6.17678 15.2374 6.46967 15.5303C6.76256 15.8232 7.23744 15.8232 7.53033 15.5303L6.46967 14.4697ZM6.46967 1.53033L13.4697 8.53033L14.5303 7.46967L7.53033 0.46967L6.46967 1.53033ZM13.4697 7.46967L6.46967 14.4697L7.53033 15.5303L14.5303 8.53033L13.4697 7.46967Z" fill="#EBEBEB"/>
                                        <g opacity="0.6">
                                            <path d="M9.03033 3.03033C9.32322 2.73744 9.32322 2.26256 9.03033 1.96967C8.73744 1.67678 8.26256 1.67678 7.96967 1.96967L9.03033 3.03033ZM7.96967 14.0303C8.26256 14.3232 8.73744 14.3232 9.03033 14.0303C9.32322 13.7374 9.32322 13.2626 9.03033 12.9697L7.96967 14.0303ZM5.46967 4.46967C5.17678 4.76256 5.17678 5.23744 5.46967 5.53033C5.76256 5.82322 6.23744 5.82322 6.53033 5.53033L5.46967 4.46967ZM6.53033 10.4697C6.23744 10.1768 5.76256 10.1768 5.46967 10.4697C5.17678 10.7626 5.17678 11.2374 5.46967 11.5303L6.53033 10.4697ZM7.96967 1.96967L5.46967 4.46967L6.53033 5.53033L9.03033 3.03033L7.96967 1.96967ZM5.46967 11.5303L7.96967 14.0303L9.03033 12.9697L6.53033 10.4697L5.46967 11.5303Z" fill="#EBEBEB"/>
                                            <path d="M2.53033 0.46967C2.23744 0.176777 1.76256 0.176777 1.46967 0.46967C1.17678 0.762563 1.17678 1.23744 1.46967 1.53033L2.53033 0.46967ZM9 8L9.53033 8.53033C9.82322 8.23744 9.82322 7.76256 9.53033 7.46967L9 8ZM1.46967 14.4697C1.17678 14.7626 1.17678 15.2374 1.46967 15.5303C1.76256 15.8232 2.23744 15.8232 2.53033 15.5303L1.46967 14.4697ZM1.46967 1.53033L8.46967 8.53033L9.53033 7.46967L2.53033 0.46967L1.46967 1.53033ZM8.46967 7.46967L1.46967 14.4697L2.53033 15.5303L9.53033 8.53033L8.46967 7.46967Z" fill="#EBEBEB"/>
                                        </g>
                                    </svg>'
                    )
                ); 
            ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-7 col-md-8 col-12">
                <?php
                  the_content();
                ?>
            </div>

        </div>
    </div>
</div>
<?php
get_footer(); //displays footer
