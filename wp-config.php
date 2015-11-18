<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wordpress');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'H|Q5KQh`&*vQPcn4cZGUo67>jby0tReuj*om%7,h}-q~wcg(kP+A%I:(bXSbFtEi');
define('SECURE_AUTH_KEY', 'Of*`x-{H_7}L#|_ Or.7XsrU9c}N+C=TZ%<W OLZC1(@m|<:uN#`T>]%l9FpnSG(');
define('LOGGED_IN_KEY', '.P+>tVwUI>os_((/;|-a8h!LN?%~q`Zx*?IJ]+;] E.rTD~_J+gg:rF|rBuk ^+|');
define('NONCE_KEY', 'dklE|^&yRa0a:=r@MxQ7_[,@[`@>f^:|8 xO<ahm5K{wGK1]k;]e;Wdl$!YjM(rr');
define('AUTH_SALT', 'NDA(ZdH8roB|8sape{`tf==xw6{Zyb>]!#CdMjr )f#^Dp%aUa-S!a44AR)*M8u8');
define('SECURE_AUTH_SALT', '$3|HzO?.Z#<Nyvt}Lx+$ ]UD={t!vrBaiDMceGPi(>_#f%)vVU$amz+X qRW12-F');
define('LOGGED_IN_SALT', 'Yl!=fc.Bb+Y$,Jh/x/[k5R@bcRuOxXajj:Hrg&8BX+fme1kX2||+`F-rYXu^v|!&');
define('NONCE_SALT', 'H7c9t!wd2xV:|6Ja0b-lJ-C$9Pna7Tf@<>mCPoa |&t|6oGB8r`|+OG+||pl.V{H');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

