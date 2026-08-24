<?php
$full_cycle = get_field('full_cycle');

$id_section = !empty($full_cycle['id_section']) ? $full_cycle['id_section'] : '';
$has_bg     = !empty($full_cycle['is_background_color']);
$bg_color   = !empty($full_cycle['has_background_color'])
    ? $full_cycle['has_background_color']
    : '#f4f6f9';

$steps = !empty($full_cycle['steps_list']) ? $full_cycle['steps_list'] : array();

// Four across on desktop, but fall back to quarters for any other row length.
$col_lg = (count($steps) > 0 && count($steps) <= 4 && 0 === 12 % count($steps))
    ? 12 / count($steps)
    : 3;
?>
<section
    <?php if ($id_section) : ?>
        id="<?php echo esc_attr($id_section); ?>"
    <?php endif; ?>
    class="section section-full-cycle py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>"
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container">

        <?php if (!empty($full_cycle['title']) || !empty($full_cycle['subtitle'])) : ?>
            <div class="row">
                <div class="col-12">
                    <?php if (!empty($full_cycle['above_title'])) : ?>
                        <p class="abovetitle mb-1 text-primary">
                            <?php echo wp_kses_post($full_cycle['above_title']); ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($full_cycle['title'])) : ?>
                        <h2 class="section-title"><?php echo wp_kses_post($full_cycle['title']); ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($full_cycle['subtitle'])) : ?>
                        <p class="subtitle"><?php echo wp_kses_post($full_cycle['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($steps) : ?>
            <div class="row mt-2 mt-lg-4">
                <?php foreach ($steps as $index => $step) : ?>
                    <div class="col-12 col-md-6 col-lg-<?php echo esc_attr($col_lg); ?> py-2 py-lg-0">
                        <div class="fc-step">
                            <div class="fc-step-num"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></div>
                            <?php if (!empty($step['title'])) : ?>
                                <div class="fc-step-title"><?php echo wp_kses_post($step['title']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($step['description'])) : ?>
                                <div class="fc-step-text"><?php echo wp_kses_post($step['description']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
