<?php
$need_post_id = !empty($args['need_post_id']) ? $args['need_post_id'] : get_the_ID();
?>
<?php if (get_field('section_contact_us_show', $need_post_id) == true) : ?>
    <section class="form-contact">
        <div class="container">
            <div class="row form-contact-inner">
                <div class="col-12 col-lg-4 col-top">
                    <div class="text">
                        <h3 class="section-title"><?php echo get_field('section_contact_us_title', $need_post_id); ?></h3>
                        <p class="sub-text"><?php echo get_field('section_contact_us_sub_text', $need_post_id); ?></p>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <?php get_template_part(
                        'template-parts/_partials/contact-form',
                        null,
                        ['variant' => 'home']
                    ); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>