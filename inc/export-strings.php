<?php

/**
 * Menu
 */
function icoda_export_add_menu()
{
    add_submenu_page(
        'tools.php',
        'Export Strings',
        'Export Strings',
        'manage_options',
        'icoda_wpml_strings_export',
        'icoda_wpml_strings_export_form'
    );
}

if (is_admin()) {
    add_action('admin_menu', 'icoda_export_add_menu');
}

/**
 * Admin page
 */
function icoda_wpml_strings_export_form()
{
?>
    <div class="wrap">
        <h1><?php echo 'Export'; ?></h1>
        <div class="form-wrap">
            <form method="post" class="validate">
                <?php wp_nonce_field('icoda_export_wpml_strings', 'icoda_export_wpml_strings_nonce'); ?>
                <input type="hidden" name="action" value="icoda_export_wpml_strings">
                <p class="submit">
                    <input type="submit" name="submit" class="button button-red" value="<?php echo 'Export Strings to CSV'; ?>">
                </p>
            </form>
        </div>
    </div>
<?php
}

function icoda_export_wpml_strings_run()
{
    global $wpdb;
    
    $header_columns = [
        'ID'                 => 'ID',
        'Value'                 => 'Value',
    ];

    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for internet explorer
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=icoda_icl_strings-" . date("Y-m-d H:i:s") . ".csv");
    $file = fopen('php://output', 'w');

    fputcsv($file, $header_columns);

    $icl_strings = $wpdb->get_results( "SELECT id, value FROM {$wpdb->prefix}icl_strings WHERE context='icoda' AND language='en'");

    foreach ($icl_strings as $icl_string_data) {

        $csv_row = [
            $icl_string_data->id,
            wp_specialchars_decode($icl_string_data->value)
        ];

        fputcsv($file, $csv_row);
    }

    die();
}

function icoda_maybe_export_wpml_strings()
{
    if (isset($_POST['icoda_export_wpml_strings_nonce'])) {
        icoda_export_wpml_strings_run();
    }
}

add_action('init', 'icoda_maybe_export_wpml_strings');
