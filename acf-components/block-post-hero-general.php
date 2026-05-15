<?php
    $hero_section = get_field('hero_section');
    $btn_link = $hero_section['btn_link_secondary'];
    $btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '#';
    $btn_target = !empty($btn_link['target']) ? $btn_link['target'] : '_self';
?>
<section class="section section-cases-hero-new section-hero-general py-5">
    <div class="section-hero-general__inner position-relative with-gradient with-gradient-pink with-gradient-blue">
    
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <?php if (!empty($hero_section['above_title'])) : ?>
                        <p class="abovetitle mb-1 text-primary">
                            <?php echo $hero_section['above_title']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['title'])) : ?>
                        <h1 class="h1 mb-3 mb-lg-4 section-title fw-bold">
                            <?php echo $hero_section['title']; ?>
                        </h1>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['subtitle'])) : ?>
                        <p class="subtitle">
                            <?php echo $hero_section['subtitle']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['btn_text_modal']) || !empty($hero_section['btn_text_second'])) : ?>
                        <div class="section-hero-new__btn d-flex flex-column flex-sm-row mt-4 mt-lg-4 pt-lg-2">
                            <?php if (!empty($hero_section['btn_text_modal'])) : ?>
                                <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
                                    <?php echo $hero_section['btn_text_modal']; ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($btn_link)) : ?>
                                
                                <a class="btn d-flex align-items-center justify-content-center btn-outline-blue" 
                                    href="<?php echo esc_url($btn_url); ?>" 
                                    target="<?php echo esc_attr($btn_target); ?>"
                                >
                                    <?php echo $btn_link['title']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-12 col-lg-5 d-flex align-items-center justify-content-lg-end justify-content-center">
                    <?php if (!empty($hero_section['has_image_background'])) : ?>
                        <div class="bg-wrap d-lg-block d-none" style="background-image: url(<?php echo $hero_section['has_image_background']; ?>);"></div>
                    <?php endif; ?>

                    <?php if (!empty($hero_section['items'])) : ?>
                        <div class="cases-box mt-3 mt-lg-0 pt-3 pt-lg-0">
                            <?php foreach ($hero_section['items'] as $item_data) : ?>
                                <div class="serv-box">
                                    <span class="number"><?php echo $item_data['value']; ?></span>
                                    <p><?php echo $item_data['text']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($hero_section['media_list'])) : ?>

                <div class="row mt-lg-2">
                    <div class="col-12 pr-0">
                        <div class="mt-4 pt-lg-4">
                            <div class="section-hero-ai-seo__slider hero-slider-ai-seo custom-slider">
                                <?php foreach ($hero_section['media_list'] as $media) : ?>

                                    <div
                                        class="media-logo">
                                        <picture>
                                            <img src="<?php echo $media['image']['url']; ?>" alt="<?php echo $media['title']; ?>" />
                                        </picture>
                                        <span class="media-title">
                                            <?php echo $media['title']; ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
                
            
        </div>
    </div>
</section>