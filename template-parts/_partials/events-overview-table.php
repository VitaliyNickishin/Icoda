<?php
$q_args = [
    'post_type' => 'event',
    'posts_per_page' => -1,
    'orderby' => array('meta_value_num' => 'DESC'),
    'meta_key' => 'date_start',
    'fields' => 'ids',
];


$meta_query = [];
$tax_query = [];
if (isset($args['country']) && $args['country'] != 'any-country') {
    $meta_query[] = [
        'key' => 'country',
        'value' => $args['country']
    ];
}
if (isset($args['date']) && $args['date'] != 'any-date') {
    $dateObj = new DateTime('now', new DateTimeZone('Europe/Kiev'));
    $start = $dateObj->format('Y-m-d 00:00:00');
    if ($args['date'] == 'week') {
        $dateObj->modify('+7 day');
    }
    if ($args['date'] == 'month') {
        $dateObj->modify('+32 day');
    }
    $meta_query[] = [
        'key' => 'date_start',
        'value' => $dateObj->format('Y-m-d 23:59:59'),
        'compare' => '<=',
        'type' => 'DATETIME',
    ];

    $meta_query[] = [
        'key' => 'date_end',
        'value' => $start,
        'compare' => '>=',
        'type' => 'DATETIME',
    ];
}

if (isset($args['online']) && $args['online']) {
    $meta_query[] = [
        'key' => 'online',
        'value' => $args['online']
    ];
}

if (isset($args['with_promocode']) && $args['with_promocode']) {
    $meta_query[] = [
        'key' => 'with_promo_code',
        'value' => $args['with_promocode']
    ];
}

if (isset($args['topic']) && $args['topic'] != 'any-topic') {
    $tax_query[] = [
        'taxonomy' => 'events_cat',
        'terms' => [$args['topic']],
        'field' => 'term_id',
    ];
}

if (!empty($meta_query)) {
    $q_args['meta_query'] = [
        'relation' => 'AND',
        ...$meta_query
    ];
}

if (!empty($tax_query)) {
    $q_args['tax_query'] =     $tax_query;
}

$_events = new WP_Query($q_args);
?>

<?php if (count($_events->posts) == 0) : ?>
    <p><?php _e('Nothig found', 'icoda'); ?></p>
