<?php
    $block_content = get_field('block_content');
    $btn_link = $block_content['button'];
    $btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '#';
    $btn_target = !empty($btn_link['target']) ? $btn_link['target'] : '_self';
    
?>
<section class="block-content-slider-edit-box py-lg-5 py-4">
    
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <?php if (!empty($block_content['title'])) : ?>
                        <h2 class="h2 mb-4 section-title">
                            <?php echo $block_content['title']; ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($block_content['subtitle'])) : ?>
                        <p class="subtitle mt-2">
                            <?php echo $block_content['subtitle']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($btn_link)) : ?>
                        <a class="mt-4 btn d-flex align-items-center justify-content-center btn-outline-blue gap-2 btn-arrow" 
                            href="<?php echo esc_url($btn_url); ?>" 
                            target="<?php echo esc_attr($btn_target); ?>"
                        >
                            <?php echo $btn_link['title']; ?>
                            <i class="fas fa-long-arrow-alt-right arrow-long"></i>
                        </a>
                    <?php endif; ?>
                    
                </div>
                <div class="col-12 col-lg-6 offset-lg-1 mt-3 pt-3">
                    <div class="slider-edit-box custom-slider">
                        <?php foreach ($block_content['slider'] as $slider): ?>
                            <?php
                                $background = $slider['background_type'] ?? '';

                                $card_class = !empty($background)
                                    ? 'card-item--' . esc_attr($background)
                                    : 'card-item--transparent';
                                ?>
                            <li
                                class="card-list-item serv-box">
                                <?php if (!empty($slider['link'])) : ?>
                                    <a href="<?php echo esc_url($slider['link']); ?>" 
                                        class="card-item <?php echo $card_class; ?>" 
                                        target="_blank"
                                        >
                                        <?php else : ?>
                                    <div class="card-item <?php echo $card_class; ?>">
                                <?php endif; ?>           
                                        <div class="card-item-top">
                                            <?php if (!empty($slider['image']['url'])) : ?>
                                                <span class="card-logo">
                                                    <picture>
                                                        <img src="<?php echo $slider['image']['url']; ?>" alt="<?php echo $slider['title']; ?>" />
                                                    </picture>
                                                </span>
                                            <?php endif; ?>

                                            <?php if (!empty($slider['name'])) : ?>
                                                <h3 class="name">
                                                    <?php echo $slider['name']; ?>
                                                </h3>
                                            <?php endif; ?>
                                            <?php if (!empty($slider['is_rating'] && $slider['rating_first'])) : ?>
                                                <span class="rating">
                                                    <span class="rating-first">
                                                        <?php echo $slider['rating_first']; ?>
                                                    </span>
                                                    <span class="rating-total">
                                                        <?php if (!empty($slider['rating_total'])) : ?>
                                                            /<?php echo $slider['rating_total']; ?>
                                                        <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($slider['is_rating'])) : ?>
                                            <div class="card-item-bottom">
                                                <div class="stars">
                                                    <?php for ($i = 0; $i < 5; $i++) : ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <div class="reviews-info">
                                                    <?php if (!empty($slider['reviews_info'])) : ?>
                                                        <?php echo $slider['reviews_info']; ?>
                                                        <?php if (!empty($slider['link'])) : ?>
                                                            <i class="fas fa-long-arrow-alt-right arrow-long"></i>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                <?php if (!empty($slider['link'])) : ?>
                                    </a>
                                        <?php else : ?>
                                    </div>
                                <?php endif; ?>   
                            </li>
                        <?php endforeach; ?>
                    </div>
                </div>
                
            
            </div>
        </div>
    
</section>