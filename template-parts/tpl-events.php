<?php
/* Template Name: Events page */

get_header();
?>
    <script>
        window.intercomSettings = {
            app_id: "gdz549ih"
        };
    </script>

<?php if ( !empty($_GET['show_new_events'])) : ?>
    <?php
global $post;
$is_blog_post = is_page_template('template-posts/new-blog-post.php');
?>
<div class="page-events">
    <section class="section mt-3 section-featured-events">
        <div class="container">
            <div class="row align-items-center section-featured-events__row">
                <div class="col-12 col-lg-7">
                    <h1 class="h1 mb-2 pb-1 mb-lg-0 pb-lg-0 main-title pr-5">
                        <?php echo _e('Top Featured Events With Us', 'icoda') ?>
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
        <div class="section-has-bg position-relative mt-4">
            
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <ul class="card-event-list">
                                <li>
                                    <div class="card-event overview-table active" data-index="0">
                                        <div class="container px-0">
                                            <div class="row flex-column-reverse flex-lg-row">
                                                <div class="col col-12 col-lg-7">
                                                    <div class="d-flex flex-column card-event__body">
                                                        <h2 class="mb-0 card-event__title order-lg-2">
                                                            <?php echo _e('Token2049', 'icoda') ?>
                                                        </h2>
                                                        <div class="d-flex justify-content-lg-between flex-column flex-lg-row order-lg-1">
                                                            <div class="card-event__info pr-2">
                                                                <span class="date">
                                                                    28 April - 4 May, 2025
                                                                </span>
                                                                <span class="country">
                                                                    <?php echo _e('Dubai, UAE', 'icoda') ?>
                                                                </span>
                                                            </div>
                                                            <ul class="badge-list mt-2 mt-lg-0">
                                                                <li class="badge badge-body">
                                                                    <?php echo _e('Blockchain', 'icoda') ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-event__footer pt-1 pt-lg-0 mt-2">
                                                        <div class="card-event__btn d-flex">
                                                            <?php get_template_part('template-parts/_partials/btn-events'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-12 col-lg-5">
                                                    <div class="card-event__img pl-lg-4">
                                                        <img src="/wp-content/uploads/2025/05/event1.png" alt="Token 2049" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card-event overview-table" data-index="1">
                                        <div class="container px-0">
                                            <div class="row flex-column-reverse flex-lg-row">
                                                <div class="col col-12 col-lg-7">
                                                    <div class="d-flex flex-column card-event__body">
                                                        <h2 class="mb-0 card-event__title order-lg-2">
                                                            <?php echo _e('Paris Blockchain Week', 'icoda') ?>
                                                        </h2>
                                                        <div class="d-flex justify-content-lg-between flex-column flex-lg-row order-lg-1">
                                                            <div class="card-event__info pr-2">
                                                                <span class="date">
                                                                    14-16 April, 2025
                                                                </span>
                                                                <span class="country">
                                                                    <?php echo _e('Paris, France', 'icoda') ?>
                                                                </span>
                                                            </div>
                                                            <ul class="badge-list mt-2 mt-lg-0">
                                                                <li class="badge badge-body">
                                                                    <?php echo _e('Blockchain', 'icoda') ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-event__footer pt-1 pt-lg-0 mt-2">
                                                        <div class="card-event__btn d-flex">
                                                            <?php get_template_part('template-parts/_partials/btn-events'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-12 col-lg-5">
                                                    <div class="card-event__img pl-lg-4">
                                                        <img src="/wp-content/uploads/2025/04/Promo-Code-SBC-Summit-Free-Tickets.png" alt="Paris Blockchain Week" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card-event overview-table" data-index="2">
                                        <div class="container px-0">
                                            <div class="row flex-column-reverse flex-lg-row">
                                                <div class="col col-12 col-lg-7">
                                                    <div class="d-flex flex-column card-event__body">
                                                        <h2 class="mb-0 card-event__title order-lg-2">
                                                            <?php echo _e('TEAMZ Summit', 'icoda') ?>
                                                        </h2>
                                                        <div class="d-flex justify-content-lg-between flex-column flex-lg-row order-lg-1">
                                                            <div class="card-event__info pr-2">
                                                                <span class="date">
                                                                    16-17 April, 2025
                                                                </span>
                                                                <span class="country">
                                                                    <?php echo _e('Tokyo, Japan', 'icoda') ?>
                                                                </span>
                                                            </div>
                                                            <ul class="badge-list mt-2 mt-lg-0">
                                                                <li class="badge badge-body">
                                                                    <?php echo _e('Web3', 'icoda') ?>
                                                                </li>
                                                                <li class="badge badge-body">
                                                                    <?php echo _e('Blockchain', 'icoda') ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-event__footer pt-1 pt-lg-0 mt-2">
                                                        <div class="card-event__btn d-flex">
                                                            <?php get_template_part('template-parts/_partials/btn-events'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-12 col-lg-5">
                                                    <div class="card-event__img pl-lg-4">
                                                        <img src="/wp-content/uploads/2025/04/MAC-Yerevan-Affiliate-Marketing-Conference.png" alt="TEAMZ Summit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                
                </div>
            </div>

        </div>
    </section>

    <section class="section section-all-events my-5 py-lg-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-title mb-4">
                        <?php echo _e('Top Featured Events With Us', 'icoda') ?>
                    </h2>

                    <?php get_template_part('template-parts/_partials/event-filters'); ?>

                    <div class="mt-3 mt-lg-4 pt-lg-0 pt-1">
                        <?php get_template_part('template-parts/_partials/events-overview-table'); ?>
                    </div>

                    <div class="text-center mt-lg-4 mt-3 pt-1 pt-lg-0 section-all-events__show-more">
                        <a href="#" class="btn btn-blue btn-show-el"><?php echo __('Show more', 'icoda'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-worldwide py-lg-4">
        <div class="section-worldwide__inner section-has-bg">
            <div class="container">
                <div class="row flex-column-reverse flex-lg-row align-items-lg-center">
                    <div class="offset-lg-1 col-lg-5 mt-4 mt-lg-0">
                        <h2 class="section-title mb-2 pb-1 fw-semibold">
                            <?php echo _e('Meet ICODA worldwide.', 'icoda') ?>
                        </h2>
                        <p class="undertitle">Catch us at major blockchain, crypto, and iGaming events across the globe.</p>
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
                            <img src="/wp-content/uploads/2025/05/meet-worldwide.png" alt="Meet ICODA worldwide" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-5 pt-lg-2">
        <?php get_template_part('template-parts/related-articles'); ?>
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
                        <h1 class="h2"><?php echo ! empty( get_field( 'events_tpl_title' ) ) ? get_field( 'events_tpl_title' ) : __('Meet us at a conference near you!', 'icoda'); ?></h1>
                        <div class="sub-text">
                            <?php
                                $default_events_tpl_subtitle = __('<p>ICODA team attends and exhibits at different events around the world.</p><p>We love to meet and connect with clients, partners, associations and other event professionals.</p>', 'icoda');
                            ?>
                            <?php echo ! empty( get_field( 'events_tpl_subtitle' ) ) ? get_field( 'events_tpl_subtitle' ) : $default_events_tpl_subtitle; ?>
                            
                            <p class="bold"><?php echo ! empty( get_field( 'events_tpl_bold_text' ) ) ? get_field( 'events_tpl_bold_text' ) : __('Check our event calendar to see where you can find us next time!', 'icoda'); ?></p>
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