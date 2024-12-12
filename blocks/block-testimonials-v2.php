<?php $rows = block_value('row'); ?>
<?php
$bg_color = '';
if (block_field('background-color', false)) {
    $bg_color = ' style="background-color: ' . block_field('background-color', false) . ';" ';
}
?>
<?php
$general_testimonials = get_field('icoda_gb_testimonials', 'option');
?>
<section class="section section-6" <?php echo $bg_color; ?>>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <?php
                    $title = block_field('title', false);
                    if( empty( $title ) ) {
                        $title = __('Testimonials', 'icoda');
                    }
                ?>

                <?php if ($title) : ?>
                    <h3 class="section-title"><?php echo $title; ?></h3>
                <?php endif; ?>

            </div>
            <div class="col-12">
                <div class="wr-slider">
                    <div class="slider-default">
                        <?php foreach ($rows['rows'] as $key => $row) : ?>
                            <div class="wr-slider-default-item">
                                <div class="slider-default-item">
                                    <div class="slider-default-item-header">
                                        <div class="profile-box">
                                            <?php if ($row['avatar']) : ?>
                                                <?php $avatar_img_url = wp_get_attachment_image_url($row['avatar']); ?>
                                                <div class="profile-box-avatar"><img data-skip-lazy src="<?php echo $avatar_img_url; ?>" class="testimonials-avatar" alt="<?php echo get_post_meta($row['avatar'], '_wp_attachment_image_alt', true); ?>"></div>
                                            <?php endif; ?>
                                            <?php // rating // $rating = get_sub_field('testimonials_rating'); 
                                            ?>
                                            <div class="profile-box-des">
                                                <p class="h5"><?= $row['name']; ?></p>
                                                <a href="<?= $row['linkedin']; ?>" class="profile-link" target="_blank"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                            </div>
                                        </div>
                                        <?php if ($row['logo']) : ?>
                                            <?php $project_img_url = wp_get_attachment_image_url($row['logo']); ?>
                                            <div class="slider-logo-box">
                                                <img src="<?php echo $project_img_url; ?>" class="testimonials-logo" alt="<?php echo get_post_meta($row['logo'], '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="slider-default-item-body">
                                        <p><?= $row['content']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (!empty($general_testimonials)) : ?>
                            <?php foreach ($general_testimonials as $general_testimonials_item) : ?>
                                <?php
                                    if( $general_testimonials_item['hide_testimonial'] ) {
                                        continue;
                                    }
                                ?>
                                <?php
                                    $queried_object_id = get_queried_object_id();
                                        if( (
                                                $queried_object_id == 10351 
                                                || $queried_object_id == 10612 
                                                || $queried_object_id == 10610 
                                                || $queried_object_id == 10611
                                                || $queried_object_id == 22149
                                            ) 
                                            && empty( $general_testimonials_item['youtube'] ) 
                                        ) {
                                            continue;
                                        }

                                        if( (
                                            $queried_object_id != 10351 
                                            && $queried_object_id != 10612 
                                            && $queried_object_id != 10610 
                                            && $queried_object_id != 10611
                                            && $queried_object_id != 22149
                                        ) 
                                            && !empty( $general_testimonials_item['youtube'] ) 
                                        ) {
                                            continue;
                                        }
                                    ?>

                                <div class="wr-slider-default-item">
                                    <div class="slider-default-item">
                                        <div class="slider-default-item-header">
                                            <div class="profile-box">
                                                <?php if ($general_testimonials_item['avatar']) : ?>
                                                    <?php $avatar_img_url = wp_get_attachment_image_url($general_testimonials_item['avatar']); ?>
                                                    <div class="profile-box-avatar"><img data-skip-lazy src="<?php echo $avatar_img_url; ?>" class="testimonials-avatar" alt="<?php echo get_post_meta($general_testimonials_item['avatar'], '_wp_attachment_image_alt', true); ?>"></div>
                                                <?php endif; ?>
                                                <div class="profile-box-des">
                                                    <p class="h5"><?= $general_testimonials_item['name']; ?></p>
                                                    <a href="<?= $general_testimonials_item['linkedin']; ?>" class="profile-link" target="_blank"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                                </div>
                                            </div>
                                            <?php if ($general_testimonials_item['logo']) : ?>
                                                <?php $project_img_url = wp_get_attachment_image_url($general_testimonials_item['logo']); ?>
                                                <div class="slider-logo-box">
                                                    <img src="<?php echo $project_img_url; ?>" class="testimonials-logo" alt="<?php echo get_post_meta($general_testimonials_item['logo'], '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="slider-default-item-body">
                                            <?= $general_testimonials_item['content']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                    <div class="wr-control"></div>
                </div>
            </div>
        </div>
    </div>
</section>