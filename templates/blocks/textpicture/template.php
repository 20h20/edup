<?php
	$title	= get_field('textpicture_title');
	$content	= get_field('textpicture_content');
	$position	= get_field('textpicture_pictureposition');
	$picture	= get_field('textpicture_picture');
	$nosvg	= get_field('textpicture_picturenosvg');
	$cover	= get_field('textpicture_picturecover');
?>
<section class="cbo-textpicture textpicture--<?php echo $position; ?>">
	<div class="textpicture-inner <?php if($nosvg == 1): ?>textpicture--nosvg<?php endif; ?> cbo-container">


		<?php if($nosvg == 0): ?>
			<svg class="textpicture-picture slide-up" viewBox="0 0 500.24 503.64" preserveAspectRatio="xMidYMid slice">
				<defs>
					<clipPath id="shape-clip">
						<path d="M457.05,235.35c26.19,17.73,46.39,45.6,42.77,77.03-10.28,89.29-51.25,149.5-151.05,185.62-50.62,18.32-106.93-11.27-152.05-40.64C117.02,405.46,0,366.75,0,260.5,0,116.63,116.63,0,260.5,0c131.32,0,59.08,142.29,196.55,235.35Z"/>
					</clipPath>
				</defs>
				<image 
					x="0" 
					y="0" 
					width="100%" 
					height="100%" 
					href="<?php echo $picture['sizes']['xlarge']; ?>" 
					preserveAspectRatio="xMidYMid slice" 
					clip-path="url(#shape-clip)"
				/>
			</svg>
		<?php else: ?>
			<div class="textpicture-picture picture--nosvg <?php if($cover == 0): ?>cbo-picture-contain<?php endif; ?> <?php if($cover == 1): ?>cbo-picture-cover<?php endif; ?>">
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
		<?php endif; ?>

		<div class="textpicture-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-2 slide-up" itemprop="headline">
					<?php echo $title ?>
				</div>
			<?php endif; ?>
			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo $content ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>