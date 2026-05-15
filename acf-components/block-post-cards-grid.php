<?php
$cards_grid = get_field('cards_grid');
$id_section = !empty($cards_grid['id_section']) ? $cards_grid['id_section'] : '';
$has_bg = !empty($cards_grid['is_background_color']);
$bg_color = !empty($cards_grid['has_background_color'])
    ? $cards_grid['has_background_color']
    : '#f4f6f9';
?>
<section 
    <?php if ($id_section) : ?>
        id="<?php echo esc_attr($id_section); ?>"
    <?php endif; ?>
    class="section section-cards-grid py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>" 
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container">
        <div class="row py-lg-4">
            <div class="col-12 col-lg-6">
                <p class="abovetitle mb-1 text-primary">
                    <?php echo $cards_grid['above_title']; ?>
                </p>
                <h2 class="h2 mb-3 section-title">
                    <?php echo $cards_grid['title']; ?>
                </h2>
                <p class="subtitle">
                    <?php echo $cards_grid['subtitle']; ?>
                </p>
            </div>
            
            <div class="col-12">
               
                <?php if (!empty($cards_grid['cards_list'])) : ?>
                    <ul class="card-list mt-4 mt-lg-3 pt-lg-3">
                        <?php foreach ($cards_grid['cards_list'] as $card) : ?>
                            <?php
                                $link_url = !empty($card['link']) ? $card['link'] : '#';
                            ?>
                            <li
                                class="serv-box">
                                <?php if (!empty($card['image']['url'])) : ?>
                                    <a href="<?php echo esc_url($link_url); ?>" class="card-logo" target="_blank">
                                        <picture>
                                            <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['title']; ?>" />
                                        </picture>
                                    </a>
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