<?php
$need_post_id = !empty($args['need_post_id']) ? $args['need_post_id'] : get_the_ID();
$partners_reward = get_field('partners_reward', $need_post_id);
?>
<section class="section-reward">
    <div class="container">
        <div class="row section-reward-inner">
            <div class="col-12 offset-lg-2 col-lg-4">
                <h2 class="h4 pr-lg-4 mb-5"><?php echo $partners_reward['title']; ?></h2>
                <div class="btn-wrap">
                    <a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php echo $partners_reward['button_text']; ?></a>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="img-block">
                    <img src="<?php echo $partners_reward['image']; ?>" alt="reward">
                </div>
            </div>
        </div>
    </div>
</section>