<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define( 'DB_NAME', 'sitioweb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Z8n6Bo~6d>#FSeyh-CRH~m9Vm6N%p7>R*2.{t=%W//hal&glrV_?45{mQF>f`ZOc' );
define( 'SECURE_AUTH_KEY',  'ty.L(_vco,CwhcP>(0b0FQu:qZOba@3F0_.x2 l0[t_oJ[>#rNJLKn0XN~48`Kl<' );
define( 'LOGGED_IN_KEY',    '#.J&HnSGY%Ivx_cWn@Xf!|ScO&%M!*h}/YFbFNVCH7ZU#(U$)}6*L7Hsz_4A30Un' );
define( 'NONCE_KEY',        'bjb0-.z([eR6*+WT:&3l|P+![ggZMMN3IUI~^jP#)P&AO4>do6rEcxZ:h@?N=tR}' );
define( 'AUTH_SALT',        'XqI{xJ%O Om/Dn4${*S0PJQz17uD2hdOHw$Z3AND9SKp0OdB/Ws]_D-57N*lo=4~' );
define( 'SECURE_AUTH_SALT', '/D(a/5iegi4!*s/L$s!v84m)4IM^Dh,ocM0k:NK}bFb]?;Mwrzm[NOzK IhJqWkv' );
define( 'LOGGED_IN_SALT',   'UNw4r8pChz36CF=U+Zg~>0,kRZ*SfT$jw,-@]j#_q?W>(fhV6*#3<JNHx!G#>qOM' );
define( 'NONCE_SALT',       'A {fg+3W}I?6fv{Huv5QF-oDQXkbmnni +qo)AOE1<UI>yG5hp)SU9MoVwX,DCBi' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
