    <?php
    $items = get_field('items');
    ?>

    <section class="section section-businesses mt-5 my-lg-5 pb-2 py-lg-5">
        <div class="section-businesses-inner mx-lg-5 mx-sm-4 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title mb-3 mb-lg-4">
                            <?php the_field('title'); ?>

                        </h3>
                        <p class="subtitle mb-3 mb-lg-4">
                            <?php the_field('subtitle'); ?>

                        </p>
                    </div>
                </div>
                <div class="row position-relative z-1">
                    <?php foreach ($items as $item_info): ?>
                        <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                            <div class="services-card">
                                <div class="services-card-header">
                                    <span class="h4 title">
                                        <?php echo $item_info['title']; ?>
                                    </span>
                                </div>
                                <div class="services-card-body d-none d-lg-block">
                                    <?php echo $item_info['description']; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>