<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '>u,:%]LAz_ =_{ZB-iN=KSVLpx]zk8K`gRs])sOj9aOrO_Qpiu6(Lp]C%sQJ.2.n');
define('SECURE_AUTH_KEY',  '`e?[0d%MlAJDXZ qAB6o4sf_N?RGhe-y0jg!m~j^b>fmsUvT>D3-=^cTk,bX=1>!');
define('LOGGED_IN_KEY',    '@B@Y$MGEef5gv-OxCIYQnj9gW;!>t#ke=qhD#lVP%ZwM$nq>e<)ukHLgehSV=juz');
define('NONCE_KEY',        '2UdX(^-5r*uD:`swcN[aLiS<OyJ*`!4;&z6D|_0VF+qu#MwHS6Kns9Z_#(r8[#!e');
define('AUTH_SALT',        'ZoUq*(<`j;~q;Ox:eBmNplwPfIVxAA&`(87x$7`C@$&4.[v1xKs*>1MN_;K+%N{t');
define('SECURE_AUTH_SALT', '`BO@c9AESkN -Ccz+pE-:v]OC#Qo7!4emylzk,l~thD}grgWIELk7&25]H+Yb9^-');
define('LOGGED_IN_SALT',   '~X5is7$UB[qz?P1TuA`zCL)QrC5A]&,^QA0hHJb=[rAjFTg2weQj;]f=l:P(.^e{');
define('NONCE_SALT',       'z8-#~+Za>VQ``Wy$`3lG0VWR_(GjF&>``=$JtaWVsqQEn/q;7yMuJKuEw8KJYWyl');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
