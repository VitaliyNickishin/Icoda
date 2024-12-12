<?php
$tags = get_terms(['taxonomy' => 'post_tag', 'hide_empty' => false]);
if (!empty($_GET['tags'])) {
    $selected_tags = explode(',', $_GET['tags']);
}
?>
<div class="tags">
    <p class="tags-title mb-3 pb-1"><?php echo __('Tags', 'icoda'); ?></p>
    <ul class="tags-list">
        <?php foreach ($tags as $tag) : ?>
            <li>
                <input type="checkbox" name="tags" value="<?php echo $tag->term_id; ?>" id="checkbox-<?php echo $tag->term_id; ?>" <?php checked(in_array($tag->term_id, $selected_tags)); ?> />
                <label for="checkbox-<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php /* ?>
    <button class="tags-button btn btn-blue mt-3" type="button"><?php echo __('Show all', 'icoda'); ?></button>
    <?php */ ?>

</div>