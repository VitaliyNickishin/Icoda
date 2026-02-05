<?php
$block_content = get_field('checklist_two_columns');
?>
<section class="block-post-checklist-two-columns py-lg-5 py-4">
    
        <div class="container">
            <h2 class="h2 mb-4 pb-3 block-title">
                <?php echo $block_content['title_block']; ?>
            </h2>
            
            <div class="box-content-wrap">
                <?php foreach ($block_content['box_checklist'] as $key => $box) : ?>
                    
                    <div class="box-content serv-box">
                        <?php if ($box['has_label']) : ?>
                            <div class="tag-undertitle"><?php echo $box['text_label']; ?></div>
                        <?php endif; ?>
                        
                        <p class="box-title mb-3">
                            <?php echo $box['box_title']; ?>
                        </p>
                        
                        <ul class="box-list">
                            <?php foreach ($box['list_items'] as $list_item) : ?>
                                <li>
                                    <?php if ($list_item['has_icon_check']) : ?>
                                        <span class="has-icon-check mr-2 pr-1"></span>
                                    <?php endif; ?>
                                    <span>
                                        <?php echo $list_item['list_text']; ?>
                                    </span>
                                    
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php if (!empty($box['button_text'])) : ?>

                            <div class="mt-auto">
                                <?php if (!empty($box['button_text']) && $key == 0) : ?>
                                    <a href="#" data-modal="#callback" class="btn btn-blue open-modal">
                                        <?php echo $box['button_text']; ?>
                                    </a>
                                <?php elseif (!empty($box['button_text']) && $key == 1) : ?>
                                    <a class="btn d-flex align-items-center justify-content-center btn-outline-blue" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/d/cqrf-wpr-bt6/talk-to-our-expert'});return false;">
                                        <?php echo $box['button_text']; ?>
                                    </a>
                                <?php endif; ?>
                                </div>
                        <?php endif; ?>
                    </div>
                   
                <?php endforeach; ?>
                
            </div>
                
        </div>
    
</section>