
<?php
	$maintitle	= get_field('clients_title');
?>
<section class="cbo-clients">
	<div class="clients-inner cbo-container">
		<?php if($maintitle): ?>
			<div class="clients-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo $maintitle ?>
			</div>
		<?php endif; ?>

		<div class="clients-list">
			<?php
				if( have_rows('clients_list') ):
				while( have_rows('clients_list') ): the_row();
				$picture = get_sub_field('picture');
				$link = get_sub_field('link');
			?>
				<a class="list-el" href="<?php echo $link ?>" target="_blank" itemscope itemtype="https://schema.org/Organization">
					<span class="el-inner cbo-picture-contain">
						<img
							src="<?php echo $picture['sizes']['small']; ?>"
							srcset="<?php echo $picture['sizes']['small'] ?> 320w, <?php echo $picture['sizes']['small'] ?> 768w, <?php echo $picture['sizes']['small'] ?> 1024w"
							alt="<?php echo $picture["alt"]; ?>"
							loading="lazy"
							width="290" height="140"
							itemprop="logo"
						>
					</span>
					<meta itemprop="url" content="<?php echo $link ?>">
				</a>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>