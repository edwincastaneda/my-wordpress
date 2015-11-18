<?php

add_action('init', 'enfermedades_init');
function enfermedades_init() {
    $labels = array(
        'name' => 'Enfermedades',
        'singular_name' => 'Enfermedad',
        'menu_name' => 'Enfermedades',
        'name_admin_bar' => 'Enfermedad',
        'add_new' => 'Nueva',
        'add_new_item' => 'Agregar Enfermedad',
        'new_item' => 'Nueva Enfermedad',
        'edit_item' => 'Editar Enfermedad',
        'view_item' => 'Ver Enfermedad',
        'all_items' => 'Todas las Enfermedades',
        'search_items' => 'Buscar Enfermedades',
        'parent_item_colon' => 'Enfermedades Padres',
        'not_found' => 'No se encontraron Enfermedades registradas.',
        'not_found_in_trash' => 'No hay Enfermedades en la papelera'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        //'taxonomies' => array('category'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position' => 97
    );
    register_post_type('enfermedad', $args);
}
