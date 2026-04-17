<?php
/* Template Name: Events page */

get_header();
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<?php if ( true || !empty($_GET['show_new_events'])) : ?>
    <?php
    // $top_events = new WP_Query([
    //     'post_type' => 'event',
    //     'posts_per_page' => 3,
    //     'orderby' => array('meta_value_num' => 'ASC'),
    //     'meta_key' => 'date_start',
    //     'fields' => 'ids',
    //     'meta_query' => [
    //         [
    //             'key' => 'date_start',
    //             'value' => date('Y-m-d 00:00:00'),
    //             'compare' => '>=',
    //             'type' => 'DATETIME',
    //         ]
    //     ]
    // ]);
    $top_events = new WP_Query([
        'post_type' => 'event',
        'posts_per_page' => -1,
        'orderby' => array('meta_value_num' => 'ASC'),
        'meta_key' => 'date_start',
        'fields' => 'ids',
        'meta_query' => [
            [
                'key' => 'is_top',
                'value' => '1',
                'compare' => '=',
            ]
        ]
    ]);
    $top_events_posts = $top_events->posts;
    
    $dateObj = new DateTime('now', new DateTimeZone('Europe/Kyiv'));

    $dateObj = new DateTime('now', new DateTimeZone('Europe/Kyiv'));
    $todayStart = $dateObj->format('Y-m-d 00:00:00');
    // $todayEnd = $dateObj->format('Y-m-d 23:59:59');
    $dateObj->setTime(23, 59, 59);
    $top_events_posts = array_filter($top_events_posts, function($topEventId) use ($dateObj) {
        $topEventDateEnd = get_field('date_end', $topEventId);
        $topEventDateEnd = $topEventDateEnd . ' 23:59:59';
        $topEventDateEnd_strtotime = strtotime($topEventDateEnd);
        if($topEventDateEnd_strtotime < $dateObj->getTimestamp()) {
            return false;
        }
        return true;
    });

    $topEventsCount = 3;

    if(count($top_events_posts) < $topEventsCount) {
        $media_partner_events = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => -1,
            'orderby' => array('meta_value_num' => 'ASC'),
            'meta_key' => 'date_start',
            'fields' => 'ids',
            'meta_query' => [
                [
                    'key' => 'is_media_partner_speaker',
                    'value' => '1',
                    'compare' => '=',
                ],
                [
                    'key' => 'date_start',
                    'value' => $todayStart,
                    'compare' => '>=',
                    'type' => 'DATETIME',
                ]
            ]
        ]);
        if(!empty($media_partner_events->posts)) {
            foreach($media_partner_events->posts as $e_post_id) {
                $top_events_posts[] = $e_post_id;
                if(count($top_events_posts) >= $topEventsCount) {
                    break;
                }
            }
        }
    }

    if(count($top_events_posts) < $topEventsCount) {
        $early_events = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => -1,
            'orderby' => array('meta_value_num' => 'ASC'),
            'meta_key' => 'date_start',
            'fields' => 'ids',
            'meta_query' => [
                [
                    'key' => 'date_start',
                    'value' => $todayStart,
                    'compare' => '>=',
                    'type' => 'DATETIME',
                ]
            ]
        ]);

        if(!empty($early_events->posts)) {
            foreach($early_events->posts as $e_post_id) {
                $is_media_partner_speaker = get_field('is_media_partner_speaker', $e_post_id);
                $is_top = get_field('is_top', $e_post_id);
                if($is_media_partner_speaker || $is_top) {
                    continue;
                }
                $top_events_posts[] = $e_post_id;
                if(count($top_events_posts) >= $topEventsCount) {
                    break;
                }
            }
        }
    }
    ?>
    <div class="page-events">
        <section class="section mt-3 section-featured-events">
            <div class="container">
                <div class="row align-items-center section-featured-events__row">
                    <div class="col-12 col-lg-7">
                        <h1 class="h1 mb-2 pb-1 mb-lg-0 pb-lg-0 main-title pr-5">
                            <?php echo get_field('events_tpl_title'); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="text-lg-right">
                            <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
                                <?php echo _e('Submit your Event', 'icoda') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($top_events_posts)) : ?>
            <div class="section-has-bg position-relative mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <ul class="card-event-list">
                                    <?php foreach ($top_events_posts as $key => $post_event_id): ?>
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
                                        $website = get_field('website', $post_event_id);
                                        $with_promo_code = get_field('with_promo_code', $post_event_id);
                                        $discount_value = get_field('discount_value', $post_event_id);
                                        $discount_code = get_field('discount_code', $post_event_id);
                                        $isRelatedPost = get_field('is_related_post', $post_event_id);
                                        $linkRelatedPost = get_field('link_related_post', $post_event_id);
                                        if(strpos($website, 'https://') === false && strpos($website, 'http://') === false) {
                                            $website = '//' . $website;
                                        }
                                        $city = get_field('city', $post_event_id);
                                        $country = get_field('country', $post_event_id);
                                        $address = array_filter([$city, $country]);
                                        if ($date_start_day == $date_end_day && $date_start_month == $date_end_month) {
                                            $date_label = date('d F, Y', $date_start_strtotime);
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
                                        ?>
                                        <li>
                                            <div class="card-event overview-table active" data-index="<?php echo $key; ?>">
                                                <div class="container px-0">
                                                    <div class="row flex-column-reverse flex-lg-row">
                                                        <div class="col col-12 col-lg-7">
                                                            <div class="d-flex flex-column card-event__body">
                                                                <h2 class="mb-0 card-event__title order-lg-2">
                                                                    <?php echo get_the_title($post_event_id); ?>
                                                                </h2>
                                                                <div class="d-flex justify-content-lg-between flex-column flex-lg-row order-lg-1">
                                                                    <div class="card-event__info pr-2">
                                                                        <span class="date">
                                                                            <?php echo $date_label; ?>
                                                                        </span>
                                                                        <span class="country">
                                                                            <?php echo implode(', ', $address); ?>
                                                                        </span>
                                                                    </div>
                                                                    <?php if (!empty($categories)): ?>
                                                                        <ul class="badge-list mt-2 mt-lg-0">
                                                                            <?php foreach ($categories as $cat_event): ?>
                                                                                <li class="badge badge-body">
                                                                                    <?php echo $cat_event->name; ?>
                                                                                </li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="card-event__footer pt-1 pt-lg-0 mt-2">
                                                                <div class="gap-2 d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
                                                                    <?php if (!empty($website) || $isRelatedPost) : ?>
                                                                        <div class="d-flex gap-2">
                                                                            <?php if (!empty($website)): ?>
                                                                                <a href="<?php echo $website; ?>" 
                                                                                    class="btn btn-blue btn-visit-website" 
                                                                                    target="_blank">
                                                                                    <?php echo _e('Grab your spot', 'icoda') ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                            <?php if ($isRelatedPost && !empty($linkRelatedPost)): ?>
                                                                                <a
                                                                                    class="btn btn-read-review d-flex align-items-center justify-content-center btn-outline-blue"
                                                                                    href="<?php echo $linkRelatedPost['url']; ?>" 
                                                                                    target="_blank"
                                                                                    >
                                                                                    <?php echo __('Read our review', 'icoda'); ?>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                                                                                              
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
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col col-12 col-lg-5">
                                                            <div class="card-event__img pl-lg-4">
                                                                <img src="<?php echo get_the_post_thumbnail_url($post_event_id); ?>" alt="<?php echo get_the_title($post_event_id); ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </section>

        <section class="section section-all-events my-5 py-lg-2">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-title mb-4">
                            <?php echo get_field('events_tpl_title_2'); ?>
                        </h2>

                        <?php get_template_part('template-parts/_partials/event-filters'); ?>

                        <div class="mt-3 mt-lg-4 pt-lg-0 pt-1" id="events-container">
                            <?php get_template_part('template-parts/_partials/events-overview-table'); ?>
                        </div>

                        <div class="text-center mt-lg-4 mt-3 pt-1 pt-lg-0 section-all-events__show-more" style="display: none;">
                            <a href="#" class="btn btn-blue btn-show-el"><?php echo __('Show more', 'icoda'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $meet_block = get_field('meet_block');
        ?>
        <section class="section section-worldwide py-lg-4">
            <div class="section-worldwide__inner section-has-bg">
                <div class="container">
                    <div class="row flex-column-reverse flex-lg-row align-items-lg-center">
                        <div class="offset-lg-1 col-lg-5 mt-4 mt-lg-0">
                            <h2 class="section-title mb-2 pb-1">
                                <?php echo $meet_block['title']; ?>
                            </h2>
                            <p class="undertitle"><?php echo $meet_block['text']; ?></p>
                            <div class="mt-3 pt-lg-3">
                                <a
                                    class="btn btn-book-meeting btn-blue"
                                    href="#"
                                    onclick="Calendly.initPopupWidget({url: 'https://calendly.com/d/cqrf-wpr-bt6/talk-to-our-expert'});return false;">
                                    <?php echo __('Book A Meeting', 'icoda'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="section-worldwide__img">
                                <img src="<?php echo $meet_block['image']['url']; ?>" alt="<?php echo $meet_block['image']['alt']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-two-logo-sliders my-5">
        <?php
            $slidersLogo = get_field('ratings');
        ?>
            <div class="container">
                <div class="row">
                   <?php/* if (!empty($slidersLogo)) : */?>

                        <div class="col-12 pr-0">
                            <h2 class="section-title mb-4">
                                <?php echo _e('Our partners', 'icoda') ?>
                            </h2>
                            
                                <div class="logos-row logos-row__left">
                                    <div class="logos-track">
                                    
                                            <div
                                                class="media-logo">
                                                <picture>
                                                    <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                                </picture>
                                                <span class="media-title">
                                                    <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                                </span>
                                            </div>
                                            <div
                                                class="media-logo">
                                                <picture>
                                                    <img src="/wp-content/uploads/2024/11/trustpilot-logo.svg" alt="Trustpilot" />
                                                </picture>
                                                <span class="media-title">
                                                    <?php echo _e('Top Rated Trustpilot Agency', 'icoda') ?>
                                                </span>
                                            </div>
                                            <div
                                                class="media-logo">
                                                <picture>
                                                    <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                                </picture>
                                                <span class="media-title">
                                                    <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                                </span>
                                            </div>
                                            <div
                                                class="media-logo">
                                                <picture>
                                                    <img src="/wp-content/uploads/2024/11/trustpilot-logo.svg" alt="Trustpilot" />
                                                </picture>
                                                <span class="media-title">
                                                    <?php echo _e('Top Rated Trustpilot Agency', 'icoda') ?>
                                                </span>
                                            </div>
                                            <div
                                                class="media-logo">
                                                <picture>
                                                    <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                                </picture>
                                                <span class="media-title">
                                                    <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                                </span>
                                            </div>
                                        

                                    </div>
                                </div>

                                <div class="logos-row logos-row__right mt-4">
                                    <div class="logos-track">
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                            </span>
                                        </div>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/trustpilot-logo.svg" alt="Trustpilot" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Rated Trustpilot Agency', 'icoda') ?>
                                            </span>
                                        </div>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                            </span>
                                        </div>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/trustpilot-logo.svg" alt="Trustpilot" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Rated Trustpilot Agency', 'icoda') ?>
                                            </span>
                                        </div>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    <?php/* endif; */?>

                </div>
            </div>
        </section>

        <div class="mt-5 pt-lg-2">
            <?php get_template_part('template-parts/related-articles', '', ['title' => get_field('related_articles_title')]); ?>
        </div>

    </div>
<?php else : ?>
    <header class="section section-1">
        <section class="wr-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php the_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="text">
                        <h1 class="h2"><?php echo ! empty(get_field('events_tpl_title')) ? get_field('events_tpl_title') : __('Meet us at a conference near you!', 'icoda'); ?></h1>
                        <div class="sub-text">
                            <?php
                            $default_events_tpl_subtitle = __('<p>ICODA team attends and exhibits at different events around the world.</p><p>We love to meet and connect with clients, partners, associations and other event professionals.</p>', 'icoda');
                            ?>
                            <?php echo ! empty(get_field('events_tpl_subtitle')) ? get_field('events_tpl_subtitle') : $default_events_tpl_subtitle; ?>

                            <p class="bold"><?php echo ! empty(get_field('events_tpl_bold_text')) ? get_field('events_tpl_bold_text') : __('Check our event calendar to see where you can find us next time!', 'icoda'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-block col-md-6">
                    <div class="wr-img">
                        <div class="bg-events"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php the_content(); ?>

<?php endif; ?>

<?php
get_footer(); ?>