<?php
$box_content = get_field('box_content');
$template_directory_uri = get_template_directory_uri();

$boxes = $box_content['box_info'] ?? [];

?>

<section class="block-slider-four-box py-4 py-lg-5">
    <div class="container">

        <?php if (!empty($box_content['block_title'])): ?>
            <h3 class="block-title">
                <?php echo esc_html($box_content['block_title']); ?>
            </h3>
        <?php endif; ?>

        <?php if (!empty($boxes)): ?>
            <div class="row slider-four-box custom-slider pl-2 pl-lg-0 mx-lg-n2">

                <?php foreach ($boxes as $box): ?>
                    <div class="col col-xl-3 px-2">
                        <a href="<?php echo esc_url($box['box_link']['url'] ?? '#'); ?>" class="box-card card-has-rotate-arrow">

                            <?php if (!empty($box['box_icon'])): ?>
                                <div class="box-icon">
                                    <?php echo file_get_contents($box['box_icon']['url']); ?>
                                </div>
                            <?php endif; ?>

                            <div class="box-card-header">
                                <span class="h4 box-title pr-3">
                                    <?php echo esc_html($box['box_title']); ?>
                                </span>

                                <img
                                    class="btn-arrow"
                                    src="<?php echo esc_url($template_directory_uri . '/assets/images/btn-circle.svg'); ?>"
                                    alt="Read more"
                                />
                            </div>

                            <div class="box-description">
                                <?php echo wp_kses_post($box['box_description']); ?>
                            </div>

                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>
