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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'insuranceproaz' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ',mF(A;f}/;wVX,FO@!L}y@9++R27Lh!VQ/o;(g=ZrG;DxnP:74<0X[B?wXR<uQ#o' );
define( 'SECURE_AUTH_KEY',  'S8>sa,_]?7ONE&6:,PUi,W(%$O6@n#Hjr18J1lhj42cY%aFeJRJ~,d)cc>z?BotX' );
define( 'LOGGED_IN_KEY',    'W(ffqN.J>vDJ7[sGuU5x 09u-E,QiV;Yp5] H+Ai{NbhDbP.)kNi[9G1ZWRG=m%<' );
define( 'NONCE_KEY',        '9BI(KrH5@ .m&QBCskRaz>mH<@%b= [{X[j=J8|K`A{sVOlYfhLLnsxNwD8Ys2Sa' );
define( 'AUTH_SALT',        '9z;H!Y_|}1Mw?7zB@L$Xw-:v)]UUzX*Pfi_?AjCTX>I{6!}T/TZq:.=F4k7g.LYZ' );
define( 'SECURE_AUTH_SALT', '&k,6R*&vgly@;`SZ_.=VPqJ2Ns}egE=My^TH>.o{JP>]RVM9 jd|hI A={j1mv>^' );
define( 'LOGGED_IN_SALT',   'X;9$MtP8Sg>TmEdN-aShjpqjiqo|B?S:|>;:2[tQ@&N)RUq2c?0L5InGRh ]`8 N' );
define( 'NONCE_SALT',       ';K4wnsj.[lT7wgL_8,QXaYz9CN~)uDX]e]Z..Sy|fv(h,F!5x)4rz5FI rwt@D8{' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
