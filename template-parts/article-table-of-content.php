<?php
$overwrite_table_of_content = get_field('overwrite_table_of_content', get_the_ID());
?>
<div class="table-of-content" style="display: none;">
    <div class="box">
        <p class="title mb-2 pb-1"><?php _e('Table of Content', 'icoda'); ?></p>
        <?php if ($overwrite_table_of_content) : ?>
            <?php
            $custom_table_of_content = get_field('custom_table_of_content', get_the_ID());
            ?>
            <ol class="list-table is-overwritten">
                <?php foreach ($custom_table_of_content as $item_data): ?>
                    <li><a href="#<?php echo $item_data['anchor']; ?>"><?php echo $item_data['title']; ?></a></li>
                <?php endforeach; ?>
            </ol>
        <?php else : ?>
            <ol class="list-table">
            </ol>
        <?php endif; ?>
    </div>
</div>