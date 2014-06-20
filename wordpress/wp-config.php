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

/**
*
* YOU SHOULD BE EDITING local-config.php !!!!!
*
* DON'T SET ENVIRONMENT SPECIFC SETTINGS IN THIS FILE, THEY BELONG IN local-config.php
*
**/

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
    include( dirname( __FILE__ ) . '/local-config.php' );
} else {
  //echo dirname( __FILE__ ) . '/local-config.php';
  // ** MySQL settings - You can get this info from your web host ** //
  /** The name of the database for WordPress */
  define('DB_NAME', 'code2040');

  /** MySQL database username */
  define('DB_USER', 'root');

  /** MySQL database password */
  define('DB_PASSWORD', '');

  /** MySQL hostname */
  define('DB_HOST', '127.0.0.1');

  /** Database Charset to use in creating database tables. */
  define('DB_CHARSET', 'utf8');

  /** The Database Collate type. Don't change this if in doubt. */
  define('DB_COLLATE', '');
}


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '82)V*{kUDT8h66jE|Hjm:CAun(<7VCmp?]wBP2z9[N$xkVUzY;-`|:~x3k}jpBs0');
define('SECURE_AUTH_KEY',  '8-2Z44Ya`r~HM.wY3iWvexp~)^B#*fM-9L6i}aMs`jU Exm#R_R|V3Q>-)GB=^rz');
define('LOGGED_IN_KEY',    'YAro8 C[NGNWMk7i`oX|}t#;[)+$v.AFei+M-u]opPZh)ru+D^Ym=~dsG8B0`=Al');
define('NONCE_KEY',        'PakE*5m|BcN+YpF4C[2}N7YD?u?:yS$z;z1HJWX=5C_Xutek5`_ >273jO5Q^8P`');
define('AUTH_SALT',        '@sBQ3KQdvX7X$(GO{Y)~q!b>]4<eo.N rn;F6<(`^W(jS=<lzW2/gw|_o)]yX}bH');
define('SECURE_AUTH_SALT', 'cmRa-XlQ8kv*M]RijDJO+NoOzT>dM%<]7rh!9u7c~Pg<.qWWE:q(+ssC}g|#c.`A');
define('LOGGED_IN_SALT',   'o=vUSRon|>8 >){$%z=M7U.cX}R$Fda+1/c-Y<L!vHuEb9X@Gbg?vy&w^+b],7Y-');
define('NONCE_SALT',       'Kch)N/,J|Q-c{)77<eYwNo:A 3A*9v{fizT>]@(6l$^Xa-/L@caQiCrYIV:>67f9');

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
