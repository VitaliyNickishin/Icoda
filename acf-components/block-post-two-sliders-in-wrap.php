    <?php
    $block_title = get_field('block_title');
    $first_slider = get_field('first_slider');
    $block_title_second = get_field('block_title_second');
    $second_slider = get_field('second_slider');
    ?>

    <section class="block-post-two-sliders-in-wrap section-path my-3 py-4 my-lg-5 py-lg-2">
        <div class="">
            <div class="container">
                <div class="row block-post-two-sliders-in-wrap-inner">
                    <div class="col-12 <?php echo is_rtl() ? 'pl-0' : 'pr-0'; ?>">
                        <?php if (!empty($block_title)): ?>
                            <h3 class="block-title">
                                <?php echo esc_html($block_title); ?>
                            </h3>
                        <?php endif; ?>
                        <div class="slider-path-list-four <?php echo is_rtl() ? 'slider-rtl' : ''; ?> custom-slider d-flex">
                            <?php foreach ($first_slider as $key => $slide): ?>
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="title h4 pr-3">
                                            <?php echo $slide['slide_title']; ?>
                                        </span>
                                        <div class="right-part">
                                            <?php if (!empty($slide['has_icon'])): ?>
                                                <div class="has-icon">
                                                    <?php echo file_get_contents($slide['has_icon']['url']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <span class="right-text"><?php echo $slide['duration_of_time']; ?></span>
                                        </div>
                                        
                                        
                                        <div class="number-step"><?php echo ($key+1); ?></div>
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo $slide['slide_description']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="arrow-control arrow-control-path"></div>
                    </div>

                    <div class="col-12 mt-5 pt-4 mt-lg-5">
                        <?php if (!empty($block_title_second)): ?>
                            <h3 class="block-title block-title-second">
                                <?php echo esc_html($block_title_second); ?>
                            </h3>
                        <?php endif; ?>
                        <div class="slider-path-list-second <?php echo is_rtl() ? 'slider-rtl' : ''; ?> custom-slider d-flex">
                            <?php foreach ($second_slider as $key => $slide): ?>
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="title h4 pr-3">
                                            <?php echo $slide['slide_title']; ?>
                                        </span>
                                        <div class="has-image d-none d-lg-block">
                                            <picture>
                                                <img src="<?php echo $slide['has_image']['url']; ?>" alt="<?php echo $media['slide_title']; ?>" />
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo $slide['slide_description']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>