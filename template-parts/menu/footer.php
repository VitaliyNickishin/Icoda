<?php
$menu = icoda_get_items_tree_menu($args['location']);

$show_only_first_item = false;
$show_only_first_item_big = false;
if ( $args['location'] == 'footer-right-down-2') {
    $show_only_first_item = true;
}

if ($args['location'] == 'footer-center-down' || $args['location'] == 'footer-left' || $args['location'] == 'footer-two-two' || $args['location'] == 'footer-center' || $args['location'] == 'footer-right-up' || $args['location'] == 'footer-right-down' ) {
    $show_only_first_item_big = true;
}


if ($show_only_first_item) {
    if( ! empty( $menu[0]->childs ) ) {
        $_item = reset($menu[0]->childs);
        echo "<p class=\"ttl\"><a href=\"{$_item['url']}\">{$_item['title']}</a></p>";
    }
} else {
    if( $show_only_first_item_big ) {
        if( ! empty( $menu[0]->childs ) ) {
            $_item_big = reset($menu[0]->childs);
            echo "<p class=\"ttl\"><a href=\"{$_item_big['url']}\">{$_item_big['title']}</a></p>";
        }
    } else {
        echo "<p class=\"ttl\">{$menu['title_menu']}</p>";
    }
    echo '<ul>';
    if (!empty($menu[0]->childs)) {
        $index = -1;
        foreach ($menu[0]->childs as $item) {
            $index++;
            if( $show_only_first_item_big && $index == 0 ) {
                continue;
            }
            $liClass = '';
            $aClass = "";
            $title = ($item['title'] !== "#") ? $item['title'] : '';
            echo "<li><a href=\"{$item['url']}\" >$title</a></li>";
        }
    }
    echo '</ul>';
}
