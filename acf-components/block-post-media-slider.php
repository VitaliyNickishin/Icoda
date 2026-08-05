<?php 
    $media_slider = get_field('media_slider'); 
?>

<section class="section-media my-lg-2 py-lg-5 py-4 my-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <?php if (!empty($media_slider['title'])) : ?>
                        <h2 class="section-title h3"><?php echo $media_slider['title']; ?></h2>
                    <?php endif; ?>
                    <div class="wr-control wr-controls wr-control-media"></div>
                </div>
                <?php if (!empty($media_slider['subtitle'])) : ?>
                    <p class="subtitle mt-2">
                        <?php echo $media_slider['subtitle']; ?>
                    </p>
                <?php endif; ?>
                
            </div>
        </div>
        <div class="col-12 col-right">
            <div class="wr-slider">
                <div class="slider-media custom-slider">
                    <?php foreach ($media_slider['items'] as $media_slider_item) : ?>
                        <a href="<?php echo $media_slider_item['link']; ?>" class="media-box" target="_blank">
                            <div class="media-img">
                                <img src="<?php echo $media_slider_item['logo']; ?>" alt="">
                            </div>
                            <div class="media-description">
                                <p><?php echo $media_slider_item['description']; ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
    </div>
</section>