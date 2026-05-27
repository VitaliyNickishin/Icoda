<?php
$content_grid_boxes = get_field('content_grid_boxes');
$has_bg = !empty($content_grid_boxes['is_background_color']);
$bg_color = !empty($content_grid_boxes['has_background_color'])
    ? $content_grid_boxes['has_background_color']
    : '#3c61e2';
?>
<section class="section section-content-grid-boxes py-5">
    
    <div class="container py-lg-4">
        <div class="section-content-grid-boxes__inner <?php echo $has_bg ? '' : 'has-bg-gradient' ?>"
            <?php if ($has_bg) : ?>
                style="background-color: <?php echo esc_attr($bg_color); ?>;"
            <?php endif; ?>
        >
            <div class="section-content-grid-boxes__content">
                <?php if (!empty($content_grid_boxes['above_title'])) : ?>
                    <p class="abovetitle mb-1">
                        <?php echo $content_grid_boxes['above_title']; ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($content_grid_boxes['title'])) : ?>
                    <h2 class="h1 mb-3 section-title">
                        <?php echo $content_grid_boxes['title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($content_grid_boxes['subtitle'])) : ?>
                    <p class="subtitle">
                        <?php echo $content_grid_boxes['subtitle']; ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="section-content-grid-boxes__list">
                <?php if (!empty($content_grid_boxes['cards_list'])) : ?>
                    <ul class="card-list">
                        <?php foreach ($content_grid_boxes['cards_list'] as $card) : ?>
                            <?php
                                $link_url = !empty($card['link']) ? $card['link'] : '#';
                            ?>
                            <li
                                class="card-list-item serv-box">
                                <?php if (!empty($card['image']['url'])) : ?>
                                    <?php if (!empty($card['link'])) : ?>
                                        <a href="<?php echo esc_url($link_url); ?>" target="_blank">
                                    <?php endif; ?>
                                        <span class="card-logo">
                                            <picture>
                                                <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['title']; ?>" />
                                            </picture>
                                        </span>
                                    <?php if (!empty($card['link'])) : ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($card['title'])) : ?>
                                    <h3 class="title">
                                        <?php echo $card['title']; ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if (!empty($card['description'])) : ?>
                                    <span class="description">
                                        <?php echo $card['description']; ?>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>            
            </div>
        </div>
    </div>
    
</section>