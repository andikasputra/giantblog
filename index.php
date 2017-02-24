<?php get_header(); ?>
	<header id="masthead" class="site-header" role="banner">
		<img src="<?php header_image(); ?>" class="header-image">
		<div class="container fluid">
			<div class="grid center">
				<div class="item-12 item-s-10 item-m-8">
					<div class="site-branding aligncenter">
						<?php 
						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

							<?php 
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description ?></p>
						<?php
							endif;
						endif; ?>
					</div> <!-- site-branding -->
				</div> <!-- item -->
			</div> <!-- wrapper -->
		</div> <!-- container -->
	</header>
	<div class="container">
		<div class="grid center">
			<div class="item-12 item-s-10 item-m-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php 
						if ( have_posts() ) :
							if ( is_home() && ! is_front_page() ) : ?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
							<?php 
							endif;

							/* start the loop */
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', get_post_format() );
							endwhile;

						else :
							get_template_part( 'template-parts/content', 'none' );
						endif; ?>
					</main>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>