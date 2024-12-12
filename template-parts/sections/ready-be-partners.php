<?php
$need_post_id = !empty($args['need_post_id']) ? $args['need_post_id'] : get_the_ID();
$partners_ready_to_be_partners = get_field('partners_ready_to_be_partners', $need_post_id);
?>
<section class="section-ready-be-partners">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-ready-be-partners-inner">
                    <h2 class="h4"><?php echo $partners_ready_to_be_partners['title']; ?></h2>
                    <?php echo $partners_ready_to_be_partners['content']; ?>
                    <div class="btn-wrap">
                        <a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php echo $partners_ready_to_be_partners['button_text']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>