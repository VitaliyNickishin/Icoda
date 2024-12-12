<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package icoda
 */

get_header();
?>

    <section class="section section-404">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-404">
                        <p class="title-404">404</p>
                        <p class="desc-404"><?php echo __('We Can’t Find The Page Your Are Looking For', 'icoda'); ?></p>
                        <div class="btn-404">
                            <a href="<?php echo home_url('/'); ?>" class="btn btn-blue"><?php echo __('Go To Main Page', 'icoda'); ?></a>
                            <a href="<?php echo home_url('/services'); ?>" class="btn btn-blue"><?php echo __('Services We Offer', 'icoda'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();?>
