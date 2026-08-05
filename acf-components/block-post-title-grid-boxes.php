<?php
$tilte_grid_boxes = get_field('title_grid_boxes');
?>
<section class="section section-title-grid-boxes py-5">
    
    <div class="container py-lg-4">
        
            <div class="section-title-grid-boxes__content text-center mb-4 pb-3">
                <?php if (!empty($tilte_grid_boxes['above_title'])) : ?>
                    <p class="abovetitle mb-1">
                        <?php echo $tilte_grid_boxes['above_title']; ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($tilte_grid_boxes['title'])) : ?>
                    <h2 class="h1 mb-3 section-title">
                        <?php echo $tilte_grid_boxes['title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($tilte_grid_boxes['subtitle'])) : ?>
                    <p class="subtitle">
                        <?php echo $tilte_grid_boxes['subtitle']; ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="section-title-grid-boxes__list">
                <?php if (!empty($tilte_grid_boxes['cards_list'])) : ?>
                    <ul class="card-list text-center">
                        <?php foreach ($tilte_grid_boxes['cards_list'] as $card) : ?>
                            
                            <li
                                class="card-list-item">
                                <?php if (!empty($card['image']['url'])) : ?>
                                    
                                        <span class="card-logo">
                                            <picture>
                                                <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['title']; ?>" />
                                            </picture>
                                        </span>
                                    
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
    
</section>