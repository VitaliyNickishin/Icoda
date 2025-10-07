    <?php
    $items = get_field('items');
    $bottom_title = get_field('bottom_title');
    $bottom_link = get_field('bottom_link');
    $disable_coins_background = get_field('disable_coins_background');
    ?>

    <section class="section section-path my-3 py-4 my-lg-5 py-lg-2">
        <div class="section-path-inner mx-lg-5 mx-sm-4 <?php echo empty($disable_coins_background) ? ' has-bg-coins ' : ''; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title mb-3 mb-lg-4">
                            <?php the_field('title'); ?>
                        </h2>
                    </div>

                    <div class="col-12 <?php echo is_rtl() ? 'pl-0' : 'pr-0'; ?>">
                        <div class="slider-path-list <?php echo is_rtl() ? 'slider-rtl' : ''; ?> custom-slider d-flex">
                            <?php foreach ($items as $key => $item_info): ?>
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo $item_info['title']; ?>
                                        </span>
                                        <div class="number-step"><?php echo ($key+1); ?></div>
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo $item_info['text']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="arrow-control arrow-control-path"></div>
                    </div>

                    <div class="col-12">
                        <div class="section-path-bottom text-center">
                            <h3 class="h4 mb-0 title fw-semibold">
                                <?php echo $bottom_title; ?>
                            </h3>
                            <div class="pt-1 m-auto">
                                <a href="<?php echo $bottom_link['url']; ?>" data-modal="#callback" class="btn btn-pink mt-3 open-modal"><?php echo $bottom_link['title']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>