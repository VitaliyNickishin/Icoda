    <?php
    $cases = get_field('cases');
    $template_directory_uri = get_template_directory_uri();
    ?>

    <section class="section section-services-cases my-3 py-4 my-lg-5 py-lg-2">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <h3 class="section-title mb-3 mb-lg-4">
                        <?php the_field('title'); ?>
                    </h3>
                    <p class="subtitle mb-3 pb-3 mb-lg-4 pr-lg-5 mr-lg-4">
                        <?php the_field('subtitle'); ?>
                    </p>

                </div>

                <div class="col-12 pr-0">
                    <div class="row slider-services-list custom-slider pl-2 pl-lg-0">
                        <?php foreach ($cases as $case_info): ?>
                            <div class="col col-lg-3 px-2 px-lg-3">
                                <a href="<?php echo get_the_permalink($case_info['case']); ?>" class="services-card card-cases card-has-rotate-arrow">
                                    <div class="services-card-img">
                                        <img src="<?php echo $case_info['image']['url']; ?>" alt="<?php echo get_the_title($case_info['case']); ?>">
                                    </div>
                                    <div class="services-card-body">
                                        <span class="h6 title pr-3"><?php echo $case_info['title']; ?></span>
                                        <img class="btn-arrow" src="<?php echo $template_directory_uri; ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="mt-3 pt-3 pt-lg-4 text-center text-lg-left">
                        <a href="<?php echo get_term_link(37, 'category'); ?>" class="btn btn-blue"><?php echo _e('See All Cases', 'icoda') ?></a>
                    </div>
                </div>
            </div>
        </div>


    </section>