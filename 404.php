<?php
	get_header();
?>
	<div class="cbo-page page-404">
		<section class="cbo-herosimple">
			<div class="herosimple-inner cbo-container">
				<div class="herosimple-container">
					<div class="herosimple-content">
						<h1 class="herosimple-title cbo-title-1 slide-up" itemprop="headline">
							Erreur 404
						</h1>
						<div class="herosimple-chapo cbo-title-2 slide-up">
							La page que vous recherchez n'existe pas.<br />Vous pouvez toujours revenir sur vos pas.
						</div>
						<a class="cbo-button button--white slide-up" href="<?php echo home_url(); ?>">
							Revenir à l'accueil
						</a>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php
	get_footer();
?>