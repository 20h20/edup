<?php
	$title = get_field('contact_title');
	$mail = get_field('contact_mail');
	$phone = get_field('contact_phone');
	$adress = get_field('contact_adresse');
	$instagram	= get_field('options_footer_instagram', 'option');
	$linkedin	= get_field('options_footer_linkedin', 'option');
?>
<section class="cbo-contact" itemscope itemtype="http://schema.org/ContactPage">
	<div class="contact-inner cbo-container">
		<?php if($title): ?>
			<div class="content-title cbo-title-1 slide-up" itemprop="headline">
				<?php echo $title ?>
			</div>
		<?php endif; ?>

		<div class="contact-box">
			<div class="box-informations">
				<div class="informations-title cbo-title-2 slide-up">
					Nos contacts
				</div>
				<div class="informations-list">
					<div class="list-el el--mail slide-right">
						<i class="icon icon--mail"></i>
						<?php echo $mail ?>
					</div>
					<div class="list-el el--phone slide-right">
						<i class="icon icon--phone"></i>
						<?php echo $phone ?>
					</div>
					<div class="list-el el--address slide-right">
						<i class="icon icon--home"></i>
						<?php echo $adress ?>
					</div>
				</div>

				<div class="socials-list">
					<div class="socials-title slide-up">
						Suivez-nous
					</div>
					<a class="list-el slide-up" href="<?php echo $instagram ?>" target="_blank" aria-label="Instagram">
						<i class="icon icon--instagram" aria-hidden="true"></i>
					</a>
					<a class="list-el slide-up" href="<?php echo $linkedin ?>" target="_blank" aria-label="LinedIn">
						<i class="icon icon--linkedin" aria-hidden="true"></i>
					</a>
				</div>
			</div>

			<div class="cbo-form form--step slide-up">
				<?php
					$posts = get_field('contact_shortcode');
					if( $posts ):
						foreach( $posts as $p ):
							$cf7_id= $p->ID;
							echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
						endforeach;
					endif;
				?>
			</div>
		</div>
	</div>
</section>