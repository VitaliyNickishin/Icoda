<?php
$box_content_slider = get_field('box_content_slider');
?>

<section class="section section-box-content-slider">
    <div class="container pr-0">
        <div class="d-flex justify-content-between pr-3">
            <div class="position-relative">
                <h2 class="section-title mb-3 mb-lg-4">
                    <?php echo $box_content_slider['title']; ?>
                </h2>
                <?php if (!empty($box_content_slider['description'])) : ?>
                    <p class="subtitle mb-3 pb-3 mb-lg-4 pr-lg-5 mr-lg-4">
                        <?php echo $box_content_slider['description']; ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="">
                <div class="wr-control wr-control-box-content"></div>
            </div>
        </div>
            
        <div class="slider-box-content <?php echo is_rtl() ? 'slider-rtl' : ''; ?> custom-slider">
            <?php if (!empty($box_content_slider['slider_list'])) : ?>
                <?php foreach ($box_content_slider['slider_list'] as $box_info): ?>
                    <div class="service-card">
                        <div class="service-num"><?php echo $box_info['number']; ?></div>
                        <div class="service-eyebrow"><?php echo $box_info['eyebrow']; ?></div>
                        <div class="service-name"><?php echo $box_info['name']; ?></div>
                        <p class="service-desc"><?php echo $box_info['service_desc']; ?></p>
                        <ul class="tags">
                            <?php foreach ($box_info['tags_list'] as $tag): ?>
                                <li class="tag"><?php echo $tag['tag']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="service-card service-cta-card" id="service-cta">
                <div class="service-eyebrow"><?php echo $box_content_slider['banner_cta']['eyebrow']; ?></div>
                <div class="service-name"><?php echo $box_content_slider['banner_cta']['name']; ?></div>
                <p class="service-desc"><?php echo $box_content_slider['banner_cta']['service_desc']; ?></p>
                <?php if (!empty($box_content_slider['banner_cta']['btn_link'])) : ?>
                    <?php
                        $btn_link = $box_content_slider['banner_cta']['btn_link'];
                        $btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '#';
                        $btn_target = !empty($btn_link['target']) ? $btn_link['target'] : '_self';
                    ?>
                    <a class="btn btn-blue cta-service-card d-flex align-items-center justify-content-center gap-2" 
                        href="<?php echo esc_url($btn_url); ?>" 
                        target="<?php echo esc_attr($btn_target); ?>"
                    >
                        <?php echo $btn_link['title']; ?>
                        <i class="fas fa-long-arrow-alt-right arrow-long"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div> 
    </div>
</section>
