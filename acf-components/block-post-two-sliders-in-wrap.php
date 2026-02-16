    <?php
    $block_title = get_field('block_title');
    $first_slider = get_field('first_slider');
    $block_title_second = get_field('block_title_second');
    $second_slider = get_field('second_slider');
    $resources = get_field('resources');
    ?>

    <section class="block-post-two-sliders-in-wrap section-path mt-3 py-4 my-lg-5 py-lg-2">
        <div class="">
            <div class="container">
                <div class="row block-post-two-sliders-in-wrap-inner">
                    <div class="col-12 px-0">
                        <?php if (!empty($block_title)): ?>
                            <h3 class="block-title block-title-first <?php echo is_rtl() ? 'pr-3' : 'pl-3'; ?>">
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
                    <!-- second slider -->
                    <div class="col-12 mt-5 pt-4 mt-lg-5 pr-0">
                        <?php if (!empty($block_title_second)): ?>
                            <h3 class="block-title block-title-second">
                                <?php echo esc_html($block_title_second); ?>
                            </h3>
                        <?php endif; ?>
                        <div class="slider-path-list-second <?php echo is_rtl() ? 'slider-rtl' : ''; ?> custom-slider d-flex">
                            <?php foreach ($second_slider as $key => $slide): ?>
                                <div class="services-card services-card-second">
                                    <div class="services-card-header">
                                        <span class="title h4">
                                            <?php echo $slide['slide_title']; ?>
                                        </span>
                                        <div class="has-image d-none d-lg-block">
                                            <picture>
                                                <img src="<?php echo $slide['has_image']['url']; ?>" alt="<?php echo $media['slide_title']; ?>" />
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="services-card-body mb-2">
                                        <?php echo $slide['slide_description']; ?>
                                    </div>
                                    <div class="services-card-footer mt-auto">
                                        <?php if ($key == 0 && !empty($resources['button_text_for_price'])) : ?>
                                            <div class="book-action">
                                                <span class="book-price fw-semibold">
                                                    $<?php echo $resources['price']; ?>
                                                </span>
                                                <button data-get-book type="button" class="btn btn-blue btn-get-book">
                                                    <?php echo $resources['button_text_for_price']; ?>
                                                </button>
                                            </div>
                                        
                                        <?php elseif ($key == 1 && !empty($resources['button_text_second_resource'])) : ?>
                                            <a download href="<?php echo $resources['file_second_resource']['url']; ?>" class="btn btn-blue">
                                                <?php echo $resources['button_text_second_resource']; ?>
                                            </a>
                                        <?php elseif ($key == 2 && !empty($resources['button_text_for_select_desktop'])) : ?>
                                            <div class="dropdown-select-block d-flex">
                                                <div class="dropdown-custom mr-2">
                                                    <button type="button" class="dropdown-custom-toggle">
                                                        <span class="dropdown-custom-label">
                                                            <?php echo $resources['placeholder_third_resource_select']; ?>
                                                        </span>
                                                    </button>

                                                    <ul class="dropdown-custom-menu">
                                                        <?php foreach ($resources['dropdown_list'] as $list): ?>
                                                            <li data-value="<?php echo $list['file_item']['url']; ?>">
                                                                <?php echo $list['text_item']; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>                                     
                                                </div>

                                                <button type="button" class="btn btn-blue btn-get-report" disabled>
                                                    <span class="d-none d-lg-block"><?php echo $resources['button_text_for_select_desktop']; ?></span>
                                                    <span class="d-lg-none"><?php echo $resources['button_text_for_select_mobile']; ?></span>
                                                </button>

                                                <input type="hidden" class="dropdown-custom-selected-value" value="">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>