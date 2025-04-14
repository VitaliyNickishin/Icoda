<section class="section-overview-table my-4 py-3">
    <h2 class="mb-4 section-title"><?php the_field('post_overview_title'); ?></h2>
    <!-- @todo 
    .overview-table - has default border gray,
    .top - add border green and green bg for badge, 
    .low - add border red and red bg for badge, 
    .has-rank - show text Rank,
    .has-cup - show icon cup,
    .hot - show icon fire
    -->
    <?php
    $link_svg = get_template_directory_uri() . '/assets/images/link-white.svg';
    $items = get_field('post_overview_items');
    foreach ($items as $key => $item):
        $add_class = '';
        $add_class_rank = '';
        if ($key < 3) {
            $add_class = 'top';
            $add_class_rank .= ' has-rank ';
        }

        if (!empty($item['mark_as_red'])) {
            $add_class = 'low';
        }

        if ($key === 0) {
            $add_class_rank .= ' has-cup ';
        }
    ?>
        <div class="overview-table d-flex position-realative mt-4 <?php echo $add_class; ?>">
            <div class="position badge d-flex <?php echo $add_class_rank; ?>"><span class="rank"><?php _e('Rank', 'icoda'); ?>&nbsp;</span>#<?php echo $key + 1; ?></div>
            <?php if (!empty($item['is_sponsored'])) : ?>
                <div class="sponsored badge"><?php _e('Sponsored', 'icoda'); ?></div>
            <?php endif; ?>
            <div class="overview-table__logo d-none d-lg-block">
                <img class="logo" src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>" />
            </div>
            <div class="overview-table__content w-100">
                <div class="overview-table__header d-flex justify-content-between">
                    <div class="overview-table__logo d-lg-none">
                        <img class="logo" src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>" />
                    </div>

                    <div class="d-flex justify-content-between w-100">

                        <div class="overview-table__title ml-3 ml-lg-0 pr-1">
                            <p class="title fw-semibold mb-2">
                                <?php echo $item['title']; ?>
                            </p>
                            <span>
                                <?php echo $item['subtitle']; ?>
                            </span>
                        </div>
                        <div class="d-lg-flex d-none overview-table__btn">
                            <?php if ( !empty($item['referral_code'])) : ?>
                                <div class="btn-copy-code">
                                    <div class="referral-field">
                                        <span class="referral-label">
                                            <?php _e('Use referral code:', 'icoda'); ?>
                                        </span>
                                        <span class="referral-code"><?php echo $item['referral_code']; ?></span>
                                    </div>
                                    
                                    <button type="button" class="btn-copy referral-copy"><?php _e('Copy', 'icoda'); ?></button>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($item['website'])): ?>
                                <a href="<?php echo $item['website']; ?>" class="btn btn-blue" target="_blank">
                                    <img class="d-lg-none" src="<?php echo $link_svg; ?>" alt="Link" />
                                    <span class="d-none d-lg-block"><?php echo empty($item['visit_website_button_name']) ? __('Visit website', 'icoda') : $item['visit_website_button_name']; ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- mobile -->
                <div class="d-lg-none d-flex mt-3 mt-lg-0 overview-table__btn">
                    <?php if ( !empty($item['referral_code'])) : ?>
                        <div class="btn-copy-code">
                            <div class="referral-field">
                                <span class=" -label">
                                    <?php _e('Use referral code:', 'icoda'); ?>
                                </span>
                                <span class="referral-code"><?php echo $item['referral_code']; ?></span>
                            </div>
                            <button type="button" class="btn-copy referral-copy"><?php _e('Copy', 'icoda'); ?></button>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($item['website'])): ?>
                        <a href="<?php echo $item['website']; ?>" class="btn btn-blue" target="_blank">
                            <img src="<?php echo $link_svg; ?>" alt="Link" />
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (!empty($item['meta_info'])) : ?>
                    <div class="overview-table__body d-lg-flex mt-3 mt-lg-4">
                        <?php foreach ($item['meta_info'] as $meta_info): ?>
                            <div class="column">
                                <p class="mb-2 title-second <?php echo $meta_info['is_hot'] ? 'hot' : ''; ?>"><?php echo $meta_info['title']; ?></p>
                                <?php if ($meta_info['type_contnet'] === 'text') : ?>
                                    <div class="description"><?php echo $meta_info['value']; ?></div>
                                <?php else : ?>
                                    <ul class="badge-list">
                                        <li class="badge badge-body"><?php echo implode('</li><li class="badge badge-body">', explode("\n", $meta_info['value'])); ?></li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

</section>