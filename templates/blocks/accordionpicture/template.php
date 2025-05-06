<?php
	$title	= get_field('accordionpicture_title');
	$picture	= get_field('accordionpicture_picture');
?>
<section class="cbo-accordionpicture">
	<div class="accordionpicture-inner cbo-container container--padding container--nomargin">

		<?php if($title): ?>
			<div class="accordionpicture-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo $title ?>
			</div>
		<?php endif; ?>

		<div class="accordionpicture-box">
			<div class="box-picture cbo-picture-cover slide-up">
				<img
					src="<?php echo $picture['sizes']['small']; ?>"
					srcset="<?php echo $picture['sizes']['small'] ?> 320w, <?php echo $picture['sizes']['small'] ?> 768w, <?php echo $picture['sizes']['medium'] ?> 1024w"
					alt="<?php echo $picture["alt"]; ?>"
					loading="lazy"
					width="300" height="300"
					decoding="async"
					itemprop="image"
				>
			</div>

			<div class="accordionpicture-list">
				<?php
					if( have_rows('accordionpicture_list') ):
					while ( have_rows('accordionpicture_list') ) : the_row();
					$title	= get_sub_field('title');
					$content = get_sub_field('content');
					$link = get_sub_field('link');
				?>
					<div class="list-el">
						<span class="el-title cbo-title-3 slide-up">
							<?php echo $title ?>

							<?php if($link): ?>
								<a href="<?php echo $link ?>">
									<i class="icon icon--arrow-next"></i>
								</a>
							<?php endif; ?>
						</span>

						<div class="el-content cbo-cms slide-up">
							<?php echo $content ?>
						</div>
					</div>
				<?php
					endwhile;
					endif;
				?>
			</div>
		</div>
	</div>
</section>