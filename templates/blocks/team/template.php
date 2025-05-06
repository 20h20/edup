<?php
	$title	= get_field('team_title');
	$chapo	= get_field('team_chapo');
?>
<section class="cbo-team">
	<div class="team-inner cbo-container">

		<div class="team-introduction">
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

		<div class="team-list">
			<?php
				if( have_rows('team_list') ):
				while( have_rows('team_list') ): the_row();
				$picture = get_sub_field('picture');
				$name = get_sub_field('name');
				$function = get_sub_field('function');
			?>
				<div class="list-el" itemscope itemtype="http://schema.org/Person">
					<div class="el-inner">
						<div class="inner-picture cbo-picture-cover slide-up">
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
						<div class="inner-content">
							<div class="el-name cbo-title-4 slide-up" itemprop="name">
								<?php echo $name ?>
							</div>
							<div class="el-function cbo-small slide-up" itemprop="jobTitle">
								<?php echo $function ?>
							</div>
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