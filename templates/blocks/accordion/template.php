<?php
	$title	= get_field('accordion_title');
	$subtitle	= get_field('accordion_subtitle');
	$chapo	= get_field('accordion_description');
?>
<section class="cbo-accordion">
	<div class="accordion-inner cbo-container container--padding container--nomargin">

		<div class="accordion-box">
			<div class="box-content">
				<?php if($title): ?>
					<div class="accordion-title cbo-title-2 slide-up" itemprop="headline">
						<?php echo $title ?>
					</div>
				<?php endif; ?>

				<?php if($subtitle): ?>
					<div class="accordion-subtitle cbo-title-3 slide-up">
						<?php echo $subtitle ?>
					</div>
				<?php endif; ?>

				<?php if($chapo): ?>
					<div class="accordion-chapo slide-up">
						<?php echo $chapo ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="accordion-list">
				<?php
					if( have_rows('accordion_list') ):
					while ( have_rows('accordion_list') ) : the_row();
					$title	= get_sub_field('title');
					$content = get_sub_field('content');
				?>
					<div class="list-el">
						<span class="el-title slide-up">
							<?php echo $title ?>
							<i class="icon icon--more"></i>
						</span>

						<div class="el-content cbo-cms">
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