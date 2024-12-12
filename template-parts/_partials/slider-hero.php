<!-- hero slider -->
<?php
$data = get_field('home_gradient_slider');
?>
<div class="hero-slider custom-slider">
    <?php foreach ($data as $key => $item_data) : ?>
        <div
            class="media-logo"
            title="<?php echo $item_data['text']; ?>">
            <picture>
                <img src="<?php echo $item_data['image']; ?>" alt="<?php echo $item_data['text']; ?>" />
            </picture>
            <span class="media-title">
                <?php echo $item_data['text']; ?>
            </span>
        </div>
    <?php endforeach; ?>
</div>