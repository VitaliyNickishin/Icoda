<?php
    $logos = get_field('logos');
?>

<section class="section-logos-slider-infinite my-lg-2 py-lg-5 py-4 my-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h3 class="section-title mb-4">
                    <?php the_field('title'); ?>
                </h3>
            </div>
            <div class="col-12 pr-0">
                <div class="slider-logos-infinite custom-slider">
                    <?php foreach ($logos as $logo_info): ?>
                        <div
                            class="media-logo <?php echo !empty($logo_info['has_white_font']) ? ' has-white-font ' : ''; ?>">
                            <picture>
                                <img src="<?php echo $logo_info['image']['url']; ?>" alt="<?php echo $logo_info['alt']; ?>" />
                            </picture>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="blur-box blur-box-left"></div>
                <div class="blur-box blur-box-right"></div>
            </div>
        </div>
    </div>
</section>