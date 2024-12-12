<?php
/* Template Name: Events page */

get_header();
?>
    <script>
        window.intercomSettings = {
            app_id: "gdz549ih"
        };
    </script>
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
<?php
get_footer(); ?>