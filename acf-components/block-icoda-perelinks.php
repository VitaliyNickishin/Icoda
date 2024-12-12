<?php
$block_data = get_field('block_perelinks');

if (!empty($block_data) && !empty($block_data['links'])) :
?>
    <section class="section section-1 perelinks mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12 px-lg-0">
                    <h3><?php echo $block_data['title']; ?>:</h3>
                    <div class="sub-text">
                        <ul class="marker-list">
                            <?php foreach ($block_data['links'] as $link) : ?>
                                <li><a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>