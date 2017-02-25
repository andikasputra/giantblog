<article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		if ( is_single() ) : 
			the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<p class="date"><?php the_date(); ?> on <?php the_category( ', ' ); ?></p>
		<?php
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
	</header> <!-- entry-header -->
	<div class="entry-content">
		<?php 
			if ( ! is_single() ) :
				the_excerpt(); ?>
				<p class="date"><?php the_date(); ?> on <?php the_category( ', ' ); ?></p>
			<?php
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
				<span class="icon-pricetags"></span>
				<?php 
				if ( get_the_tags() ) : 
					the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' );
				else :
					echo '<ul class="tags"><li><a href="">no tags</a></li></ul>';
				endif; ?>
			</div>

			<div class="author">
				<figure class="author-figure">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
				</figure>
				<div class="grid left-right author-meta">
					<div class="item-m-8">
						<p><strong><a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a> </strong></p>
						<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
					</div>
					<div class="item-m-4">
						<div class="share">
							<p><strong>SHARE THIS POST</strong></p>
							<button class="twitter" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>','','width=500px,height=500px')"><i class="icon-twitter"></i></button>
							<button class="facebook" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>','','width=500px,height=500px')"><i class="icon-facebook"></i></button>
							<button class="google" title="Share on Google Plus" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','','width=500px,height=500px')"><i class="icon-googleplus"></i></button>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<?php 
	endif; ?>
</article>
<?php 
if ( is_single() ) : 
	$orig_post = $post;
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	// print_r($tags);
	if ( $tags ) :
		foreach ( $tags as $tag ) $tag_ids[] = $tag->term_id;
		// print_r($tag_ids);
		$args = array(
			'tag__in' => $tag_ids,
			'post__not_in' => array( $post->ID ),
			'posts_per_page' => 2,
			'caller_get_posts' => 1
		);
		$related_posts = new WP_Query( $args );

		if ( $related_posts->have_posts() ) :
			echo '<div class="related-posts">';
			echo '<h4>Related Posts</h4>';
			echo '<div class="grid">';
			while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				echo '<div class="item-s-6">'; ?>
					<div class="related-item">
						<div class="img">
							<img src="<?php the_post_thumbnail_url() ?>" alt="">
						</div>
						<div class="text">
							<h5><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
						</div>
					</div>
				<?php
				echo '</div>';
			endwhile;
			echo '</div>';
		endif;
		$post = $orig_post;
		wp_reset_query();
	endif ?>

<?php 
endif; ?>