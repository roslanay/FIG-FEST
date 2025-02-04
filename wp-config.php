<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fig-fest' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
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
define( 'AUTH_KEY',         ')I2%12MG}FLzR IA8#(xR:V<]9O9C_nZE4n]EW9x)eLZ9dBm`7}@?+W-Pen}ryQN' );
define( 'SECURE_AUTH_KEY',  'n@rEu6>%X5FZ<(yNYh%Vyl@z*[^n`/19_og(kiv-Hje__[&uoLl8 yf|TRU>IxAE' );
define( 'LOGGED_IN_KEY',    '$x7b9z2-6)|7~#>tYXPL<YEaevFnX4dazd]?-)NOvuPodcEpkjGFUZD@&j7`dY+m' );
define( 'NONCE_KEY',        '.o,ce#|=:AE_V{)CRO+xDfwljy3:BYafYqe:&=%%q0)>hhpuyU{PN5C$p 6bde3D' );
define( 'AUTH_SALT',        'i#t=yJJY5|6&>^],RJU7ajN-tH=bCHCo~{xvb]evM5|rkKO6W{Y_Bw#{g1sYt~2%' );
define( 'SECURE_AUTH_SALT', 'cD=,.iB4qzpYuuKVR/Y-Q(MSh&Ro$a_F(`hClO&Ib !7bXlkA`fT xVRY!>aPa]O' );
define( 'LOGGED_IN_SALT',   ':%eYPx~l^6ZdfW$fU:NbM]0#+*4-JzAq;LQ!L%g0[Z#:|-&N)?_WdaO_Qz^br^gH' );
define( 'NONCE_SALT',       'Dr7<2Z2:3|KGoO6Z+X5{w#Ug=!Wss$`4$zqY}tMQZrW^&6cqb>K:Tu,]XBz$W,f5' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */


/* Multisite define( 'WP_ALLOW_MULTISITE', true ); */
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'localhost:8888' );
define( 'PATH_CURRENT_SITE', '/fig-fest/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
