<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_dss' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'iXR|YfNF)x{9RORDw4A*MV-;]r6@jh<s>=]l S@%;QL/Pl%9mGKrsz(J)1e*?C^>' );
define( 'SECURE_AUTH_KEY',  'F|99/PPwN]KjVJu/0 vO}%-$gngr?[L/l5X[06UG,xehNdlT+3kH3SWRf}WSAx0@' );
define( 'LOGGED_IN_KEY',    's]7-i]-YVHE,,k^l=E:.CogHmeav<TbX2wv)/Co^w;F)sNsY=zEKGU<[r~*6aT^$' );
define( 'NONCE_KEY',        '?Qr.!lzGM8kJ5HmNEYqZ.=Q<9nGPAlFWUWD@Kkw94{+OFB]e!D~S;?:~9a$7@wE(' );
define( 'AUTH_SALT',        'G|bkTyc/tnw|JsA^wM8J-a~h/5B7l)2XyDg|?_e#{f8=q%^C|Xkb. dFVv$K2pKo' );
define( 'SECURE_AUTH_SALT', '2}{9s8];} -B}]<Mf@[tphSxQ KdEjLs^]{NIx<8AxFL~mQg@Wut]+CE-xLb}eB<' );
define( 'LOGGED_IN_SALT',   '0T7~D|C4*X9(mltwmJYq3O=*aCDR:&_[Kr~RP,S>jNnvsglw(CI/EX,<FYjQsR<v' );
define( 'NONCE_SALT',       ',{rl#)C Z(jWTl%rOSSV-a?QV>nNN^Xey,!B|%duoDS@TPYaV1!Z*?Hnc .a%BxM' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_dss_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
