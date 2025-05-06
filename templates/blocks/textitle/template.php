<?php
	$title = get_field('textitle_title');
	$content = get_field('textitle_content');
?>
<section class="cbo-textitle">
	<div class="textitle-inner cbo-container">
		<div class="textitle-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-2 slide-up">
					<?php echo $title; ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo $content; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>