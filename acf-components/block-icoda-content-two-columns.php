<?php
$block_content = get_field('block_content');
?>
<section class="block-content-two-columns py-lg-5 py-4">
    
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2 mb-lg-4 mb-4 pb-lg-3 section-title">
                        <?php echo $block_content['title']; ?>
                    </h2>
                </div>
                <div class="box-content-slider custom-slider d-md-flex">
                    <div class="first-column">
                        <div class="box-content ">
                            <div class="box-card mb-3">
                                <p class="box-title fw-semibold text-primary">
                                    <?php echo $block_content['first_column']['box_title']; ?>
                                </p>
                                <span class="fw-semibold"><?php echo $block_content['first_column']['box_subtitle']; ?></span>
                            </div>
                            
                            <ul class="box-list">
                                <?php foreach ($block_content['first_column']['box_list'] as $item): ?>
                                    <li><?php echo $item['list_content']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="second-column">
                        <div class="box-content ">
                            <div class="box-card mb-3">
                                <p class="box-title fw-semibold">
                                    <?php echo $block_content['second_column']['box_title']; ?>
                                </p>
                                <span class="fw-semibold"><?php echo $block_content['second_column']['box_subtitle']; ?></span>
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
        </div>
    
</section>