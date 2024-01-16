<?php
/**
* Template Name: Default
* Description: Template for a Hello Bar page
* Template Post Type: post, page, our_project
*/
 // displays header
    get_header();
    ?> </header> 
<?php
    // Remove sidebar
    remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
?>
<div class="row mb-5 blog-post-page">
    <div class="col-12">
        <div class="row">
            <div class="col-12 p-0">
                    <?php echo do_shortcode( '[slider_individual_projects id="'.$_GET['postID'].'"]' ); ?>
            </div>
        </div>
        <!-- <div class="row d-flex justify-content-end project-heading">
            <div class="col-6">
                <div class="row justify-content-center d-flex">
                    <div class="col-7">
                       P>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="container">
            <div class="row d-flex flex-lg-row  flex-column-reverse justify-content-center project-content mb-5 pb-5 pe-2 ps-2">
                <div class="col-lg-6 col-12  ">
                    <div class="row  justify-content-end d-flex mt-5">
                        <div class="col-lg-8 col-10">
                            <div class="row mt-5 tiles" >
                                    <?php 
                                    if(get_field( "tiles_gallery", $_GET['postID'] )){
                                        foreach (get_field( "tiles_gallery", $_GET['postID'] ) as $key => $value) {
                                            echo '<div class="col-4"> 
                                                <div class="tiles-item ratio ratio-1x1" style=" background:url('.$value.');" ">
                                                </div>
                                            </div>';
                                        } 
                                    }
                                    ?>
                                    <h1>Moodboard</h1>
                            </div>
                        </div>
                        <?php if(get_field('btn_projects', $_GET['postID']) == 1) {
                                echo '<div class="col-10 d-lg-none ">
                                    <div class="wp-block-button btn-project-website  w-100">
                                        <a class="wp-block-button__link" href="">Project website</a>
                                    </div>
                                </div>';
                        } ?>
                        <div class="col-10 d-lg-none ">
                            <div class="wp-block-button contact-us-open w-100 handle-sidebar">
                                <a class="wp-block-button__link" >Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 ">
                    <div class="row justify-content-lg-center justify-content-end d-flex ">
                        <div class="col-lg-8 col-10">
                            <h1 class="heading"><?php echo get_the_title( $_GET['postID']);?></h1>
                            <P class="status"><?php   echo get_field( "status_project", $_GET['postID'] ); ?></p>
                            <p class="content">
                                <?php  echo get_field( "content_post", $_GET['postID'] );;?>
                            </p>
                            <p class="mt-4 social-medial">SHARE 
                                <span class="float-md-none float-end me-2 ">
                                    <a class="ms-md-2" id="facebook-share" target="_plank" href="#">
                                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M29 10H25.4545C23.8874 10 22.3844 10.6321 21.2762 11.7574C20.168 12.8826 19.5455 14.4087 19.5455 16V19.6H16V24.4H19.5455V34H24.2727V24.4H27.8182L29 19.6H24.2727V16C24.2727 15.6817 24.3972 15.3765 24.6189 15.1515C24.8405 14.9264 25.1411 14.8 25.4545 14.8H29V10Z" stroke="#bfbfbf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <!-- Your share button code -->
                                    <!-- <div class="fb-share-button" 
                                    data-href="https://srpg.tmscl.co/" 
                                    data-layout="button_count">
                                    </div> -->
                                    <!-- <a  class="ms-md-2" target="_blank" href="">
                                        <svg width="17" height="22" viewBox="0 0 17 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.03125 0C4.48906 0 0 3.01498 0 7.89449C0 10.9976 1.75312 12.7608 2.81562 12.7608C3.25391 12.7608 3.50625 11.5442 3.50625 11.2004C3.50625 10.7905 2.45703 9.9177 2.45703 8.21185C2.45703 4.66793 5.16641 2.15545 8.67266 2.15545C11.6875 2.15545 13.9187 3.86129 13.9187 6.99528C13.9187 9.33586 12.9758 13.7261 9.92109 13.7261C8.81875 13.7261 7.87578 12.9327 7.87578 11.7954C7.87578 10.1293 9.04453 8.516 9.04453 6.79693C9.04453 3.87892 4.8875 4.40787 4.8875 7.93416C4.8875 8.67468 4.98047 9.49454 5.3125 10.1689C4.70156 12.7872 3.45312 16.6882 3.45312 19.3858C3.45312 20.2189 3.57266 21.0387 3.65234 21.8718C3.80286 22.0393 3.7276 22.0217 3.95781 21.938C6.18906 18.8965 6.10937 18.3015 7.11875 14.3212C7.66328 15.3526 9.07109 15.908 10.1867 15.908C14.8883 15.908 17 11.3458 17 7.23331C17 2.8563 13.2016 0 9.03125 0Z" fill="#BFBFBF"/>
                                        </svg>
                                    </a> -->
                                </span>
                            </p>
                        </div>
                        <?php if(get_field('btn_projects', $_GET['postID']) == 1) {
                                echo '<div class="col-lg-8 col-10  mt-5 ">
                                    <div class="wp-block-button btn-project-website  w-100">
                                        <a class="wp-block-button__link" href="">Project website</a>
                                    </div>
                                </div>';
                        } ?>
                        <div class="col-lg-8 col-10  mt-5">
                            <div class="wp-block-button contact-us-open w-100 handle-sidebar">
                                <a class="wp-block-button__link">Contact us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row d-flex justify-content-md-end justify-content-start fixed-bottom navigation-item-projects invidual-projects">
    <?php 
        global $post; 
        $post = get_post( $_GET['postID'], $args );
        setup_postdata( $post );
        $previous_post = get_previous_post( )->ID;
        $next_post = get_next_post()->ID;
        $args = array('post_type'=>'our_project', 'posts_per_page' => -1);
        $posts = get_posts($args);
        $first_id = $posts[0]->ID; // To get ID of first lpost in custom post type 
        // outside of loop
        $last_id = end($posts)->ID;
        wp_reset_postdata();
        ?>
    <div class="col-xl-4 col-sm-6 p-0 col-10 d-flex justify-content-md-end group-navigation">
        <div class="row">

        <?php if ($first_id == $_GET['postID']) 
                echo '<div class=" projects-prev navigation disabled" aria-hidden="true">';
            else 
                echo '<div class="projects-prev navigation " aria-hidden="true">';
        ?>
                        <svg class="no-hover" width="16" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.46967 0.46967C7.76256 0.176777 8.23744 0.176777 8.53033 0.46967C8.82322 0.762563 8.82322 1.23744 8.53033 1.53033L7.46967 0.46967ZM1 8L0.46967 8.53033C0.176777 8.23744 0.176777 7.76256 0.46967 7.46967L1 8ZM8.53033 14.4697C8.82322 14.7626 8.82322 15.2374 8.53033 15.5303C8.23744 15.8232 7.76256 15.8232 7.46967 15.5303L8.53033 14.4697ZM8.53033 1.53033L1.53033 8.53033L0.46967 7.46967L7.46967 0.46967L8.53033 1.53033ZM1.53033 7.46967L8.53033 14.4697L7.46967 15.5303L0.46967 8.53033L1.53033 7.46967Z" fill="#EBEBEB"/>
                        </svg>
                        <svg class="hover"  width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.46967 0.46967C8.76256 0.176777 9.23744 0.176777 9.53033 0.46967C9.82322 0.762563 9.82322 1.23744 9.53033 1.53033L8.46967 0.46967ZM2 8L1.46967 8.53033C1.17678 8.23744 1.17678 7.76256 1.46967 7.46967L2 8ZM9.53033 14.4697C9.82322 14.7626 9.82322 15.2374 9.53033 15.5303C9.23744 15.8232 8.76256 15.8232 8.46967 15.5303L9.53033 14.4697ZM9.53033 1.53033L2.53033 8.53033L1.46967 7.46967L8.46967 0.46967L9.53033 1.53033ZM2.53033 7.46967L9.53033 14.4697L8.46967 15.5303L1.46967 8.53033L2.53033 7.46967Z" fill="#EBEBEB"/>
                            <g opacity="0.6">
                            <path d="M6.96967 3.03033C6.67678 2.73744 6.67678 2.26256 6.96967 1.96967C7.26256 1.67678 7.73744 1.67678 8.03033 1.96967L6.96967 3.03033ZM8.03033 14.0303C7.73744 14.3232 7.26256 14.3232 6.96967 14.0303C6.67678 13.7374 6.67678 13.2626 6.96967 12.9697L8.03033 14.0303ZM10.5303 4.46967C10.8232 4.76256 10.8232 5.23744 10.5303 5.53033C10.2374 5.82322 9.76256 5.82322 9.46967 5.53033L10.5303 4.46967ZM9.46967 10.4697C9.76256 10.1768 10.2374 10.1768 10.5303 10.4697C10.8232 10.7626 10.8232 11.2374 10.5303 11.5303L9.46967 10.4697ZM8.03033 1.96967L10.5303 4.46967L9.46967 5.53033L6.96967 3.03033L8.03033 1.96967ZM10.5303 11.5303L8.03033 14.0303L6.96967 12.9697L9.46967 10.4697L10.5303 11.5303Z" fill="#EBEBEB"/>
                            <path d="M13.4697 0.46967C13.7626 0.176777 14.2374 0.176777 14.5303 0.46967C14.8232 0.762563 14.8232 1.23744 14.5303 1.53033L13.4697 0.46967ZM7 8L6.46967 8.53033C6.17678 8.23744 6.17678 7.76256 6.46967 7.46967L7 8ZM14.5303 14.4697C14.8232 14.7626 14.8232 15.2374 14.5303 15.5303C14.2374 15.8232 13.7626 15.8232 13.4697 15.5303L14.5303 14.4697ZM14.5303 1.53033L7.53033 8.53033L6.46967 7.46967L13.4697 0.46967L14.5303 1.53033ZM7.53033 7.46967L14.5303 14.4697L13.4697 15.5303L6.46967 8.53033L7.53033 7.46967Z" fill="#EBEBEB"/>
                            </g>
                        </svg>
                        <span class="control-text">Prev </span>
                    </div>
                <div class="navigation">
                    <a href="../all-project">
                        <span >Projects</span>
                    </a>
                </div>
        <?php if ($last_id == $_GET['postID']) 
                echo '<div class="projects-next navigation disabled" aria-hidden="true">';
            else 
                echo '<div class="projects-next navigation " aria-hidden="true">';
            ?>
                <span class="control-text">Next</span>
                    <svg class="no-hover" width="16" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L1.53033 0.46967ZM8 8L8.53033 8.53033C8.82322 8.23744 8.82322 7.76256 8.53033 7.46967L8 8ZM0.46967 14.4697C0.176777 14.7626 0.176777 15.2374 0.46967 15.5303C0.762563 15.8232 1.23744 15.8232 1.53033 15.5303L0.46967 14.4697ZM0.46967 1.53033L7.46967 8.53033L8.53033 7.46967L1.53033 0.46967L0.46967 1.53033ZM7.46967 7.46967L0.46967 14.4697L1.53033 15.5303L8.53033 8.53033L7.46967 7.46967Z" fill="#EBEBEB"/>
                    </svg>
                            <svg class="hover" width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.53033 0.46967C7.23744 0.176777 6.76256 0.176777 6.46967 0.46967C6.17678 0.762563 6.17678 1.23744 6.46967 1.53033L7.53033 0.46967ZM14 8L14.5303 8.53033C14.8232 8.23744 14.8232 7.76256 14.5303 7.46967L14 8ZM6.46967 14.4697C6.17678 14.7626 6.17678 15.2374 6.46967 15.5303C6.76256 15.8232 7.23744 15.8232 7.53033 15.5303L6.46967 14.4697ZM6.46967 1.53033L13.4697 8.53033L14.5303 7.46967L7.53033 0.46967L6.46967 1.53033ZM13.4697 7.46967L6.46967 14.4697L7.53033 15.5303L14.5303 8.53033L13.4697 7.46967Z" fill="#EBEBEB"/>
                                <g opacity="0.6">
                                <path d="M9.03033 3.03033C9.32322 2.73744 9.32322 2.26256 9.03033 1.96967C8.73744 1.67678 8.26256 1.67678 7.96967 1.96967L9.03033 3.03033ZM7.96967 14.0303C8.26256 14.3232 8.73744 14.3232 9.03033 14.0303C9.32322 13.7374 9.32322 13.2626 9.03033 12.9697L7.96967 14.0303ZM5.46967 4.46967C5.17678 4.76256 5.17678 5.23744 5.46967 5.53033C5.76256 5.82322 6.23744 5.82322 6.53033 5.53033L5.46967 4.46967ZM6.53033 10.4697C6.23744 10.1768 5.76256 10.1768 5.46967 10.4697C5.17678 10.7626 5.17678 11.2374 5.46967 11.5303L6.53033 10.4697ZM7.96967 1.96967L5.46967 4.46967L6.53033 5.53033L9.03033 3.03033L7.96967 1.96967ZM5.46967 11.5303L7.96967 14.0303L9.03033 12.9697L6.53033 10.4697L5.46967 11.5303Z" fill="#EBEBEB"/>
                                <path d="M2.53033 0.46967C2.23744 0.176777 1.76256 0.176777 1.46967 0.46967C1.17678 0.762563 1.17678 1.23744 1.46967 1.53033L2.53033 0.46967ZM9 8L9.53033 8.53033C9.82322 8.23744 9.82322 7.76256 9.53033 7.46967L9 8ZM1.46967 14.4697C1.17678 14.7626 1.17678 15.2374 1.46967 15.5303C1.76256 15.8232 2.23744 15.8232 2.53033 15.5303L1.46967 14.4697ZM1.46967 1.53033L8.46967 8.53033L9.53033 7.46967L2.53033 0.46967L1.46967 1.53033ZM8.46967 7.46967L1.46967 14.4697L2.53033 15.5303L9.53033 8.53033L8.46967 7.46967Z" fill="#EBEBEB"/>
                                </g>
                            </svg>
            </div>     
        </div>        
    </div>
    <div class="col-lg-1 col-2 m-0 p-0">
        <div id="back-to-top" class="control back-to-top w-50" aria-hidden="true">
        <svg width="14" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.292893 12.2929C-0.0976311 12.6834 -0.0976311 13.3166 0.292893 13.7071C0.683418 14.0976 1.31658 14.0976 1.70711 13.7071L0.292893 12.2929ZM13 1L13.7071 0.292893C13.3166 -0.0976311 12.6834 -0.097631 12.2929 0.292893L13 1ZM24.2929 13.7071C24.6834 14.0976 25.3166 14.0976 25.7071 13.7071C26.0976 13.3166 26.0976 12.6834 25.7071 12.2929L24.2929 13.7071ZM1.70711 13.7071L13.7071 1.70711L12.2929 0.292893L0.292893 12.2929L1.70711 13.7071ZM12.2929 1.70711L24.2929 13.7071L25.7071 12.2929L13.7071 0.292893L12.2929 1.70711Z" fill="#EBEBEB"/>
        </svg>
        </div> 
    </div>
</div>
<?php

get_footer(); //displays footer
