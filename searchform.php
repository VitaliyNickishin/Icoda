<?php
$action_url = '/blog/';
if (is_home()) {
    $action_url = get_permalink(get_option('page_for_posts'));
} elseif (is_category()) {
    $action_url = get_term_link(get_queried_object());
}
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo $action_url; ?>">
    <div>
        <label class="screen-reader-text" for="s"><?php echo _x('Search for:', 'icoda') ?></label>
        <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" autocomplete="off" placeholder="<?php echo esc_attr_x('Search article', 'icoda') ?>">
        <button type="submit" id="searchsubmit" value="<?php echo esc_attr_x('Search', 'icoda') ?>">
            <img src="/wp-content/uploads/2024/05/search.svg" alt="search">
        </button>
    </div>
</form>