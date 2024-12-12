<?php
$categories = [
    [
        'id' => -1,
        'name' => 'Article',
        'svg' => '<svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.0016 1.61599C3.0016 2.50676 2.32807 3.23198 1.5008 3.23198C0.67353 3.23198 0 2.50676 0 1.61599C0 0.725225 0.67353 0 1.5008 0C2.32807 0 3.0016 0.725225 3.0016 1.61599ZM3.0016 7C3.0016 7.89077 2.32807 8.61599 1.5008 8.61599C0.67353 8.61599 0 7.89077 0 7C0 6.10923 0.67353 5.38401 1.5008 5.38401C2.32807 5.38401 3.0016 6.10923 3.0016 7ZM3.0016 12.384C3.0016 13.2748 2.32807 14 1.5008 14C0.67353 14 0 13.2748 0 12.384C0 11.4932 0.67353 10.768 1.5008 10.768C2.32807 10.768 3.0016 11.4932 3.0016 12.384ZM16 1.07601V2.15203C16 2.44764 15.7767 2.692 15.4985 2.692H5.50172C5.22718 2.692 5.00023 2.45158 5.00023 2.15203V1.07601C5.00023 0.780405 5.22352 0.536036 5.50172 0.536036H15.5022C15.7767 0.536036 16.0037 0.776464 16.0037 1.07601H16ZM16 6.46002V7.53604C16 7.83164 15.7767 8.07601 15.4985 8.07601H5.50172C5.22718 8.07601 5.00023 7.83559 5.00023 7.53604V6.46002C5.00023 6.16441 5.22352 5.92005 5.50172 5.92005H15.5022C15.7767 5.92005 16.0037 6.16047 16.0037 6.46002H16ZM16 11.844V12.92C16 13.2157 15.7767 13.46 15.4985 13.46H5.50172C5.22718 13.46 5.00023 13.2196 5.00023 12.92V11.844C5.00023 11.5484 5.22352 11.3041 5.50172 11.3041H15.5022C15.7767 11.3041 16.0037 11.5445 16.0037 11.844H16Z" fill="currentColor" />
    </svg>'
    ],
    [
        'id' => 38,
        'name' => 'Blog',
        'svg' => '<svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 1.6884C0 0.753603 0.781574 0 1.75107 0H12.2532C13.2184 0 14.0043 0.753603 14.0043 1.6884V18L7.00427 14.0631L0 18V1.6884Z" fill="currentColor" />
    </svg>',
    ],
    [
        'id' => 113,
        'name' => 'Top',
        'svg' => '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.9994 0.449951L11.1251 6.98198H18L12.4375 11.0191L14.5619 17.5499L8.9994 13.514L3.43805 17.5499L5.56255 11.0191L0 6.98198H6.87491L8.9994 0.449951Z" fill="currentColor" />
    </svg>',

    ],
    [
        'id' => 36,
        'name' => 'Education',
        'svg' => '<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.6821 13.3095C15.5315 13.849 15.5315 15.3933 15.6821 15.9369C15.8745 16.0933 16 16.3322 16 16.5957V17.1599C16 17.6294 15.6193 18.0041 15.1425 18.0041H3.43007C1.53935 18.0041 0 16.4928 0 14.6273V3.3768C0 1.51132 1.53516 0 3.43007 0H15.1425C15.6193 0 16 0.374743 16 0.8442V12.6548C16 12.9183 15.8745 13.1572 15.6821 13.3095ZM13.6199 13.499H3.43007C2.80261 13.499 2.2881 14.0055 2.2881 14.6232C2.2881 15.2409 2.79843 15.7474 3.43007 15.7474H13.6241C13.5571 15.1462 13.5571 14.1002 13.6241 13.499H13.6199ZM4.57203 5.41524C4.57203 5.53054 4.66824 5.62526 4.78536 5.62526H12.3566C12.4737 5.62526 12.5699 5.53054 12.5699 5.41524V4.71105C12.5699 4.59574 12.4737 4.50103 12.3566 4.50103H4.78536C4.66824 4.50103 4.57203 4.59574 4.57203 4.71105V5.41524ZM4.57203 7.66369C4.57203 7.779 4.66824 7.87371 4.78536 7.87371H12.3566C12.4737 7.87371 12.5699 7.779 12.5699 7.66369V6.95951C12.5699 6.8442 12.4737 6.74948 12.3566 6.74948H4.78536C4.66824 6.74948 4.57203 6.8442 4.57203 6.95951V7.66369Z" fill="currentColor" />
    </svg>',

    ],
];
$queried_object = get_queried_object();
$queried_object_id = get_queried_object_id();
$blog_page_id = get_option('page_for_posts');
$slected_svg = '';
?>

<?php foreach ($categories as $cat_data) {
    if ($cat_data['id'] != -1) {
        $cat_real_obj_id = apply_filters('wpml_object_id', $cat_data['id'], 'category', true, ICL_LANGUAGE_CODE);
        if ($queried_object_id === $cat_real_obj_id) {
            $slected_svg = $cat_data['svg'];
        }
    } else {
        if (is_home()) {
            $slected_svg = $cat_data['svg'];
        }
    }
}
?>

<div class="sidebar-blog col-12 col-md-3">
    <div class="dropdown mb-3 mb-md-0 position-relative">
        <button class="dropdown__button d-md-none" type="button">
            <?php echo $slected_svg; ?>
            <span class="ml-3"><?php echo is_home() ? __('All', 'icoda') : $queried_object->name; ?></span>
        </button>
        <ul class="dropdown__list list-blog-filters">

            <?php foreach ($categories as $cat_data) : ?>
                <?php
                if ($cat_data['id'] != -1) :
                    $cat_real_obj_id = apply_filters('wpml_object_id', $cat_data['id'], 'category', true, ICL_LANGUAGE_CODE);
                    $cat_real_obj = get_term($cat_real_obj_id, 'category');
                ?>
                    <li class="dropdown__list-item <?php echo $queried_object_id === $cat_real_obj_id ? 'dropdown__list-item_active' : ''; ?>" data-value="<?php echo $cat_real_obj->name; ?>">
                        <a href="<?php echo get_term_link($cat_real_obj, 'category'); ?>" class="d-flex align-items-center">
                            <?php echo $cat_data['svg']; ?>
                            <p class="ml-3 text-uppercase"><?php echo $cat_real_obj->name; ?></p>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="dropdown__list-item <?php echo is_home() ? 'dropdown__list-item_active' : ''; ?>" data-value="<?php echo __('All', 'icoda'); ?>">
                        <a href="<?php echo get_post_type_archive_link('post'); ?>" class="d-flex align-items-center">
                            <?php echo $cat_data['svg']; ?>
                            <p class="ml-3 text-uppercase"><?php echo __('All', 'icoda'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>

        </ul>
        <input type="text" name="select-category" value="" class="dropdown__input_hidden d-none">
    </div>

    <div class="sidebar-blog__tags d-none d-md-block">
        <?php get_template_part('template-parts/tags'); ?>
    </div>

</div>