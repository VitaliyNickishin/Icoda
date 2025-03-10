<section class="section-result my-lg-3 py-5 py-lg-4">
    <h2 class="mb-4 section-title"><?php the_field('post_case_results_title'); ?></h2>
    <div class="resault-boxes">
        <?php if (have_rows('post_case_results_items')): ?>
            <?php while (have_rows('post_case_results_items')): the_row(); ?>
                <div class="serv-box">
                    <span class="number mb-2"><?php echo get_sub_field('title'); ?></span>
                    <p><?php echo get_sub_field('text'); ?></p>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>