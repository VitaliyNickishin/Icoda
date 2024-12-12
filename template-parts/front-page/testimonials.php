<?php
$general_testimonials = get_field('icoda_gb_testimonials', 'option');
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
            $title = get_field('section_9_title-en', $args['post_id']);
            if (empty($title)) {
                $title = __('Testimonials', 'icoda');
            }
            ?>
            <h3 class="section-title"><?php echo $title; ?></h3>
        </div>
        <div class="col-12">
            <div class="wr-slider">
                <div class="slider-default custom-slider">

                    <?php if (!empty($general_testimonials)) : ?>
                        <?php foreach ($general_testimonials as $general_testimonials_item) : ?>
                            <?php
                            if ($general_testimonials_item['hide_testimonial']) {
                                continue;
                            }
                            ?>
                            <div class="wr-slider-default-item">
                                <div class="slider-default-item">
                                    <div class="slider-default-item-header">
                                        <div class="profile-box">
                                            <?php if (!empty($general_testimonials_item['avatar'])) : ?>
                                                <?php $avatar_img_url = wp_get_attachment_image_url($general_testimonials_item['avatar'], 'full'); ?>
                                                <div class="profile-box-avatar">
                                                    <img src="<?php echo $avatar_img_url; ?>" alt="<?php echo get_post_meta($general_testimonials_item['avatar'], '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="profile-box-des">
                                                <p class="h5"><?= $general_testimonials_item['name']; ?></p>
                                                <?php if (!empty($general_testimonials_item['linkedin'])) : ?>
                                                    <a href="<?php echo $general_testimonials_item['linkedin']; ?>" class="profile-link" target="_blank"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                                <?php endif; ?>
                                                <?php if (!empty($general_testimonials_item['youtube'])) : ?>
                                                    <?php
                                                    $youtube_link_text = !empty($general_testimonials_item['youtube_link_text']) ? $general_testimonials_item['youtube_link_text'] :  __('Youtube Chanel', 'icoda');
                                                    ?>
                                                    <a href="<?php echo $general_testimonials_item['youtube']; ?>" target="_blank" class="profile-link"><?php echo $youtube_link_text; ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($general_testimonials_item['logo'])) : ?>
                                            <?php $logo_img_url = wp_get_attachment_image_url($general_testimonials_item['logo'], 'full'); ?>
                                            <div class="slider-logo-box">
                                                <img src="<?php echo $logo_img_url; ?>" alt="logo-project">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="slider-default-item-body testimonials-content ellipsis ellipsis-content">
                                        <?php echo $general_testimonials_item['content']; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="wr-control wr-control-testimonials"></div>
            </div>
        </div>
    </div>
</div>