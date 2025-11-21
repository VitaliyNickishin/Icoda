<?php
$sub_menu_banner = get_field('icoda_gb_header_sub_menu_banner', 'option');
?>
<div class="sub-menu-banner">
    <div class="text-center">
        <p class="title fw-semibold">
            <?php echo $sub_menu_banner['banner_title']; ?>
        </p>
        <div class="description">
            <?php echo $sub_menu_banner['banner_description']; ?>
        </div>
        <a href="<?php echo $sub_menu_banner['page_url']; ?>" class="btn btn-blue text-capitalize"><?php echo $sub_menu_banner['button_text']; ?></a>
    </div>
</div>