<?php
	$title	= get_field('partnersrich_title');
	$chapo	= get_field('partnersrich_chapo');
?>
<section class="cbo-partnersrich">
	<div class="partnersrich-inner cbo-container container--padding">

		<div class="partnersrich-introduction">
			<?php if($title): ?>
				<div class="introduction-title cbo-title-2 slide-up" itemprop="headline">
					<?php echo $title ?>
				</div>
			<?php endif; ?>

			<?php if($chapo): ?>
				<div class="introduction-chapo slide-up">
					<?php echo $chapo ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="partnersrich-list">
			<?php
				if( have_rows('partnersrich_list') ):
				while( have_rows('partnersrich_list') ): the_row();
				$picture = get_sub_field('picture');
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$link = get_sub_field('link');
			?>
				<div class="list-el">
					<div class="el-inner">
						<div class="inner-picture cbo-picture-contain slide-up">
							<img
								src="<?php echo $picture['sizes']['small']; ?>"
								srcset="<?php echo $picture['sizes']['small'] ?> 320w, <?php echo $picture['sizes']['small'] ?> 768w, <?php echo $picture['sizes']['medium'] ?> 1024w"
								alt="<?php echo $picture["alt"]; ?>"
								loading="lazy"
								width="150" height="300150"
								decoding="async"
								itemprop="image"
							>
						</div>
						<div class="inner-content">
							<?php if($title): ?>
								<div class="el-title cbo-title-4 slide-up">
									<?php echo $title ?>
								</div>
							<?php endif; ?>

							<?php if($description): ?>
								<div class="el-description slide-up">
									<?php echo $description ?>
								</div>
							<?php endif; ?>

							<?php if($link): ?>
								<a class="el-link slide-up" href="<?php echo $link ?>">
									En savoir plus <i class="icon icon--arrow-next"></i>
								</a>
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