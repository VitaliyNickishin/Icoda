<?php
$table_info = get_field('table_info');
if (!$table_info || empty($table_info['table_rows'])) {
    return;
}
$id_section = !empty($table_info['id_section']) ? $table_info['id_section'] : '';
$has_bg = !empty($table_info['is_background_color']);
$bg_color = !empty($table_info['has_background_color'])
    ? $table_info['has_background_color']
    : '#f4f6f9';

$rows = $table_info['table_rows'];

$column_header_first = !empty($table_info['column_header_first'])
    ? $table_info['column_header_first']
    : 'Header column first';
$column_header_second = !empty($table_info['column_header_second'])
    ? $table_info['column_header_second']
    : 'Header column second';
$column_header_third = !empty($table_info['column_header_third'])
    ? $table_info['column_header_third']
    : 'Header column third';
$column_header_four = !empty($table_info['column_header_four'])
    ? $table_info['column_header_four']
    : 'Header column four';
$column_header_five = !empty($table_info['column_header_five'])
    ? $table_info['column_header_five']
    : 'Header column five';
?>
<section 
    class="section section-table-info py-5 <?php echo $has_bg ? '' : 'bg-white'; ?>" 
    <?php if ($has_bg) : ?>
        style="background-color: <?php echo esc_attr($bg_color); ?>;"
    <?php endif; ?>>
    <div class="container py-lg-4">
        <?php if (!empty($table_info['above_title'])) : ?>
            <p class="abovetitle mb-1 text-primary">
                <?php echo $table_info['above_title']; ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($table_info['title'])) : ?>
            <h2 class="h2 mb-2 section-title">
                <?php echo $table_info['title']; ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($table_info['subtitle'])) : ?>
            <p class="subtitle">
                <?php echo $table_info['subtitle']; ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($table_info['table_rows'])) : ?>
            <div class="tbl-info mt-4">

                <!-- Desktop -->
                <div class="tbl-desktop d-none d-lg-block">

                    <table class="tbl-info-table">

                        <thead>
                            <tr>
                                
                                <th><?php echo esc_html($column_header_first); ?></th>                                
                                <th><?php echo esc_html($column_header_second); ?></th>
                                <th><?php echo esc_html($column_header_third); ?></th>                            
                                <th><?php echo esc_html($column_header_four); ?></th>                            
                                <th><?php echo esc_html($column_header_five); ?></th>                                
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($rows as $index => $row) : ?>

                                <?php
                                $alt = $index % 2 !== 0;

                                $is_highlighted = !empty($row['highlight_row']);

                                $allowed_risks = ['empty', 'low', 'medium', 'high'];

                                $risk_color = in_array($row['risk_color'], $allowed_risks)
                                ? $row['risk_color']
                                : 'empty';

                                $risk_class = 'risk-' . $risk_color;

                                $row_classes = [
                                    'table-row',
                                ];

                                if ($alt) {
                                    $row_classes[] = 'is-alt';
                                }

                                if ($is_highlighted) {
                                    $row_classes[] = 'is-highlighted';
                                }
                                ?>

                                <tr class="<?php echo esc_attr(implode(' ', $row_classes)); ?>">

                                    <td class="tbl-channel">
                                        <?php echo esc_html($row['body_column_one']); ?>
                                    </td>

                                    <td>
                                        <?php echo esc_html($row['body_column_two']); ?>
                                    </td>

                                    <td>
                                        <?php echo esc_html($row['body_column_three']); ?>
                                    </td>

                                    <td class="tbl-risk <?php echo esc_attr($risk_class); ?>">
                                        <?php echo esc_html($row['body_column_four']); ?>
                                    </td>

                                    <td>
                                        <?php echo esc_html($row['body_column_five']); ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

                <!-- Mobile -->
                <div class="tbl-mobile d-lg-none d-grid gap-3">

                    <?php foreach ($rows as $row) : ?>

                        <?php
                        $is_highlighted = !empty($row['highlight_row']);

                        $allowed_risks = ['empty', 'low', 'medium', 'high'];
                        $risk_color = in_array($row['risk_color'], $allowed_risks)
                        ? $row['risk_color']
                        : 'empty';

                        $risk_class = 'risk-' . $risk_color;

                        $card_classes = [
                            'tbl-card',
                        ];

                        if ($is_highlighted) {
                            $card_classes[] = 'is-highlighted';
                        }
                        ?>

                        <div class="<?php echo esc_attr(implode(' ', $card_classes)); ?>">

                            <div class="tbl-card__top">

                                <div class="tbl-card__title">
                                    <?php echo esc_html($row['body_column_one']); ?>
                                </div>

                                <span class="tbl-risk-badge <?php echo esc_attr($risk_class); ?>">
                                    <?php echo esc_html($row['body_column_four']); ?>
                                </span>

                            </div>

                            <div class="tbl-card__grid">

                                <span class="tbl-key"><?php echo esc_html($column_header_second); ?></span>
                                <span class="tbl-val">
                                    <?php echo esc_html($row['body_column_two']); ?>
                                </span>

                                <span class="tbl-key"><?php echo esc_html($column_header_third); ?></span>
                                <span class="tbl-val">
                                    <?php echo esc_html($row['body_column_three']); ?>
                                </span>

                                <span class="tbl-key"><?php echo esc_html($column_header_five); ?></span>
                                <span class="tbl-val">
                                    <?php echo esc_html($row['body_column_five']); ?>
                                </span>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>
        <?php endif; ?>
    </div>
</section>