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
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'n:fX#)tUfg(NShlU`k*dq*D!z2.)`QcEw@j&SY_]_0JmZ]3$v+IzrH>NC OD4)xA');
define('SECURE_AUTH_KEY',  '^3L&fIBJ>z;2d|,ee6v7-O=r)|2C3rs&(-6PuNeO?r4c||6NWAo!>rU|Lxoj)?]X');
define('LOGGED_IN_KEY',    '.~%Bs`/j/`r|0^/XgYNy7bedUE~C6*5m(6#xQ6/t[0*-PXkk=agdC,1Sh&y>bL>2');
define('NONCE_KEY',        '^H+}*:/ffS/ikm01$sV8O^)YZ@kG&Z&`@q-n|3y$4C$r2Qn`Ga 6zc@&tJSF<J4G');
define('AUTH_SALT',        '$jRBr7$-1RwZNzIU$#9`IpLnPfP>9x,<{LbKhD9g8c}y)9-}SM{AQCw<TU1x6S_)');
define('SECURE_AUTH_SALT', '9ys1rKTS$/(Huj^Xwwe+gO7tm`@zePjxcH|Ke+0D~<qRV/KRVzZ=BMi,r<95ZhsT');
define('LOGGED_IN_SALT',   '#T}~|.mpE+BIr~U*b-MIJfRa^J*@S$]2WPhc{C-b9fmN=wd/JEwe>6BCoxo9e|pf');
define('NONCE_SALT',       'bNm;qZ)pa1!2L+9k5RQ?gtN-5&RQ+{p~75|@wsqS%CL^%i>YKDWi.4px$hHI?K/Z');

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
