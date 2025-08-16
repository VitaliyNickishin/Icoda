<?php

/*
Template Name: New Blog Post
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

        <?php get_template_part('template-parts/related-articles'); ?>

        <button type="button" class="btn-mobile-table-of-content d-lg-none" data-toggle="modal" data-target="#tableOfContentModal" class="icon-mobile-table-of-content d-lg-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M3.6875 8.5C3.6875 7.9132 4.1632 7.4375 4.75 7.4375H28.8333C29.4201 7.4375 29.8958 7.9132 29.8958 8.5C29.8958 9.0868 29.4201 9.5625 28.8333 9.5625H4.75C4.1632 9.5625 3.6875 9.0868 3.6875 8.5ZM3.6875 15.5833C3.6875 14.9966 4.1632 14.5208 4.75 14.5208H17.5C18.0868 14.5208 18.5625 14.9966 18.5625 15.5833C18.5625 16.1701 18.0868 16.6458 17.5 16.6458H4.75C4.1632 16.6458 3.6875 16.1701 3.6875 15.5833ZM3.6875 22.6667C3.6875 22.0799 4.1632 21.6042 4.75 21.6042H16.0833C16.6701 21.6042 17.1458 22.0799 17.1458 22.6667C17.1458 23.2535 16.6701 23.7292 16.0833 23.7292H4.75C4.1632 23.7292 3.6875 23.2535 3.6875 22.6667Z" fill="#1C274C"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.5404 24.8346C24.9553 25.2495 25.6279 25.2495 26.0429 24.8346L29.5846 21.2929C29.9995 20.878 29.9995 20.2053 29.5846 19.7904C29.1696 19.3755 28.497 19.3755 28.082 19.7904L26.3541 21.5182V12.75C26.3541 12.1632 25.8784 11.6875 25.2916 11.6875C24.7048 11.6875 24.2291 12.1632 24.2291 12.75V21.5182L22.5012 19.7904C22.0863 19.3755 21.4136 19.3755 20.9987 19.7904C20.5838 20.2053 20.5838 20.878 20.9987 21.2929L24.5404 24.8346Z" fill="#1C274C"/>
            </svg>
        </button>

        <!-- Modal table of content mobile -->
        <div class="modal fade modal-table-of-content" id="tableOfContentModal" tabindex="-1" role="dialog" aria-labelledby="tableOfContentModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title"><?php _e('Table of Content', 'icoda'); ?></p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                <path d="M21.2452 20.6715C20.8547 21.062 20.2215 21.062 19.831 20.6715L12.5366 13.3771L5.24226 20.6715C4.85174 21.062 4.21857 21.062 3.82805 20.6715C3.43752 20.2809 3.43752 19.6478 3.82805 19.2572L11.1224 11.9629L3.82807 4.66857C3.43754 4.27797 3.43754 3.64487 3.82807 3.25427C4.21859 2.86377 4.85176 2.86377 5.24228 3.25427L12.5366 10.5487L19.831 3.25427C20.2215 2.86377 20.8547 2.86377 21.2452 3.25427C21.6357 3.64487 21.6357 4.27797 21.2452 4.66847L13.9508 11.9629L21.2452 19.2572C21.6357 19.6478 21.6357 20.2809 21.2452 20.6715Z" fill="#0F0F0F"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (is_page_template('template-posts/new-blog-post.php')): ?>
                            <?php get_template_part('template-parts/article-table-of-content'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


    <?php endwhile; ?>

<?php endif; ?>


<?php
get_footer();
