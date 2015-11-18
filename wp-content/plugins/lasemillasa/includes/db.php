<?php

function la_semilla_create_table() {
    global $wpdb;
    global $la_semilla_db_version;

    $table_name = $wpdb->prefix . 'recetas';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
                id_animal int(11),
                id_enfermedad int(11),
                id_producto int(11),
		UNIQUE KEY id (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    add_option('la_semilla_db_version', $la_semilla_db_version);
}

register_activation_hook(__FILE__, 'la_semilla_create_table');
