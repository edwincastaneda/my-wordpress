<?php


add_action('admin_init', 'la_semilla_opciones');
function la_semilla_opciones() {
    register_setting('la_semilla_grupo_opciones', 'slug_productos');
    register_setting('la_semilla_grupo_opciones', 'id_pagina');
    register_setting('la_semilla_grupo_opciones', 'id_pagina_resultado');
}


function registrar_estilo() {
    $src = PLUGIN_PATH . "css/lasemilla.css";
    $handle = "registrar-estilo";
    wp_register_script($handle, $src);
    wp_enqueue_style($handle, $src, array(), false, false);
}

add_action('admin_head', 'registrar_estilo');