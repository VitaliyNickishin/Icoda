<?php
$classes = [
    'first',
    'second',
    'third',
    'fourth',
];
$data = get_field('home_gradient_counters');
?>
<div class="info-about-us">
    <?php foreach ($data as $key => $item_data) : ?>
        <div class="<?php echo $classes[$key]; ?>-block info-block d-flex align-items-center">
            <div class="info-block__img">
                <?php foreach ($item_data['images'] as $image_src) : ?>

                    <img
                        class="avatar"
                        src="<?php echo $image_src; ?>"
                        width="40px"
                        height="40px"
                        alt="">
                <?php endforeach; ?>
            </div>
            <div class="info-block__digital">
                <span class="number">
                    <?php echo $item_data['value']; ?><?php if (!empty($item_data['with_plus'])) : ?><span class="symbol">+</span><?php endif; ?>
                </span>
                <p class="text"><?php echo $item_data['text']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>