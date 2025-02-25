<?php

/*
Template Name: New Case
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
        the_content();
        ?>


    <?php endwhile; ?>

    <?php if (has_category('cases') || has_category('cases-zh-hans')) : ?>
        <style>
            .article-page .section.section-form {
                padding-bottom: 80px;
                padding-top: 50px;
            }

            .section-form .l-box .text-vert {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                margin-top: auto;
                margin-bottom: auto;
            }

            .section-form .l-box .h4 {
                max-width: 233px;
                padding-bottom: 25px;
            }

            .section-form .wr-form {
                padding-left: 50px;
            }

            .section-form .row-vert {
                -ms-flex-align: center;
                align-items: center;
            }

            @media (max-width: 767.98px) {

                .section-form .l-box,
                .section-form .wr-form {
                    padding-left: 0;
                }

                .section-form .l-box {
                    min-height: auto;
                    padding-bottom: 40px;
                }
            }
        </style>
        <?php echo do_shortcode('[contact-form-new]'); ?>

    <?php endif; ?>

<?php endif; ?>


<?php
get_footer();
