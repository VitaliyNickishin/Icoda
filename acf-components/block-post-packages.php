<?php
$packages = get_field('packages');

$id_section = !empty($packages['id_section']) ? $packages['id_section'] : '';
$has_bg     = !empty($packages['is_background_color']);
$bg_color   = !empty($packages['has_background_color'])
    ? $packages['has_background_color']
    : '#f4f6f9';

$cards      = !empty($packages['cards_list']) ? $packages['cards_list'] : array();
$bottom_btn = !empty($packages['bottom_btn_link']) ? $packages['bottom_btn_link'] : array();

// Four across on desktop, but fall back to quarters for any other row length.
$col_lg = (count($cards) > 0 && count($cards) <= 4 && 0 === 12 % count($cards))
    ? 12 / count($cards)
    : 3;
?>
<section
    <?php if ($id_section) : ?>
        id="<?php echo esc_attr($id_section); ?>"
    <?php endif; ?>
    class="section section-packages py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>"
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container">

        <?php if (!empty($packages['title']) || !empty($packages['subtitle'])) : ?>
            <div class="row">
                <div class="col-12">
                    <?php if (!empty($packages['above_title'])) : ?>
                        <p class="abovetitle mb-1 text-primary">
                            <?php echo wp_kses_post($packages['above_title']); ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($packages['title'])) : ?>
                        <h2 class="section-title"><?php echo wp_kses_post($packages['title']); ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($packages['subtitle'])) : ?>
                        <p class="subtitle"><?php echo wp_kses_post($packages['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($cards) : ?>
            <div class="row mt-2 mt-lg-4">
                <?php
                foreach ($cards as $card) :
                    $is_highlighted = !empty($card['is_highlighted']);
                    $badge          = $is_highlighted && !empty($card['badge_text']) ? $card['badge_text'] : '';
                    $btn            = !empty($card['btn_link']) ? $card['btn_link'] : array();
                    $card_class     = $is_highlighted ? 'pk-card pk-card-featured' : 'pk-card';
                    $btn_class      = $is_highlighted ? 'btn btn-blue' : 'btn btn-outline-blue';
                    ?>
                    <div class="col-12 col-md-6 col-lg-<?php echo esc_attr($col_lg); ?> pk-col">
                        <div class="<?php echo esc_attr($card_class); ?>">
                            <?php if ($badge) : ?>
                                <div class="pk-badge"><?php echo esc_html($badge); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($card['name'])) : ?>
                                <div class="pk-name"><?php echo wp_kses_post($card['name']); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($card['description'])) : ?>
                                <div class="pk-tagline"><?php echo wp_kses_post($card['description']); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($card['features_list'])) : ?>
                                <ul class="pk-list">
                                    <?php foreach ($card['features_list'] as $feature) : ?>
                                        <li><span><?php echo wp_kses_post($feature['description']); ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty($btn['url'])) : ?>
                                <a class="<?php echo esc_attr($btn_class); ?>" href="<?php echo esc_url($btn['url']); ?>">
                                    <?php echo esc_html(!empty($btn['title']) ? $btn['title'] : __('Get a custom quote', 'icoda')); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($packages['bottom_title']) || !empty($packages['bottom_subtitle']) || !empty($bottom_btn['url'])) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="pk-more">
                        <div>
                            <?php if (!empty($packages['bottom_title'])) : ?>
                                <div class="pk-more-title"><?php echo wp_kses_post($packages['bottom_title']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($packages['bottom_subtitle'])) : ?>
                                <div class="pk-more-text"><?php echo wp_kses_post($packages['bottom_subtitle']); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($bottom_btn['url'])) : ?>
                            <a class="btn btn-blue" href="<?php echo esc_url($bottom_btn['url']); ?>">
                                <?php echo esc_html(!empty($bottom_btn['title']) ? $bottom_btn['title'] : __('Get in touch', 'icoda')); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
