<?php
/*
Plugin Name: Credipass - Calcola mutuo
Description: Un plugin per calcolare la rata del mutuo, utilizzando i dati Credipass.
Version: 1.0
Author: Gabriele Piccinnu
*/

function credipass_calcola_mutuo_enqueue_scripts() {
    wp_enqueue_style('credipass-bootstrap-styles', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', array(), null);
    wp_enqueue_style('credipass-calcola-mutuo-styles', plugins_url('css/styles.css', __FILE__));

    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js', array(), null, true);
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('credipass-calcola-mutuo-script', plugins_url('js/script.js', __FILE__), array('jquery', 'bootstrap-bundle'), null, true);

    // Localize script to pass plugin directory URL to JavaScript
    $upload_dir = wp_upload_dir();
    $tassi_file_url = $upload_dir['baseurl'] . '/credipass-calcola-mutuo/tassi-last.js';
    wp_localize_script('credipass-calcola-mutuo-script', 'credipassData', array(
        'pluginUrl' => plugin_dir_url(__FILE__),
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'tassiFileUrl' => $tassi_file_url
    ));

    // Enqueue the tassi-last.js file
    if (file_exists($upload_dir['basedir'] . '/credipass-calcola-mutuo/tassi-last.js')) {
        wp_enqueue_script('tassi-last', $tassi_file_url, array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'credipass_calcola_mutuo_enqueue_scripts');

function credipass_calcola_mutuo_admin_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js', array(), null, true);
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('credipass-calcola-mutuo-script', plugins_url('js/script.js', __FILE__), array('jquery', 'bootstrap-bundle'), null, true);

    // Localize script to pass plugin directory URL to JavaScript for admin
    $upload_dir = wp_upload_dir();
    $tassi_file_url = $upload_dir['baseurl'] . '/credipass-calcola-mutuo/tassi-last.js';
    wp_localize_script('credipass-calcola-mutuo-script', 'credipassData', array(
        'pluginUrl' => plugin_dir_url(__FILE__),
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'tassiFileUrl' => $tassi_file_url
    ));

    // Enqueue the tassi-last.js file for admin
    if (file_exists($upload_dir['basedir'] . '/credipass-calcola-mutuo/tassi-last.js')) {
        wp_enqueue_script('tassi-last', $tassi_file_url, array(), null, true);
    }
}
add_action('admin_enqueue_scripts', 'credipass_calcola_mutuo_admin_enqueue_scripts');

function credipass_calcola_mutuo_shortcode() {
    ob_start();
    include 'templates/form-template.php';
    return ob_get_clean();
}
add_shortcode('calcolatore_mutuo', 'credipass_calcola_mutuo_shortcode');

function credipass_calcola_mutuo_download_tassi() {
    $url = 'https://www.credipass.it/forms-data/tassi-last.js';
    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['basedir'] . '/credipass-calcola-mutuo/';
    $file_path = $upload_path . 'tassi-last.js';

    // Create the directory if it doesn't exist
    if (!file_exists($upload_path)) {
        wp_mkdir_p($upload_path);
    }

    // Download the file and save it locally
    $response = wp_remote_get($url);
    if (is_wp_error($response)) {
        return false;
    }
    $body = wp_remote_retrieve_body($response);
    file_put_contents($file_path, $body);
    return true;
}

register_activation_hook(__FILE__, 'credipass_calcola_mutuo_download_tassi');

function credipass_calcola_mutuo_schedule_event() {
    if (!wp_next_scheduled('credipass_calcola_mutuo_cron_job')) {
        wp_schedule_event(time(), 'daily', 'credipass_calcola_mutuo_cron_job');
    }
}
add_action('wp', 'credipass_calcola_mutuo_schedule_event');

function credipass_calcola_mutuo_cron_job() {
    credipass_calcola_mutuo_download_tassi();
}

register_deactivation_hook(__FILE__, 'credipass_calcola_mutuo_deactivation');
function credipass_calcola_mutuo_deactivation() {
    $timestamp = wp_next_scheduled('credipass_calcola_mutuo_cron_job');
    wp_unschedule_event($timestamp, 'credipass_calcola_mutuo_cron_job');
}

// Add Dashboard Widget
function credipass_calcola_mutuo_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'credipass_calcola_mutuo_dashboard_widget', // Widget slug.
        'Credipass - Sincronizzazione Tassi', // Title.
        'credipass_calcola_mutuo_dashboard_widget_render' // Display function.
    );
}
add_action('wp_dashboard_setup', 'credipass_calcola_mutuo_add_dashboard_widget');

function credipass_calcola_mutuo_dashboard_widget_render() {
    ?>
    <div id="credipass-sync-status"></div>
    <button id="credipass-sync-button" class="button button-primary">Sincronizza Tassi</button>
    <?php
}

// Handle AJAX request for manual sync
function credipass_calcola_mutuo_sync_tassi() {
    if (credipass_calcola_mutuo_download_tassi()) {
        wp_send_json_success('Sincronizzazione completata con successo.');
    } else {
        wp_send_json_error('Errore durante la sincronizzazione.');
    }
}
add_action('wp_ajax_credipass_calcola_mutuo_sync_tassi', 'credipass_calcola_mutuo_sync_tassi');
?>
