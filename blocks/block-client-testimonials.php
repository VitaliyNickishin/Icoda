<?php
$disable_block = block_value('disable-block');
if($disable_block) {
    return;
}
?>

<?php $rows = block_value('row'); ?>
<?php
// var_dump(block_value('row'));
?>
<?php
$general_testimonials = get_field('icoda_gb_testimonials', 'option');
?>
<section class="section section-2 section-testimonials">
    <div class="container">
        <div class="row">
            <div class="d-none d-md-block col-md-5"></div>
            <div class="col-12 col-sm-12 col-md-7">
                <div class="wr-description-project">
                    <div class="des-section">
                        <?php
                            $title = block_field('title', false);
                            if( empty( $title ) ) {
                                $title = __('Testimonials', 'icoda');
                            }
                        ?>
                        <?php if ($title) : ?>
                            <p id="client_testimonials" class="h4"><?php echo $title; ?></p>
                        <?php endif; ?>
                        <div class="sub-text">
                            <?php foreach ($rows['rows'] as $key => $row) : ?>
                                <p><?= $row['content']; ?></p>
                                <div class="profile-box">
                                    <?php if ($row['avatar']) : ?>
                                        <?php $avatar_img_url = wp_get_attachment_image_url($row['avatar']); ?>
                                        <div class="profile-box-avatar"><img src="<?php echo $avatar_img_url; ?>" alt="<?php echo get_post_meta($row['avatar'], '_wp_attachment_image_alt', true); ?>"></div>
                                    <?php endif; ?>
                                    <div class="profile-box-des">
                                        <p class="h5"><?= $row['name']; ?></p>
                                        <a class="profile-link" href="<?= $row['linkedin']; ?>"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
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

                                    <?php echo $general_testimonials_item['content']; ?></p>
                                    <div class="profile-box">
                                        <?php if ($general_testimonials_item['avatar']) : ?>
                                            <?php $avatar_img_url = wp_get_attachment_image_url($general_testimonials_item['avatar']); ?>
                                            <div class="profile-box-avatar"><img src="<?php echo $avatar_img_url; ?>" alt="<?php echo get_post_meta($general_testimonials_item['avatar'], '_wp_attachment_image_alt', true); ?>"></div>
                                        <?php endif; ?>
                                        <div class="profile-box-des">
                                            <p class="h5"><?= $general_testimonials_item['name']; ?></p>
                                            <a class="profile-link" href="<?= $general_testimonials_item['linkedin']; ?>"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>