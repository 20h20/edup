<?php
	$icontitle	= get_field('blocs_icone');
	$maintitle	= get_field('blocs_title');
?>
<section class="cbo-blocs">
	<div class="blocs-inner cbo-container">
		<?php if($maintitle): ?>
			<div class="blocs-title title--icon cbo-title-2 slide-up" itemprop="headline">
				<?php echo $maintitle ?>
				<?php if($icontitle): ?>
					<span class="icon-picture cbo-picture-contain">
						<img
							loading="lazy"
							decoding="async"
							src="<?php echo $icontitle['sizes']['xlarge']; ?>"
							srcset="<?php echo $icontitle['sizes']['small']; ?> 320w, <?php echo $icontitle['sizes']['xlarge']; ?> 768w, <?php echo $icontitle['sizes']['xlarge']; ?> 1024w"
							alt="<?php echo $icontitle['alt']; ?>" sizes="100vw"
							width="20" height="20"
							itemprop="image"
						>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="blocs-list">
			<?php
				if( have_rows('blocs_list') ):
				while ( have_rows('blocs_list') ) : the_row();
				$title	= get_sub_field('title');
				$icon	= get_sub_field('icon');
				$content	= get_sub_field('content');
				$adlink	= get_sub_field('adlink');
				$btxt	= get_sub_field('btxt');
				$bturl	= get_sub_field('bturl');
			?>
				<div class="list-el">
					<?php if($adlink == 1): ?>
						<a class="el-inner slide-up" href="<?php echo $bturl ?>">
					<?php endif; ?>
					<?php if($adlink == 0): ?>
						<span class="el-inner slide-up">
					<?php endif; ?>

						<span class="inner-content">
							<?php if($title): ?>
								<span class="inner-title cbo-title-3 slide-up">
									<?php if($icon): ?>
										<span class="inner-icon cbo-picture-contain">
											<img
												loading="lazy"
												decoding="async"
												src="<?php echo $icon['sizes']['xlarge']; ?>"
												srcset="<?php echo $icon['sizes']['small']; ?> 320w, <?php echo $icon['sizes']['xlarge']; ?> 768w, <?php echo $icon['sizes']['xlarge']; ?> 1024w"
												alt="<?php echo $icon['alt']; ?>" sizes="100vw"
												width="20" height="20"
												itemprop="image"
											>
										</span>
									<?php endif; ?>

									<?php echo $title ?>
								</span>
							<?php endif; ?>

							<?php if($content): ?>
								<span class="content-text slide-up">
									<?php echo $content ?>
								</span>
							<?php endif; ?>
						</span>

						<?php if($adlink == 1): ?>
							<span class="cbo-button">
								<?php echo $btxt ?>
							</span>
						<?php endif; ?>
					<?php if($adlink == 1): ?>
						</a>
					<?php endif; ?>
					<?php if($adlink == 0): ?>
					</span>
				<?php endif; ?>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>