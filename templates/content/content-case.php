<?php
	$logo = get_field('casestudie_logo', get_the_ID());
	$post_type = get_post_type();
	$categories = array();

	if ($post_type === 'casestudies') {
		$categories = get_the_terms(get_the_ID(), 'casestudies_cat');
	}

	$categories_list = '';
	$parent_category = get_term_by('slug', 'thematiques', 'casestudies_cat');
	$parent_category_id = $parent_category ? $parent_category->term_id : 0;

	if (!empty($categories) && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			if (term_is_ancestor_of($parent_category_id, $category->term_id, 'casestudies_cat')) {
				$color = get_field('category_color', $category);
				$categories_list .= '<span class="tag cbo-small" style="background:' . esc_attr($color) . '" itemprop="articleSection">' . esc_html($category->name) . '</span>';
			}
		}
	}

	$excerpt = get_the_excerpt();
	$limited_excerpt = wp_trim_words($excerpt, 16, '...');
?>
<article <?php post_class('el--case slide-up'); ?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<a class="el-inner" href="<?php the_permalink(); ?>" itemprop="url">
		<span class="el-picture">
			<span class="tags-list slide-up">
				<?php echo $categories_list; ?>
			</span>
			<span class="picture-inner cbo-picture-contain slide-up">
				<?php if ($logo && isset($logo['sizes']['small'])) : ?>
					<img
						src="<?php echo esc_url($logo['sizes']['small']); ?>"
						srcset="<?php echo esc_url($logo['sizes']['small']); ?> 320w,
								<?php echo esc_url($logo['sizes']['small']); ?> 768w,
								<?php echo esc_url($logo['sizes']['medium']); ?> 1024w"
						alt="<?php echo esc_attr($logo['alt']); ?>"
						loading="lazy"
						width="160" height="160"
						decoding="async"
					>
				<?php endif; ?>
			</span>
		</span>
		<span class="el-content">
			<span class="content-top">
				<h3 class="content-title cbo-title-3" itemprop="headline">
					<?php the_title(); ?>
				</h3>
				<span class="content-text">
					<?php echo $limited_excerpt; ?>
				</span>
			</span>
			<span class="cbo-button button--border">
				Voir le cas client
			</span>
		</span>
	</a>
</article>
