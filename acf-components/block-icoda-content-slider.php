<?php
$block_content = get_field('block_content');
?>
<section class="block-content-slider py-lg-5 py-4">
    
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="tag-undertitle mb-2 d-inline-block"><?php echo $block_content['tag']; ?></div>
                    <h2 class="h2 mb-4 section-title">
                        <?php echo $block_content['title']; ?>
                    </h2>
                    <ul class="content-list">
                        <?php foreach ($block_content['content_list'] as $item): ?>
                            <li>
                                <p class="fw-semibold"><?php echo $item['list_title']; ?></p>
                                <span><?php echo $item['list_text']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-12 col-lg-4 offset-lg-2 mt-3 pt-3 px-0">
                    <div class="slider-llm custom-slider">
                        <?php foreach ($block_content['slider'] as $slider): ?>
                            <div
                                class="slider-image">
                                <picture>
                                    <img src="<?php echo $slider['image']['url']; ?>" alt="<?php echo $slider['title']; ?>" />
                                </picture>
                                <p class="fw-semibold slider-title mt-2 mb-2 pb-1"><?php echo $slider['title']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="arrow-control arrow-control-llm"></div>
            
                </div>
                
            
            </div>
        </div>
    
</section>