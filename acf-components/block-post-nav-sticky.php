<?php
$nav_sticky = get_field('nav_sticky');
?>
<div class="block-nav-sticky">
    <div class="container">
        <div class="row gap-1">
            <div class="col-12 d-flex">
                <?php if (!empty($nav_sticky['title'])) : ?>
                    <span class="mr-3 label text-uppercase d-flex align-items-center">
                        <?php echo $nav_sticky['title']; ?>
                    </span>
                <?php endif; ?>
                
                <?php  if (!empty($nav_sticky['nav_list'])) : ?>
                    <ul class="d-flex">
                        <?php foreach ($nav_sticky['nav_list'] as $link) : ?>
                            <?php
                                $link_url = !empty($link['link_anchor']) ? $link['link_anchor'] : '#';
                            ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" 
                                class="nav-link"
                                >
                                    <?php echo $link['link_title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>