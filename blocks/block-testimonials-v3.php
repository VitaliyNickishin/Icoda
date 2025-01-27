<?php
$disable_block = block_value('disable-block');
if ($disable_block) {
    return;
}

$button_text = block_value('button-text');
$button_link = block_value('button-link');
?>

<?php
$general_testimonials = get_field('icoda_gb_testimonials', 'option');
?>
<?php
if (!block_rows('row') && empty($general_testimonials)) {
    return;
}
?>
<section class="section section-6 section-testimonials">
    <div class="container">
        <div class="row">
            <?php
            $title = block_field('title', false);
            if (empty($title)) {
                $title = __('Testimonials', 'icoda');
            }
            ?>
            <?php if ($title) : ?>
                <div class="col-12">
                    <p class="h3"><?php echo $title; ?></p>
                </div>
            <?php endif; ?>

            <div class="col-12">
                <div class="wr-slider">
                    <div class="slider-default custom-slider">

                        <?php while (block_rows('row')) :
                            block_row('row'); ?>

                            <div class="wr-slider-default-item">
                                <div class="slider-default-item">
                                    <div class="slider-default-item-header">
                                        <div class="profile-box">

                                            <?php if (!empty(block_sub_value('avatar'))) : ?>
                                                <div class="profile-box-avatar">
                                                    <img data-skip-lazy src="<?php block_sub_field('avatar'); ?>" alt="avatar">
                                                </div>
                                            <?php endif; ?>


                                            <div class="profile-box-des">
                                                <p class="h5"><?php block_sub_field('name'); ?></p>
                                                <?php if ($linkedin = block_sub_field('linkedin', false)) : ?>
                                                    <a href="<?php echo $linkedin; ?>" target="_blank" class="profile-link"><?php _e('LinkedIn Profile', 'icoda'); ?></a>
                                                <?php endif; ?>
                                                <?php if ($youtube = block_sub_field('youtube', false)) : ?>
                                                    <?php
                                                    $youtube_link_text = block_sub_field('youtube_link_text', false);
                                                    $youtube_link_text = empty($youtube_link_text) ? __('Youtube Chanel', 'icoda') : $youtube_link_text;
                                                    ?>
                                                    <a href="<?php echo $youtube; ?>" target="_blank" class="profile-link"><?php echo $youtube_link_text; ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if (!empty(block_sub_value('logo'))) : ?>
                                            <div class="slider-logo-box">
                                                <img src="<?php block_sub_field('logo'); ?>" alt="logo-project">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="slider-default-item-body">
                                        <?php block_sub_field('content'); ?>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                        reset_block_rows('row'); ?>


                        <?php if (!empty($general_testimonials)) : ?>
                            <?php foreach ($general_testimonials as $general_testimonials_item) : ?>
                                <?php
                                $queried_object_id = get_queried_object_id();
                                if ((
                                        $queried_object_id == 10351
                                        || $queried_object_id == 10612
                                        || $queried_object_id == 10610
                                        || $queried_object_id == 10611
                                        || $queried_object_id == 22149
                                    )
                                    && empty($general_testimonials_item['youtube'])
                                ) {
                                    continue;
                                }

                                if ((
                                        $queried_object_id != 10351
                                        && $queried_object_id != 10612
                                        && $queried_object_id != 10610
                                        && $queried_object_id != 10611
                                        && $queried_object_id != 22149
                                    )
                                    && !empty($general_testimonials_item['youtube'])
                                ) {
                                    continue;
                                }

                                if ((
                                        $queried_object_id == 10351
                                        || $queried_object_id == 10612
                                        || $queried_object_id == 10610
                                        || $queried_object_id == 10611
                                        || $queried_object_id == 22149
                                    )
                                    && ! empty($general_testimonials_item['youtube'])
                                ) {
                                    $general_testimonials_item['hide_testimonial'] = false;
                                }
                                ?>

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
                                                    <?php $avatar_img_url = wp_get_attachment_image_url($general_testimonials_item['avatar']); ?>
                                                    <div class="profile-box-avatar">
                                                        <img data-skip-lazy src="<?php echo $avatar_img_url; ?>" alt="<?php echo get_post_meta($general_testimonials_item['avatar'], '_wp_attachment_image_alt', true); ?>">
                                                    </div>
                                                <?php endif; ?>


                                                <div class="profile-box-des">
                                                    <p class="h5"><?= $general_testimonials_item['name']; ?></p>
                                                    <?php if (!empty($general_testimonials_item['linkedin'])) : ?>
                                                        <a href="<?php echo $general_testimonials_item['linkedin']; ?>" target="_blank" class="profile-link"><?php _e('LinkedIn Profile', 'icoda'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($general_testimonials_item['position'])) : ?>
                                                        <p><?php echo $general_testimonials_item['position']; ?></p>
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
                                                <?php $logo_img_url = wp_get_attachment_image_url($general_testimonials_item['logo']); ?>
                                                <div class="slider-logo-box">
                                                    <img src="<?php echo $logo_img_url; ?>" alt="logo-project">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="slider-default-item-body">
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

            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                <div class="col-12 text-center mt-5">
                    <div class="pt-lg-2 m-auto">
                        <a href="<?php echo $button_link; ?>" class="btn btn-blue mt-4"><?php echo $button_text; ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>