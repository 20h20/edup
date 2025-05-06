<?php
	get_header();
	$title	= get_field('options_casestudies_title', 'option');
	$content	= get_field('options_casestudies_content', 'option');
	$picture	= get_field('options_casestudies_picture', 'option');
?>
	<div class="cbo-page page--archive page--casestudies">
		<section class="cbo-herosimple">
			<div class="herosimple-picture cbo-picture-cover">
				<img
					loading="lazy"
					decoding="async"
					src="<?php echo $picture['sizes']['xlarge']; ?>"
					srcset="<?php echo $picture['sizes']['small']; ?> 320w, <?php echo $picture['sizes']['xlarge']; ?> 768w, <?php echo $picture['sizes']['xlarge']; ?> 1024w"
					alt="<?php echo $picture['alt']; ?>" sizes="100vw"
					width="200" height="1500"
					itemprop="image"
				>
			</div>

			<div class="herosimple-inner cbo-container container--nomargin container--padding">
				<div class="herosimple-content">
					<h1 class="herosimple-title cbo-title-1 slide-up" itemprop="headline">
						<?php echo $title; ?>
					</h1>

					<div class="herosimple-chapo cbo-chapo slide-up">
						<?php echo $content; ?>
					</div>
				</div>
			</div>
		</section>

		<div class="cbo-breadcrumb">
			<div class="breadcrumb-inner cbo-container container--nomargin slide-up" itemprop="breadcrumb">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div class="breadcrumb-inner">','</div>');
				} ?>
			</div>
		</div>

		<div class="cbo-container">
			<div class="cbo-filters slide-up">
				<div class="filters-inner">
					<div class="filters-menu">
						Choisir une catégorie
					</div>
					<div class="filters-list">
						<?php
							$all_categories_url = home_url('/nos-etude-de-cas');
							$secteurs_parent = get_term_by('slug', 'secteurs', 'casestudies_cat');
							$thematique_parent = get_term_by('slug', 'thematiques', 'casestudies_cat');

        					if ( $secteurs_parent && $thematique_parent ) {
								$secteurs_children = get_terms(array(
									'taxonomy'	=> 'casestudies_cat',
									'parent'	=> $secteurs_parent->term_id,
									'orderby'	=> 'name',
									'order'	=> 'ASC',
									'hide_empty' => false,
								));

								$thematique_children = get_terms(array(
									'taxonomy'	=> 'casestudies_cat',
									'parent'	=> $thematique_parent->term_id,
									'orderby'	=> 'name',
									'order'	=> 'ASC',
									'hide_empty' => false,
								));
								echo '<a class="list-el el--active" href="' . esc_url($all_categories_url) . '"><span class="el-inner">Toutes les catégories</span></a>';
						?>
							<div class="list-el">
								<select id="secteurs-select" name="secteurs" class="el-inner">
									<option value="">Secteurs</option>
									<?php foreach ($secteurs_children as $child) : ?>
										<option value="<?php echo get_term_link($child->term_id); ?>">
											<?php echo esc_html($child->name); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="list-el">
								<select id="thematique-select" name="thematique" class="el-inner">
									<option value="">Thematiques</option>
									<?php foreach ($thematique_children as $child) : ?>
										<option value="<?php echo get_term_link($child->term_id); ?>">
											<?php echo esc_html($child->name); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<section class="archive-articles">
			<div class="articles-inner cbo-container">
				<div class="articles-list casestudies-list cols--3">
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								get_template_part('templates/content/content','case');
							endwhile;
							echo page_navi();
						else :
							echo '<p class="articles-noarticles cbo-title-3">Aucune étude de cas n\'a été trouvée.</p>';
						endif;
					?>
				</div>
			</div>
		</section>
	</div>
<?php
	get_footer();
?>