<?php
$banner_badge = get_field('banner_badge');
$has_bg = !empty($banner_action['is_background_color']);
$bg_color = !empty($banner_action['has_background_color'])
    ? $banner_action['has_background_color']
    : '#3c61e2';
?>
<section class="section section-banner-badge py-5">
    
    <div class="container py-lg-4">
        <div class="section-banner-badge__inner <?php echo $has_bg ? '' : 'has-bg-gradient' ?>"
            <?php if ($has_bg) : ?>
                style="background-color: <?php echo esc_attr($bg_color); ?>;"
            <?php endif; ?>
        >
        
            <div class="section-banner-badge__image">
                <?php if (!empty($banner_badge['badge_big']['url'])) : ?>
                    <div class="badge-big">
                        <picture>
                            <img src="<?php echo $banner_badge['badge_big']['url']; ?>" alt="<?php echo $banner_badge['badge_alt']; ?>" />
                        </picture>
                    </div>
                <?php endif; ?>               
            </div>
            
            <div class="section-banner-badge__content">
                <?php if (!empty($banner_badge['above_title'])) : ?>
                    <p class="abovetitle mb-1">
                        <?php echo $banner_badge['above_title']; ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($banner_badge['title'])) : ?>
                    <h2 class="h1 mb-3 section-title">
                        <?php echo $banner_badge['title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($banner_badge['subtitle'])) : ?>
                    <p class="subtitle">
                        <?php echo $banner_badge['subtitle']; ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($banner_badge['btn_text'])) : ?>
                    <div class="section-banner-badge__btn mt-3 pb-lg-2 pb-1">
                        <a href="#" data-modal="#callback" class="btn btn-blue btn-modal open-modal">
                            <?php echo $banner_badge['btn_text']; ?>
                            <i class="fas fa-long-arrow-alt-right arrow-long"></i>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if (!empty($banner_badge['badge_list'])) : ?>
                    <div class="section-banner-badge__list mt-4 pt-lg-4 pt-3">
                        <?php foreach ($banner_badge['badge_list'] as $badge) : ?>
                            <div class="badge-small serv-box">
                                <picture>
                                    <img src="<?php echo $badge['image']['url']; ?>" alt="<?php echo $badge['alt']; ?>" />
                                </picture>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
</section>