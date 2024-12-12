<?php
$items = get_field('pbmd_items');
?>
<section class="section-media-design indent pt-0 pt-lg-5">
    <div class="container">
        <div class="row">

            <?php foreach ($items as $key => $item_data) : ?>
                <div class="<?php echo ($key == 0) ? 'col-12 col-40' : 'col-12 col-60 mt-4 mt-lg-0 pr-lg-0'; ?>">
                    <div class="content-title <?php echo ($key == 0) ? 'mb-lg-5' : 'mb-lg-3'; ?>">
                        <p class="title <?php echo ($key == 0) ? '' : 'short'; ?>"><?php echo $item_data['title']; ?></p>
                    </div>
                    <div class="img-wrap pl-lg-1 <?php echo ($key == 0) ? 'first-img' : ''; ?>">
                        <img src="<?php echo $item_data['image']; ?>" alt="media-img">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>