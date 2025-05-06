<?php
	get_header();

	$post_type = get_post_type();
	$categories = array();
	
	if ( $post_type === 'post' ) {
		$categories = get_the_category();
	}
	
	$categories_list = '';
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $category ) {
			$color = get_field('category_color', $category);
			$category_link = get_category_link( $category->term_id );
			$categories_list .= '<a href="' . esc_url( $category_link ) . '" class="category-link">';
			$categories_list .= '<span class="tag cbo-small" style="background:' . esc_attr( $color ) . '" itemprop="articleSection">' . esc_html( $category->name ) . '</span>';
			$categories_list .= '</a>';
		}
	}

	$btactive	= get_field('ressource_btactive');
	$buttontxt	= get_field('ressource_buttontxt');
	$popintitle	= get_field('ressource_popintitle');
	$popindesc	= get_field('ressource_popindesc');
	$form	= get_field('ressource_form');
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('cbo-page page--news news--single'); ?> itemscope itemtype="http://schema.org/BlogPosting">

		<?php if($btactive){ ?>
			<div id="myModal" class="cbo-modale" role="dialog">
				<div class="modale-inner">
					<button type="button" class="modale-close" id="myModal-close" aria-label="Fermer la fenêtre">
						<span class="top"></span>
						<span class="bottom"></span>
					</button>
					<div class="modale-content">
						<?php if($popintitle): ?>
							<span class="modale-title cbo-title-3">
								<?php echo $popintitle ?>
							</span>
						<?php endif; ?>

						<?php if($popindesc): ?>
							<span class="modale-desc cbo-cms">
								<?php echo $popindesc ?>
							</span>
						<?php endif; ?>
					</div>

					<div class="cbo-form">
						<?php echo $form ?>
						
					</div>
				</div>
				<div class="modale-overlay" id="myModal-close"></div>
			</div>
		<?php } ?>

		<section class="cbo-herorich">
			<div class="herorich-inner cbo-container container--padding">
				<div class="herorich-picture cbo-picture-contain slide-up">
					<?php the_post_thumbnail( 'small', array( 'sizes' => '(max-width:320px) 145px, (max-width:425px) 220px, 500px' ) );?>
				</div>

				<div class="herorich-content">
					<div class="herorich-cat slide-up">
						<span class="list-el">
							<?php
								foreach((get_the_category()) as $category){
									echo $category->name." ";
									echo category_description($category);
								}
							?>
						</span>
					</div>
					<h1 class="herorich-title cbo-title-1 slide-up" itemprop="headline">
						<?php the_title(); ?>
					</h1>

					<div class="herorich-desc cbo-cms slide-up">
						<?php the_excerpt(); ?>
					</div>

					<?php if($btactive){ ?>
						<a href="#" class="herorich-button cbo-button button-modale slide-up">
							<?php echo $buttontxt ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</section>

		<div class="cbo-breadcrumb slide-up">
			<div class="breadcrumb-inner cbo-container container--nomargin slide-up" itemprop="breadcrumb">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div class="breadcrumb-inner">','</div>');
				} ?>
			</div>
		</div>

		<?php
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		?>

		<div class="cbo-social">
			<div class="social-inner cbo-container container--nomargin">
				<div class="share-title">
					Partager sur :
				</div>
				<a href="#" id="linkedin-share-button" class="social-icon" target="_blank">
					<i class="icon icon--linkedin"></i>
				</a>
			</div>
		</div>

		<section class="cbo-relation">
			<div class="relation-inner cbo-container container--padding container--nomargin">

				<div class="relation-title cbo-title-2 slide-up">
					Articles similaires
				</div>

				<div class="articles-list ">
					<?php
						$current_cat = get_queried_object();
						$categories = get_the_terms($current_cat->ID, 'category');
						if ($categories && !is_wp_error($categories) && !empty($categories)) {
							$current_category = $categories[0]->slug;
							$event_id = get_the_ID();
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 3,
								'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field'    => 'slug',
										'terms'    => $current_category,
									),
								),
								'post__not_in' => array($event_id), 
							);
							$query = new WP_Query($args);
							if ($query->have_posts()) :
								while ($query->have_posts()) : $query->the_post();
									get_template_part('templates/content/content', 'article');
								endwhile;
								wp_reset_postdata();
							else :
								echo 'Aucun article similaire';
							endif;
						} else {
							echo 'Aucune catégorie associée à cet article.';
						}
					?>
				</div>

				<div class="relation-button">
					<a href="<?php echo home_url(); ?>/nos-actualites/" class="cbo-button">Tous les articles</a>
				</div>
			</div>
		</section>
	</article>
<?php
	get_footer();
?>