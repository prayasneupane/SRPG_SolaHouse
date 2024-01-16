<?php
/**
* Template Name: Project
* Description: Template for a Hello Bar page
* Template Post Type: post, page, our_project
*/
//* Add custom body class
// displays header
get_header(); 
get_sidebar('submenu');
//* Add custom body class
?>
    <div class="row project-page w-90">
    <?php
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );?>
            <p class='d-lg-flex d-none projects-title'><?php the_title(); ?></p>
        <div class="col-12">
            <?php       
                the_content();
            ?>
            <div class="row navigation-item-projects fixed-bottom d-flex align-items-center">
                <div class="col-2 d-md-block d-none text-center number-project">
                    <span class="current-project"></span> <span class="sum-project">/ </span>
                </div>
                <div class="col-7  d-md-block d-none">
                    <div class="row scollbar-project">
                    </div>
                </div>
                <div class="col-md-2 col-12 ms-md-none">
                    <div class="row text-md-center d-flex  justify-content-center">
                        <div class="control projects-prev text-md-start text-center" style="padding-right: 13px;" aria-hidden="true">
                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.46967 0.46967C7.76256 0.176777 8.23744 0.176777 8.53033 0.46967C8.82322 0.762563 8.82322 1.23744 8.53033 1.53033L7.46967 0.46967ZM1 8L0.46967 8.53033C0.176777 8.23744 0.176777 7.76256 0.46967 7.46967L1 8ZM8.53033 14.4697C8.82322 14.7626 8.82322 15.2374 8.53033 15.5303C8.23744 15.8232 7.76256 15.8232 7.46967 15.5303L8.53033 14.4697ZM8.53033 1.53033L1.53033 8.53033L0.46967 7.46967L7.46967 0.46967L8.53033 1.53033ZM1.53033 7.46967L8.53033 14.4697L7.46967 15.5303L0.46967 8.53033L1.53033 7.46967Z" fill="#EBEBEB"/>
                            </svg>
                            <span class="d-md-none ms-2">Prev</span>
                        </div>
                        <div class="control projects-next text-md-start text-center" aria-hidden="true">
                            <span class="d-md-none me-2">Next</span>
                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L1.53033 0.46967ZM8 8L8.53033 8.53033C8.82322 8.23744 8.82322 7.76256 8.53033 7.46967L8 8ZM0.46967 14.4697C0.176777 14.7626 0.176777 15.2374 0.46967 15.5303C0.762563 15.8232 1.23744 15.8232 1.53033 15.5303L0.46967 14.4697ZM0.46967 1.53033L7.46967 8.53033L8.53033 7.46967L1.53033 0.46967L0.46967 1.53033ZM7.46967 7.46967L0.46967 14.4697L1.53033 15.5303L8.53033 8.53033L7.46967 7.46967Z" fill="#EBEBEB"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navigation">
            <button id="page-control-prev" class="carousel-control-prev d-none" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button id="page-control-next" class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<?php 

get_footer(); //displays footer
