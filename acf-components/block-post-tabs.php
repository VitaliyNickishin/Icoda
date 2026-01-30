<?php
$block_tabs = get_field('block_tabs');

if (!empty($block_tabs)) :
?>
    <section class="section block-tabs">
        <div class="container">
            <div class="row">
                <div class="col-12 text-lg-center">
                    <h2 class="h2 mb-2 pb-1 block-title"><?php echo $block_tabs['title']; ?></h2>
                    <p class="subtitle">
                        <?php echo $block_tabs['subtitle']; ?>
                    </p>
                    
                </div>
                <div class="col-12 mt-4 pt-lg-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <?php if (!empty($block_tabs['nav_tabs'])) : ?>
                                <?php foreach ($block_tabs['nav_tabs'] as $index => $nav_tab) : ?>
                                    <button class="nav-link <?php if ($index === 0) : ?>active<?php endif; ?>" id="nav-<?php echo $index; ?>-tab" data-toggle="tab" data-target="#nav-<?php echo $index; ?>" type="button" role="tab" aria-controls="nav-<?php echo $index; ?>" aria-selected="true">
                                        <?php if (!empty($nav_tab['nav_tab_icon'])) : ?>
                                            <span class="nav-icon">
                                                <?php echo file_get_contents($nav_tab['nav_tab_icon']['url']); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php echo $nav_tab['nav_tab_title']; ?>
                                    </button>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <?php foreach ($block_tabs['tab_contents'] as $index => $tab_content) : ?>
                        <div class="tab-pane fade <?php if ($index === 0) : ?>show active<?php endif; ?>" id="nav-<?php echo $index; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $index; ?>-tab">
                            <div class="tab-pane-header">
                                <?php if (!empty($tab_content['tab_pane_header_icon'])) : ?>
                                    <span class="tab-pane-header-icon">
                                        <?php echo file_get_contents($tab_content['tab_pane_header_icon']['url']); ?>
                                    </span>
                                <?php endif; ?>
                                <p class="tab-pane-header-title">
                                    <?php echo $tab_content['tab_pane_header_title']; ?>
                                </p>
                            </div>
                            <div class="tab-pane-body">
                                <ul>
                                    <?php foreach ($tab_content['tab_pane_list_items'] as $list_item) : ?>
                                        <li>
                                            <?php if ($list_item['has_icon_check']) : ?>
                                                <span class="has-icon-check"></span>
                                            <?php endif; ?>
                                            <span>
                                                <?php echo $list_item['tab_pane_list_description']; ?>
                                            </span>
                                            
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>