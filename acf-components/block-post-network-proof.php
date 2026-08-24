<?php
$network_proof = get_field('network_proof');

$id_section = !empty($network_proof['id_section']) ? $network_proof['id_section'] : '';
$has_bg     = !empty($network_proof['is_background_color']);
$bg_color   = !empty($network_proof['has_background_color'])
    ? $network_proof['has_background_color']
    : '#f4f6f9';

$seconds = !empty($network_proof['marquee_seconds']) ? (int) $network_proof['marquee_seconds'] : 42;
if ($seconds < 5 || $seconds > 300) {
    $seconds = 42;
}
?>
<section
    <?php if ($id_section) : ?>
        id="<?php echo esc_attr($id_section); ?>"
    <?php endif; ?>
    class="section section-network-proof py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>"
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container">

        <?php
        $has_subtitle = !empty($network_proof['subtitle']);
        if (!empty($network_proof['title']) || $has_subtitle) :
            ?>
            <div class="row align-items-end">
                <div class="col-12 <?php echo $has_subtitle ? 'col-lg-6' : ''; ?>">
                    <?php if (!empty($network_proof['above_title'])) : ?>
                        <p class="abovetitle mb-1 text-primary">
                            <?php echo wp_kses_post($network_proof['above_title']); ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($network_proof['title'])) : ?>
                        <h2 class="section-title"><?php echo wp_kses_post($network_proof['title']); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ($has_subtitle) : ?>
                    <div class="col-12 col-lg-6">
                        <p class="subtitle"><?php echo wp_kses_post($network_proof['subtitle']); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($network_proof['items'])) : ?>
            <div class="row mt-3 mt-lg-4">
                <?php foreach ($network_proof['items'] as $item) : ?>
                    <div class="col-12 col-md-4 py-2 py-md-0">
                        <div class="np-stat">
                            <div class="np-stat-value"><?php echo esc_html($item['value']); ?></div>
                            <div class="np-stat-label"><?php echo esc_html($item['text']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($network_proof['media_list'])) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="np-featured">
                        <?php if (!empty($network_proof['media_label'])) : ?>
                            <div class="np-featured-label">
                                <?php echo esc_html($network_proof['media_label']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="np-marquee">
                            <div class="np-marquee-track" style="animation-duration: <?php echo esc_attr($seconds); ?>s;">
                                <?php
                                /*
                                 * Printed twice: the track scrolls by exactly -50%, so the second
                                 * copy is what makes the loop seamless. Hidden from assistive tech
                                 * so the outlets are not announced twice.
                                 */
                                for ($copy = 0; $copy < 2; $copy++) :
                                    ?>
                                    <div class="np-marquee-group"<?php echo 0 === $copy ? ' aria-label="' . esc_attr__('Media outlets we have placed coverage in', 'icoda') . '"' : ' aria-hidden="true"'; ?>>
                                        <?php foreach ($network_proof['media_list'] as $media) : ?>
                                            <?php if (!empty($media['image'])) : ?>
                                                <?php
                                                echo wp_get_attachment_image(
                                                    $media['image'],
                                                    'medium',
                                                    false,
                                                    array(
                                                        'class'   => 'np-marquee-logo',
                                                        'alt'     => !empty($media['name']) ? esc_attr($media['name']) : '',
                                                        'loading' => 'lazy',
                                                    )
                                                );
                                                ?>
                                            <?php elseif (!empty($media['name'])) : ?>
                                                <span><?php echo esc_html($media['name']); ?></span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
