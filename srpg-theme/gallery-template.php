<?php
/**
* Template Name: Gallery
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
get_sidebar('right');
?>
<div class="container p-0">
    <div class="row ms-md-auto me-md-auto ms-0 me-1 mt-5 gallery-page story-page justify-content-center">
        <div class="col-lg-10 col-12">
            <?php the_content(); ?>
            <div class="row mb-5 d-flex justify-content-center footer-gallery">
                <div class="col-12 text-center">
                    <h2>See our portfolio of completed and upcoming projects.</h2>
                </div>
                <div class="col-lg-4 col-md-6 col-10 mt-4 pt-3">
                    <div class="wp-block-button btn-project-website">
                        <a class="wp-block-button__link" href="../our-projects/all-project/">See our projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-end fixed-bottom navigation-item-projects">
        <div class="col-lg-1 col-4  d-flex justify-content-end">
            <span id="back-to-top" class="control back-to-top w-50" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.292893 12.2929C-0.0976311 12.6834 -0.0976311 13.3166 0.292893 13.7071C0.683418 14.0976 1.31658 14.0976 1.70711 13.7071L0.292893 12.2929ZM13 1L13.7071 0.292893C13.3166 -0.0976311 12.6834 -0.097631 12.2929 0.292893L13 1ZM24.2929 13.7071C24.6834 14.0976 25.3166 14.0976 25.7071 13.7071C26.0976 13.3166 26.0976 12.6834 25.7071 12.2929L24.2929 13.7071ZM1.70711 13.7071L13.7071 1.70711L12.2929 0.292893L0.292893 12.2929L1.70711 13.7071ZM12.2929 1.70711L24.2929 13.7071L25.7071 12.2929L13.7071 0.292893L12.2929 1.70711Z" fill="#EBEBEB"/>
                    </svg>
            </span>
        </div>
    </div>
</div>

<?php
get_footer(); //displays footer
