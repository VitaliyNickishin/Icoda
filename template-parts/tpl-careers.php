<?php
/* Template Name: Careers page */

get_header();

// $front_page_id = get_option('page_on_front');

?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<main>
    <section class="section section-1">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4 mb-lg-5">
                    <?php the_breadcrumbs(); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text">
                        <h1 class="h2"><?php echo __('Careers', 'icoda'); ?></h1>
                        <div class="sub-text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-flex align-items-center col-lg-6">
                    <div class="bg-careers">
                        <img src="<?php the_field('main_image'); ?>" alt="team">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $collage_images = get_field('collage_images'); ?>
    <section class="section section-2">
        <div class="container">
            <div class="row">
                <div class="d-none d-lg-block col-lg-6">
                    <div class="wr-img position-relative h-100">
                        <?php foreach ($collage_images as $key => $image_url) : ?>
                            <div class="wr-img-gen wr-img-gen-<?php echo ($key + 1); ?>">
                                <img src="<?php echo $image_url; ?>" alt="team-member">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="career-list">
                        <?php $advantage_list_items = get_field('advantage_list_items'); ?>
                        <?php foreach ($advantage_list_items as $item_data) : ?>
                            <div class="career-list-item">
                                <?php if ($item_data['type'] == 'h3') : ?>
                                    <p class="h3"><?php echo $item_data['heading_value']; ?></p>
                                <?php elseif ($item_data['type'] == 'h4') : ?>
                                    <p class="h4"><?php echo $item_data['heading_value']; ?></p>
                                <?php endif; ?>
                                <?php if (!empty($item_data['subtext'])) : ?>
                                    <p><?php echo $item_data['subtext']; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="l-box bg-color-light-blue">
                        <div class="bg-line-left"></div>
                        <p class="h4"><?php echo __('What’s your passion?', 'icoda'); ?></p>
                        <?php if( ICL_LANGUAGE_CODE == 'en' ) : ?>
                            <p><?php echo __('We are always seeking talented individuals to join our growing team. Check out all our open spots below.', 'icoda'); ?></p>                            
                        <?php else : ?>
                            <p><?php echo __('Check out all our open spots below', 'icoda'); ?></p>
                        <?php endif; ?>
                        <ul>
                            <?php if (have_rows('links')) : ?>
                                <?php while (have_rows('links')) : the_row(); ?>
                                    <li><a href="<?php echo get_sub_field('url'); ?>" <?php echo get_sub_field('open_in_new_window') ? 'target="_blank"' : ''; ?> class="link-arrow link-blue"><?php echo get_sub_field('label'); ?></a></li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                        <p class="h5"><?php echo __('Please email your CV to', 'icoda'); ?></p>
                        <a target="_blank" href="mailto:post@icoda.io" class="btn btn-blue ico-btn ico-mail"><span></span>post@icoda.io</a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="wr-form">
                        <div class="form-default-header">
                            <p class="h5"><?php echo __('Send an application via the form', 'icoda'); ?></p>
                            <div class="theme-media-list">
                                <?php get_template_part('template-parts/_partials/media-list'); ?>
                            </div>
                        </div>
                        <?php get_template_part('template-parts/_partials/contact-form'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php // get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => $front_page_id]); 
    ?>
</main>
<?php
get_footer(); ?>