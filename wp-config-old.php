<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dssserv_wp');

/** MySQL database username */
define('DB_USER', 'dssserv_wp');

/** MySQL database password */
define('DB_PASSWORD', 'tE8rZKNutvD8G9vM');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+g1u($%Z3eAM4uN|vPC2_[{|=$;BiL_2^-E1:$Jv?l3J5IN6unH3NVR _1KAhKOI');
define('SECURE_AUTH_KEY',  'KCX^Y#_~[Z6u9$vmCrh<dY4F@CObH^us/RV(NEu9eQ-bV19h/c@@itteh7<O<Xq~');
define('LOGGED_IN_KEY',    'WB1C3`QbS!P|eBc+FneGi+4<(ercYN^[-.s@=n@HmQf)05+)d:c&n2w;(r67Am#h');
define('NONCE_KEY',        '%95hYDP/`RK!D/v,<08S,!Ie<4yes+M8tF,FMbY[+&N%!m<UH[TL?ch#usvnm|_u');
define('AUTH_SALT',        ']Fynh-.8hJ<QYQ3v+~<-+jVy($}]^<cx?R58>xz_W-D~vYZ/+cX%X ^ZYZ8f$te$');
define('SECURE_AUTH_SALT', '#x3%&Hqzmm-;ro,-3/6j|.Ro.G7>B8 yB{`A%XBwX!9l+VXb{<~Pc@DA^2^zY$8-');
define('LOGGED_IN_SALT',   '!aTo#0443>b.MMIA>e3+rPr9/!+:UKB}cT8Bn+-cWQhE};8I)KMlva&{dw_v=<U#');
define('NONCE_SALT',       'v-0*-0~W?vmI)//<S`hHm(-U+_6XWv5AmE3RK*9DaK*&xuWL!4?> .mEi]>FNK=Q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('siteurl','http://spidadesign.us/dssserv');
define('home','http://spidadesign.us/dssserv');
