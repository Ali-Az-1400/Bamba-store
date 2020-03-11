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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bamba store' );

/** MySQL database username */
define( 'DB_USER', 'Ali' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Ali12345' );

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
define( 'AUTH_KEY',         'ig6Mygxm^Ik:1C` ]6f|zahI1:Z`x 89i[ke(FQ}Z3qd<K9CitQH&A!r }*4%J}k' );
define( 'SECURE_AUTH_KEY',  'A>=F5%nW(0MBzaKzLwZ{c$xe7Ds+NJ%qS0B*2 Z5^z@0Z[D.WG0:*LQ2R1`]!/nX' );
define( 'LOGGED_IN_KEY',    ')3-pjyS_Z&)_s}#}TR*TB%R?X1JdYTY~+1zPh #koQB]*M<}/6KAIDN%Wm-`@YTL' );
define( 'NONCE_KEY',        'U;lP_vMyrU.0AdN#bT;dOQ3~b;JY9fOtRf[T{r3Q2EM>hX]MdVraGX>>=[w{z+;:' );
define( 'AUTH_SALT',        'w0X<FF:icc_<QZvqdIKDyd-Z +rm1i7#SR`Dl,h4>Aor[i j!X!w9K8ZA{`DtoD ' );
define( 'SECURE_AUTH_SALT', 'j$DQOx?FA%f49p#o,X^3S<Pxw`7aGDK+}PlGrRHBp2XE!xikU2UHkK2&wNwh0ruH' );
define( 'LOGGED_IN_SALT',   ':.e|n:=oUJMT9{%.P{pSVg j&*PyX}K!wz&c/W5Mf;q^b^d/}&Ai#}XJ.w#cb<R@' );
define( 'NONCE_SALT',       'kq-[ O;wCpN{Fms6hUH 6>[.BQ11Q]EBkBEFI3N;+]E q9*4$24,`81$qUVte;&j' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
