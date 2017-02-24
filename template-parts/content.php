<article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		if ( is_single() ) : ?>
			<div class="grid">
				<div class="item-4 item-s-3 item-m-2">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
				</div>
				<div class="item-8">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> in <?php the_category( ', ' ); ?>
					<p class="date"><?php the_date(); ?></p>
				</div>
			</div>
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' ); 
		else :
			the_title( '<h2 class="entry-title">', '</h2>' );
		endif; ?>
	</header> <!-- entry-header -->
	<div class="entry-content">
		<?php 
			if ( ! is_single() ) :
				the_excerpt();
			else :
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'giantblog' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'giantblog' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php 
		if ( is_single() ) : ?>
			<footer class="entry-footer">
				<div class="content-tag">
					<span class="icon-tags"></span>
					<?php 
					if ( get_the_tags() ) : 
						the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' );
					else :
						echo '<ul class="tags"><li><a href="">no tags</a></li></ul>';
					endif; ?>
				</div>
			</footer>
		<?php 
		endif; ?>
</article>