<?php
	get_header();
	$posts_page_id = get_option('page_for_posts');
	$title	= get_field('options_ressources_title', 'option');
	$content	= get_field('options_ressources_content', 'option');
	$picture	= get_field('options_ressources_picture', 'option');
?>
	<div class="cbo-page page--archive">
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

		<section class="archive-articles">
			<div class="articles-inner cbo-container">
				<div class="articles-list">
					<?php
						if ( have_posts() ) :
						while ( have_posts() ) : the_post();
						get_template_part('templates/content/content','article');
						endwhile;
							echo page_navi();
						endif;
					?>
				</div>
			</div>
		</section>
	</div>
<?php
	get_footer();
?>