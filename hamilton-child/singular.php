<?php

get_header();

if (have_posts()) :

	while (have_posts()) : the_post(); ?>

		<article <?php post_class('entry section-inner'); ?>>

			<header class="page-header section-inner thin<?php if (has_post_thumbnail()) echo ' fade-block'; ?>">

				<div>

					<?php

					the_title('<h1 class="title entry-title">', '</h1>');

					// Only output post meta data on single
					if (is_single()) : ?>

						<div class="meta">

							<?php
							echo __('', 'hamilton') . ' ';
							the_category(', ');
							?>

						</div><!-- .meta -->

					<?php endif;

					// Make sure we have a custom excerpt
					if (has_excerpt()) the_excerpt();
					?>

				</div>

			</header><!-- .page-header -->

			<?php if (has_post_thumbnail() && !post_password_required()) : ?>

				<figure class="entry-image featured-image">
					<?php the_post_thumbnail(); ?>
				</figure>

			<?php endif; ?>

			<div class="entry-content section-inner thin">

				<?php
				the_content();
				?>

			</div><!-- .content -->

			<?php

			wp_link_pages(array(
				'before' => '<p class="section-inner thin linked-pages">' . __('Pages:', 'hamilton'),
			));

			if (get_post_type() == 'post') : ?>

				<div class="meta bottom section-inner thin">

					<?php if (get_the_tags()) : ?>

						<p class="tags"><?php the_tags('<span>#', '</span><span>#', '</span> '); ?></p>

					<?php endif; ?>

				</div><!-- .meta -->

			<?php endif; ?>

			<?php

			// Output comments wrapper if comments are open, or if there's a comment number – and check for password
			if ((comments_open() || get_comments_number()) && !post_password_required()) : ?>

				<div class="section-inner thin">
					<?php comments_template(); ?>
				</div><!-- .section-inner -->

			<?php endif; ?>

		</article><!-- .entry -->

		<?php
		previous_post_link('<div class="previous">%link</div>', '%title');
		next_post_link('<div class="next">%link</div>', '%title');
		?>
<?php

		if (get_post_type() == 'post') get_template_part('related-posts');

	endwhile;

endif;

get_footer(); ?>