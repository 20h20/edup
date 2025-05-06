<article <?php post_class('list-el'); ?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<a class="el-inner slide-up" href="<?php the_permalink(); ?>" itemprop="url">
		<span class="el-content">
			<h3 class="content-title cbo-title-3 slide-up" itemprop="headline">
				<?php the_title(); ?>
			</h3>
			<span class="content-link cbo-small slide-up">
				Lire l'article <i class="icon icon--arrow-next"></i>
			</span>
		</span>
	</a>
</article>