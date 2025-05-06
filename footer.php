		</div><!-- End main -->

		<?php
			$description	= get_field('options_footer_description', 'option');
			$adress	= get_field('options_footer_adress', 'option');
			$mail	= get_field('options_footer_mail', 'option');
			$phone	= get_field('options_footer_phone', 'option');
			$instagram	= get_field('options_footer_instagram', 'option');
			$linkedin	= get_field('options_footer_linkedin', 'option');
		?>
		<footer itemscope itemtype="http://schema.org/WPFooter" role="contentinfo">
			<div class="footer-inner cbo-container container--padding">
				<div class="footer-identity" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
					<a class="identity-logo cbo-picture-contain slide-up" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
						<img
							decoding="async"
							src="<?php bloginfo('template_directory'); ?>/library/img/logo-edup.svg"
							alt="<?php echo get_bloginfo('description'); ?>" sizes="100vw"
							loading="lazy"
							width="130" height="100"
							itemprop="logo"
						>
					</a>
					<div class="identity-description cbo-chapo slide-up">
						<?php echo $description ?>
					</div>
				</div>

				<div class="footer-infos">
					<div class="infos-address slide-up" itemscope itemtype="http://schema.org/LocalBusiness">
						<?php echo $adress ?>
					</div>
					<a class="infos-mail slide-up" href="mailto:<?php echo $mail ?>">
						<?php echo $mail ?>
					</a>
					<a class="infos-phone slide-up" href="mailto:<?php echo $phone ?>">
						<?php echo $phone ?>
					</a>
				</div>

				<div class="footer-bottom">
					<nav class="bottom-nav cbo-small slide-up" role="navigation" aria-label="Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu( array(
							'theme_location' => 'footer-annexe',
						));?>
					</nav>
					<div class="bottom-social social-list" itemprop="sameAs">
						<a class="list-el slide-up" href="<?php echo $instagram ?>" target="_blank" aria-label="Instagram">
							<i class="icon icon--instagram" aria-hidden="true"></i>
						</a>
						<a class="list-el slide-up" href="<?php echo $linkedin ?>" target="_blank" aria-label="LinedIn">
							<i class="icon icon--linkedin" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?>
		<script defer src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>
	</body>
</html>