<?php

add_action('init', 'animales_init');
function animales_init() {

    $labels = array(
        'name' => 'Animales',
        'singular_name' => 'Animal',
        'menu_name' => 'Animales',
        'name_admin_bar' => 'Animal',
        'add_new' => 'Nuevo',
        'add_new_item' => 'Agregar Animal',
        'new_item' => 'Nuevo Animal',
        'edit_item' => 'Editar Animal',
        'view_item' => 'Ver Animal',
        'all_items' => 'Todos los Animales',
        'search_items' => 'Buscar Animales',
        'parent_item_colon' => 'Animales Padres',
        'not_found' => 'No se encontraron Animales registrados.',
        'not_found_in_trash' => 'No hay Animales en la papelera'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        //'taxonomies' => array('category'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position' => 97
    );

    register_post_type('animal', $args);
}

