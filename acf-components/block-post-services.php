    <?php
    $services = get_field('services');
    $help_title = get_field('help_title');
    $help_subtitle = get_field('help_subtitle');
    $help_link = get_field('help_link');
    $template_directory_uri = get_template_directory_uri();
    ?>

    <section class="section section-services-list py-3 my-4 py-lg-5 my-lg-2">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h3 class="section-title mb-4">
                        <?php the_field('title'); ?>
                    </h3>
                </div>
            </div>
            <div class="row slider-services-grid custom-slider pl-2 pl-lg-0">
                <?php foreach ($services as $service_info): ?>
                    <div class="col col-lg-4 px-2 p-lg-3">
                        <a href="<?php echo $service_info['link']; ?>" class="services-card card-has-rotate-arrow">
                            <div class="services-card-header">
                                <span class="h4 title pr-3">
                                    <?php echo $service_info['title']; ?>
                                </span>
                                <img class="btn-arrow" src="<?php echo $template_directory_uri; ?>/assets/images/btn-circle.svg" alt="Read more" />
                            </div>
                            <div class="services-card-body">
                                <?php echo $service_info['description']; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>


            </div>
            <div class="row mb-5 pb-2 mb-md-0 pb-md-0">
                <div class="col-12">
                    <div class="arrow-control arrow-control-service-grid"></div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-12 text-center mt-5">
                    <h4 class="h4 mb-0 title">
                        <?php echo $help_title; ?>
                    </h4>
                    <span class="d-md-block undertitle">
                        <?php echo $help_subtitle; ?>
                    </span>
                    <div class="pt-lg-2 m-auto">
                        <a href="<?php echo $help_link['url']; ?>" class="btn btn-blue mt-4"><?php echo $help_link['title']; ?></a>
                    </div>
                </div>
            </div>
        </div>

    </section>