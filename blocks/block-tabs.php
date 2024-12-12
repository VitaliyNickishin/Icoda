<section class="section section-tech">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="h3"><?php block_value('title'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="wr-tabs">
                    <ul class="nav" id="pills-tab" role="tablist">
                        <?php $i = 0; ?>
                        <?php $labels = array(); ?>
                        <?php while (block_rows('tabs_labels')) :
                            block_row('tabs_labels');
                            $id = block_sub_value('id');
                            $labels[$id] =  block_sub_value('label');
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $i == 0 ? 'active' : '' ?>" id="<?php echo $id; ?>-tab" data-toggle="pill" href="#<?php echo $id; ?>" role="tab" aria-controls="<?php echo $id; ?>" aria-selected="<?php echo $i == 0 ? 'true' : 'false' ?>">
                                    <?php block_sub_field('label'); ?>
                                </a>
                            </li>
                            <?php $i++; ?>
                        <?php endwhile;
                        reset_block_rows('tabs_labels'); ?>
                    </ul>

                    <?php
                    $tabs_groups = array();
                    $tabs_items = block_value('tabs_items');
                    foreach ($tabs_items['rows']  as $key => $tabs_item) :
                        $tabs_groups[$tabs_item['id']][] = array(
                            'image' => $tabs_item['image'],
                            'name' => $tabs_item['name'],
                            'is_link' => $tabs_item['is_link'],
                            'link' => $tabs_item['link']
                        );
                    endforeach;
                    ?>

                    <div class="tab-content" id="pills-tabContent">
                        <!--filter-->
                        <div class="filter-color">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <filter id="sepia" x="-10%" y="-10%" width="120%" height="120%" filterUnits="objectBoundingBox" primitiveUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feColorMatrix type="matrix" values="1 0 0 0 0
                                                1 0 0 0 0
                                                1 0 0 0 0
                                                0 0 0 1 0" in="SourceGraphic" result="colormatrix" />
                                        <feComponentTransfer in="colormatrix" result="componentTransfer">
                                            <feFuncR type="table" tableValues="0.78" />
                                            <feFuncG type="table" tableValues="0.77" />
                                            <feFuncB type="table" tableValues="0.81" />
                                            <feFuncA type="table" tableValues="0 1" />
                                        </feComponentTransfer>
                                        <feBlend mode="color" in="componentTransfer" in2="SourceGraphic" result="blend" />
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <!--filter-->

                        <?php $i = 1; ?>
                        <?php foreach ($tabs_groups as $tab_group_id => $tab_items) : ?>
                            <div class="tab-pane fade <?php echo $i == 1 ? 'show active' : '' ?>" id="<?php echo $tab_group_id; ?>" role="tabpanel" aria-labelledby="<?php echo $tab_group_id; ?>-tab">
                                <div class="list-logo list-<?php echo sanitize_title($labels[$tab_group_id]); ?>">
                                    <?php foreach ($tab_items as $key => $tab_item_data) : ?>
                                        <?php
                                        $image_url = wp_get_attachment_image_url($tab_item_data['image']);
                                        if ($tab_item_data['is_link']) :
                                        ?>
                                            <a href="<?php echo $tab_item_data['link']; ?>" class="logo-item logo-item-<?php echo ( $key + 1 ); ?>" target="_blank">
                                                <img class="skip-lazy" src="<?php echo $image_url; ?>" alt="ico">
                                                <span><?php echo $tab_item_data['name']; ?></span>
                                            </a>
                                        <?php else : ?>
                                            <div class="logo-item logo-item-<?php echo $key; ?>">
                                                <img class="skip-lazy" src="<?php echo $image_url; ?>" alt="ico">
                                                <span><?php echo $tab_item_data['name']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>