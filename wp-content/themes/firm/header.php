<?php
/**
 * The header for our theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
	<div class="header_inner">
		<div class="grid-container">
			<div class="grid-25 tablet-grid-25 mobile-grid-100 ">
				<div class="logo">
					<?php 	
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						if ( has_custom_logo() ) {
						        echo '<img class="logo_img" src="'. esc_url( $logo[0] ) .'">';
						} else {
						        echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
						}
					?>
				</div>
			</div>
			<div class="grid-75 tablet-grid-75 mobile-grid-100 ">
				<div class="header_menu">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</header>
	