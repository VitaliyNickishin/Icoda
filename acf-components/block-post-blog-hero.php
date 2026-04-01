<?php
$hero_section = get_field('hero_section');
?>
<section class="section section-blog-hero pb-5">
    <div class="section-blog-hero__inner position-relative with-gradient with-gradient-pink with-gradient-blue">
    
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <?php if (!empty($hero_section['above_title'])) : ?>
                        <p class="abovetitle mb-1 text-primary">
                            <?php echo $hero_section['above_title']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['title'])) : ?>
                        <h1 class="h1 mb-4 title">
                            <?php echo $hero_section['title']; ?>
                        </h1>
                    <?php endif; ?>
                    <?php if (!empty($hero_section['subtitle'])) : ?>
                        <p class="undertitle">
                            <?php echo $hero_section['subtitle']; ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <div class="col-12 col-lg-5 pr-lg-0 mt-5 mt-lg-0 d-flex justify-content-lg-end justify-content-center">
                   
                    <?php if (!empty($hero_section['cases_box'])) : ?>
                        <ul class="cases-box">
                            <?php foreach ($hero_section['cases_box'] as $key => $item) : ?>
                            <li class="serv-box">
                                <?php if (!empty($item['number'])) : ?>
                                    <span class="number"><?php echo $item['number']; ?></span>
                                <?php endif; ?>
                                <?php if (!empty($item['text'])) : ?>
                                    <p class="text"><?php echo $item['text']; ?></p>
                                <?php endif; ?>
                                
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                
            </div>
            <?php if (!empty($hero_section['media_list'])) : ?>

                <div class="row mt-lg-2">
                    <div class="col-12 pr-0">
                        <div class="mt-4 pt-lg-4">
                            <div class="section-hero-ai-seo__slider hero-slider-ai-seo custom-slider">
                                <?php foreach ($hero_section['media_list'] as $media) : ?>

                                    <div
                                        class="media-logo">
                                        <picture>
                                            <img src="<?php echo $media['image']['url']; ?>" alt="<?php echo $media['title']; ?>" />
                                        </picture>
                                        <span class="media-title">
                                            <?php echo $media['title']; ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>