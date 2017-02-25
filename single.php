<?php get_header(); ?>
	<header id="masthead" class="site-header" role="banner">
		<?php if ( get_the_post_thumbnail_url() ) : ?>
			<img src="<?php the_post_thumbnail_url(); ?>" class="header-image">
		<?php else : ?>
			<img src="<?php header_image(); ?>" class="header-image">
		<?php endif; ?>
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
							/* start the loop */
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', get_post_format() );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							endwhile;
						?>
					</main>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>