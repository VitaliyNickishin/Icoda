<section class="section section-with-gutenberg">
    <h1><?php the_title(); ?></h1>

    <?php get_template_part('template-parts/article-date'); ?>

    <?php
    $disable_post_thumbnail = get_field('icoda_disable_post_thumbnail');
    ?>
    <?php
    if (empty($disable_post_thumbnail)) {
        the_post_thumbnail('full');
    }
    ?>
    <div class="article-main-content">
        <?php the_content(); ?>
    </div>
</section>