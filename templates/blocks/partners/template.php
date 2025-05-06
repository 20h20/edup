<section class="cbo-partners">
	<div class="partners-inner cbo-container container--padding container--nomargin">	
		<div class="partners-list">
			<?php
				if( have_rows('partners_list') ):
				while( have_rows('partners_list') ): the_row();
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