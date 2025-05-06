<?php
	get_header();

	$post_type = get_post_type();
	$categories = array();
	$logo	= get_field('casestudie_logo');

	if ( $post_type === 'casestudies' ) {
		$categories = get_the_terms( get_the_ID(), 'casestudies_cat' );
	}
	$categories_list = '';

	$parent_category_id = get_term_by('slug', 'thematiques', 'casestudies_cat')->term_id;

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $category ) {
			if ( term_is_ancestor_of( $parent_category_id, $category->term_id, 'casestudies_cat' ) ) {
				$categories_list .= '<span class="tag">' . esc_html( $category->name ) . '</span>';
			}
		}
	}
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('cbo-page page--news news--single'); ?>>
		<section class="single-hero">
			<div class="hero-inner cbo-container">
				<h1 class="hero-title cbo-title-1 slide-up" itemprop="headline">
					<?php the_title(); ?>
				</h1>
				<div class="infomations-list slide-up">
					<span class="list-el">
						<?php echo $categories_list; ?>
					</span>
					<span class="list-el">
						<?php echo get_the_author(); ?>
					</span>
					<time class="list-el" itemprop="datePosted" datetime="<?php echo get_the_date(); ?>">
						<?php echo get_the_date(); ?>
					</time>
				</div>
				<div class="hero-picture cbo-picture-cover slide-up">
					<?php the_post_thumbnail( 'small', array( 'sizes' => '(max-width:320px) 145px, (max-width:425px) 220px, 500px' ) );?>
				</div>
			</div>
		</section>

		<?php
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		?>


		<section class="cbo-relation">
			<div class="relation-inner cbo-container container--padding container--nomargin">

				<div class="relation-title title--icon cbo-title-2 slide-up" itemprop="headline">
					Cas clients similaires
				</div>

				<div class="relation-list articles-list">
					<?php
						$current_cat = get_queried_object();
						$categories = get_the_terms($current_cat->ID, 'casestudies_cat');
						if ($categories && !is_wp_error($categories) && !empty($categories)) {
							$current_category = $categories[0]->slug;
							$event_id = get_the_ID();
							$args = array(
								'post_type' => 'casestudies',
								'posts_per_page' => 3,
								'tax_query' => array(
									array(
										'taxonomy' => 'casestudies_cat',
										'field'    => 'slug',
										'terms'    => $current_category,
									),
								),
								'post__not_in' => array($event_id), 
							);
							$query = new WP_Query($args);
							if ($query->have_posts()) :
								while ($query->have_posts()) : $query->the_post();
									get_template_part('templates/content/content', 'case');
								endwhile;
								wp_reset_postdata();
							else :
								echo 'Aucune étude de cas.';
							endif;
						} else {
							echo 'Aucune catégorie associée à cet article.';
						}
					?>
				</div>

				<div class="relation-button">
					<a href="<?php echo home_url(); ?>/nos-etude-de-cas/" class="cbo-button">Toutes les études de cas</a>
				</div>
			</div>
		</section>
	</article>
<?php
	get_footer();
?>