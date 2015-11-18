<?php

require_once('../../../../wp-load.php');
global $wpdb;
$table_name = $wpdb->prefix . "recetas";

$wpdb->delete( $table_name, array( 'id' => $_POST['id'] ) );

header("Location: ".admin_url()."admin.php?page=administrar_recetas");

?>