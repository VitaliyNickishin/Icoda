<?php
$cards_grid = get_field('cards_grid');
$id_section = !empty($cards_grid['id_section']) ? $cards_grid['id_section'] : '';
$has_bg = !empty($cards_grid['is_background_color']);
$bg_color = !empty($cards_grid['has_background_color'])
    ? $cards_grid['has_background_color']
    : '#f4f6f9';
?>
<section 
    class="section section-cards-grid-review py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>" 
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container">
        <div class="row py-lg-4">
            <div class="col-12 col-lg-6">
                <?php if (!empty($cards_grid['above_title'])) : ?>
                    <p class="abovetitle mb-1 text-primary">
                        <?php echo $cards_grid['above_title']; ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($cards_grid['title'])) : ?>
                    <h2 class="h2 mb-2 section-title">
                        <?php echo $cards_grid['title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($cards_grid['subtitle'])) : ?>
                    <p class="subtitle">
                        <?php echo $cards_grid['subtitle']; ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <div class="col-12">
               
                <?php if (!empty($cards_grid['cards_list'])) : ?>
                    <ul class="card-list mt-4 mt-lg-3 pt-lg-3">
                        <?php foreach ($cards_grid['cards_list'] as $card) : ?>
                            <?php
                                $link_url = !empty($card['link']) ? $card['link'] : '#';
                            ?>
                            <li
                                class="card-list-item serv-box">
                                <?php if (!empty($card['link'])) : ?>
                                    <a href="<?php echo esc_url($link_url); ?>" class="card-item" target="_blank">
                                        <?php else : ?>
                                    <div class="card-item">
                                <?php endif; ?>           
                                        <div class="card-item-top">
                                            <?php if (!empty($card['image']['url'])) : ?>
                                                <span class="card-logo">
                                                    <picture>
                                                        <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['title']; ?>" />
                                                    </picture>
                                                </span>
                                            <?php endif; ?>

                                            <?php if (!empty($card['name'])) : ?>
                                                <h3 class="name">
                                                    <?php echo $card['name']; ?>
                                                </h3>
                                            <?php endif; ?>
                                            <?php if (!empty($card['rating_first'])) : ?>
                                                <span class="rating">
                                                    <span class="rating-first">
                                                        <?php echo $card['rating_first']; ?>
                                                    </span>
                                                    <span class="rating-total">
                                                        <?php if (!empty($card['rating_total'])) : ?>
                                                            /<?php echo $card['rating_total']; ?>
                                                        <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-item-bottom">
                                            <div class="stars">
                                                <span aria-hidden="true" style="display: inline-flex; gap: 3px;"><i class="fas fa-star" style="color: rgb(239, 64, 53); font-size: 14px;"></i><i class="fas fa-star" style="color: rgb(239, 64, 53); font-size: 14px;"></i><i class="fas fa-star" style="color: rgb(239, 64, 53); font-size: 14px;"></i><i class="fas fa-star" style="color: rgb(239, 64, 53); font-size: 14px;"></i><i class="fas fa-star" style="color: rgb(239, 64, 53); font-size: 14px;"></i></span>
                                            </div>
                                            <div class="reviews-info">
                                                <?php if (!empty($card['reviews_info'])) : ?>
                                                    <?php echo $card['reviews_info']; ?>
                                                    <i class="fas fa-long-arrow-alt-right arrow-long"></i>
                                                    <!-- <span aria-hidden="true">→</span> -->
                                                <?php endif; ?>
                                            </div>
                                            
                                        </div>
                                <?php if (!empty($card['link'])) : ?>
                                    </a>
                                        <?php else : ?>
                                    </div>
                                <?php endif; ?>   
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
</section>