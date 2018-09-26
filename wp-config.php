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
define('DB_NAME', 'wp_theme');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'inx@!123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'gY1@LlpLm3sz_jb,|e&2Fblg^BaYLz^+.p71MYK7<D&Nt.,hR<ckaNi8KF$e?R{R');
define('SECURE_AUTH_KEY',  '1a%imw#u1nYFWZtyz?hX=yKOmQG!QRo `{2?0Ymo~8pjs?NC4t{?~bbjxmx9Mpz<');
define('LOGGED_IN_KEY',    '[I{X&-/S3*Y1<)F.XpCY3mZ#q6?q;9KG~X{$?,AP<hSu9/U-zI,sb u<5DAF@4=n');
define('NONCE_KEY',        'fjqxcaew*2ntmHHH5d<<BZjU~tkdGPMYG<!Y( :OpU.J.9w,7]>D].Xh-HW2.]lU');
define('AUTH_SALT',        'jmJbGt^9i@lOcy#]=Q)a6af2 X+c-Ka%@N`P2reGozs`6rn,L)7YUGn^yHB ~yQ(');
define('SECURE_AUTH_SALT', 'kz}-VzH%56!CWl8z@nvQ7x,-^iZ_2*0Wo7t8vV?AIZFeO(k~haD~uY+S2%Wi+DVn');
define('LOGGED_IN_SALT',   '>N.m_|Exu_%/HLfn0WN.u VCl0wtAC%&_YQ-v=`)ldAp,R(PI:iGo(jDom6kFjwl');
define('NONCE_SALT',       '*Y~nK8C9DJHUveV/p4$EoT%k>m])TG+RIO7A}LgP @|5,Kiz]`mkI>k0kmw/!fg$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpt_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
