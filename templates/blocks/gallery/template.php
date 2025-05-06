<?php
	$galerie	= get_field('gallery_list');
?>
<section class="cbo-gallery">
	<div class="gallery-inner cbo-container">
		<div class="gallery-list">
			<?php 
				if( $galerie ):
				foreach( $galerie as $image ):
			?>
				<div class="list-el">
					<div class="el-inner cbo-picture-cover">
						<img
							src="<?php echo $image['sizes']['small']; ?>"
							srcset="<?php echo $image['sizes']['small'] ?> 320w, <?php echo $image['sizes']['small'] ?> 768w, <?php echo $image['sizes']['small'] ?> 1024w"
							alt="<?php echo $image["alt"]; ?>"
							loading="lazy"
							width="500" height="500"
						>
					</div>
				</div>
			<?php 
				endforeach;
				endif;
			?>
		</div>
	</div>
</section>