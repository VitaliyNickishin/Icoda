<section class="section-goals">
    <h2 class="mb-4 section-title"><?php the_field('post_case_project_goals_title'); ?></h2>
    <div class="goals-boxes">
        <?php if (have_rows('post_case_project_goals_items')): ?>
            <?php $counter = 1; ?>
            <?php while (have_rows('post_case_project_goals_items')): the_row(); ?>
                <div class="serv-box">
                    <span class="number mb-2"><?php echo $counter . '. ' . get_sub_field('title'); ?></span>
                    <p><?php echo get_sub_field('text'); ?></p>
                </div>
                <?php $counter++; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>