<?php
/* Template Name: Events page */

get_header();
?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>


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

    $calendar_events = [];

    $events = get_posts([
        'post_type'      => 'event',
        'posts_per_page' => -1,
    ]);


    foreach ($events as $event) {
        $date_end = get_field('date_end', $event->ID);

        if (strtotime($date_end) < strtotime($todayStart)) {
            continue;
        }

        $categories = get_the_terms($event->ID, 'events_cat');

        $calendar_events[] = [
            'id'          => $event->ID,
            'title'       => get_the_title($event->ID),
            'start'       => date('Y-m-d', strtotime(get_field('date_start', $event->ID))),
            'end'         => date('Y-m-d', strtotime($date_end)),
            'location'    => get_field('city', $event->ID),
            'country'     => get_field('country', $event->ID),
            'url_website'         => get_field('website', $event->ID) ?: '#',
            'is_related_post'         => get_field('is_related_post', $event->ID),
            'url_related_post'         => get_field('link_related_post', $event->ID) ?: '#',
            'description' => get_the_excerpt($event->ID),
            'modal_banner'      => get_the_post_thumbnail_url($event->ID) ?: '',
            'with_promo_code' => get_field('with_promo_code', $event->ID),
            'discount_codes' => get_field('discount_code', $event->ID),
            'categories'  => !empty($categories)
                ? wp_list_pluck($categories, 'name')
                : [],
        ];
    }

    $hero_section = get_field('hero_section');
    $sidebar_banner = get_field('sidebar_banner');
    $btn_link = $hero_section['btn_link_secondary'];
    $btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '#';
    $btn_target = !empty($btn_link['target']) ? $btn_link['target'] : '_self';
    ?>

    <script>
        window.eventsData = <?php echo wp_json_encode($calendar_events); ?>;
    </script>

    <div class="page-events">
        
        <section class="section py-5 section-featured-events">
            
            <?php if(!empty($top_events_posts)) : ?>
                <?php
                    usort($top_events_posts, function($a, $b) {
                    $dateA = strtotime(get_field('date_start', $a));
                    $dateB = strtotime(get_field('date_start', $b));

                    return $dateA <=> $dateB;
                });
                ?>
            <div class="py-lg-4 with-gradient with-gradient-pink with-gradient-blue">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                        <?php if (!empty($hero_section['above_title'])) : ?>
                        <p class="abovetitle">
                            <?php echo $hero_section['above_title']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['title'])) : ?>
                        <h1 class="h1 mb-3 mb-lg-4 section-title fw-bold">
                            <?php echo $hero_section['title']; ?>
                        </h1>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['subtitle'])) : ?>
                        <p class="subtitle">
                            <?php echo $hero_section['subtitle']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['btn_text_modal']) || !empty($hero_section['btn_text_second'])) : ?>
                        <div class="section-featured-events__btn mt-4 mt-lg-4 pt-lg-2">
                            <?php if (!empty($hero_section['btn_text_modal'])) : ?>
                                <a href="#" data-modal="#callback" class="btn btn-blue open-modal d-flex align-items-center justify-content-center">
                                    <?php echo $hero_section['btn_text_modal']; ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($btn_link)) : ?>
                                
                                <a class="btn d-flex align-items-center justify-content-center btn-outline-blue" 
                                    href="<?php echo esc_url($btn_url); ?>"
                                    target="<?php echo esc_attr($btn_target); ?>"
                                >
                                    <?php echo $btn_link['title']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    </div>
                        <div class="col-12 col-lg-7">
                            <div class="">
                                <?php if (!empty($hero_section['eyebrow_top_events'])) : ?>
                                    <div class="hed-eyebrow mb-3 mt-4 mt-lg-0">
                                        <?php echo $hero_section['eyebrow_top_events']; ?>
                                    </div>
                                <?php endif; ?>
                                <ul class="card-event-list">
                                    <?php foreach ($top_events_posts as $key => $post_event_id): ?>
                                        <?php
                                        $date_start = get_field('date_start', $post_event_id);
                                        $date_start_strtotime = strtotime($date_start);
                                        $date_start_year = date('Y', $date_start_strtotime);
                                        $date_start_month = date('m', $date_start_strtotime);
                                        $date_start_m = date('M', $date_start_strtotime);
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
                                                        <div class="col col-12 col-lg-6">
                                                            <div class="d-flex flex-column hed-item">
                                                                <div class="hed-compact">
                                                                    <div class="hed-date-col">
                                                                        <div class="hed-day"><?php echo $date_start_day; ?></div>
                                                                        <div class="hed-month"><?php echo $date_start_m; ?></div>
                                                                    </div>
                                                                    <div class="hed-info">
                                                                        <div class="hed-title"><?php echo get_the_title($post_event_id); ?></div>
                                                                        <div class="hed-sub"><?php echo implode(', ', $address); ?></div>
                                                                    </div>
                                                                    <i class="hed-arrow fas fa-long-arrow-alt-right arrow-long" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col col-12 col-lg-6">
                                                            <div class="card-event__img">
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

        <?php
            $block_tabs['nav_tabs'] = [
                [
                    'nav_tab_title' => 'All events',
                    'topics' => 'all'
                ],
                [
                    'nav_tab_title' => 'Crypto & Web3',
                    'topics' => [945,941,951,1003,956,955,959,954,950]
                ],
                [
                    'nav_tab_title' => 'AI & Tech',
                    'topics' => [942,964,965,947]
                ],
                [
                    'nav_tab_title' => 'iGaming',
                    'topics' => [962,963,949,943,1056]
                ],
                [
                    'nav_tab_title' => 'Previous events',
                    'is_previous' => true
                    
                ]
            ];
        ?>
        
            <!-- use id for anchor btn from hero-->
            <div id="all-events" class="py-lg-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <!-- Sidebar -->
                            <aside class="sidebar" aria-label="Calendar and navigation">
                                <div id="calendarView" class="calendar-block"></div>

                                <div class="agency-card">
                                    <?php if (!empty($sidebar_banner['title'])) : ?>
                                        <p class="agency-card-title section-title mb-2 pb-1"><?php echo $sidebar_banner['title']; ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($sidebar_banner['description'])) : ?>
                                        <p class="agency-card-description"><?php echo $sidebar_banner['description']; ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($sidebar_banner['btn_text_modal'])) : ?>
                                        <a href="#" data-modal="#callback" class="btn btn-outline-white open-modal">
                                            <?php echo $sidebar_banner['btn_text_modal']; ?>
                                            <i class="fas fa-long-arrow-alt-right arrow-long" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </aside>
                        </div>
                        <div class="col-12 col-lg-9">
                            <!-- Main -->
                            <section class="section section-all-events">
                                <h2 class="section-title mb-4">
                                    <?php echo get_field('title_all_events'); ?>
                                </h2>
                                <nav>
                                    <div class="nav nav-tabs border-0 mb-2 mb-lg-4" id="nav-tab" role="tablist">
                                        <?php if (!empty($block_tabs['nav_tabs'])) : ?>
                                            <?php foreach ($block_tabs['nav_tabs'] as $index => $nav_tab) : ?>
                                                <button 
                                                    class="nav-link <?php if ($index === 0) : ?>active<?php endif; ?>" 
                                                    id="nav-<?php echo $index; ?>-tab" 
                                                    data-toggle="tab" 
                                                    data-target="#nav-<?php echo $index; ?>" 
                                                    type="button" role="tab" 
                                                    aria-controls="nav-<?php echo $index; ?>" 
                                                    aria-selected="true"
                                                    data-topics='<?php echo json_encode($nav_tab['topics'] ?? []); ?>'
                                                    data-previous="<?php echo !empty($nav_tab['is_previous']) ? 'true' : 'false'; ?>"
                                                    >
                                                    <?php echo $nav_tab['nav_tab_title']; ?>
                                                </button>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    
                                        <div class="tab-pane fade show active">

                                            <?php get_template_part('template-parts/_partials/event-filters'); ?>

                                            <div class="mt-3 mt-lg-4 pt-lg-0 pt-1" id="events-container">
                                                <?php get_template_part('template-parts/_partials/events-overview-table'); ?>
                                            </div>

                                            <div class="text-center mt-lg-4 mt-3 pt-1 pt-lg-0 section-all-events__show-more" style="display: none;">
                                                <a href="#" class="btn btn-blue btn-show-el"><?php echo __('Show more', 'icoda'); ?></a>
                                            </div>
                                        </div>
                                
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============ MODAL ============ -->
            <div class="modal-overlay" id="modalOverlay" aria-hidden="true">
                <div class="modal" role="dialog" aria-modal="true" id="modal"></div>
            </div>
        
        <?php
            $media_partners = get_field('media_partners');
            $media_partners_grid = $media_partners['grid_items'];
            $grid_groups = array_chunk($media_partners_grid, 3);
            $btn_link = $media_partners['btn_link_secondary'];
            $btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '#';
            $btn_target = !empty($btn_link['target']) ? $btn_link['target'] : '_self';
        ?>
        <section class="section section-media-partners py-lg-4">
            <div class="container">
                <div class="mp-top">
                    <h2 class="section-title mb-2 pb-1">
                        <?php echo $media_partners['title']; ?>
                    </h2>
                </div>
                <div class="mp-bottom">
                    <div class="mp-left">
                        <div class="description"><?php echo $media_partners['description']; ?></div>
                        
                        <?php if (!empty($media_partners['btn_text_modal']) || !empty($media_partners['btn_text_second'])) : ?>
                            <div class="section-media-partners__btn d-flex flex-column flex-sm-row mt-4 mt-lg-4 pt-lg-2 gap-3">
                                <?php if (!empty($media_partners['btn_text_modal'])) : ?>
                                    <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
                                        <?php echo $media_partners['btn_text_modal']; ?>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (!empty($btn_link)) : ?>
                                    
                                    <a class="btn d-flex align-items-center justify-content-center btn-outline-blue gap-2 btn-second" 
                                        href="<?php echo esc_url($btn_url); ?>" 
                                        target="<?php echo esc_attr($btn_target); ?>"
                                    >
                                        <?php echo $btn_link['title']; ?>
                                        <i class="fas fa-long-arrow-alt-right arrow-long"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mp-right">
                        
                        <?php if (!empty($media_partners_grid)) : ?>
                            <div class="cases-box mp-stats-grid">
                                <?php foreach ($grid_groups as $items_grid) : ?>
                                    <?php foreach ($items_grid as $item_grid) : ?>
                                        <div class="serv-box <?php echo count($items_grid) == 1 ? 'mp-stat-wide' : ''; ?>">
                                            <span class="number"><?php echo $item_grid['value']; ?></span>
                                            <p class="text"><?php echo $item_grid['text']; ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-two-logo-sliders my-5">
        <?php
            $revers_sliders = get_field('revers_sliders');
            $section_title = get_field('section_title');
            $first_slider = get_field('first_slider');
            $second_slider = get_field('second_slider');
            $cta_text = get_field('cta_text');
        ?>
            <div class="container">
                <div class="row">
                   <?php if (!empty($first_slider)) : ?>

                        <div class="col-12 px-0">
                            <?php if (!empty($section_title)): ?>
                                <h2 class="section-title mb-4 px-3">
                                    <?php echo esc_html($section_title); ?>
                                </h2>
                            <?php endif; ?>
                            
                            <div class="logos-row logos-row__left">
                                <div class="logos-track">
                                    <?php foreach ($first_slider as $key => $slide): ?>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="<?php echo $slide['slide_image']['url']; ?>" alt="<?php echo $slide['slide_title']; ?>" width="160" height="160" />
                                            </picture>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <?php if (!empty($second_slider)): ?>
                                <div class="logos-row logos-row__right mt-4">
                                    <div class="logos-track">
                                        <?php foreach ($second_slider as $key => $slide): ?>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="<?php echo $slide['slide_image']['url']; ?>" alt="<?php echo $slide['slide_title']; ?>" width="160" height="160" />
                                            </picture>
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($cta_text)): ?>
                            <div class="col-12 mt-4 text-center">
                                <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
                                    <?php echo $cta_text; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <?php get_template_part('template-parts/sections/map-global'); ?>

        <div class="mt-5 pt-lg-2">
            <?php get_template_part('template-parts/related-articles', '', ['title' => get_field('related_articles_title')]); ?>
        </div>

    </div>

<?php
get_footer(); ?>