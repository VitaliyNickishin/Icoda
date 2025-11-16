<?php
$block_content = get_field('block_content');
?>
<section class="block-content-two-columns py-lg-5 py-4">
    
        <div class="container">
            <h2 class="h2 mb-4 section-title">
                <?php echo $block_content['title']; ?>
            </h2>
            
            <div class="row box-content-slider custom-slider py-md-3">
                <div class="col col-md-6 first-column px-md-2">
                    <div class="box-content">
                        <div class="box-card-wrap position-relative">
                            <div class="box-card mb-3">
                                <p class="box-title fw-semibold text-primary">
                                    <?php echo $block_content['first_column']['box_title']; ?>
                                </p>
                                <span class="fw-semibold"><?php echo $block_content['first_column']['box_subtitle']; ?></span>
                            </div>
                        </div>
                        
                        <ul class="box-list">
                            <?php foreach ($block_content['first_column']['box_list'] as $item): ?>
                                <li><?php echo $item['list_content']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-6 second-column px-md-2">
                    
                    <div class="box-content ">
                        <div class="box-card-wrap position-relative">
                            <div class="box-card mb-3 position-relative">
                                <div class="decor"></div>
                                <p class="box-title fw-semibold">
                                    <?php echo $block_content['second_column']['box_title']; ?>
                                </p>
                                <span class="fw-semibold"><?php echo $block_content['second_column']['box_subtitle']; ?></span>
                            </div>
                        </div>
                        
                        <ul class="box-list">
                            <?php foreach ($block_content['second_column']['box_list'] as $item): ?>
                                <li><?php echo $item['list_content']; ?></li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>
            </div>
                
        </div>
    
</section>