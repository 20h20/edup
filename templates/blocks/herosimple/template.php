<?php
	$title	= get_field('herosimple_title');
	$content	= get_field('herosimple_content');
	$type	= get_field('herosimple_media');
	$picture	= get_field('herosimple_picture');
	$video	= get_field('herosimple_video');
	$addbt	= get_field('herosimple_addbt');
	$btxt	= get_field('herosimple_btxt');
	$bturl	= get_field('herosimple_bturl');
	$addbt2	= get_field('herosimple_addbt2');
	$btxt2	= get_field('herosimple_btxt2');
	$bturl2	= get_field('herosimple_bturl2');
	$breadcrumb	= get_field('herosimple_breadcrumb');
?>
<section class="cbo-herosimple">
	<div class="herosimple-picture cbo-picture-cover">
		<?php if($type == 'picture'): ?>
			<img
				decoding="async"
				src="<?php echo $picture['sizes']['xlarge']; ?>"
				srcset="<?php echo $picture['sizes']['small']; ?> 320w, <?php echo $picture['sizes']['xlarge']; ?> 768w, <?php echo $picture['sizes']['xlarge']; ?> 1024w"
				alt="<?php echo $picture['alt']; ?>" sizes="100vw"
				width="200" height="1500"
				itemprop="image"
			>
		<?php endif; ?>

		<?php if($type == 'video'): ?>
			<video autoplay="autoplay" itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
				<source loading="lazy" type="video/mp4" src="<?php echo $video['url'] ?>" itemprop="contentUrl">
			</video>
		<?php endif; ?>
	</div>

	<div class="herosimple-inner cbo-container container--nomargin container--padding">
		<div class="herosimple-content">
			<?php if($title): ?>
				<h1 class="herosimple-title cbo-title-1 slide-up" itemprop="headline">
					<?php echo $title; ?>
				</h1>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="herosimple-chapo cbo-chapo slide-up">
					<?php echo $content; ?>
				</div>
			<?php endif; ?>

			<?php if($addbt == 1): ?>
				<div class="herosimple-buttons slide-up">
					<a class="cbo-button" href="<?php echo $bturl ?>" itemprop="url">
						<?php echo $btxt ?>
					</a>

					<?php if($addbt2 == 1): ?>
						<a class="cbo-button button--white" href="<?php echo $bturl2 ?>" itemprop="url">
							<?php echo $btxt2 ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if($breadcrumb == 1): ?>
	<div class="cbo-breadcrumb">
		<div class="breadcrumb-inner cbo-container container--nomargin slide-up" itemprop="breadcrumb">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<div class="breadcrumb-inner">','</div>');
			} ?>
		</div>
	</div>
<?php endif; ?>