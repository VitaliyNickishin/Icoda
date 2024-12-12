<?php
/* Template Name: Download page */
get_header();
?>
    <script>
        window.intercomSettings = {
            app_id: "gdz549ih"
        };
    </script>
    <section class="wr-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php the_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php the_content(); ?>
<?php
// get_sidebar();
get_footer(); ?>