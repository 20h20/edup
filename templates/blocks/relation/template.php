<?php
	$icontitle	= get_field('relation_icone');
	$title	= get_field('relation_title');
?>
<section class="cbo-relation">
	<div class="relation-inner cbo-container container--padding container--nomargin">

		<?php if($title): ?>
			<div class="relation-title title--icon cbo-title-2 slide-up" itemprop="headline">
				<?php echo $title ?>

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

		<div class="relation-list articles-list casestudies-list">
			<?php
				global $post;
				$posts = get_field('relation_list');
				if ($posts):
					foreach ($posts as $post):
						setup_postdata($post);
						$post_type = get_post_type();

						if ($post_type === 'post') {
							get_template_part('templates/content/content', 'article');
						} elseif ($post_type === 'casestudies') {
							get_template_part('templates/content/content', 'case');
						}
					endforeach;
					wp_reset_postdata();
				endif;
			?>
		</div>

	</div>
</section>