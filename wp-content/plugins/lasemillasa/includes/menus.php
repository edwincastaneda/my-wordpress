<?php
add_action('admin_menu', 'la_semilla_menu');
function la_semilla_menu() {
    add_menu_page('La Semilla', 'La Semilla', 'manage_options', 'administrar_recetas', 'admin_recetas');
    add_submenu_page('administrar_recetas', 'Administrar Recetas', 'Administrar Recetas', 'manage_options', 'administrar_recetas', 'admin_recetas');
    add_submenu_page('administrar_recetas', 'Configuración', 'Configuración', 'manage_options', 'administrar_configuracion', 'admin_configuracion');
}

function admin_configuracion() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    echo '<div class="wrap">';
    echo '<h2>Configuración</h2>';
    include('configuracion.php');
    echo '</div>';
}

function admin_recetas() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    wp_enqueue_script('jquery.dataTables', PLUGIN_PATH . '/js/jquery.dataTables.js', array('jquery'));
    wp_enqueue_style('jquery.dataTables', PLUGIN_PATH . '/css/jquery.dataTables.min.css');

    wp_enqueue_script('funciones', PLUGIN_PATH . '/js/funciones.js', array('jquery'));

    echo '<div class="wrap">';
    echo '<h2>Recetas</h2>';
    include('recetas.php');
    echo '</div>';
}
