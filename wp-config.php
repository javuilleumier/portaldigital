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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/u712080898/public_html/digital/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'u712080898_digit');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'u712080898_digit');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'UCC2007*');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'mysql.hostmania.es');

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
define('AUTH_KEY', '{uRcHugDO/j3q=k0hAY_ z[eGGa>)wCG7:kh:Pc-nOTp[-!{3)te:Gi_)%g0t*GC');
define('SECURE_AUTH_KEY', '&*y&#UZ29!q&UvN#[u)&XWo^<~b8+|OAj_p}9k@V7D^zYM9|<p}<cmmncUsk~.+h');
define('LOGGED_IN_KEY', 'MbT_8+mhezCGV_qZwX(fm5K;1!bb?UWEt`ODFV2FnpWefC1O*VEA7P-ipv.*pHj>');
define('NONCE_KEY', ',_ FewAP8Qwv2E;_dGgUz4JA1yY}(0BG,hG~5-AS5>`];?oT}DE`!(8%^.G_qQi+');
define('AUTH_SALT', '>*iL9.4Oc#xWgexH/&li 4Pl@8W,>^<r]M2hMMxe<,P!7ifwyLF+)C)|j;@mc(}-');
define('SECURE_AUTH_SALT', 'D#>78>__@CVRb(w<Uz:&[nVR<G`7T.-@z%YJcaqCh8R5 9{]SORfvme.3I^2F3U]');
define('LOGGED_IN_SALT', '9HMw#WKM+>,4DeDXNR dWGFJ;Q9Qb^4K}>JUiw`C Alq4+$BNG^ceW{|Z7:9&&oG');
define('NONCE_SALT', 'L#Fxy;(^Az:|u]1Wp$xsb,;lY#px.vU$<eS%|7AF$7ZEzB%ET}]-b.2S[efd%u^J');

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

