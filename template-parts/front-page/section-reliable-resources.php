<section class="section section-reliable-resources">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title text-lg-center"><?php the_field('section_3_title_block-en'); ?></h3>
            </div>
        </div>
        <?php $partners_list = get_field('section_3-en'); ?>
        <?php get_template_part('template-parts/sections/reliable-resources-new', '', ['partners_list' => $partners_list]); ?>
    </div>
</section>