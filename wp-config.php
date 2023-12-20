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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '5]kDqaPq(>Q+,z-u`?JMT=QcB3([X~n]=d1lUT V9;tIPbhwOY:QXwZX6T<IGpH=' );
define( 'SECURE_AUTH_KEY',   '_OB``gq6*%dS3*;9kr[U6Vq``>fIbJ9NFJ.3@t^i{>AH=[IQv4C{e:cebYN1am1_' );
define( 'LOGGED_IN_KEY',     'P D@MBw9M$+0qY{I *_pX< uYZ|>njIllN&L0Uj3o?^85o:jBDe*R5%Oq4Y!OWSm' );
define( 'NONCE_KEY',         'b?DJ:)+OE$>4Nh/#!S{87~>IU?q3rz]G>ra>G8R/xy24Z*B8}m]0]C7Cy7jmXFW!' );
define( 'AUTH_SALT',         '0m|o3x:*VY:=QCAg#yv;0+;61C4Oda?{Ey]`f1IglAU9pT~@t(?pc`4,n#~|3P/U' );
define( 'SECURE_AUTH_SALT',  'K`TKF3Cmjag.DhA4QO^3kPf-k0?6H>z|Eo#ie=[bOS>Zgvkrfg=G.@TeD1?UT[zW' );
define( 'LOGGED_IN_SALT',    '$U^^_6j:&Dm5Ag3I # 730[@~@C]dSmy!GWrc>B|o0Pa^<QZF]Xh:?`x#F<Q8{.`' );
define( 'NONCE_SALT',        '%ZcDTP/ylQ9yt5b&^8[GD3`Mm=x]{B:]IU1^&aTM| Tu`#wN5&D^zf.COFf<kcEB' );
define( 'WP_CACHE_KEY_SALT', 'Lsb,Y&>h %FD?)6&?[xJx|w5Yvtg8]% zPQ1c4Lc;!40L2+=VvbbPcu)SDiUN)uG' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