<?php else: ?>
    <?php foreach ($_events->posts as $key => $post_event_id): ?>
        <?php
        $date_start = get_field('date_start', $post_event_id);
        $date_start_strtotime = strtotime($date_start);
        $date_start_year = date('Y', $date_start_strtotime);
        $date_start_month = date('m', $date_start_strtotime);
        $date_start_day = date('d', $date_start_strtotime);
        $date_end = get_field('date_end', $post_event_id);
        $date_end_strtotime = strtotime($date_end);
        $date_end_year = date('Y', $date_end_strtotime);
        $date_end_month = date('m', $date_end_strtotime);
        $date_end_day = date('d', $date_end_strtotime);
        $with_promo_code = get_field('with_promo_code', $post_event_id);
        $discount_value = get_field('discount_value', $post_event_id);
        $discount_code = get_field('discount_code', $post_event_id);
        $icoda_role = get_field('icoda_role', $post_event_id);
        $website = get_field('website', $post_event_id);
        $city = get_field('city', $post_event_id);
        $country = get_field('country', $post_event_id);
        $address = array_filter([$city, $country]);
        if ($date_start_day == $date_end_day && $date_start_month == $date_end_month) {
            $date_label = date('d F, Y');
        } else {
            $date_parts = [
                'start' => date('d', $date_start_strtotime),
                'end' => date('d', $date_end_strtotime),
            ];
            if ($date_start_month == $date_end_month) {
                $date_parts['end'] .= ' ' . date('F', $date_start_strtotime);
            } else {
                $date_parts['start'] .= ' ' . date('F', $date_start_strtotime);
                $date_parts['end'] .= ' ' . date('F', $date_end_strtotime);
            }
            if ($date_start_year == $date_end_year) {
                $date_parts['end'] .= ', ' . date('Y', $date_end_strtotime);
            } else {
                $date_parts['start'] .= ', ' . date('Y', $date_start_strtotime);
                $date_parts['end'] .= ', ' . date('Y', $date_end_strtotime);
            }
            $date_label = implode(' - ', $date_parts);
        }
        $categories = get_the_terms($post_event_id, 'events_cat');

        $excerpt = get_the_excerpt($post_event_id);

        $str_word_count = str_word_count($excerpt);
        ?>


        <div class="overview-table d-flex position-realative mt-2 overview-table--item icoda-hidden">

            <div class="overview-table__content pl-0 w-100">

                <div class="row">
                    <div class="col col-12 col-lg-8 pr-lg-0">
                        <div class="overview-table__header d-flex justify-content-between">
                            <div class="d-flex justify-content-between w-100">

                                <div class="pr-lg-5">
                                    <p class="title fw-semibold mb-2">
                                        <?php echo get_the_title($post_event_id); ?>
                                    </p>
                                    <div class="undertitle-wrap d-none d-lg-block">
                                        <!-- @todo short text (use 20 worlds and trucated)  -->
                                        <span class="undertitle undertitle-short">
                                            <?php echo wp_trim_words($excerpt, 15); ?>
                                        </span>
                                        <?php if ($str_word_count > 15) : ?>
                                            <!-- @todo add read-more-index  -->
                                            <input type="checkbox" id="read-more-<?php echo $key+1; ?>" class="read-more" style="display: none" name='read-more-<?php echo $key+1; ?>'>
                                            <!-- @todo full text -->
                                            <span class="undertitle undertitle-full">
                                                <?php echo get_the_excerpt($post_event_id); ?>
                                            </span>
                                            <!-- @todo add read-more-index  -->
                                            <label for="read-more-<?php echo $key+1; ?>">
                                                <span><?php _e('Read more', 'icoda'); ?></span>
                                                <span><?php _e('Read less', 'icoda'); ?></span>
                                            </label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="overview-table__body mt-3 mt-lg-4">
                            <div class="column">
                                <p class="mb-2 title-second"><?php _e('Date', 'icoda'); ?></p>
                                <div class="description"><?php echo $date_label; ?></div>
                            </div>
                            <div class="column">
                                <p class="mb-2 title-second"><?php _e('Location', 'icoda'); ?></p>
                                <div class="description"><?php echo implode(', ', $address); ?></div>
                            </div>
                            <?php if (!empty($categories)): ?>
                                <div class="column">
                                    <p class="mb-2 title-second"><?php _e('Topics', 'icoda'); ?></p>
                                    <ul class="badge-list">
                                        <?php foreach ($categories as $cat_event): ?>
                                            <li class="badge badge-body">
                                                <?php echo $cat_event->name; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($icoda_role)): ?>
                                <?php
                                $icoda_role = array_map('trim', array_filter(explode(',', $icoda_role)));
                                ?>
                                <div class="column">
                                    <p class="mb-2 title-second"><?php _e('iCODA Role', 'icoda'); ?></p>
                                    <ul class="badge-list">
                                        <?php foreach ($icoda_role as $ir): ?>
                                            <li class="badge badge-body badge-role">
                                                <?php echo $ir; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="col col-12 col-lg-4 pl-lg-0">
                        <div class="d-flex mt-3 mt-lg-0 section-all-events__btn overview-table__btn justify-content-end">

                            <?php if ($with_promo_code): ?>
                                <div class="btn-copy-code">
                                    <div class="referral-field">
                                        <span class="referral-label">
                                            <?php echo $discount_value; ?>
                                        </span>
                                        <span class="referral-code"><?php echo $discount_code; ?></span>
                                    </div>
                                    <button type="button" class="btn-copy referral-copy"><?php _e('Copy', 'icoda'); ?></button>
                                </div>
                            <?php endif; ?>


                            <div class="d-flex card-event__btn">

                                <?php if (!empty($website)): ?>
                                    <a href="<?php echo $website; ?>" class="btn btn-blue btn-visit-website" target="_blank">
                                        <?php echo _e('Visit website', 'icoda') ?>
                                    </a>
                                <?php endif; ?>
                                <a
                                    class="btn btn-book-meeting d-flex align-items-center justify-content-center btn-outline-blue"
                                    href="#"
                                    onclick="Calendly.initPopupWidget({url: 'https://calendly.com/d/cqrf-wpr-bt6/talk-to-our-expert'});return false;">
                                    <?php echo __('Book A Meeting', 'icoda'); ?>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php endforeach; ?>
<?php endif; ?>