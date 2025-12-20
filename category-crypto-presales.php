<?php
get_header();
?>

<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>
<?php 
global $wp_query; 
global $post;
?>


<section class="section-presales pb-5">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="d-none d-lg-block">
                    <?php the_breadcrumbs(); ?>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                <h1 class="h2 mb-2 pb-1 mt-5 pt-lg-4 section-title">
                    <?php single_cat_title(); ?>
                </h1>
                <div class="undertitle">
                    <?php echo category_description(); ?>
                </div>
            </div>
        </div>

        <div class="row mt-3 pt-3 mt-lg-4 pt-lg-0">
            <div class="col-12 pr-0">
                <?php get_template_part('template-parts/tags', '', ['crypto-presale' => 1]); ?>
            </div>
        </div>

        <div class="row mt-4 mt-lg-5 mx-lg-n2">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $title = get_the_title(get_the_ID());
                    $excerpt = get_the_excerpt(get_the_ID());
                    $tag = get_the_terms(get_the_ID(), 'post_tag');
                    ?>

                    <div class="col-12 col-lg-6 mb-3 px-lg-2">
                        <div class="card-presale">

                            <div class="card-presale-body">
                                <span class="h6 mb-2 text-uppercase d-block title"><?php echo $title; ?></span>
                                <div class="sub-text">
                                    <p><?php echo $excerpt; ?></p>
                                </div>
                            </div>

                            <div class="card-presale-footer mt-4 d-flex justify-content-between align-items-center">
                                <div class="tag">
                                    <?php if (!empty($tag)) : ?>
                                        <?php echo $tag[0]->name; ?>
                                    <?php endif; ?>
                                </div>

                                <a class="link-arrow d-flex" href="<?php the_permalink(); ?>">
                                    <span class="d-none d-lg-block">
                                        <?php _e('Learn more', 'icoda'); ?>
                                    </span>
                                    <span class="d-lg-none">
                                        <?php _e('More', 'icoda'); ?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else : ?>
                <p><?php _e('Nothing was found for these criteria.', 'icoda'); ?></p>
            <?php endif; ?>
        </div>
        <div class="has-content-guttenberg">
            <?php
                $module_ids = get_field('choose_the_id_module_for_category',get_queried_object());
                if ($module_ids) 
                {
                    foreach ($module_ids as $module_id) 
                    {
                        $post_id = get_post($module_id);
                        if ($post_id) 
                        {
                            echo apply_filters('the_content', $post_id->post_content);
                        }
                    }
                }
			?>
        </div>
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/category-parts/crypto-presales'); ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
