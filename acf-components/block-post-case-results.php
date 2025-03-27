<?php
$results = get_field('post_case_results_items');
if (!empty($results)) :
    $result_groups = array_chunk($results, 2);
?>
    <section class="section-result my-lg-3 py-5 py-lg-4">
        <h2 class="mb-3 section-title"><?php the_field('post_case_results_title'); ?></h2>
        <div class="resault-boxes row">
            <?php if (!empty($results)): ?>
                <?php foreach ($result_groups as $result_items) : ?>
                    <?php foreach ($result_items as $result_item) : ?>
                        <div class="col col-12 <?php echo count($result_items) == 1 ? '' : 'col-lg-6'; ?>">
                            <div class="serv-box ">
                                <span class="number mb-2"><?php echo $result_item['title']; ?></span>
                                <p><?php echo $result_item['text']; ?></p>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>