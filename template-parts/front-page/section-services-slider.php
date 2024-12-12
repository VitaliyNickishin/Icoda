<?php if (get_field('section_2_show')) : ?>
    <?php $services = get_field('section_2-en'); ?>

    <?php
    $icoda_gb_services = get_field('icoda_gb_services', 'option');
    if (!empty($_GET['new_services']) && !empty($icoda_gb_services)) {
        $services = [];
        foreach ($icoda_gb_services as $item_row_data) {
            if (!empty($item_row_data['custom_url'])) {
                $link_val = $item_row_data['custom_url'];
            } elseif (!empty($item_row_data['post_obj'])) {
                $link_val = get_the_permalink($item_row_data['post_obj']);
            } else {
                $link_val = '#';
            }

            if (!empty($item_row_data['custom_title'])) {
                $title_val = $item_row_data['custom_title'];
            } elseif (!empty($item_row_data['post_obj'])) {
                $title_val = get_the_title($item_row_data['post_obj']);
            } else {
                $title_val = __('Service', 'icoda');
            }

            if (!empty($item_row_data['description'])) {
                $desc_val = $item_row_data['description'];
            } else {
                $desc_val = '';
            }

            if (!empty($item_row_data['custom_label'])) {
                $label_val = $item_row_data['custom_label'];
            } elseif (!empty($item_row_data['is_hot'])) {
                $label_val = __('hot', 'icoda');
            } else {
                $label_val = '';
            }
            $services[] = [
                'section_2_link-en' => $link_val,
                'section_2_title-en' => $title_val,
                'section_2_desc-en' => $desc_val,
                'section_2_label-en' => $label_val
            ];
        }
    }
    ?>
    <?php if (!empty($services)) : ?>
        <section class="section section-services-slider">
            <div class="container">
                <div class="">
                    <div class="service-slider custom-slider">
                        <?php foreach ($services as $service_item) : ?>
                            <div class="service-box hot">
                                <div class="d-flex justify-content-between">
                                    <a href="<?php echo $service_item['section_2_link-en']; ?>" class="service-box__title h6"><?php echo $service_item['section_2_title-en']; ?>
                                    </a>
                                    <?php if ($service_item['section_2_label-en']) : ?>
                                        <span class="ml-2 label-hot"><?php echo $service_item['section_2_label-en']; ?></span>
                                    <?php endif ?>
                                </div>
                                <p class="service-box__description ellipsis-content ellipsis"><?php echo $service_item['section_2_desc-en']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php endif; ?>