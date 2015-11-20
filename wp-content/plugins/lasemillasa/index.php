<?php
/*
  Plugin Name: Enfermedades (La Semilla S. A.)
  Plugin URI:
  Description: Integración de productos de Woocomerce con catálogo de animales y enfermedades.
  Version: 1.0
  Author: Edwin Castañeda
  Author URI:
 */


global $la_semilla_db_version;
$la_semilla_db_version = '1.0';

define('PLUGIN_PATH',  plugin_dir_url(__FILE__)); 


include "includes/db.php";
include "includes/menus.php";
include "includes/config.php";
include "includes/front.php";


/* POST TYPES */
include "post_types/animales.php";
include "post_types/enfermedades.php";