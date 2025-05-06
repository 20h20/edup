<?php
	$icontitle	= get_field('slidetextpicture_icon');
	$maintitle	= get_field('slidetextpicture_title');
?>
<section class="cbo-slidetextpicture">
	<div class="slidetextpicture-inner cbo-container">

		<?php if($maintitle): ?>
			<div class="slidetextpicture-title title--icon cbo-title-2 slide-up" itemprop="headline">
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

		<div class="slidetextpicture-list">
			<?php
				if( have_rows('slidetextpicture_list') ):
				while ( have_rows('slidetextpicture_list') ) : the_row();
				$title	= get_sub_field('title');
				$content = get_sub_field('content');
				$picture = get_sub_field('picture');
				$position = get_sub_field('pictureposition');
			?>
				<div class="list-el">
					<div class="el-inner inner--<?php echo $position; ?>">
						<div class="inner-picture cbo-picture-cover">
							<img
								decoding="async"
								src="<?php echo $picture['sizes']['small']; ?>"
								srcset="<?php echo $picture['sizes']['small']; ?> 320w, <?php echo $picture['sizes']['xlarge']; ?> 768w, <?php echo $picture['sizes']['xlarge']; ?> 1024w"
								alt="<?php echo $picture['alt']; ?>" sizes="100vw"
								loading="lazy"
								width="768" height="768"
								itemprop="image"
							>
						</div>
						<div class="inner-content">
							<?php if($title): ?>
								<div class="content-title cbo-chapo" itemprop="headline">
									<?php echo $title ?>
								</div>
							<?php endif; ?>
							<?php if($content): ?>
								<div class="content-text cbo-cms">
									<?php echo $content ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>



