<?php
/* Template Name: iGaming Marketing 
Template Post Type: post
*/

global $post;

get_header();

?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <nav class="wr-breadcrumb" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php the_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </nav>

        <?php
        if (empty($_GET['post-redesign'])) :
            the_content();
        else :
        ?>

        <!-- new html here -->

        <?php endif; ?>

    <?php endwhile; ?>

    <?php
    echo do_shortcode('[contact-form-new]');
    ?>

<?php endif; ?>

<?php
get_footer();
