<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body>
	<nav class="navigation fixed-top" id="site-navigation">
		<div class="container">
			<div class="grid left-right">
				<header>
					<div class="brand">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					</div>
					<div class="nav-toggle" id="nav-toggle">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</header>
				<?php 
				wp_nav_menu( array( 
					'theme_location' => 'menu-1',
					'menu_id' => 'primary-menu',
					'container_class' => 'menu'
				) ); ?>
			</div>
		</div>
	</nav>
	<div id="content" class="site-content">