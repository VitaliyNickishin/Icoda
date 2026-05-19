<?php
$grid_logos = get_field('grid_logos');
$id_section = !empty($grid_logos['id_section']) ? $grid_logos['id_section'] : '';
$has_bg = !empty($grid_logos['is_background_color']);
$bg_color = !empty($grid_logos['has_background_color'])
    ? $grid_logos['has_background_color']
    : '#f4f6f9';
$has_bg_inner = !empty($grid_logos['is_background_color_inner']);
$bg_color_inner = !empty($grid_logos['has_background_color_inner'])
    ? $grid_logos['has_background_color_inner']
    : '#f4f6f9';
?>
<section 
    class="section section-grid-logos py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>" 
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container py-lg-4">
        <?php if (!empty($grid_logos['above_title'])) : ?>
            <p class="abovetitle mb-1 text-primary">
                <?php echo $grid_logos['above_title']; ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($grid_logos['title'])) : ?>
            <h2 class="h2 mb-2 section-title">
                <?php echo $grid_logos['title']; ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($grid_logos['subtitle'])) : ?>
            <p class="subtitle pb-lg-3">
                <?php echo $grid_logos['subtitle']; ?>
            </p>
        <?php endif; ?>
        <div class="section-grid-logos__inner mt-4 mt-lg-3 <?php echo $has_bg_inner ? '' : 'has-bg' ?>"
            <?php if ($has_bg_inner) : ?>
                style="background-color: <?php echo esc_attr($bg_color); ?>;"
            <?php endif; ?>
        > 
            <?php if (!empty($grid_logos['logos_list'])) : ?>
                <ul class="logos-list">
                    <?php foreach ($grid_logos['logos_list'] as $logo) : ?>
                        <li>
                            <?php if (!empty($logo['link'])) : ?>
                                <a href="<?php echo esc_url($logo['link']); ?>" class="logos-item" target="_blank">
                                    <?php else : ?>
                                <div class="logos-item">
                            <?php endif; ?>    
                                <?php if (!empty($logo['image']['url'])) : ?>
                                    <span class="logo">
                                        <picture>
                                            <img src="<?php echo $logo['image']['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                                        </picture>
                                    </span>
                                    <?php else : ?>
                                        <span class="logos-item-placeholder">
                                            <?php echo $logo['alt']; ?>
                                        </span>
                                <?php endif; ?>  
                            <?php if (!empty($logo['link'])) : ?>
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
    
</section>