<?php
get_header();
$front_page_id = get_option('page_on_front');
?>

<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>
<?php global $wp_query; ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2 mb-md-3">
                    <?php the_breadcrumbs(); ?>
                </div>
            </div>
        </div>

        <div class="page-blog">
            <?php

                $module_ids = get_field('choose_the_id_module_for_category',get_queried_object());
                if ($module_ids) 
                {
                    foreach ($module_ids as $module_id) 
                    {
                        $post = get_post($module_id);
                        if ($post) 
                        {
                            setup_postdata($post);
                            echo apply_filters('the_content', $post->post_content);
                            wp_reset_postdata();
                        }
                    }
                }
                ?>
        </div>

        
        <?php/* get_template_part('template-parts/front-page/leadership', '', ['post_id'=> 13552 ]); */?>
    

        <?php echo do_shortcode('[contact-form-new]'); ?>

    </main>
<?php
get_footer();
