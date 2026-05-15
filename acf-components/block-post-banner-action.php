<?php
$banner_action = get_field('banner_action');
$has_bg = !empty($banner_action['is_background_color']);
$bg_color = !empty($banner_action['has_background_color'])
    ? $banner_action['has_background_color']
    : '#3c61e2';
?>
<section class="section section-banner-action py-5" 
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container py-lg-4">
        <div class="row">
            <div class="col-12 col-lg-5">
                <p class="abovetitle mb-1 text-primary">
                    <?php echo $banner_action['above_title']; ?>
                </p>
                <h2 class="h1 mb-3 pb-lg-1 section-title">
                    <?php echo $banner_action['title']; ?>
                </h2>
                <p class="subtitle">
                    <?php echo $banner_action['subtitle']; ?>
                </p>
            </div>
            
            <div class="col-12 offset-lg-1 col-lg-6 d-flex align-items-lg-center justify-content-lg-end justify-content-center">
               <?php if (!empty($banner_action['btn_text_modal']) || !empty($banner_action['btn_link_and_text_second'])) : ?>
                        <div class="section-banner-action__btn d-flex flex-column gap-3 mt-3 pt-3 pt-lg-0 mt-lg-0">
                            
                            <?php if (!empty($banner_action['btn_text_modal'])) : ?>
                                <a href="#" data-modal="#callback" class="btn btn-modal open-modal">
                                    <?php echo $banner_action['btn_text_modal']; ?>
                                    <i class="has-arrow"></i>
                                </a>
                            <?php endif; ?>
                            

                            <?php if (!empty($banner_action['btn_link_and_text_second'])) : ?>
                                <?php
                                    $btn_link = $banner_action['btn_link_and_text_second'];
                                    $btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '#';
                                    $btn_target = !empty($btn_link['target']) ? $btn_link['target'] : '_self';
                                ?>
                                <a class="btn d-flex align-items-center justify-content-center btn-second" 
                                    href="<?php echo esc_url($btn_url); ?>" 
                                    target="<?php echo esc_attr($btn_target); ?>"
                                >
                                    <?php echo $btn_link['title']; ?>
                                    <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 12px;"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                
            </div>
        </div>
    </div>
    
</section>