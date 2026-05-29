<?php
$table_compare = get_field('table_compare');
if (!$table_compare) {
    return;
}
$id_section = !empty($table_compare['id_section']) ? $table_compare['id_section'] : '';
$has_bg = !empty($table_compare['is_background_color']);
$bg_color = !empty($table_compare['has_background_color'])
    ? $table_compare['has_background_color']
    : '#f4f6f9';

$column_header = !empty($table_compare['column_header'])
? $table_compare['column_header']
: 'Dimension';

$column_header_first = !empty($table_compare['column_header_first'])
    ? $table_compare['column_header_first']
    : 'Header column first';

$column_header_second = !empty($table_compare['column_header_second'])
    ? $table_compare['column_header_second']
    : 'Header column second';
?>
<section 
    class="section section-table-compare py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>" 
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container py-lg-4">
        <?php if (!empty($table_compare['above_title'])) : ?>
            <p class="abovetitle mb-1 text-primary">
                <?php echo $table_compare['above_title']; ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($table_compare['title'])) : ?>
            <h2 class="h2 mb-2 section-title">
                <?php echo $table_compare['title']; ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($table_compare['subtitle'])) : ?>
            <p class="subtitle">
                <?php echo $table_compare['subtitle']; ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($table_compare['table_rows'])) : ?>
            <div class="tbl-info mt-4">
                <!-- Desktop -->
                <div class="tbl-desktop d-none d-lg-block">
                    <div class="tbl-header">
                        <div class="tbl-header__dimension">
                            <?php echo esc_html($column_header); ?>
                        </div>
                        <div class="tbl-header__first">
                            <span>
                                <?php echo esc_html($column_header_first); ?>
                            </span>
                            <?php if (!empty($table_compare['column_header_label_first'])) : ?>
                                <span class="tbl-header__divider"></span>
                                <span class="tbl-header__label">
                                    <?php echo esc_html($table_compare['column_header_label_first']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="tbl-header__second">
                            <span>
                                <?php echo esc_html($column_header_second); ?>
                            </span>
                            <?php if (!empty($table_compare['column_header_label_second'])) : ?>
                                <span class="tbl-header__divider"></span>
                                <span class="tbl-header__label">
                                    <?php echo esc_html($table_compare['column_header_label_second']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php foreach ($table_compare['table_rows'] as $index => $row) : ?>
                        <?php
                        $is_odd = $index % 2 === 1;
                        ?>
                        <div class="tbl-row <?php echo $is_odd ? 'is-odd' : ''; ?>">
                            <div class="tbl-row__dimension">
                                <?php echo esc_html($row['dimension']); ?>
                            </div>
                            <div class="tbl-row__first">
                                <?php echo esc_html($row['first_column']); ?>
                            </div>
                            <div class="tbl-row__second">
                                <?php echo esc_html($row['second_column']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Mobile -->
                <div class="tbl-mobile d-lg-none d-grid gap-3">
                    <?php foreach ($table_compare['table_rows'] as $row) : ?>
                        <div class="tbl-card">
                            <div class="tbl-card__title">
                                <?php echo esc_html($row['dimension']); ?>
                            </div>
                            <div class="tbl-card__first">
                                <div class="tbl-card__label-wrap">
                                    <span class="tbl-card__label tbl-card__label--ai">
                                        <?php echo esc_html($column_header_first); ?>
                                    </span>
                                    <?php if (!empty($table_compare['column_header_label_first'])) : ?>
                                        <span class="tbl-card__sub">
                                            <?php echo esc_html($table_compare['column_header_label_first']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="tbl-card__text">
                                    <?php echo esc_html($row['first_column']); ?>
                                </div>
                            </div>
                            <div class="tbl-card__second">
                                <div class="tbl-card__label-wrap">
                                    <span class="tbl-card__label tbl-card__label--second">
                                        <?php echo esc_html($column_header_second); ?>
                                    </span>
                                    <?php if (!empty($table_compare['column_header_label_second'])) : ?>
                                        <span class="tbl-card__sub tbl-card__sub--second">
                                            <?php echo esc_html($table_compare['column_header_label_second']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="tbl-card__text tbl-card__text--second">
                                    <?php echo esc_html($row['second_column']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>